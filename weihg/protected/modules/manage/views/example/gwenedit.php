<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="pragma" content="no-cache">  
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">  
<meta http-equiv="expires" content="0">  
<title>顾问信息编辑</title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/crop/imgareaselect-default.css" media="all" >
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/crop/uploadify.css" media="all" >
    <script data-main="<?php echo Yii::app()->homeUrl;?>js/crop/manage_anli" type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/crop/require.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/bootstrap.min.js"></script>
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/css/buttons.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/whg-manage-common.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/html5shiv.js"></script>
    <![endif]-->
<script  src="<?php echo Yii::app()->homeUrl;?>js/geo.js"></script>
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
<body onload="setup();preselect('<?php echo $list->province?>','<?php echo $list->city?>','<?php echo $list->area?>');">
<div class="breadcrumbs">
    <ul class="breadcrumb">
        <li><i class="glyphicon glyphicon-home"></i><a href='#'> 首页 > </a></li> 
        <li><a href='#'> 我的管理 </a></li>
        <li class="active">个人信息编辑</li>
    </ul>
</div>

<div class="guwenedit">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><span aria-hidden="true" class="glyphicon glyphicon-user"></span> 基本信息编辑</h3>
      </div>
      <div class="panel-body">   
        <?php $form = $this -> beginWidget("CActiveForm",array('htmlOptions' => array('enctype' => 'multipart/form-data','role'=>'form','class'=>"form-inline")));?>
              <table class="table">          
                <tbody>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->labelEx($list,'name');?>：</td>
                    <td><?php echo $form->textField($list,'name',array("class"=>"form-control","placeholder"=>"真实姓名不能为空"));?></td>
                    <td><?php echo $form->error($list,'name');?></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'password');?>：</td>
                    <td><?php echo $form->passwordField($list,'password',array("class"=>"form-control","placeholder"=>"不填默认为 123321"));?></td>
                    <td><?php echo $form->error($list,'password');?></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'sex');?>：</td>
                    <td><?php $list->sex=1;?><?php echo $form->radioButtonList($list,'sex',array(1=>'男 ',2=>' 女'),array('separator'=>'&nbsp;&nbsp;&nbsp;'))?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->labelEx($list,'icon');?>：</td>
                    <td>
                        <input type="hidden" id="hide-cuted" name="Adviser[icon]" value="<?php echo $list->icon;?>" class="form-control">
                        <button type="button" class="btn btn-info btn-sm glyphicon glyphicon-picture" data-toggle="modal" data-target=".bs-example-modal-lg"><small> 更新图像</small></button>
                        <img id="image-cutshow" width="50" src="<?php echo $list->icon;?>" class="img-circle" alt="">
                        
                    </td>
                    <td><?php echo $form->error($list,'icon');?></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'level');?>：</td>
                    <td><?php echo $form->dropDownList($list,'level',array(1=>'初级',2=>'中级',3=>'高级'),array("class"=>"form-control"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'job');?>：</td>
                    <td><?php echo $form->dropDownList($list,'job',array(1=>'司仪',2=>'策划'),array("class"=>"form-control"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'style');?>：</td>
                    <td><?php echo $form->dropDownList($list,'style',array(1=>'个性',2=>'时尚',3=>'奢华',4=>' 草坪',5=>'清新',6=>'浪漫',7=>'童话',8=>'唯美',9=>'中式',10=>'西式',11=>'庄重',12=>'复古'),array("class"=>"form-control"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'work_exp');?>：</td>
                    <td><?php echo $form->dropDownList($list,'work_exp',array(1=>'1-5年',2=>'5-10年',3=>'10-15年',4=>'15-20年',5=>'20年以上'),array("class"=>"form-control"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'price_fw');?>：</td>
                    <td><?php echo $form->dropDownList($list,'price_fw',array(1=>'800元-1500元',2=>'1500元-3000元',3=>'3000元-5000元',4=>'5000元-8000元',5=>'8000元-10000元',6=>'10000元以上'),array("class"=>"form-control"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'garees');?>：</td>
                    <td><?php echo $form->dropDownList($list,'garees',array(1=>'150场 - 200场',2=>'200场-500场',3=>'500场-800场',4=>'800场-1000场',5=>'1000+场'),array("class"=>"form-control"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'anlis');?>：</td>
                    <td><?php echo $form->textField($list,'anlis',array("class"=>"form-control","placeholder"=>"填写一个数字如 100"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->labelEx($list,'mobile');?>：</td>
                    <td><?php echo $form->textField($list,'mobile',array("class"=>"form-control","placeholder"=>"手机必填"));?></td>
                    <td><?php echo $form->error($list,'mobile');?></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'phone');?>：</td>
                    <td><?php echo $form->textField($list,'phone',array("class"=>"form-control","placeholder"=>"固定电话"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->labelEx($list,'weixin');?>：</td>
                    <td><?php echo $form->textField($list,'weixin',array("class"=>"form-control","placeholder"=>"微信必填"));?></td>
                    <td><?php echo $form->error($list,'weixin');?></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'qq');?>：</td>
                    <td><?php echo $form->textField($list,'qq',array("class"=>"form-control"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right">城市：</td>
                    <td>  
                          <?php echo $form->dropDownList($list,'province',array(),array("class"=>"select span2 form-control",'id'=>'s1'));?>
                          <?php echo $form->dropDownList($list,'city',array(),array("class"=>"select span2 form-control",'id'=>'s2'));?>
                          <?php echo $form->dropDownList($list,'area',array(),array("class"=>"select span2 form-control",'id'=>'s3'));?>
                    </td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'address');?>：</td>
                    <td><?php echo $form->textField($list,'address',array('style'=>'width:400px',"class"=>"form-control"));?></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td class="whg-text-right"><?php echo $form->label($list,'intro');?>：</td>
                    <td><?php echo $form->textArea($list,'intro',array('style'=>'width:400px;height:300px;','class'=>'form-control','rows'=>'5'));?></td>
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
                            <input type="text" id="ratio" class="form-control" placeholder="Ratio" value="1.1">
                         </div>
                        <span id="cut-help" class="help-block">输入宽高比进行裁剪初始化。例如1.3</span>
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
