<?php

namespace app\modules\web\controllers;
use app\modules\web\controllers\common\BaseController;


/**
 * Default controller for the `web` module
 */
class BrandController extends BaseController
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
    public function actionInfo()
    {
        return $this->render('info');
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
