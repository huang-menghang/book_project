<?php
/**
 * Created by PhpStorm.
 * User: UrlService
 * Date: 2017/9/13
 * Time: 17:05
 */

namespace app\common\services;
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
        $domain_config = \Yii::$app->params['domain'];
        $path = Url::toRoute(array_merge([$path],$params));
        return $domain_config['web'].$path;
   }

   public static function  buildMUrl($path,$params=[]){
       $domain_config = \Yii::$app->params['domain'];
       $path = Url::toRoute(array_merge([$path],$params));
       return $domain_config['m'].$path;
   }
   // www
    public static function  buildWwwUrl($path,$params=[]){
        $domain_config = \Yii::$app->params['domain'];
        $path = Url::toRoute(array_merge([$path],$params));
        return  $domain_config['www'].$path;
    }
   // null
    public static function  buildNullUrl(){
        return "javascript:void(0);";
    }
}