<?php

namespace app\modules\web\controllers;

use yii\web\Controller;

/**
 * Default controller for the `web` module
 */
class BookController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->layout="main";
        return $this->render('index');
    }

    public function actionInfo()
    {
        $this->layout="main";
        return $this->render('info');
    }

    public function  actionCat(){
        $this->layout="main";
        return $this->render('cat');
    }

    public  function  actionCat_set(){
        $this->layout="main";
        return $this->render('cat_set');
    }

    public function actionSet()
    {
        $this->layout="main";
        return $this->render('set');
    }
    public function actionImages()
    {
        $this->layout="main";
        return $this->render('images');
    }
}
