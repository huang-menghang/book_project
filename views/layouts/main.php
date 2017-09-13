<?php
// 引入前端资源文件
use  app\assets\AppAsset;
// 将当前视图注入进来
AppAsset::register($this);
?>
// 视图开始注入点
<?php $this->beginPage();?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--css head区域，js是放在</body>区域内 -->
    <?php $this->head();?>
    <title>编程浪子微信图书商城</title>
<body>
<?php $this->beginBody();?>
<div class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-collapse collapse pull-left">
            <ul class="nav navbar-nav ">
                <li><a href="http://book.imooc.test/">首页</a></li>
                <li><a target="_blank" href="http://www.54php.cn/">博客</a></li>
                <li><a href="http://book.imooc.test/web/user/login">管理后台</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- 需要放入的不同内容begin-->
<?=$content;?>
<!-- 需要放入的不同内容end-->
<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage();