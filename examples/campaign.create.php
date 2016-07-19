<?php

use vedebel\directv5\Campaign\Campaign;
use vedebel\directv5\Campaign\CampaignCollection;
use vedebel\directv5\Campaign\Properties\TextCampaign;

require_once 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client();

$client = new \vedebel\directv5\Client($httpClient);

$settings = new TextCampaign\Settings();

$strategy = new TextCampaign\BiddingStrategy(
    new TextCampaign\BiddingStrategy\Search('HIGHEST_POSITION'),
    new TextCampaign\BiddingStrategy\Network('SERVING_OFF')
);

$textCampaign = new TextCampaign();
$textCampaign->settings = $settings;
$textCampaign->biddingStrategy = $strategy;

$campaign = new Campaign();
$campaign->name = 'Test';
$campaign->startDate = date('Y-m-d');
$campaign->textCampaign = $textCampaign;

$collection = new CampaignCollection();

$collection->add($campaign);

$campaignsRepository = $client->getRepository('campaign');
$addResult = $campaignsRepository->add($collection);