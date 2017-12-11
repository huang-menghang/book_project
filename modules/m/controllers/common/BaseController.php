<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2017-9-30
 * Time: 14:38
 */

namespace app\modules\m\controllers\common;


use app\common\components\BaseWebController;
use app\common\services\UrlService;
use app\models\member\Member;

class BaseController extends  BaseWebController{

    protected  $current_user = null;
    protected $auth_cookie_name = "mooc_book_member";
    protected $salt = "dm3HsNYz3Uyddd46Rjg";
    protected $auth_cookie_current_openid = "shop_m_openid";

    /*这部分永远不用登录,类似拦截器*/
    protected $allowAllAction = [
        'm/oauth/login',
        'm/oauth/logout',
        'm/oauth/callback',
        'm/user/bind',
        'm/pay/callback',
        'm/product/ops',
        'm/product/search',
    ];
    /**
     * 以下特殊url
     * 如果在微信中,可以不用登录(但是必须要有openid)
     * 如果在H5浏览器,可以不用登录
     */
    public $special_AllowAction = [
        'm/default/index',
        'm/product/index',
        'm/product/info'
    ];

     public function __construct($id,$module ,array $config = []){
         parent::__construct($id,$module, $config);
         $this->layout = "main";
     }
     // 在会员端登录登录拦截
     public  function  beforeAction($action){




        return true;
     }
     // 校验用户是是否登录
     protected  function  checkLoginStatus(){
         $auth_cookie = $this ->getCookie($this->auth_cookie_name);
         if(!$auth_cookie){
             return false;
         }
         // 获取cookie的value，并将cookie分割
         list($auth_token,$member_id) = explode("#",$auth_cookie);
         if($member_id && preg_match("/^\d+$/",$member_id)){
           $member_info = Member::findOne(['id'=>$member_id,'status'=>1]);


         }




     }


     public function  goHome(){
         // 跳转到登录界面
         return $this->redirect(UrlService::buildMUrl("/default/index"));
     }


}