<?php

namespace app\modules\web\controllers;
use app\models\User;
use app\modules\web\controllers\common\BaseController;


/**
 * Default controller for the `web` module
 */
class AccountController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */
      public function __construct($id,$module,array $config =[])
      {
        parent::__construct($id,$module,$config);
        $this->layout="main";
      }


    public function actionIndex()
    {
       // 从数据库获取数据
       $list= User::find()->orderBy(["uid"=>SORT_DESC])->all();
       return $this->render('index',['list'=>$list]);
    }

    public function actionSet()
    {

        return $this->render('set');
    }
    public function actionInfo()
    {

        return $this->render('info');
    }
}
