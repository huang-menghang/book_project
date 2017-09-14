<?php
/**
 * Created by PhpStorm.
 * User: BaseWebController
 * Date: 2017/9/13
 * Time: 15:50
 */

namespace app\common\components;
use yii\web\Controller;


/**
 * Class BaseWebController
 * @package app\common\components
 *
 *  集成常用公共方法，
 *  get,post,setCookie,getCookie,removeCookie,renderJson
 *
 */

class BaseWebController extends  Controller
{

  public $enableCsrfValidation =false;
   // 获取http的get参数
  public function get($key,$default_val=""){
      return \Yii::$app->request->get($key,$default_val);
  }
   //获取http的post参数
  public  function  post($key,$default_val=""){
      return \Yii::$app->request->post($key,$default_val);
  }
  //设置cookie值
  public function  setCookie($name,$value,$expire = 0){
      $cookies = \Yii::$app->response->cookies;
      $cookies->add(new \yii\web\Cookie([
                 'name'=>$name,
                 'value'=>$value,
                  'expire'=>$expire
          ]));
  }
  //获取cookie
   public  function  getCookie($name,$default_val=""){
      $cookie = \Yii::$app->request->cookies;
      return $cookie->getValue($name,$default_val);
   }
 //删除cookie
    public function  removeCookie($name){
       $cookies = \Yii::$app->response->cookies;
       $cookies->remove($name);
    }
   // api 调用统一返回json的方法，req_id 用来反推问题
      public function renderJson($data = [],$msg="ok",$code=200){
          header('Content-type:application/json');
          echo json_encode([
              "code" => $code,
              "msg" => $msg,
              "data" => $data,
              "req_id"=> uniqid()
          ]);
          //return  \Yii::$app->end();
    }
    public function  renderJs($msg,$url){
          return $this->renderPartial("@app/views/common/js",['msg'=>$msg,'url'=>$url]);
    }
}