<?php

use vedebel\directv5\Campaign\Campaign;
use vedebel\directv5\Campaign\CampaignCollection;

require_once 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client();

$client = new \vedebel\directv5\Client($httpClient);

$client->login('hollowj-33', '70c93ff2944d4f7fbba854963d6598a2');

$campaign = new Campaign();
$campaign->id = 18935769;
$campaign->name = 'Test';

$collection = new CampaignCollection();
$collection->add($campaign);

$campaignsRepository = $client->getRepository('campaign');
$addResult = $campaignsRepository->update($collection);