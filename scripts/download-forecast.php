<?php

$serviceLocator = require(__DIR__ . '/../app/bootstrap.php');

$repository = $serviceLocator->getRepository();

$query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where text="prague") and u="c"';
$url = 'https://query.yahooapis.com/v1/public/yql?q=' . $query . '&format=json';

$client = new GuzzleHttp\Client();
$res = $client->request('GET', $url);

if ($res->getStatusCode() != 200) {
    echo "Chyba.";
}

$response = json_decode((string) $res->getBody(), true);

$itemList = $response['query']['results']['channel']['item']['forecast'];

$repository->deleteAll();

foreach ($itemList as $item) {
    $repository->insertItem(
        $item['date'],
        $item['low'],
        $item['high']
    );
}

echo 'Download forecast is done.';
