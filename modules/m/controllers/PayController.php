<?php

namespace app\modules\m\controllers;

use app\modules\m\controllers\common\BaseController;



class PayController extends BaseController
{

    // 支付界面
    public function actionBuy()
    {
        return $this->render('buy');
    }
}
