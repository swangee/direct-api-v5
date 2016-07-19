<?php
namespace vedebel\directv5\Common;

use JsonSerializable;

/**
 * Class Money
 * @package vedebel\directv5\Common
 */
class Money implements JsonSerializable
{
    /**
     *
     */
    const MONEY_MULTIPLIER = 1000000;

    /**
     * @var
     */
    private $amount;

    /**
     * Money constructor.
     * @param $amount
     */
    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return (string) $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) ($this->amount * self::MONEY_MULTIPLIER);
    }

    /**
     * @param int $precision
     * @return float
     */
    public function toFloat(int $precision = 0) : float
    {
        return round((float) ((string) $this), $precision);
    }
}