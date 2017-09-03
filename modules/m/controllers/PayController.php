<?php

namespace app\modules\m\controllers;

use yii\web\Controller;


class PayController extends Controller
{
    // 品牌首页
    public function actionBuy()
    {
        $this->layout="main";
        return $this->render('buy');
    }
}
