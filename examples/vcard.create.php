<?php

use vedebel\directv5\Ad;
use vedebel\directv5\VCard;

$httpClient = new \GuzzleHttp\Client();
$client = new \vedebel\directv5\Client($httpClient);

$testCampaign = null; //Enter campaign id

$vCard = new VCard\VCard();
$vCard->campaignId = $testCampaign;
$vCard->country = 'США';
$vCard->city = 'Нью Йорк';
$vCard->companyName = 'Супер компания';
$vCard->workTime = '0;4;10;0;18;0;5;6;11;0;16;0';
$vCard->phone = new VCard\Properties\Phone('+380', '044', '1234567');
$vCard->street = 'Улица';
$vCard->house = 1;
$vCard->building = 1;
$vCard->apartment = 123;
$vCard->instantMessenger = new VCard\Properties\InstantMessenger('skype', 'nickname');
$vCard->extraMessage = 'Extra message';
$vCard->contactEmail = 'test@test.com';
$vCard->ogrn = '5077746887312';
$vCard->contactPerson = 'My Name';

$vCardCollection = new VCard\VCardCollection([$vCard]);
$client->getRepository('v-card')->add($vCardCollection);

/**
 * $id property will be added to $vCard object if no errors occurred
 * Now we need to map this card to ad if want it to be displayed for in direct interface
 */

$textAd = new Ad\Properties\TextAd();
$textAd->vCardId = $vCard->id;

$ad = new Ad\Ad();
$ad->id = 2249943262;
$ad->textAd = $textAd;

$adCollection = new Ad\AdCollection([$ad]);
$client->getRepository('ad')->update($adCollection);