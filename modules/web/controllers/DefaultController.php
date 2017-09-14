<?php

namespace app\modules\web\controllers;

use app\common\services\UrlService;
use app\modules\web\controllers\common\BaseController;


/**
 * Default controller for the `web` module
 */
class DefaultController extends BaseController
{
    /**
     * Renders the index view for the module
     * @return string
     */

    public function actionIndex()
    {
        return $this->redirect(UrlService::buildWebUrl("/dashboard/index"));
    }
}
