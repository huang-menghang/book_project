<?php

namespace app\modules\web\controllers;

use yii\web\Controller;

class MemberController extends BaseController
{
    public function __construct($id,$module,array $config =[])
    {
        parent::__construct($id,$module,$config);
        $this->layout="main";
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionInfo()
    {
        return $this->render('info');
    }

    public function actionSet()
    {
        return $this->render('set');
    }

    public function  actionComment()
    {
        return $this->render('comment');
    }


}
