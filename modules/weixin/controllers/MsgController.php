<?php
/**
 * Created by PhpStorm.
 * User: MsgController
 * Date: 2017/10/11
 * Time: 21:16
 */

namespace app\modules\weixin\controllers;


use app\common\components\BaseWebController;

class MsgController extends  BaseWebController{

    public function  actionIndex(){
        // 加密验证

        if (!$this->checkSignature()){
            echo  date("Y-m-d H:i:s");
            return "error signature";
        }

        if(array_key_exists("echostr",$_GET) && $_GET['echostr'] ){
         return $_GET['echostr'];
        }


    }

    public function  checkSignature(){
        $signature = trim($this->get("signature"));
        $timestamp = trim($this->get("timestamp"));
        $nonce = trim($this->get("nonce"));
        $tmpArr = array(\Yii::$app->params['weixin']['token'],$timestamp,$nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if($signature == $tmpStr){
          return true;
        }
        else{
            return false;
        }

    }


}