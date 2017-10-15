<?php

namespace app\controllers;


use app\common\components\BaseWebController;
use app\common\services\captcha\ValidateCode;
use app\common\services\UtilService;
use app\models\sms\SmsCaptcha;


class DefaultController extends BaseWebController
{
    private $captcha_cookie_name = "validate_code";

    public function actionIndex()
    {
        return $this->render("index");
    }

    public function actionImg_captcha()
    {
        $font_path = \Yii::$app->getBasePath() . "/web/fonts/captcha.ttf";
        $captcha_handle = new ValidateCode($font_path);
        $captcha_handle->doimg();
        $this->setCookie($this->captcha_cookie_name, $captcha_handle->getCode());

    }

    // 获取短信验证码
    public function actionGet_captcha()
    {
        $mobile = $this->post("mobile", "");
        $img_captcha = $this->post("img_captcha", "");
        if (!$mobile || !preg_match('/^1[0-9]{10}$/', $mobile)) {
            $this->removeCookie($this->captcha_cookie_name);
            return $this->renderJson([], "请输入符合要求的手机号码~~", -1);
        }

        $captcha_code = $this->getCookie( $this->captcha_cookie_name );
        if( strtolower( $img_captcha  ) != $captcha_code ){
            $this->removeCookie( $this->captcha_cookie_name );
            return $this->renderJson( [],"请输入正确图形校验码\r\n你输入的图形验证码是{$img_captcha},正确的是{$captcha_code}~~",-1 );
        }
        $model_sms = new SmsCaptcha();
        $model_sms->geneCustomCaptcha( $mobile ,UtilService::getIP() );
        $this->removeCookie( $this->captcha_cookie_name );
        if( $model_sms ){
            return $this->renderJson( [],"发送成功~~，手机验证码是".$model_sms->captcha );
        }

        return $this->renderJson( [],ConstantMapService::$default_syserror,-1 );



    }

}
