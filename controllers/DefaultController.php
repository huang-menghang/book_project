<?php

namespace app\controllers;


use app\common\components\BaseWebController;
use app\common\services\captcha\ValidateCode;


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

}
