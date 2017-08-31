<?php

namespace app\modules\web\controllers;

use yii\web\Controller;

/**
 * Default controller for the `web` module
 */
class StatController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout=false;
        return $this->render('index');
    }

    public function actionProduct()
    {
        $this->layout=false;
        return $this->render('product');
    }

    public function actionMember()
    {
        $this->layout=false;
        return $this->render('member');
    }
    public function actionShare()
    {
        $this->layout=false;
        return $this->render('share');
    }
}
