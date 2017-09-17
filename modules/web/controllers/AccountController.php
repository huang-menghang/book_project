<?php

namespace app\modules\web\controllers;

use app\common\services\ConstantMapService;
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
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = "main";
    }


    public function actionIndex()
    {
        // 从数据库获取数据,从用户表获取数据,倒叙排序

        $status = intval($this->get("status", ConstantMapService::$status_default));
        $mix_kw = trim($this->get("mix_kw", ""));
        $p = intval($this->get("p", 1));
        $query = User::find();
        if ($status > ConstantMapService::$status_default) {
            $query->andWhere(['status' => $status]);
        }
        if ($mix_kw) {
            $where_nickname = ['LIKE', 'nickname', '%' . $mix_kw . '%', false];
            $where_mobile = ['LIKE', 'mobile', '%' . $mix_kw . '%', false];
            $query->andWhere(['OR', $where_nickname, $where_mobile]);
        }
        // 分页功能，总记录pageTotal，pageSize
        $page_size = 1;
        $total_res_count = $query->count();
        $total_page = ceil($total_res_count / $page_size);


        $list = $query->orderBy(["uid" => SORT_DESC])
            ->offset(($p - 1)* $page_size)
            ->limit($page_size)
            ->all();


        return $this->render("index", [
            'list' => $list,
            'status_mapping' => ConstantMapService::$status_mapping,
            'search_conditions' => [
                'mix_kw' => $mix_kw,
                'status' => $status,
                'p' => $p
            ],
            'pages' => [
                'total_count' => $total_res_count,
                'page_size' => $page_size,
                'total_page' => $total_page,
                'p' => $p
            ]]
        );
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
