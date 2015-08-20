<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="pragma" content="no-cache">  
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">  
<meta http-equiv="expires" content="0">  
<title>会长后台管理系统</title>
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/whg-manage-common.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
<!--bread-->
<div class="breadcrumbs breadcrumbs-fixed">
    <ul class="breadcrumb">
        <li><i class="glyphicon glyphicon-home"></i><a href='#'> 首页 > </a></li> 
        <li><a href='#'> 我的首页 </a></li>
    </ul>
</div>
<!--bread-->

    <div class="mange-panel">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><span aria-hidden="true" class="glyphicon glyphicon-user"></span> 我的基本信息</h3>
          </div>
          <div class="panel-body">   
            <dl class="dl-horizontal">
                <dt><img width="120" height="120" src="<?php echo '/'.$user->icon;?>" class="img-circle" alt="" /></dt>
                <dd><br />欢迎您： <?php echo $user->loger?> 
                    来到会长后台管理系统<br />
                    tel ：<?php echo $user->mobile?><br />
                    qq ：<?php echo $user->qq?><br />
                </dd>
            </dl>
            <ul class="list-unstyled">
                 <li><hr /></li>
                <li>简介：</li>
                <p> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user->assocer_jy?></p>
            </ul>
          </div>
        </div>
    </div>
</body>
</html>