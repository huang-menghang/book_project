<?php

namespace app\modules\m\controllers;

use yii\web\Controller;


class ProductController extends Controller
{
    // 商品列表
    public function actionIndex()
    {
        $this->layout=false;
        return $this->render('index');
    }

    public function  actionInfo(){
        $this->layout=false;
        return $this->render('info');

    }

    public function  actionOrder(){
        $this->layout=false;
        return $this->render("order");
    }

}
