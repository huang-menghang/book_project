<?php

namespace app\modules\m\controllers;

use app\modules\m\controllers\common\BaseController;



class ProductController extends BaseController
{

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
