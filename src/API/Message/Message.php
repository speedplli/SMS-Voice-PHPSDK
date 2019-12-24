<?php

namespace Unifonic\API\Message;

use GUMP;
use Unifonic\API\Exception;
use Unifonic\API\Client;

/**
 * Class Message
 *
 * @package Unifonic\API\Message
 */
Class Message
{
    /** @var Client */
    private $client;

    /**
     * @param $oClient
     */
    public function __construct(Client $oClient)
    {
        $this->client = $oClient;

    }

    public function Rules($methodName)
    {
        $rules = [
            'Send'               => [
                'Recipient' => 'numeric|required|min_len,12|max_len,14',
                'Body'      => 'required',
                'SenderID'  => 'max_len,16',
            ],
            'SendBulkMessages'   => [
                'Recipient' => 'required',
                'Body'      => 'required',
                'SenderID'  => 'max_len,16',
            ],
            'GetMessageIDStatus' => [
                'MessageID' => 'numeric|required',
            ],
            'GetMessagesDetails' => [
                'MessageID' => 'numeric',
                'status'    => 'min_len,12|max_len,14',
                'SenderID'  => 'max_len,16',
                'DateFrom'  => 'max_len,55',
                'DateFTo'   => 'max_len,55',
                'limit'     => 'numeric',
                'page'      => 'numeric',
            ],
            'GetMessagesReport'  => [
                'DateFrom' => 'max_len,55',
                'DateFTo'  => 'max_len,55',
            ],
            'GetScheduled'       => [],
            'StopScheduled'      => [
                'Recipient' => 'numeric|required|'
            ]
        ];

        return $rules["$methodName"];
    }

    /**
     * @param $Recipient
     * @param $Body
     * @param $SenderID
     *
     * @return mixed
     * @throws \Exception
     * @throws Exception
     */
    public function Send($Recipient, $Body, $SenderID = null)
    {
        $aParams = [
            'Recipient' => $Recipient,
            'Body'      => $Body,
            'SenderID'  => $SenderID
        ];
        try {
            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_Send($aParams);
            } else {
                return $valid[0];
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $Recipient
     * @param $Body
     * @param $SenderID
     *
     * @return mixed
     * @throws \Exception
     * @throws Exception
     */
    public function SendBulkMessages($Recipient, $Body, $SenderID = null)
    {
        $aParams = [
            'Recipient' => $Recipient,
            'Body'      => $Body,
            'SenderID'  => $SenderID
        ];
        try {
            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_SendBulk($aParams);
            } else {
                return $valid[0];
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $MessageID
     *
     * @return mixed
     * @throws \Exception
     * @throws Exception
     */
    public function GetMessageIDStatus($MessageID)
    {
        $aParams = ['MessageID' => $MessageID];
        try {
            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_GetMessageIDStatus($aParams);
            } else {
                return $valid[0];
            }
        } catch (Exception $e) {
            throw $e;
        }
    }


    /**
     * @param $MessageID
     * @param $status
     * @param $SenderID
     * @param $DateFrom
     * @param $DateTo
     * @param $limit
     * @param $page
     *
     * @return mixed
     * @throws \Exception
     * @throws Exception
     */
    public function GetMessagesDetails($MessageID = null, $status = null, $SenderID = null, $DateFrom = null,
        $DateTo = null, $limit = null, $page = null)
    {
        $aParams = [
            'MessageID' => $MessageID,
            'status'    => $status,
            'SenderID'  => $SenderID,
            'DateFrom'  => $DateFrom,
            'DateTo'    => $DateTo,
            'Limit'     => $limit,
            'page'      => $page
        ];

        try {
            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_GetMessagesDetails($aParams);
            } else {
                return $valid[0];
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @param $DateFrom
     * @param $DateTo
     *
     * @return mixed
     * @throws \Exception
     * @throws Exception
     */
    public function GetMessagesReport($DateFrom = null, $DateTo = null)
    {
        $aParams = ['DateFrom' => $DateFrom, 'DateTo' => $DateTo];
        try {
            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_GetMessagesReport($aParams);
            } else {
                return $valid[0];
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     * @throws Exception
     */
    public function GetScheduled()
    {
        $aParams = [];
        try {
            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_GetScheduled($aParams);
            } else {
                return $valid[0];
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     * @throws Exception
     */
    public function StopScheduled($MessageID)
    {
        $aParams = ['MessageID' => $MessageID];
        try {
            $valid = GUMP::is_valid($aParams, $this->Rules(__FUNCTION__));
            if ($valid === true) {
                return $this->client->Messages_StopScheduled($aParams);
            } else {
                return $valid[0];
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
