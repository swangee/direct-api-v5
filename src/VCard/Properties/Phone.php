<?php
namespace vedebel\directv5\VCard\Properties;

use vedebel\directv5\Common\Object;

/**
 * Class Phone
 * @package vedebel\directv5\VCard\Properties
 *
 * @property string $countryCode
 * @property string $cityCode
 * @property string $phoneNumber
 * @property string|null $extension
 */
class Phone extends Object
{
    /**
     * Phone constructor.
     *
     * @param string $countryCode
     * @param string $cityCode
     * @param string $phoneNumber
     * @param string|null $extension
     */
    public function __construct(string $countryCode, string $cityCode, string $phoneNumber, string $extension = null)
    {
        $attributes = [
            'countryCode' => $countryCode,
            'cityCode' => $cityCode,
            'phoneNumber' => $phoneNumber
        ];

        if (!is_null($extension)) {
            $attributes['extension'] = $extension;
        }

        parent::__construct($attributes);
    }
}