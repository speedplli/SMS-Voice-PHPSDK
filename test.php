<?php
require('Unifonic/Autoload.php');
use \Unifonic\API\Client;
$client = new Client();

//Kindly note that the newly added sender ID nust me approved by our system if you have any issue please contact our support team
try {
    //$response = $client->Messages->Send('recipient','messageBody','senderName');
	$response = $client->Messages->SendBulkMessages('966505050505,966555655555','Hello','UNIFONIC');

    /* Examples */
    //$response = $client->Account->AddSenderID('newSenderName');
    //$response = $client->Voice->Call('',f);
    //$response = $client->Account->GetBalance();
    
    print_r($response);
     
} catch (Exception $e) {

    echo $e->getCode();
}

