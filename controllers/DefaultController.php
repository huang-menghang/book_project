<?php

namespace app\controllers;


use app\common\components\BaseWebController;


class DefaultController extends BaseWebController
{
    public function actionIndex()
    {
        return $this->render("index");
    }
}
