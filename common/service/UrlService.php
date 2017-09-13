<?php
/**
 * Created by PhpStorm.
 * User: UrlService
 * Date: 2017/9/13
 * Time: 17:05
 */

namespace app\common\components;
use yii\helpers\Url;

/**
 * Class UrlService
 * @package app\common\components
 *
 *
 */


class UrlService
{
   public static  function  buildWebUrl($path,$params=[]){
        $path = Url::toRoute(array_merge([$path],$params));
        return "/web".$path;
   }

   public static function  buildMUrl($path,$params=[]){
       $path = Url::toRoute(array_merge([[$path]],$params));
       return "/m".$path;
   }
   // www
    public static function  buildWwwUrl($path,$params=[]){
        $path = Url::toRoute(array_merge([[$path]],$params));
        return "/m".$path;
    }
   // null
    public static function  buildNullUrl(){
        return "javascript:void(0);";
    }
}