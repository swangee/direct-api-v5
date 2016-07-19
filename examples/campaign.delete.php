<?php

use vedebel\directv5\Common\SelectionCriteria;

require_once 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client();

$client = new \vedebel\directv5\Client($httpClient);

$client->login('hollowj-33', '70c93ff2944d4f7fbba854963d6598a2');

$criteria = new SelectionCriteria(['Ids' => [18935769]]);

$campaignsRepository = $client->getRepository('campaign');
$deleteResult = $campaignsRepository->delete($criteria);