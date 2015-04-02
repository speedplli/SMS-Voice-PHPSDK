<?php
require('OTS/Autoload.php');
use \OTS\API\Client;
$client = new Client();


try {
    $response = $client->Account->AddSenderID('Hello');
    $response = $client->Voice->Call('',f);
    $response = $client->Messages->SendBulkMessages('966505050505,966555655555','Hello','OTS');
} catch (Exception $e) {

    echo $e->getCode();
}

