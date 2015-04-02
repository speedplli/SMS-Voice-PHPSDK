<?php
require('OTS/Autoload.php');
use OTS\API\Client;
use OTS\API\Verify\Voice;

$client = new Client();
$call = new Voice($client);

//GetCallIDStatus
    $CallID 	=  29;

    $GetCallIDStatus = $call->GetCallIDStatus($CallID);

    var_dump($GetCallIDStatus);

//call
    $Recipient  =  962785295462;
    $Content 	= 'https://voiceusa.s3.amazonaws.com/voiceWavFiles/14260802945984.mp3';


    $callTest = $call->Call($Recipient , $Content);
    var_dump($callTest);


//TTSCall
    $Recipient  =  962785295462;
    $Content 	= 'Hello world';
    $Language	= 'english';


    $TTSCall = $call->TTSCall($Recipient,$Content,$Language);
    var_dump($TTSCall);

//GetCallsDetails
    $CallID 	= 24 ;
    $DateFrom 	= '2014-02-01';
    $DateTo 	= '2014-03-01';

    $GetCallsDetails = $call->GetCallsDetails($CallID,$DateFrom,$DateTo);
    var_dump($GetCallsDetails);
