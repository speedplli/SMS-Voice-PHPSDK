<?php

namespace Unifonic\API\Verify;

use GUMP;
use Unifonic\API\Client;

/**
 * Class Voice
 *
 * @package Unifonic\API\Verify
 */
Class Verify
{
    //Time Session Passcode
    const SECURITY_TSP = 'TSP';
    //One Time Passcode
    const SECURITY_OTP = 'OTP';

    /** @var Client */
    private $client;

    /**
     * @param $oClient
     */
    public function __construct(Client $oClient)
    {
        $this->client = $oClient;
    }

    /**
     * @param $method_ame
     *
     * @return mixed
     */
    public function Rules($method_ame)
    {
        $rules = [
            'GetCode'      => [
                'Recipient'    => 'numeric|required|min_len,12|max_len,12',
                'Body'         => 'required',
                'SecurityType' => 'required|contains,' . self::SECURITY_TSP . ' ' . self::SECURITY_OTP
            ],
            'VerifyNumber' => [
                'Recipient' => 'numeric|required|min_len,12|max_len,12',
                'PassCode'  => 'required|numeric|min_len,4|max_len,4'
            ]
        ];
        return $rules["$method_ame"];
    }

    /**
     * @param $Recipient
     * @param $Body
     * @param $SecurityType
     * @param $Expiry
     *
     * @return mixed
     */

    public function GetCode($Recipient, $Body, $SecurityType = self::SECURITY_TSP, $Expiry = '24:00:00')
    {
        $aParams = ['Recipient' => $Recipient, 'Body' => $Body, 'SecurityType' => $SecurityType, 'Expiry' => $Expiry];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Verify_GetCode($aParams);
        } else {
            return $valid[0];
        }
    }

    /**
     * @param $Recipient
     * @param $PassCode
     *
     * @return mixed
     */

    public function VerifyNumber($Recipient, $PassCode)
    {

        $aParams = ['Recipient' => $Recipient, 'PassCode' => $PassCode];
        $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
        if ($valid === true) {
            return $this->client->Verify_VerifyNumber($aParams);
        } else {
            return $valid[0];
        }

    }

}
