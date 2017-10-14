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

class BaseController extends  BaseWebController{

    protected  $current_user = null;

     public function __construct($id,$module ,array $config = []){
         parent::__construct($id,$module, $config);
         $this->layout = "main";
     }

     public  function  beforeAction($action){
        return true;
     }


     public function  goHome(){
         // 跳转到登录界面
         return $this->redirect(UrlService::buildMUrl("/default/index"));
     }


}