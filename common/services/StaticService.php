<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2017/9/16
 * Time: 13:32
 */

namespace app\common\services;


class StaticService
{
  public static function  includeAppJsStatic($path,$depend){
      self::includeAppStatic("js",$path,$depend);
  }
  public static function  includeAppCssStatic($path,$depend){
      self::includeAppStatic("css",$path,$depend);
  }
  protected  static  function  includeAppStatic($type,$path,$depend){
        $release_version = defined("RELEASE_VERSION")?RELEASE_VERSION:time();
        $path = $path."?ver=".$release_version;
         if($type == "js"){
             \Yii::$app->getView()->registerJsFile($path,["depends"=>$depend]);
         }else{
             \Yii::$app->getView()->registerCssFile($path,["depends"=>$depend]);
         }


  }

}