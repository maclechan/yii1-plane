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
        <li><a href='#'> 协会管理 </a></li>
        <li class="active"><a href='#'>协会活动</a></li>
    </ul>
</div>

<div class="whg-admin-wrap">
    <p></p>
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> 
                <small>协会活动 </small>
                <small class="red">
                <?php
                  //判断是否有提示信息
                  if(Yii::app()->user->hasFlash('success')){
                      echo Yii::app()->user->getFlash('success');
                  }         
                ?>
                </small>
              </div>
              
              <?php $form = $this -> beginWidget("CActiveForm",array('htmlOptions' => array('enctype' => 'multipart/form-data','role'=>'form','class'=>"form-inline")));?>
              <table class="table">             
                <tbody>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'title');?></td>
                    <td><?php echo $form->textField($list,'title',array("class"=>"form-control"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'pic');?></td>
                    <td><?php echo CHtml::activeFileField($list,'g_path',array('style'=>'width:160px;')); ?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'type');?>：</td>
                    <td><?php echo $form->dropDownList($list,'type',array(1=>'会长风采',2=>'协会热门活动'),array("class"=>"form-control"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'content');?>：</td>
                    <td colspan="2">
                        <div id="edui_fixedlayer" style="padding-left:60px;width:750px;height:450px">
<?php

 $this->widget('ext.ueditor.Ueditor',
            array(
                'getId'=>'desc',
                'UEDITOR_HOME_URL'=>"/",
                'options'=>"toolbars:[['fullscreen', 'source', '|', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch','autotypeset', '|',
                'blockquote', '|', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist','selectall', 'cleardoc', '|', 'customstyle',
                'paragraph', '|','rowspacingtop', 'rowspacingbottom','lineheight', '|','fontfamily', 'fontsize', '|',
                'directionalityltr', 'directionalityrtl', '|', '', 'indent', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
                'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright',
                'imagecenter', '|', 'insertimage', 'emotion', 'insertvideo', 'attachment', 'map', 'gmap', 'insertframe','highlightcode','webapp','pagebreak', '|',
                'horizontal', 'date', 'time', 'spechars','snapscreen', 'wordimage', '|',
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 

'splittorows', 'splittocols', '|',
                'print', 'preview', 'searchreplace','help']],
                    wordCount:false,
                    elementPathEnabled:false,
                    imagePath:'/assets/1f670b15/php/',
                    ",
            ));
?></div>
                    </td>
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

</body>
</html>
