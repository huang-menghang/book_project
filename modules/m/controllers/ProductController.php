<?php

namespace app\modules\m\controllers;

use yii\web\Controller;


class ProductController extends Controller
{
    // 商品列表
    public function actionIndex()
    {
        $this->layout="main";
        return $this->render('index');
    }

    public function  actionInfo(){
        $this->layout="main";
        return $this->render('info');

    }

    public function  actionOrder(){
        $this->layout="main";
        return $this->render("order");
    }

}
