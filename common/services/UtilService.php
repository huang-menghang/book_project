<?php
/**
 * Created by PhpStorm.
 * User: UtilService
 * Date: 2017/9/14
 * Time: 17:23
 */

namespace app\common\services;


class UtilService
{
    public  static  function  getIP(){
        if(!empty( $_SERVER['HTTP_X_FORWARDED_FOR'])){
           return  $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $_SERVER['REMOTE_ADDR'];
    }

}