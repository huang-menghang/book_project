<?php

namespace app\modules\m\controllers;

use app\modules\m\controllers\common\BaseController;



class UserController extends BaseController
{

    public function  actionIndex()
    {
        if(\Yii::$app->request->isGet){
           return $this->render('index',['current_user'=>$this->current_user]);
        }

        return $this->render('index');
    }
    public function  actionAddress(){
      return $this->render('address');
    }

    public function  actionAddress_set(){
     return $this->render('address_set');
    }

    public function  actionFav(){
      return $this->render('fav');
    }


    public function actionBind()
    {
        return $this->render('bind');




    }

    public function  actionCart(){
        return $this->render('cart');
    }

    public  function  actionOrder(){
        return $this->render("order");
    }

    public function  actionComment(){
        return $this->render("comment");
    }

    public function  actionComment_set(){
        return $this->render("comment_set");
    }
}
