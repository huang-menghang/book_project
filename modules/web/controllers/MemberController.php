<?php

namespace app\modules\web\controllers;



use app\common\services\ConstantMapService;
use app\common\services\UrlService;
use app\common\services\UtilService;
use app\models\member\Member;
use app\modules\web\controllers\common\BaseController;

class MemberController extends BaseController
{
    public function __construct($id,$module,array $config =[])
    {
        parent::__construct($id,$module,$config);
        $this->layout="main";
    }

    public function actionIndex()
    {
      $mix_kw = trim($this->get("mix_kw",""));
      $status = intval($this->get("status",ConstantMapService::$status_default));
      $p = intval($this->get("p",1));
      $p = ($p > 0)?$p:1;

      $query = Member::find();

      if ($mix_kw) {
            $where_nickname = ['LIKE', 'nickname', '%' . $mix_kw . '%', false];
            $where_mobile = ['LIKE', 'mobile', '%' . $mix_kw . '%', false];
            $query->andWhere(['OR', $where_nickname, $where_mobile]);
        }

        if ($status > ConstantMapService::$status_default) {
            $query->andWhere(['status' => $status]);
        }
        // 分页功能
        $page_size = 1;
        $total_res_count = $query->count();
        $total_page = ceil($total_res_count / $page_size);

        $list = $query->orderBy(["id" => SORT_DESC])
            ->offset(($p - 1) * $page_size)
            ->limit($page_size)
            ->all();
        $data = [];

        if($list){
            foreach ($list as $_item){
                $data[] = [
                    'id' => $_item['id'],
                    'nickname' => UtilService::encode($_item['nickname']),
                    'mobile' => UtilService::encode($_item['mobile']),
                    'sex_desc' => ConstantMapService::$sex_mapping[ $_item['sex']],
                    'avatar' => UrlService::buildPicUrl("avatar",$_item['avatar']),
                    'status_desc' => ConstantMapService::$status_mapping[ $_item['status']],
                    'status' => $_item['status']
                ];
            }
        }

        return $this->render('index',[
            'list' => $data,
            'search_conditions' =>[
              'mix_kw' => $mix_kw,
              'p'=> $p,
              'status'=> $status
            ],
            'status_mapping' => ConstantMapService::$status_mapping,
            'pages' =>[
                'total_count' => $total_res_count,
                'page_size' =>$page_size,
                'total_page' => $total_page,
                'p' => $p
            ]
        ]);
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
