<?php

namespace app\modules\m\controllers;

use yii\web\Controller;


class ProductController extends Controller
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config = []);
        $this->layout="main";
    }

    // 商品列表
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function  actionInfo(){
        return $this->render('info');

    }

    public function  actionOrder(){
        $this->layout="main";
        return $this->render("order");
    }

}
