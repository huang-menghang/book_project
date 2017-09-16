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
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = "main";
    }

    public function actionLogin()
    {
        // get 页面展示，post 逻辑
        if (\Yii::$app->request->isGet) {
            $this->layout = "user";
            return $this->render('login');
        }
        $login_name = trim($this->post("login_name", ""));
        $login_pwd = trim($this->post("login_pwd", ""));
        if (!$login_name || !$login_pwd) {
            return $this->renderJs('请输入正确的用户和密码', UrlService::buildWebUrl("/user/login"));
        }
        // 从用户表 获取 login_name = $login_name 信息是否不存在
        $user_info = User::find()->where(['login_name' => $login_name])->one();
        if (!$user_info) {
            return $this->renderJs('请输入正确的用户和密码', UrlService::buildWebUrl("/user/login"));
        }
        // 验证密码
        // 密码加密算法 = md5(login_pwd + md5(login_salt))
       // $auth_pwd = md5($login_pwd . md5($user_info['login_salt']));
        if (!$user_info->verifyPassword($login_pwd)) {
            return $this->renderJs('请输入正确的用户和密码', UrlService::buildWebUrl("/user/login"));
        }

        //保存用户的登录状态
        //cookies进行保存用户登录状态
        // 加密字符串+"#"+uid,加密字符串 = md5(login_name + login_pwd + login_salt)
        $this->setLoginStatus($user_info);
//        $this->setCookie("mooc_book", $this->geneAuthToken($user_info)."#".$user_info['uid']);
        return $this->redirect(UrlService::buildWebUrl("/dashboard/index"));
    }

    public function actionEdit()
    {
        if (\Yii::$app->request->isGet) {
            return $this->render('edit', ['user_info' => $this->current_user]);
        }
        $nickname = trim($this->post("nickname", ""));
        $email = trim($this->post("email", ""));

        if (mb_strlen($nickname, "utf-8") < 1) {
            return $this->renderJson([], "请输入合法姓名--", -1);
        }
        if (mb_strlen($email, "utf-8") < 1) {
            return $this->renderJson([], "请输入合法邮箱--", -1);
        }
        $user_info = $this->current_user;
        $user_info->nickname = $nickname;
        $user_info->email = $email;
        $user_info->updated_time = date("Y-m-d H:i:s");
        $user_info->update(0);
        return $this->renderJson([], "编辑成功");


    }

    public function actionResetPwd()
    {
        if (\Yii::$app->request->isGet) {
            return $this->render('reset_pwd', ['user_info' => $this->current_user]);
        }
        $old_password = trim($this->post("old_password", ""));
        $new_password = trim($this->post("new_password", ""));

        if(mb_strlen($old_password,"utf-8")<1){
            return $this->renderJson([],"请输入原密码--",-1);
        }
        if(mb_strlen($new_password,"utf-8")<6){
            return $this->renderJson([],"请输入不少于6位字符的新密码--",-1);
        }
        if ($old_password == $new_password){
            return $this->renderJson([],"请输入重新密码,新密码与原密码一致--",-1);
        }

        //判断原密码是否一致
        $current_user = $this->current_user;
      //  $auth_pwd = md5($old_password.md5($current_user['login_salt']));
        if(!$current_user->verifyPassword($old_password)){
            return $this->renderJson([],"输入的原密码与旧密码不一致",-1);
        }

        $current_user->setPassword($new_password);
        $current_user->updated_time = date("Y-m-d H:i:s");
        $current_user->update(0);
      // 设置登录态
        $this->setLoginStatus( $current_user );
       //$this->setLoginStatus($user_info);
        return $this->renderJson([],"重置密码成功");

    }

    public function actionLogout()
    {
        //$this->removeCookie("mooc_book");
        $this->removeLoginStatus();
        return $this->redirect(UrlService::buildWebUrl("/user/login"));
    }

}
