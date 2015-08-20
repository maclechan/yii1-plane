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
        <li><a href='#'> 我的首页 </a></li>
        <li class="active">会长信息修改</li>
    </ul>
</div>

<div class="whg-admin-wrap">
    <p></p>
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> 
                <small>会长信息修改</small>
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
                    <td class="whg-text-right"><?php echo $form->labelEx($list,'loger');?>：</td>
                    <td><?php echo $form->textField($list,'loger',array("class"=>"form-control","placeholder"=>"协会登录名不能为空"));?></td>
                    <td><?php echo $form->error($list,'loger');?></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'password');?>：</td>
                    <td><?php echo $form->passwordField($list,'password',array("class"=>"form-control","placeholder"=>"不填默认为 123321"));?></td>
                    <td><?php echo $form->error($list,'password');?></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'icon');?>：</td>
                    <td><?php echo CHtml::activeFileField($list,'g_path'); ?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->labelEx($list,'assoc_name');?>：</td>
                    <td><?php echo $form->textField($list,'assoc_name',array("class"=>"form-control","placeholder"=>"协会登录名不能为空"));?></td>
                    <td><?php echo $form->error($list,'assoc_name');?></td>
                  </tr>
                   <tr>
                    <td class="whg-text-right"><?php echo $form->labelEx($list,'assocer');?>：</td>
                    <td><?php echo $form->textField($list,'assocer',array("class"=>"form-control","placeholder"=>"协会登录名不能为空"));?></td>
                    <td><?php echo $form->error($list,'assocer');?></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->labelEx($list,'mobile');?>：</td>
                    <td><?php echo $form->textField($list,'mobile',array("class"=>"form-control","placeholder"=>"手机必填"));?></td>
                    <td><?php echo $form->error($list,'mobile');?></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'qq');?>：</td>
                    <td><?php echo $form->textField($list,'qq',array("class"=>"form-control","placeholder"=>"qq"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->labelEx($list,'mail');?>：</td>
                    <td><?php echo $form->textField($list,'mail',array("class"=>"form-control","placeholder"=>"邮件"));?></td>
                    <td><?php echo $form->error($list,'mail');?></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'assocer_jy');?>：</td>
                    <td><?php echo $form->textField($list,'assocer_jy',array("class"=>"form-control"));?></td>
                    <td></td>
                  </tr>
                  
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'assoc_desc');?>：</td>
                    <td><div id="edui_fixedlayer" style="padding-left:60px;width:750px;height:450px">
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
                    initialContent:'".$list->assoc_desc."',
                    ",
            ));
?></div></td>
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
