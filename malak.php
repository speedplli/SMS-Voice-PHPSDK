<?php
require('OTS/API/Client.php');
require('OTS/API/Message/Message.php');
require('OTS/API/Exception.php');
use OTS\API\Message\Message;
use OTS\API\Client;
use OTS\API\Exception;


$client = new Client();

$oSendSms = new Message($client);
/*$sendSms = $oSendSms->SendMessage(array(
     'Recipient' => 962799286754,
     'Body' => 'test php sdk'
));
var_dump($sendSms);*/

/*$getSmsStatus = $oSendSms->GetMessageIDStatus(array(
    'MessageID' => $sendSms->MessageID
));
var_dump($getSmsStatus);*/

/*$sendBulkSms = $oSendSms->SendBulkMessages(array(
    'AppSid'    => 'KBb%2FJ1WUrrMpsUYy0osEWaT4SEzBgJE5XL7L81zTagI%3D',
    'Recipient' => 962799286754,
    'Body'      => 'test'
));
var_dump($sendBulkSms);*/


/*$smsDetails = $oSendSms->GetMessagesDetails();
var_dump($smsDetails);*/

/*$smsReport = $oSendSms->GetMessagesDetails();
var_dump($smsReport);*/

