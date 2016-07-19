<?php
/**
 * Created by PhpStorm.
 * User: hollowj
 * Date: 24.05.16
 * Time: 13:55
 */

namespace vedebel\directv5\Common;


class BoolValue implements \JsonSerializable
{
    private $value;

    public function __construct($value)
    {
        if (is_string($value)) {
            $this->value = strtoupper($value) === 'YES';
        } else {
            $this->value = (bool) $value;
        }
    }

    public function jsonSerialize()
    {
        return (string) $this;
    }

    public function __toString()
    {
        return $this->value ? 'YES' : 'NO';
    }
}