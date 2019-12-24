<?php

namespace Unifonic\API;

use Unifonic\API\Account\Account;
use Unifonic\API\Message\Message;
use Unifonic\API\Verify\Verify;
use Unifonic\API\Voice\Voice;
use Unifonic\API\Checker\Checker;

class Client
{
    /**
     * @var Message
     */
    public $Messages;
    /**
     * @var Voice
     */
    public $Voice;
    /**
     * @var Account
     */
    public $Account;
    /**
     * @var Account
     */
    public $Checker;
    /**
     * @var Verify
     */
    public $Verify;
    /**
     * @param string $apiKey
     * @param string $apiSecret
     */
    private $api_url;
    private $app_sid;
    private $action;
    public  $params;

    public function __construct($api_url, $app_sid)
    {
        $this->api_url = $api_url;
        $this->app_sid = $app_sid;
        $this->Messages = new Message($this);
        $this->Account = new Account($this);
        $this->Voice = new Voice($this);
        $this->Verify = new Verify($this);
        $this->Checker = new Checker($this);
    }

    /**
     * @return mixed
     * @throws Exception
     */
    private function call()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url . $this->action);
        curl_setopt($ch, CURLOPT_POST, count($this->params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($this->params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $result = json_decode($result);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_status == 500) {
            throw new Exception('Couldn\'t Connect to API');
        }

        if ($result && isset($result->success)) {
            if ($result->success == 'true') {
                return $result->data;
            }
            $code = str_replace('ER-', '', $result->errorCode);
            throw new Exception(serialize($result->message), $code);
        }
    }

    /**
     * @param $method_name
     * @param $args
     *
     * @return mixed
     * @throws Exception
     */
    public function __call($method_name, $args)
    {
        if (method_exists($this, $method_name)) {
            return $this->$method_name();
        }

        $this->action = str_replace('_', '/', $method_name);
        $this->params = isset($args[0]) ? $args[0] : [];
        $this->params['AppSid'] = $this->app_sid;
        return $this->call();
    }
}
