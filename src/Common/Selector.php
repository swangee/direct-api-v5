<?php
/**
 * Created by PhpStorm.
 * User: hollowj
 * Date: 23.05.16
 * Time: 17:14
 */

namespace vedebel\directv5\Common;


class Selector implements \Iterator
{
    protected $selectData = [];

    protected $valid;
    protected $currentKey;
    protected $currentValue;

    /**
     * @param string $property
     * @param $value
     */
    public function addSelection(string $property, $value)
    {
        $property = ucfirst(trim($property));

        if (isset($this->selectData[$property])) {
            if (is_array($this->selectData[$property])) {
                if (is_array($value)) {
                    $valueArray = $value;
                } elseif (is_object($value)) {
                    $valueArray = (array) $value;
                } else {
                    $valueArray = [$value];
                }

                $this->selectData[$property] = array_replace($this->selectData[$property], $valueArray);
            }
        } else {
            $this->selectData[$property] = $value;
        }
    }

    /**
     * @param $property
     * @param $value\
     */
    public function __set($property, $value)
    {
        $this->addSelection($property, $value);
    }

    /**
     * List of methods to implement Iterator
     */

    public function current()
    {
        if (is_null($this->currentKey)) {
            return current($this->selectData);
        }
        return $this->currentValue;
    }

    /**
     * @return mixed
     */
    public function next()
    {
        $element = each($this->selectData);

        if ($element === false) {
            $this->valid = false;
            return;
        }

        $this->currentKey = $element['key'];
        $this->currentValue = $element['value'];
    }

    /**
     * @return int
     */
    public function key()
    {
        if (is_null($this->currentKey)) {
            $key = key($this->selectData);
            next($this->selectData);
            return $key;
        }
        return $this->currentKey;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->valid;
    }

    /**
     *
     */
    public function rewind()
    {
        reset($this->selectData);

        $this->currentKey = null;
        $this->currentValue = null;

        $this->valid = count($this->selectData) > 0;
    }
}