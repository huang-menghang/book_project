<?php

namespace app\modules\web\controllers;


use app\common\services\UrlService;
use app\models\User;
use app\modules\web\controllers\common\BaseController;

/**
 * Default controller for the `web` module
 */
class UserController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function __construct($id,$module,array $config =[])
    {
        parent::__construct($id,$module,$config);
        $this->layout="main";
    }
    public function actionLogin()
    {
       // get 页面展示，post 逻辑
      print  "进入登录界面";
       if (\Yii::$app->request->isGet){
           $this->layout ="user";
           return $this->render('login');
       }
       $login_name = trim($this ->post("login_name",""));
       $login_pwd = trim($this->post("login_pwd",""));
       if(!$login_name || !$login_pwd){
           return $this->renderJs('请输入正确的用户和密码',UrlService::buildWebUrl("/user/login"));
       }
       // 从用户表 获取 login_name = $login_name 信息是否不存在
      $user_info = User::find()->where(['login_name' => $login_name])->one();
      if(!$user_info){
          return $this->renderJs('请输入正确的用户和密码',UrlService::buildWebUrl("/user/login"));
      }
      // 验证密码
      // 密码加密算法 = md5(login_pwd + md5(login_salt))
        $auth_pwd = md5($login_pwd . md5($user_info['login_salt']));
        if($auth_pwd != $user_info['login_pwd'] ){
            return $this->renderJs('请输入正确的用户和密码',UrlService::buildWebUrl("/user/login"));
        }

        //保存用户的登录状态
        //cookies进行保存用户登录状态
        // 加密字符串+"#"+uid,加密字符串 = md5(login_name + login_pwd + login_salt)
        $this->setLoginStatus($user_info);
//        $this->setCookie("mooc_book", $this->geneAuthToken($user_info)."#".$user_info['uid']);
        print  "进入登录界面2";
        return $this->redirect(UrlService::buildWebUrl("/dashboard/index"));
    }
    public function actionEdit()
    {
        return $this->render('edit');
    }
    public function actionResetPwd()
    {
        return $this->render('reset_pwd');
    }
   public function  actionLogout(){
        //$this->removeCookie("mooc_book");
       $this->removeLoginStatus();
       return $this->redirect(UrlService::buildWebUrl("/user/login"));
   }

}
