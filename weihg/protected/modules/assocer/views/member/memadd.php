<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="pragma" content="no-cache">  
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">  
<meta http-equiv="expires" content="0">  
<title>顾问后台管理系统</title>
  <script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/jquery-1.11.1.min.js"></script>
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/whg-manage-common.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/html5shiv.js"></script>
    <![endif]-->

</head>
<body>
<div class="breadcrumbs">
    <ul class="breadcrumb">
        <li><i class="glyphicon glyphicon-home"></i><a href='#'> 首页 > </a></li> 
        <li><a href='#'> 协会成员 </a></li>
        <li class="active"><a href='#'>添加成员</a></li>
    </ul>
</div>

<div class="whg-admin-wrap">
    <p></p>
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> 
                <small>协会成员录入</small>
                <small class="red">
                <?php
                  //判断是否有提示信息
                  if(Yii::app()->user->hasFlash('success')){
                      echo Yii::app()->user->getFlash('success');
                  }         
                ?>
                </small>
              </div>
              <div class="panel-body">
                <p><span class="glyphicon glyphicon-hand-right"></span> <small>为了更好的体验，请在谷歌浏览器下操作！</small></p>
              </div>
              <?php $form = $this -> beginWidget("CActiveForm",array('htmlOptions' => array('enctype' => 'multipart/form-data','role'=>'form','class'=>"form-inline")));?>
              <table class="table">
              
                <tbody>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'cy_name');?>：</td>
                    <td><?php echo $form->textField($list,'cy_name',array("class"=>"form-control","placeholder"=>"协会成员名称"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'cy_logo');?>：</td>
                    <td><?php echo CHtml::activeFileField($list,'g_path'); ?></td>
                    <td></td>
                  </tr>
                
                  <tr>
                    <td></td>
                    <td>
                        <input type="submit" class="button button-rounded button-flat-primary" value=" 添 加 " />
                        <input class="button button-rounded button-flat-primary" type="reset" value=" 重 置 "></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
              <?php $this->endWidget();?>
            </div>       
</div>  

<!--footer message-->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container"></div>
</nav>
<!--footer message-->
</body>
</html>
