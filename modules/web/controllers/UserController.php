<?php

namespace app\modules\web\controllers;

use yii\web\Controller;

/**
 * Default controller for the `web` module
 */
class UserController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionLogin()
    {
        $this->layout ="user";
        return $this->render('login');
    }
    public function actionEdit()
    {
        $this->layout ="main";
        return $this->render('edit');
    }
    public function actionResetPwd()
    {
        $this->layout ="main";
        return $this->render('reset_pwd');
    }
}
