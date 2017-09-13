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

    public function  actionCat(){
        return $this->render('cat');
    }

    public  function  actionCat_set(){
        return $this->render('cat_set');
    }

    public function actionSet()
    {
        return $this->render('set');
    }
    public function actionImages()
    {
        return $this->render('images');
    }
}
