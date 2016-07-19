<?php
namespace vedebel\directv5\Common;

class Object implements \JsonSerializable
{
    /**
     * @var
     */
    protected $attributes;

    /**
     * @var array
     */
    protected $warnings = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * Object constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = null)
    {
        $this->attributes = is_array($attributes) ? $attributes : [];
    }

    /**
     * @param array $newAttributes
     */
    public function updateAttributes($newAttributes)
    {
        if (is_object($newAttributes)) {
            $newAttributes = (array) $newAttributes;
        }

        if ($constructor = (new \ReflectionObject($this))->getConstructor()) {
            $parameters = $constructor->getParameters();

            foreach ($parameters as $parameter) {
                $parameterName = ucfirst($parameter->name);

                if (isset($newAttributes[$parameterName])) {
                    $this->attributes[$parameterName] = $newAttributes[$parameterName];
                }
            }
        }
    }

    /**
     * @param $object
     * @return Object
     */
    public static function createFromStdObject($object) : Object
    {
        if (is_object($object)) {
            $object = json_decode(json_encode($object), true);
        }

        return self::convertObject($object, get_called_class());
    }

    /**
     * @param $name
     * @return mixed
     */
    final public function __get($name)
    {
        if (!isset($this->attributes[$name])) {
            throw new \OutOfBoundsException(sprintf('Trying to get invalid not set property: %s', $name));
        }

        return $this->attributes[$name];
    }

    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    final public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * @param string $pathString
     * @return mixed
     */
    final public function get(string $pathString)
    {
        $path = explode('.', $pathString);

        $attributes = $this->attributes;
        $currentLevel = &$attributes;

        $leftPath = $path;

        do {
            if (!count($leftPath)) {
                break;
            }

            $pathItem = array_shift($leftPath);

            if (!isset($currentLevel[$pathItem])) {
                break;
            }

            $currentLevel = $currentLevel[$pathItem];

            if (count($leftPath) === 0) {
                return $currentLevel;
            }

        } while ($pathItem);

        throw new \InvalidArgumentException(sprintf('There is no value for path %s', print_r($path, 1)));
    }

    /**
     * @param string $pathString
     * @return bool
     */
    final public function has(string $pathString)
    {
        $path = explode('.', $pathString);

        $attributes = $this->attributes;
        $currentLevel = &$attributes;

        $leftPath = $path;

        do {
            if (!count($leftPath)) {
                break;
            }

            $pathItem = array_shift($leftPath);

            if (!isset($currentLevel[$pathItem])) {
                break;
            }

            $currentLevel = $currentLevel[$pathItem];

            if (count($leftPath) === 0) {
                return true;
            }

        } while ($pathItem);

        return false;
    }

    /**
     * @param string $pathString
     * @param $value
     * @return bool
     */
    final public function set(string $pathString, $value)
    {
        $path = explode('.', $pathString);

        $attributes = $this->attributes;
        $currentLevel = &$attributes;

        do {
            if (!count($path)) {
                break;
            }

            $pathItem = array_shift($path);

            if (!isset($currentLevel[$pathItem])) {
                $currentLevel[$pathItem] = null;
            }

            $currentLevel = &$currentLevel[$pathItem];

            if (count($path) === 0) {
                $currentLevel = $value;

                return true;
            }

            $currentLevel = [];
        } while ($pathItem);

        return false;
    }

    /**
     * @param array $errors
     */
    final public function setErrors(array $errors)
    {
        foreach ($errors as $error) {
            $this->errors[] = new ExceptionNotification($error);
        }
    }

    /**
     * @param array $warnings
     */
    final public function setWarnings(array $warnings)
    {
        foreach ($warnings as $warning) {
            $this->warnings[] = new ExceptionNotification($warning);
        }
    }

    /**
     * @return ExceptionNotification[]
     */
    final public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return ExceptionNotification[]
     */
    final public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @return array
     */
    final public function toArray()
    {
        return $this->jsonSerialize();
    }

    /**
     * Implementation of JsonSerializable
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->prepareAttributesBeforeEncode();
    }

    /**
     * @return array
     */
    protected function prepareAttributesBeforeEncode()
    {
        $preparedAttributes = [];

        foreach ($this->attributes as $attribute => $value) {
            $preparedAttributes[ucfirst($attribute)] = $value;
        }

        return $preparedAttributes;
    }

    /**
     * @param array $arguments
     */
    final protected function setAttributes(array $arguments)
    {
        if ($constructor = (new \ReflectionObject($this))->getConstructor()) {
            $parameters = $constructor->getParameters();

            foreach ($parameters as $key => $parameter) {
                if (isset($arguments[$key])) {
                    $this->attributes[$parameter->name] = $arguments[$key];
                }
            }
        }
    }

    /**
     * @param array $objectData
     * @param $className
     * @return null
     */
    final protected static function convertObject(array $objectData, $className)
    {
        $object = null;

        $classReflection = new \ReflectionClass($className);

        do {
            $methodExists = $classReflection->hasMethod('__construct');

            if (!$methodExists) {
                $classReflection = $classReflection->getParentClass();

                if (!$classReflection) {
                    return [];
                }
            }
        } while (!$methodExists);

        $classNameOfClassWithConstructor = $classReflection->name;

        $constructorParams = (new \ReflectionMethod($classNameOfClassWithConstructor, '__construct'))
            ->getParameters();

        $args = [];

        foreach ($constructorParams as $constructorParam) {
            $paramName = ucfirst($constructorParam->name);

            if ($constructorParam->isVariadic()) {
                $args = array_merge($args, $objectData);
                break;
            } elseif (isset($objectData[$paramName])) {
                $paramValue = $objectData[$paramName];
                unset($objectData[$paramName]);
            } else {
                $paramValue = null;
            }

            $constructorParamClass = $constructorParam->getClass();

            if (!is_null($paramValue) && $constructorParamClass) {
                $constructorParamClassName = $constructorParamClass->name;

                if (!is_array($paramValue)) {
                    $paramValue = [$paramValue];
                }
                $paramValue = self::convertObject($paramValue, $constructorParamClassName);
            } else {
                $type = (string) $constructorParam->getType();

                switch ($type) {
                    case 'int':
                        $paramValue = (int) $paramValue;
                        break;

                    case 'float':
                        $paramValue = (float) $paramValue;
                        break;

                    case 'string':
                        $paramValue = (string) $paramValue;
                        break;

                    case 'array':
                        $paramValue = (array) $paramValue;
                        break;
                }

                if (!$paramValue && $constructorParam->allowsNull()) {
                    $paramValue = null;
                }
            }

            $args[] = $paramValue;
        }

        $object = new $className(...$args);

        return $object;
    }
}