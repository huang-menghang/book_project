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
    public function __construct($id,$module,array $config =[])
    {
        parent::__construct($id,$module,$config);
        $this->layout="main";
    }
    public function actionLogin()
    {
        $this->layout ="user";
        return $this->render('login');
    }
    public function actionEdit()
    {
        return $this->render('edit');
    }
    public function actionResetPwd()
    {
        return $this->render('reset_pwd');
    }
}
