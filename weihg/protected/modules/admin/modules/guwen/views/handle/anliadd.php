<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="pragma" content="no-cache">  
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">  
<meta http-equiv="expires" content="0">  
<title>案例信息录入</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/crop/imgareaselect-default.css" media="all" >
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/crop/uploadify.css" media="all" >
<script data-main="<?php echo Yii::app()->homeUrl;?>js/crop/anli" type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/crop/require.min.js"></script>
 <script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/bootstrap.min.js"></script>
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/css/buttons.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/whg-admin-common.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/html5shiv.js"></script>
    <![endif]-->

<style type="text/css">
#image-uploaded,
#image-cuted{
    position:relative;
    max-width:100%;
}
#cut-preview-wrap{
    position:relative;
    display:block;
    padding:0;
    margin:0;
    border:0;
    width:100%;
    overflow:hidden;
}
#cut-preview{
    position:absolute;
    padding:0;
    margin:0;
    border:0;
    top:0;
    left:0;
}
label{font-weight:normal;}
.modal-lg{width: 1000px}

</style>
</head>
<body>
<div class="breadcrumbs">
    <ul class="breadcrumb">
        <li><i class="glyphicon glyphicon-home"></i><a href='#'> 首页 > </a></li> 
        <li><a href='#'> 顾问管理 </a></li>
        <li class="active"><a href='#'>顾问信息</a></li>
        <li class="active">案例录入</li>
    </ul>
</div>

<div class="whg-admin-wrap">
    <p></p>
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> 
                <small>案例录入 </small>
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
                    <td class="whg-text-right"><?php echo $form->label($list,'advi_id');?>：</td>
                    <td><input type="text" readonly="" placeholder="<?php echo $adviser->id;?>" class="form-control"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'advi_name');?>：</td>
                    <td><input type="text" readonly="" placeholder="<?php echo $adviser->name;?>" class="form-control"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->labelEx($list,'title');?>：</td>
                    <td><?php echo $form->textField($list,'title',array("class"=>"form-control","placeholder"=>"案例名称"))?></td>
                    <td><?php echo $form->error($list,'title',array('class'=>'errorMessage glyphicon glyphicon-exclamation-sign'));?></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->labelEx($list,'cover');?>：</td>
                    <td>
                        <input type="hidden" id="hide-cuted" name="AdviserAnli[cover]" class="form-control">
                        <button type="button" class="btn btn-info btn-sm glyphicon glyphicon-picture" data-toggle="modal" data-target=".bs-example-modal-lg"><small> 上传图像</small></button>
                        <img id="image-cutshow" width="50" src="" class="img-circle" alt="">
                        
                    </td>
                    <td><?php echo $form->error($list,'cover',array('class'=>'errorMessage glyphicon glyphicon-exclamation-sign'));?></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'zans');?>：</td>
                    <td><?php echo $form->textField($list,'zans',array("class"=>"form-control","placeholder"=>"不填默认为99个赞"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'desc');?>：</td>
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
<!--图像裁剪区域-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">图像裁剪</h4>
      </div>
      <div class="modal-body">
        <div class="container">

        <div class="row" id="cutone">
            <div class="col-xs-3">
              
                <div id="upload-wrap" style="margin-top:40px;">
                    <input type="file"  id="file" name="file" />
                    <span class="help-block">选择图片(1M以内);</span>
                    <span class="help-block">图片格式必须为：png, jpeg, jpg, gif;</span>
                    <span class="help-block">图片不允许涉及政治敏感与色情;</span>
                    <p>
                        <a id="upload" class="btn btn-sm btn-success" style="display:none;" href="#">上传</a>
                    </p>

                    <br>
                    <div class="col-xs-12" id="ratio-wrap" style="margin-top:30px;display:none;">
                        <div id="ratio-input" class="input-group">
                            <span class="input-group-addon">裁剪宽高比例</span>
                            <input type="text" id="ratio" class="form-control" placeholder="Ratio" value="3.2">
                         </div>
                        <span id="cut-help" class="help-block">输入宽高比进行裁剪初始化。例如3.2</span>
                        <p>
                            <a id="cutInit" class="btn btn-success" href="#">下一步</a>
                            <a id="cut" style="display:none;" class="btn btn-success" href="#">确定裁剪</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <label for="">裁剪区域</label>
                <div class="row">
                    <div class="col-xs-12" id="uploaded-wrap" style="display:none;">
                    </div>
                </div>
            </div>
            <div class="col-xs-3" id="preview-wrap" style="display:none;">
                <label for="">裁剪预览</label>
                <div id="cut-preview-wrap">
                    <img id="cut-preview" src="" alt="">
                </div>
                <p>
                    <small id="log"></small>
                </p>
                
            </div>
        </div>

        <div class="row" id="cuted-wrap" style="display:none;">
            <div class="col-xs-offset-1 col-xs-8 text-center">
                <h4>成功预览</h4>
                <p><img id="image-cuted" src="" alt=""></p>
                <button type="button" class="btn btn-success btn-block" data-dismiss="modal">确定</button>
            </div>
        </div>

    </div>

      </div>
    </div>
  </div>
</div>
<!--图像裁剪区域-->    

</body>
</html>
