<?php

namespace app\modules\web\controllers;

use yii\web\Controller;

/**
 * Default controller for the `web` module
 */
class FinanceController extends Controller
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

    public function actionAccount()
    {
        $this->layout="main";
        return $this->render('account');
    }

    public function actionPay_info()
    {
        $this->layout="main";
        return $this->render('pay_info');
    }
}
