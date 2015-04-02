<?php

require('OTS/Autoload.php');
use OTS\API\Client;

$oClient     = new Client();

//GetCode
$Recipient 	     =  962785295462;
$Body            = 'Your Verification Number is :- ';
$SecurityType    = 'OTP';
$Expiry          = '00:20:00';
$GetCode = $oClient->Verify->GetCode($Recipient,$Body,$SecurityType,$Expiry);

var_dump($GetCode);

//VerifyNumber
$Recipient  =  962785295462;
$PassCode 	= '2145';

$VerifyNumber = $oClient->Verify->VerifyNumber($Recipient,$PassCode);
var_dump(VerifyNumber);