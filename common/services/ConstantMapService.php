<?php
/**
 * Created by PhpStorm.
 * User: ConstantMapService
 * Date: 2017/9/17
 * Time: 14:05
 */

namespace app\common\services;


class ConstantMapService
{
    public static $status_default = -1;
    public static $status_mapping = [
        1 => '正常',
        0 => '已删除'
    ];

    public static $default_avatar = "default_avatar";

    public static $default_password = "******";

    public static $default_syserror = "系统繁忙,请稍后尝试~~";

    public static $sex_mapping = [
        1 => '女',
        0 => '男'
    ];

}