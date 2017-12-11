<?php

namespace app\modules\m\controllers;

use app\common\services\ConstantMapService;
use app\common\services\UtilService;
use app\models\member\Member;
use app\modules\m\controllers\common\BaseController;
use app\models\sms\SmsCaptcha;



class UserController extends BaseController
{

    public function actionIndex()
    {
        if (\Yii::$app->request->isGet) {
            return $this->render('index', ['current_user' => $this->current_user]);
        }

        return $this->render('index');
    }

    public function actionAddress()
    {
        return $this->render('address');
    }

    public function actionAddress_set()
    {
        return $this->render('address_set');
    }

    public function actionFav()
    {
        return $this->render('fav');
    }


    public function actionBind()
    {
        if (\Yii::$app->request->isGet) {
            return $this->render('bind');
        }

        $mobile = trim($this->post("mobile"));
        $img_captcha = trim($this->post("img_captcha"));
        $captcha_code = trim($this->post("captcha_code"));
        $date_now = date("Y-m-d H:i:s");

        if( mb_strlen($mobile,"utf-8") < 1 || !preg_match("/^[1-9]\d{10}$/",$mobile) ){
            return $this->renderJSON([],"请输入符合要求的手机号码~~",-1);
        }

        if (mb_strlen( $img_captcha, "utf-8") < 1) {
            return $this->renderJSON([], "请输入符合要求的图像校验码~~", -1);
        }

        if (mb_strlen( $captcha_code, "utf-8") < 1) {
            return $this->renderJSON([], "请输入符合要求的手机验证码~~", -1);
        }


        if ( !SmsCaptcha::checkCaptcha($mobile, $captcha_code ) ) {
            return $this->renderJSON([], "请输入正确的手机验证码~~", -1);
        }

        $member_info = Member::find()->where(['mobile'=>$mobile,'status'=>1])->one();

        if(!$member_info){
           if(Member::findOne(['mobile'=>$mobile])){
            $this->renderJSON([], "手机号码已经注册~~", -1);
           }
           $modle_member = new Member();
           $modle_member ->nickname= $mobile;
           $modle_member ->mobile = $mobile;
           $modle_member ->setSalt();
           $modle_member ->avatar = ConstantMapService::$default_avatar;
           $modle_member ->reg_ip = sprintf("%u",ip2long(UtilService::getIP()));
           $modle_member ->status = 1;
           $modle_member ->created_time = $modle_member->updated_time = date("Y-m-d H:i:s");
           $modle_member ->save(0);
           $member_info = $modle_member;
        }

        if(!$member_info || !$member_info['status']){
            return $this->renderJSON([], "你的账户已被禁止,请联系客服~~", -1);
        }

        return $this->renderJSON([], "绑定成功~~", -1);


    }

    public function actionCart()
    {
        return $this->render('cart');
    }

    public function actionOrder()
    {
        return $this->render("order");
    }

    public function actionComment()
    {
        return $this->render("comment");
    }

    public function actionComment_set()
    {
        return $this->render("comment_set");
    }
}
