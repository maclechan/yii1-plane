<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>坛城文化后台管理系统</title>
<link href="<?php echo CSS_URL; ?>/bootstrap.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/base_new.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/font.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/member.css"/>
<script  src="<?php echo Yii::app()->homeUrl;?>js/jquery.min.js"></script>
</head>
<style type="text/css">
label {
  display: inline;line-height:26px;
  margin-bottom: 0;
}
</style>
<body>
    <div class="main">
     <div class="tab">
	     <div class="tabLeft">当前位置：
	     	<a href="javascript:void(0);" class="ccc_color">用户管理</a> > 
	     	<a href="javascript:void(0);" class="ccc_color">员工管理</a> > 
	     	<a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">新增员工</a>
	    </div>
     </div>
     <div class="search">
	 
        <div class="clear"></div>
     </div>	 
     <div class="clear"></div>
      <div class="shops_add">
     <?php $form=$this->beginWidget("CActiveForm")?>
     <table class="same_t table table-hover">
      <thead style="background-color:#FFF">
     <tr>
	    <td colspan="3" align="left">
	      <span style="color: #03F">（提示：请输入员工真实姓名，以作后台登陆使用！）</span>	      </td>
	    </tr>
  <tr>
    <td width="103" style="text-align:right">
    	<?php echo $form->label($emp_model,'user_name'); ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td style="text-align:left">
	    <?php echo $form->textField($emp_model,'user_name',array('class'=>'input_style')); ?>&nbsp;&nbsp;&nbsp;&nbsp;
    </td>
    <td style="text-align:left">
	    <!--表单验证失败显示错误信息-->
	   <span style="color: red"><?php echo $form ->error($emp_model,'user_name'); ?></span>
    </td>
  </tr>
  <tr>
    <td style="text-align:right">
    	<?php echo $form->label($emp_model,'password'); ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td style="text-align:left">
	    <?php echo $form->passwordField($emp_model,'password',array('class'=>'input_style')); ?>&nbsp;&nbsp;&nbsp;&nbsp;	   
    </td>
     <td width="691" align="left" valign="middle">
	    <!--表单验证失败显示错误信息-->
	   <span style="color: red"><?php echo $form ->error($emp_model,'password'); ?></span>
    </td>
  </tr>
  <tr>
    <td style="text-align:right"><?php echo $form->label($emp_model,'mobile');?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td style="text-align:left">
    	 <?php echo $form->textField($emp_model,'mobile',array('class'=>'input_style')); ?>&nbsp;&nbsp;&nbsp;&nbsp;    	
    </td>
    <td style="text-align:left"><span style="color: red">
    		<!--表单验证失败显示错误信息-->
	   		<?php echo $form ->error($emp_model,'mobile'); ?>
	    </span></td>
  </tr>
  <tr>
    <td style="text-align:right">
    <?php echo $form->label($emp_model,'email');?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td style="text-align:left">
   		  <?php echo $form->textField($emp_model,'email',array('class'=>'input_style')); ?>&nbsp;&nbsp;&nbsp;&nbsp;
   		 
    </td>
    <td style="text-align:left"><span style="color: red">
    		<!--表单验证失败显示错误信息-->
	   		<?php echo $form ->error($emp_model,'email'); ?>
	    </span>
        </td>
  </tr>
  <tr>
    <td style="text-align:right">
    <?php echo $form->label($emp_model,'user_groups');?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td style="text-align:left">
    <select name='role_id' id="role_id" class="span2">
            	<option value="0">请给员工分配组</option>
            	<?php 
            		if($user_info->role_id==1){
						foreach ($role_model as $k=>$v){ ?>
							<?php if($v -> role_id!=1){?>
							<option value="<?php echo $v -> role_id; ?>" >
								<?php echo $v->role_name?>		
							</option>
				<?php 
							}
						}
            			
            		}elseif($user_info->role_id==2){
						foreach ($role_model as $k=>$v){ ?>
							<?php if($v -> role_id!=1 && $v -> role_id!=2){?>
							<option value="<?php echo $v -> role_id; ?>" >
								<?php echo $v->role_name?>		
							</option>
						<?php 	} }
					}else if($user_info->role_id==3){
						foreach ($role_model as $k=>$v){ ?>
							<?php if($v -> role_id!=1 && $v -> role_id!=2){?>
							<option value="<?php echo $v -> role_id; ?>" >
								<?php echo $v->role_name?>		
							</option>
						<?php 	} }
            		}else{
            				echo '<option>你没有这个权限</option>';
            			}
            	?>				
     </select>
    
    </td>
    <td></td>
  </tr>

  <tr>
    <td style="text-align:right">
    <?php echo $form->label($emp_model,'status');?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td style="text-align:left">
		<?php echo $form->radioButtonList($emp_model,'status',array(0=>'禁用 ',1=>'开启'),array('separator'=>'&nbsp;'))?>   		
    </td>
    <td>
    	<span style="color: red">
    		<!--表单验证失败显示错误信息-->
	   		<?php echo $form ->error($emp_model,'status'); ?>
	    </span>
	</td>      
  </tr>
    <tr>   	 
	      <td></td>
	    <td>
	    	<input type="submit"  class="btn btn-primary" name="保存" id="epmadd" value="确定添加" />&nbsp;&nbsp;
            <input name=""  class="btn btn-primary" type="reset" value="重置" />
        </td>
        <td>
        <span style="color: red">
	    <?php
                //判断是否有提示信息
                if(Yii::app()->user->hasFlash('success')){
                    echo Yii::app()->user->getFlash('success');
                }         
            ?>
          </span></td>
	  </tr>
      </thead>
</table>
</div>
<div class="pageBG"></div>
<?php $this->endWidget(); ?>
    
</div>

</body>
</html>
<script>
     document.getElementById('role_id').value=<?php echo isset($emp_model)?$emp_model->role_id:0;?>
</script>