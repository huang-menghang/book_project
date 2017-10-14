<?php
/**
 * Created by PhpStorm.
 * User: OauthController
 * Date: 2017/10/13
 * Time: 11:43
 */

namespace app\modules\m\controllers;


use app\common\components\HttpClient;
use app\common\services\UrlService;
use app\modules\m\controllers\common\BaseController;

class OauthController extends BaseController
{

    public function actionLogin()
    {
        // 获取到登录方式,是静默登录还是授权登录
        $scope = $this->get("scope", "");
        $appid = \Yii::$app->params['weixin']['appid'];
        $redirect_url = UrlService::buildMUrl("/oauth/callback");
        // 调用微信授权登录接口
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=${$appid}&redirect_uri=${$redirect_url}&response_type=code&scope=${$scope}&state=#wechat_redirect";
        return $this->redirect($url);


    }

    // 微信回调接口
    public function actionCallback()
    {
        $code = $this->get("code","");
        if (!$code){
            return $this->goHome();
        }
        // 通过code 获取网页授权...
        $appid = \Yii::$app->params['weixin']['appid'];
        $sk =  \Yii::$app->params['weixin']['sk'];
        $url =  "https://api.weixin.qq.com/sns/oauth2/access_token?appid=${appid}&secret=${sk}&code=${code}&grant_type=authorization_code";
        // 获取到回调回来的json 字符串
        $ret = HttpClient::get($url);
        $ret = json_decode($ret,true);
        $ret_token = isset($ret['access_token'])?$ret['access_token']:'';
        // 如果没信息就回到主界面
        if(!$ret_token){
            return $this->goHome();
        }

        $openid = isset($ret['openid'])?$ret['openid']:"";
        $scope = isset($ret['scope'])?$ret['scope']:"";

        // 如果是授权登录则通过openid和access_token 拉取用户信息
        if($scope == "snsapi_userinfo"){
            $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$ret_token}&openid={$openid}&lang=zh_CN ";
            $wechat_user_info = HttpClient::get($url);
            $wechat_user_info = @json_decode($wechat_user_info,true);
            var_dump($wechat_user_info);

        }








    }


}