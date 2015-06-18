<?php
/**
 * Created by PhpStorm.
 * User: malak
 * Date: 6/18/15
 * Time: 11:57 AM
 */

namespace OTS\API\Checker;
use OTS\API\Exception;
use OTS\lib\GUMP\gump;

/**
 * Class Account
 * @package OTS\API\Account
 */
Class Checker
{

    /**
     * @var
     */
    private $client;

    /**
     * @param $oClient
     */
    public function __construct($oClient)
    {

        $this->client = $oClient;

    }


    public function Rules($methodName){

        $rules = array(
            'CheckNumber'=>array(
                'Recipient' =>  'numeric|required|min_len,12|max_len,14'
            )
        );

        return $rules["$methodName"];
    }

    /**
     * @param $Recipient
     * @return mixed
     */
    public function CheckNumber($Recipient)
    {
        $aParams = array();
        $aParams['Recipient'] = $Recipient;

        $valid = GUMP::is_valid($aParams ,$this->Rules(__FUNCTION__));
        if($valid === true)
        {
            return $this->client->Checker_CheckNumber($aParams);

        }else{
            return $valid[0];
        }
    }


}
?>
