<?php

namespace app\modules\web\controllers;

use yii\web\Controller;

/**
 * Default controller for the `web` module
 */
class AccountController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout="main";
        return $this->render('index');
    }

    public function actionSet()
    {
        $this->layout="main";
        return $this->render('set');
    }
    public function actionInfo()
    {
        $this->layout="main";
        return $this->render('info');
    }
}
