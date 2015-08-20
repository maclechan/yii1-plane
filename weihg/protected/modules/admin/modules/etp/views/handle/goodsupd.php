<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">  
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">  
<meta http-equiv="expires" content="0">  
<title>图片上传裁剪</title>
    <script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/bootstrap.min.js"></script>
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/whg-admin-common.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/html5shiv.js"></script>
    <![endif]-->

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/crop/imgareaselect-default.css" media="all" >
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/crop/uploadify.css" media="all" >
<script data-main="<?php echo Yii::app()->homeUrl;?>js/crop/goodsadd" type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/crop/require.min.js"></script>

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
th,td{text-align: left;}
</style>
</head>
<body>
<div class="whg-admin-wrap">
            <div class="panel panel-default">
              <!-- Default panel contents -->
              <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> <small>产品信息录入</small></div>
              <div class="panel-body">
                <p>ps: *号为必填项</p>
              </div>
		<form name="form1" class="form-inline" method="post" action="<?php echo $this->createUrl('etpgoodsupdate',array("id"=>$goods_data->goods_id))?>" enctype="multipart/form-data" onsubmit="return check_submit()">
		<table class="table">
      		<tbody>			
      			<tr>
			    	<td>产品名称<font color="red">&nbsp;*</font></td>
			    	<td><input type="text" name="goodname" id="goodname" class="form-control" value="<?php echo $goods_data->goods_name?>" /><font color="gray">&nbsp;&nbsp;(限制120个字符内)</font></td>
			    </tr>
			    <tr>
			    	<td>商家名称<font color="red">&nbsp;*</font></td>
			    	<td><input type="text" name="shangjia" id="shangjia" class="form-control" value="<?php echo $goods_data->bs_name?>" /><font color="gray">&nbsp;&nbsp;(输入产品的商家名)</font></td>
			    </tr>
			    <tr>
			    	<td>线下地址</td>
			    	<td><input type="text" name="s_location" id="s_location" class="form-control" value="<?php echo $goods_data->bs_location?>" /></td>
			    </tr>
			    <tr>
			    	<td>简介</td>
			    	<td><input type="text" name="intro" id="intro" class="form-control" value="<?php echo $goods_data->goods_intro?>" /></td>
			    </tr>
			    <tr>
			    	<td>原价<font color="red">&nbsp;*</font></td>
			    	<td><input type="text" name="price" id="price" class="form-control" value="<?php echo $goods_data->price?>" /><font color="gray">&nbsp;&nbsp;(限制20个字符内,格式:2400)</font></td>
			    </tr>
			    <tr>
			    	<td>商城优惠价<font color="red">&nbsp;*</font></td>
			    	<td><input type="text" name="shop_price" id="shop_price" class="form-control" value="<?php echo $goods_data->shop_price?>" /><font color="gray">&nbsp;&nbsp;(限制20个字符内,格式:2400)</font></td>
			    </tr>
			    <tr>
			    	<td>类别<font color="red">&nbsp;*</font></td>
			    	<td>			    		
						<select name="c_id" id="c_id" onchange="attr_load()" class="form-control">
							<option value="" />--请选择--</option>
							<?php foreach($category as $list){?>
							<option value="<?php echo $list->c_id;?>" /><?php echo $list->c_name;?></option>
							<?php }?>
			            </select>
					</td>
			    </tr>	
			    <tr>
			    	<td>标签</td>
			    	<td id="tags"></td>
			    </tr>				
			    <tr>
			    	<td>产品图片<font color="red">&nbsp;*</font></td>
					<input type="hidden" id="hide-cuted" name="icon" class="form-control" value="<?php echo $goods_data->goods_img?>">
			    	<td><button type="button" class="btn btn-info btn-sm glyphicon glyphicon-picture" data-toggle="modal" data-target=".bs-example-modal-lg"><small>编辑图像</small></button></td>
			    </tr>
			    <tr>
			    	<td>产品详情<font color="red">&nbsp;*</font></td>
			    	<td><div id="edui_fixedlayer" style="width:800px;height:450px"><?php
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
                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', '|',
                'print', 'preview', 'searchreplace','help']],
                    wordCount:false,
                    elementPathEnabled:false,
                    imagePath:'/assets/1f670b15/php/',
					initialContent:'".$goods_data->goods_desc."',
                    ",
            ));
?></div></td>
			    </tr>
			    <tr>
			    	<td style="text-align:right"></td>
			    	<td style="text-align:left">
			    		<input class="btn btn-primary" name="navadd" type="submit" value="确定添加" />　
	        			<input class="btn btn-primary" id="navreset" name="reset" type="button" value="取消" />　
	        			<input class="btn btn-primary" id="navback" name="navback" type="button" value="返回" />
	        		</td>
			    </tr>				
      		</tbody>
      	</table>   
	</form>
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
<script>
	function attr_load(){
		var cid = $("#c_id").val();
		$.ajax({
			type: "POST",
			url: "/admin/etp/handle/etploadtags",
			data: {'cid':cid},
			error:function(XMLResponse){
				alert(XMLResponse.responseText);
				return false;
			},
			success:function(data){
		//		alert(data);
				if(data == 1){
					document.getElementById('tags').innerHTML = '';
				}else{
					document.getElementById('tags').innerHTML = data;
				}
			}
		});				
	}
	function check_submit(){
		var goodname = $("#goodname").val();
		if(goodname == ''){
			alert("请输入产品名称");
			$("#goodname").focus();
			return false;
		}
		var shangjia = $("#shangjia").val();
		if(shangjia == ''){
			alert("请选择商家");
			$("#shangjia").focus();
			return false;
		}		
		var price = $("#price").val();
		if(price == ''){
			alert("请输入产品原价");
			$("#price").focus();
			return false;
		}		
		var shop_price = $("#shop_price").val();
		if(shop_price == ''){
			alert("请输入商城优惠价");
			$("#shop_price").focus();
			return false;
		}
		var c_id = $("#c_id").val();
		if(c_id == ''){
			alert("请选择行业类别");
			$("#c_id").focus();
			return false;
		}
		var upimg = $("#hide-cuted").val();
		if(upimg == ''){
			alert("请上传图片");
			return false;
		}				
		if(editor.getContent() == ''){
			alert("请输入产品详情");
			return false;		
		}
		return true;
	}
document.getElementById('c_id').value='<?php echo $goods_data->c_id?>';
</script>
</body>
</html>