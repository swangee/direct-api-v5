<?php
namespace vedebel\directv5\VCard;

use vedebel\directv5\Common\Object;
use vedebel\directv5\VCard\Properties\InstantMessenger;
use vedebel\directv5\VCard\Properties\Phone;
use vedebel\directv5\VCard\Properties\PointOnMap;

/**
 * Class VCard
 * @package vedebel\directv5\VCard
 * 
 * @property int|null $id
 * @property int|null $campaignId
 * @property string|null $country
 * @property string|null $city
 * @property string|null $companyName
 * @property string|null $workTime
 * @property Phone|null $phone
 * @property string|null $street
 * @property string|null $house
 * @property string|null $building
 * @property string|null $apartment
 * @property InstantMessenger|null $instantMessenger
 * @property string|null $extraMessage
 * @property string|null $contactEmail
 * @property string|null $ogrn
 * @property int|null $metroStationId
 * @property PointOnMap|null $pointOnMap
 * @property string|null $contactPerson
 */
class VCard extends Object
{
    /**
     * VCard constructor.
     * 
     * @param int|null $id
     * @param int|null $campaignId
     * @param string|null $country
     * @param string|null $city
     * @param string|null $companyName
     * @param string|null $workTime
     * @param Phone|null $phone
     * @param string|null $street
     * @param string|null $house
     * @param string|null $building
     * @param string|null $apartment
     * @param InstantMessenger|null $instantMessenger
     * @param string|null $extraMessage
     * @param string|null $contactEmail
     * @param string|null $ogrn
     * @param int|null $metroStationId
     * @param PointOnMap|null $pointOnMap
     * @param string|null $contactPerson
     */
    public function __construct(
        int $id = null, int $campaignId = null, string $country = null, string $city = null, string $companyName = null,
        string $workTime = null, Phone $phone = null, string $street = null, string $house = null, string $building = null,
        string $apartment = null, InstantMessenger $instantMessenger = null, string $extraMessage = null,
        string $contactEmail = null, string $ogrn = null, int $metroStationId = null, PointOnMap $pointOnMap = null,
        string $contactPerson = null
    )
    {
        $attributes = [];

        if (!is_null($id)) {
            $attributes['id'] = $id;
        }
        if (!is_null($campaignId)) {
            $attributes['campaignId'] = $campaignId;
        }
        if (!is_null($country)) {
            $attributes['country'] = $country;
        }
        if (!is_null($city)) {
            $attributes['city'] = $city;
        }
        if (!is_null($companyName)) {
            $attributes['companyName'] = $companyName;
        }
        if (!is_null($workTime)) {
            $attributes['workTime'] = $workTime;
        }
        if (!is_null($phone)) {
            $attributes['phone'] = $phone;
        }
        if (!is_null($street)) {
            $attributes['street'] = $street;
        }
        if (!is_null($house)) {
            $attributes['house'] = $house;
        }
        if (!is_null($building)) {
            $attributes['building'] = $building;
        }
        if (!is_null($apartment)) {
            $attributes['apartment'] = $apartment;
        }
        if (!is_null($instantMessenger)) {
            $attributes['instantMessenger'] = $instantMessenger;
        }
        if (!is_null($extraMessage)) {
            $attributes['extraMessage'] = $extraMessage;
        }
        if (!is_null($contactEmail)) {
            $attributes['contactEmail'] = $contactEmail;
        }
        if (!is_null($ogrn)) {
            $attributes['ogrn'] = $ogrn;
        }
        if (!is_null($metroStationId)) {
            $attributes['metroStationId'] = $metroStationId;
        }
        if (!is_null($pointOnMap)) {
            $attributes['pointOnMap'] = $pointOnMap;
        }
        if (!is_null($contactPerson)) {
            $attributes['contactPerson'] = $contactPerson;
        }

        parent::__construct($attributes);
    }
}