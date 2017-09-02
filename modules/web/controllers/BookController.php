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
        $this->layout=false;
        return $this->render('index');
    }

    public function actionInfo()
    {
        $this->layout=false;
        return $this->render('info');
    }

    public function  actionCat(){
        $this->layout=false;
        return $this->render('cat');
    }

    public  function  actionCat_set(){
        $this->layout=false;
        return $this->render('cat_set');
    }

    public function actionSet()
    {
        $this->layout=false;
        return $this->render('set');
    }
    public function actionImages()
    {
        $this->layout=false;
        return $this->render('images');
    }
}
