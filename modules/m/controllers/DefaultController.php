<?php

namespace app\modules\m\controllers;

use yii\web\Controller;


class DefaultController extends Controller
{
    // 品牌首页
    public function actionIndex()
    {
        $this->layout="main";
        return $this->render('index');
    }
}
