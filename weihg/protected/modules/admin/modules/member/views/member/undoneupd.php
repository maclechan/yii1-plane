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
<script  src="<?php echo Yii::app()->homeUrl;?>js/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">
$(function(){
	$('#memadd').click(function(){
		var name = $('#name').val();
		var mobile = $('#mobile').val();
		var sex = $("input[name='sex']:checked").val();
		var qq = $('#qq').val();
		var cid = '';
		$('input[name=need[]]').each(function(){
			if($(this).attr('checked')==true){
				cid += $(this).val()+',';
			}
		}); 		
		var wed_t = $('#wed_t').val();
		var address = $('#address').val();
		var allot_desc = $('#allot_desc').val();
		var regexp = /((\(\d{3}\))|(\d{3}\-))?13[0-9]\d{8}|15[0-9]\d{8}|18[0-9]\d{8}/g;
		if(name==''){
			$("#name_msg").html("请输入姓名");
			$('#name').focus();
			return false;
		}else if(mobile=='' || !regexp.test(mobile) || mobile.length > 11){
			$("#name_msg").html("");
			$("#mobile_msg").html("请输入正确的手机号");
			$('#mobile').focus();
			return false;		
		}else if(cid==''){
			$("#name_msg").html("");
			$("#mobile_msg").html("");
			$("#need_msg").html("请至少选择一个需求");
			$('#need').focus();
			return false;		
		}else if(wed_t==''){
			$("#name_msg").html("");
			$("#mobile_msg").html("");
			$("#need_msg").html("");
			$("#wedt_msg").html("请选择婚期");
			$('#wed_t').focus();
			return false;		
		}else{
			$("#name_msg").html("");
			$("#mobile_msg").html("");
			$("#need_msg").html("");
			$("#wedt_msg").html("");
			$.ajax({
				type: "POST",
				url: "/admin/member/member/undonememupdsave",
				data: {'name':name,'mobile':mobile,'sex':sex,'qq':qq,'cid':cid,'wed_t':wed_t,'address':address,'allot_desc':allot_desc,"mid":<?php echo isset($memupd)?$memupd->id:''?>},
				success:function(msg){
			//	alert(msg);return false;
				if(msg==1){
					alert('编辑成功');
				//	window.location.href='/admin/member/member/undonemem';	
					window.history.go(-1);
				}else if(msg==3){
					alert('请把必选项输入完整'); 
				}else{
					alert('编辑失败');
				}
				}
			}); 
		}
	}); 
});
</script>

</head>
<style type="text/css">
label {
  display: inline;line-height:26px;float:left;
  margin-bottom: 0;
}
</style>
<body>
    <div class="main">
     <div class="tab">
     <div class="tabLeft">
     	当前位置    <a href="javascript:void(0);" class="ccc_color">用户管理</a> > 
     		 	<a href="javascript:void(0);" class="ccc_color">网友管理</a> > 
    		 	<a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">编辑网友</a>
     </div>
     </div>    
          
     <div class="clear"></div>
<div class="shops_add">
<!-- 表单  开始 -->

    <table class="same_t table">
    	 <thead style="background-color:#FFF">
		<tr>
			<td align="left" colspan="3">
				<span style="color: #03F">（提示：*号为必填项！）</span>	      
			</td>
	    </tr>		 
		  <tr>
		    <td width="11%" height="40" align="right" valign="middle">
		    	网友名字<font color="red">&nbsp;*</font>&nbsp;&nbsp;&nbsp;
		    </td>
		    <td height="40" colspan="3" style="text-align:left">
		    	<input type="text" id="name" name="name" value="<?php echo isset($memupd)?$memupd->name:''?>" />
		    	<!--表单验证失败显示错误信息-->
			    <span class="red"><div id="name_msg"></div></span>
		    </td>
		   </tr>    
		   <tr>
		    <td width="11%" height="40" align="right" valign="middle">
		    	网友手机<font color="red">&nbsp;*</font>&nbsp;&nbsp;&nbsp;
		    </td>
		    <td width="37%" height="40" style="text-align:left">
		    	<input type="text" id="mobile" name="mobile" value="<?php echo isset($memupd)?$memupd->mobile:''?>" />
				<span class="red"><div id="mobile_msg"></div></span>   
		    </td>
		   </tr>
		  <!-- 需求  结束-->   
		  <tr>
		    <td height="40" align="right" valign="middle">网友性别&nbsp;&nbsp;&nbsp;</td>
		    <td height="40" style="text-align:left">
				<label class="radio inline"><input type="radio" <?php echo isset($memupd) && $memupd->sex=='保密'?'checked="true"':'';?> id="sex" value="保密" name="sex" class="txt">保密</label>
				<label class="radio inline"><input type="radio" <?php echo isset($memupd) && $memupd->sex=='男'?'checked="true"':'';?> id="sex" value="男" name="sex" class="txt">男</label>
				<label class="radio inline"><input type="radio" <?php echo isset($memupd) && $memupd->sex=='女'?'checked="true"':'';?> id="sex" value="女" name="sex" class="txt">女</label>
		    </td>
		    <td height="40" style="text-align:left">		    		
				<!--表单验证失败显示错误信息-->
		        <span class="red"><div id="name_msg"></div></span>
		    </td>
		  </tr>		    		    
		  <tr>
		    <td width="11%" height="40" align="right" valign="middle">网友QQ&nbsp;&nbsp;&nbsp;</td>
		    <td width="37%" height="40" style="text-align:left">
		    	<input type="text" id="qq" name="qq" value="<?php echo isset($memupd)?$memupd->qq:''?>" />
		    	<!--表单验证失败显示错误信息-->
			   <span class="red"><div id="qq_msg"></div></span>
		    </td>
		  </tr>			
		  <!-- 需求  开始-->  		   
		   <tr>
		    <td height="40" align="right" valign="middle">网友需求<font color="red">&nbsp;*</font>&nbsp;&nbsp;&nbsp;</td>
		    <td height="40" style="text-align:left">
		    	<?php 
					if(isset($memupd)){
						$i = 1;
						foreach($memupd->alot as $alval){
							$alarr[] = $alval->category_id;
							if($i == 1){
								$allot_desc = $alval->allot_desc;
							}
							$i++;
						}
					}
		    		if($category){
		    			foreach($category as $v){
		    			//	echo "<input type=\"checkbox\" name=\"need[]\" value=\"{$v->c_id}\">{$v->c_name}&nbsp;&nbsp;";
							$checked = isset($alarr) && in_array($v->c_id,$alarr) ? 'checked="ture"' : '';
							echo '<label class="checkbox inline">
								<input type="checkbox" name="need[]" '.$checked.' value="'.$v->c_id.'+'.$v->c_name.'">
									'.$v->c_name.'
							</label>';
		    			}
		    		}
		    	
		    	?>
		    </td>
		    <td height="40" style="text-align:left">		    		
		    	<!--表单验证失败显示错误信息-->
		         <span class="red"><div id="need_msg"></div></span>
		    </td>
		  </tr>		   				    		    

		  <tr>
		    <td width="11%" height="40" align="right" valign="middle">需求描述&nbsp;&nbsp;&nbsp;</td>
		    <td width="37%" height="40" style="text-align:left">
				<textarea id="allot_desc" name="allot_desc" class="t_w"><?php echo isset($allot_desc)?$allot_desc:''?></textarea>
		    	<!--表单验证失败显示错误信息-->
			   <span class="red"><div id="allotdesc_msg"></div></span>
		    </td>
		  </tr>
		  
		  <tr>
		    <td height="40" align="right" valign="middle">网友婚期<font color="red">&nbsp;*</font>&nbsp;&nbsp;&nbsp;</td>
		    <td height="40" style="text-align:left">
		    	<input type="text" id="wed_t" name="wed_t" onfocus="WdatePicker()" value="<?php echo isset($memupd)?date('Ymd',$memupd->wed_t):''?>" />
		    	<!--表单验证失败显示错误信息-->
			   <span class="red"><div id="wedt_msg"></div></span>
		    </td>
		  </tr>		  
		  		  
		  <tr>
		    <td width="11%" height="40" align="right" valign="middle">网友地址&nbsp;&nbsp;&nbsp;</td>
		    <td width="37%" height="40" style="text-align:left">
		    	<input type="text" id="address" name="address" value="<?php echo isset($memupd)?$memupd->address:''?>" />
		    	<!--表单验证失败显示错误信息-->
			   <span class="red"><div id="address_msg"></div></span>
		    </td>
		  </tr>
		  
		  <tr>
		    <td height="40" align="center" valign="middle">&nbsp;</td>
		    <td height="40" colspan="3" style="text-align:left">
		    	<input  type="hidden" name="" value="">
		    	<input class="btn btn-primary" type="button" id="memadd" value="确定">&nbsp;&nbsp;&nbsp;
		        <input class="btn btn-primary" type="reset" value="重置">
		    </td>
		  </tr>
		 </thead>
    </table>


   <!-- 表单  结束 --> 
    
 </div>    
      
     <div class="pageBG">       
        <div class="clear"></div>
    </div>
    
</div>
</body>
</html>