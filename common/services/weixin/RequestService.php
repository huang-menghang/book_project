<?php
/**
 * Created by PhpStorm.
 * User: RequestService
 * Date: 2017/10/12
 * Time: 16:19
 */

namespace app\common\services\weixin;


use app\common\components\HttpClient;
use app\common\services\BaseService;
use app\models\member\OauthAccessToken;

class RequestService extends  BaseService {
    private  static  $app_token = "";
    private  static  $appid = "";
    private  static $app_secret = "";

    private static  $url = "https://api.weixin.qq.com/cgi-bin/";

    public static  function  getAccessToken(){
        // 获取到当前时间
        $date_now = date("Y-m-d H:i:s");
        // 找到一条合适的AccessToken，如果有直接返回
        $access_token_info = OauthAccessToken::find()->where(['>','expired_time',$date_now])->limit(1)->one();
        // 如果有则返回
        if($access_token_info){
            return $access_token_info['access_token'];
        }
        // 调用微信api
        $path = 'token?grant_type=client_credential&appid='.self::getAppid().'&secret='.self::getAppSecret();

        $res = self::send($path);
        // 如果没有返回值,则需要将返回错误信息
        if ( !$res ){
            return self::_err(self::getLastErrorMsg());
        }

        // 如果存在则将数据存入数据库

        $model_access_token = new OauthAccessToken();
        $model_access_token->access_token = $res['access_token'];
        $model_access_token->expired_time = date("Y-m-d H:i:s",$res['expires_in']+time()-200);
        $model_access_token->created_time = $date_now;
        $model_access_token->save(0);
        return $res['access_token'];

    }


    public static  function send($path,$data=[],$method = 'GET'){
        $request_url = self::$url.$path;
        var_dump($request_url);
        if ($method == "POST"){
            $res = HttpClient::post($request_url,$data);
        }else{
            $res = HttpClient::get($request_url,[]);
        }
        $ret = @json_decode($res,true);

        if(!$ret || ( isset($res['errcode']) && $res['errcode'])){
            return self::_err($res['errmsg']);
        }

        return $ret;

    }

    public static function setConfig($appid,$app_token,$app_secret){
        self::$appid = $appid;
        self::$app_token = $app_token;
        self::$app_secret = $app_secret;
    }


    /**
     * @return string
     */
    public static function getAppToken()
    {
        return self::$app_token;
    }

    /**
     * @return string
     */
    public static function getAppid()
    {
        return self::$appid;
    }

    /**
     * @return string
     */
    public static function getAppSecret()
    {
        return self::$app_secret;
    }





}