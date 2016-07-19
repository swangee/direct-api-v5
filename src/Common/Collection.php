<?php
namespace vedebel\directv5\Common;

use vedebel\directv5\Common\Object as ObjectItem;

/**
 * Class Collection
 * @package vedebel\directv5\Common
 */
abstract class Collection implements \JsonSerializable, \ArrayAccess, \Iterator
{
    /**
     * @var ObjectItem[]
     */
    protected $collection = [];

    /**
     * @var array
     */
    protected $warnings = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var
     */
    private $position = 0;

    /**
     * Collection constructor.
     * @param array $collection
     */
    public function __construct(array $collection = [])
    {
        $this->collection = $collection;
    }

    /**
     * List of personal methods of this class
     */

    /**
     * @param ObjectItem $item
     */
    public function add(ObjectItem $item)
    {
        $this->collection[] = $item;
    }

    /**
     * @param ObjectItem[] $items
     */
    public function addMany(array $items)
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        $classPath = explode('\\', get_class($this));
        $className = end($classPath);

        return str_replace('Collection', 's', $className);
    }

    /**
     * @param int $id
     * @return int|null
     */
    final public function getIndexById(int $id)
    {
        $index = null;

        foreach ($this->collection as $itemIndex => $item) {
            if ($item->id === $id) {
                $index = (int) $itemIndex;
                break;
            }
        }

        return $index;
    }

    /**
     * @param $itemIndex
     * @param array $errors
     */
    final public function setErrors($itemIndex, array $errors)
    {
        $this->errors[$itemIndex] = [];

        foreach ($errors as $error) {
            $this->errors[$itemIndex][] = new ExceptionNotification($error);
        }

        $this->collection[$itemIndex]->setErrors($errors);
    }

    /**
     * @param $itemIndex
     * @param array $warnings
     */
    final public function setWarnings($itemIndex, array $warnings)
    {
        $this->warnings[$itemIndex] = [];

        foreach ($warnings as $warning) {
            $this->warnings[$itemIndex][] = new ExceptionNotification($warning);
        }

        $this->collection[$itemIndex]->setWarnings($warnings);
    }

    /**
     * @return bool
     */
    final public function hasErrors()
    {
        return count($this->errors) > 0;
    }

    /**
     * @return array
     */
    final public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    final public function hasWarnings()
    {
        return count($this->warnings) > 0;
    }

    /**
     * @return array
     */
    final public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @return int
     */
    final public function getLength()
    {
        return count($this->collection);
    }

    /**
     * @return array
     */
    final public function toArray()
    {
        $array = [];
        
        foreach ($this->collection as $item) {
            $array[] = $item->toArray();
        }
        
        return $array;
    }

    /**
     * Methods for working with collection
     */

    /**
     * Method is for merging two collections. Collections MUST be instances of the same class.
     *
     * @param Collection $collection
     * @return mixed
     */
    public function merge(Collection $collection)
    {
        if (get_class($collection) !== get_called_class()) {
            throw new \InvalidArgumentException(sprintf(
                'Merged collections MUST be instances of the same class. Base collection class: %s, merged collection class: %s',
                get_called_class(),
                get_class($collection)
            ));
        }

        $newCollection = $this->collection;

        foreach ($collection as $item) {
            $newCollection[] = $item;
        }

        $collectionClass = get_called_class();
        return new $collectionClass($newCollection);
    }

    /**
     * @return ObjectItem|null
     */
    public function first()
    {
        reset($this->collection);
        return current($this->collection);
    }

    /**
     * @return ObjectItem
     */
    public function last() : ObjectItem
    {
        return end($this->collection);
    }

    /**
     * @param callable $filterCallback
     * @return Collection
     */
    final public function filter(callable $filterCallback)
    {
        $filtered = [];

        foreach ($this->collection as $item) {
            if ($filterCallback($item)) {
                $filtered[] = $item;
            }
        }

        $collectionClass = get_called_class();
        return new $collectionClass($filtered);
    }

    /**
     * @param string $field
     * @param mixed $filterValue
     * @param string $operator
     * @return Collection
     */
    final public function filterBy(string $field, $filterValue, string $operator = '===') : Collection
    {
        $filtered = [];

        foreach ($this->collection as $item) {
            switch ($operator) {
                case '===':
                    $add = $item->get($field) === $filterValue;
                    break;

                case '!==':
                    $add = $item->get($field) !== $filterValue;
                    break;

                case '!=':
                case '<>':
                    $add = $item->get($field) !== $filterValue;
                    break;

                case '>=':
                    $add = $item->get($field) >= $filterValue;
                    break;

                case '<=':
                    $add = $item->get($field) <= $filterValue;
                    break;

                case '>':
                    $add = $item->get($field) > $filterValue;
                    break;

                case '<':
                    $add = $item->get($field) < $filterValue;
                    break;

                case 'in':
                    if (!is_array($filterValue)) {
                        throw new \UnexpectedValueException(
                            sprintf('Filter value MUST be an array. %s given.', gettype($filterValue))
                        );
                    }

                    $add = array_search($item->get($field), $filterValue) !== false;
                    break;

                default:
                    throw new \InvalidArgumentException(sprintf('Operator %s is not allowed.', $operator));
            }

            if ($add) {
                $filtered[] = $item;
            }
        }

        $collectionClass = get_called_class();
        return new $collectionClass($filtered);
    }

    /**
     * Implementation of JsonSerializable
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->collection;
    }

    /**
     * List of methods to implement Iterator
     */

    public function current()
    {
        return $this->collection[$this->position];
    }

    /**
     * @return mixed
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->offsetExists($this->position);
    }

    /**
     *
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * List of methods to implement ArrayAccess
     */

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->collection[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new \OutOfBoundsException(sprintf('Undefined offset %s', $offset));
        }
        return $this->collection[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->collection[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->collection[$offset]);
    }
}