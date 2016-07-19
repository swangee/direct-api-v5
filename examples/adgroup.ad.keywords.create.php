<?php

use vedebel\directv5\Ad;
use vedebel\directv5\Keyword;
use vedebel\directv5\Common;
use vedebel\directv5\Ad\AdCollection;
use vedebel\directv5\AdGroup\AdGroupCollection;
use vedebel\directv5\Common\BoolValue;
use vedebel\directv5\Common\NegativeKeywords;
use vedebel\directv5\Common\SelectionCriteria;
use vedebel\directv5\Keyword\KeywordCollection;

$httpClient = new \GuzzleHttp\Client();

$client = new \vedebel\directv5\Client($httpClient);

$testCampaign = 18534907;


$adGroups = [];

$negativeKeywords = new NegativeKeywords(['badkeyword', 'negative']);

$adGroup = new \vedebel\directv5\AdGroup\AdGroup();
$adGroup->campaignId = $testCampaign;
$adGroup->name = 'Pricer AdGroup';
$adGroup->regionIds = [187];
$adGroup->negativeKeywords = $negativeKeywords;
$adGroup->trackingParams = 'param=param-value';

$adGroups[] = $adGroup;

$collection = new AdGroupCollection();

foreach ($adGroups as $adGroup) {
    $collection->add($adGroup);
}

$adGroupRepository = $client->getRepository('ad-group');
$adGroupRepository->add($collection);

if (!$adGroup->id) {
    return;
}

$textAd = new Ad\Properties\TextAd();
$textAd->text = 'Ad text';
$textAd->title = 'Ad title';
$textAd->href = 'http://smart-sitemaps.pp.ua';
$textAd->mobile = new BoolValue(false);
$textAd->displayUrlPath = 'карта-сайта';

$ad = new Ad\Ad();
$ad->adGroupId = $adGroup->id;
$ad->textAd = $textAd;

$ads = [$ad];

$collection = new AdCollection();
foreach ($ads as $ad) {
    $collection->add($ad);
}

$adRepository = $client->getRepository('ad');
$adRepository->add($collection);

if (!$ad->id) {
    $criteria = new SelectionCriteria(['Ids' => [$adGroup->id]]);
    $adGroupRepository->delete($criteria);

    return;
}

$keywords = [];

for ($i = 0; $i < 10; $i++) {
    $keyword = new Keyword\Keyword();
    $keyword->adGroupId = $adGroup->id;
    $keyword->keyword = 'Keyword with number ' . $i;
    $keyword->bid = new Common\Money(10);
    $keyword->contextBid = new Common\Money(7);

    $keywords[] = $keyword;
}

$collection = new KeywordCollection();

foreach ($keywords as $keyword) {
    $collection->add($keyword);
}

$keywordRepository = $client->getRepository('keyword');
$keywordsResult = $keywordRepository->add($collection);

if (($keywordsErrors = $keywordsResult->getErrors()) && count($keywordsErrors) === $collection->getLength()) {
    $criteria = new SelectionCriteria(['Ids' => [$ad->id]]);
    $adRepository->delete($criteria);

    $criteria = new SelectionCriteria(['Ids' => [$adGroup->id]]);
    $adGroupRepository->delete($criteria);
}