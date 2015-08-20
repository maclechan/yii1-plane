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
<script  src="<?php echo Yii::app()->homeUrl;?>js/member.js"></script>
</head>
<body>
    <div class="main">
     <div class="tab">
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">用户管理</a> > 
     <a href="javascript:void(0);" class="ccc_color">网友管理</a> > 
     <a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">分配网友</a></div>
     </div>
     <div class="clear"></div>
     <div class="shops_add">
     		<table class="same_t table table-bordered table-hover">
            <tbody>
              <tr>
                <td style="text-align:right">&nbsp;网友姓名</td>
                <td style="text-align:left">&nbsp;<?php echo $mem->name?></td>
              </tr>
              <tr>
                <td style="text-align:right">&nbsp;性 别</td>
                <td style="text-align:left">&nbsp;<?php echo $mem->sex?></td>
              </tr>
              <tr>
                <td style="text-align:right">&nbsp;电话</td>
                <td style="text-align:left">&nbsp;<?php echo $mem->mobile?></td>
              </tr>
              <tr>
                <td style="text-align:right">&nbsp;QQ号码</td>
                <td style="text-align:left">&nbsp;<?php echo $mem->qq?></td>
              </tr>
              <tr>
                <td style="text-align:right">&nbsp;婚期</td>
                <td style="text-align:left">&nbsp;<?php echo date('Y-m-d',$mem->wed_t);?></td>
              </tr>
              <tr>
                <td style="text-align:right">&nbsp;分配商家</td>
                <td style="text-align:left">&nbsp;
                <select name="b_id" id="b_id" class="lab_160" onchange="changeht()">
            	<option value="0">-请给网友分配商家-</option>
				<?php foreach($cus as $val):?>			
					<option value="<?php echo $val->id;?>">
						<?php echo $val->name;?>				
					</option>
				<?php endforeach;?>
              </select>&nbsp;<select id="contid" name="contid" class="lab_160"></select>&nbsp;(合同编号大的代表最新)</td>		  
              </tr>
              <tr>
                <td style="text-align:right">&nbsp;需求</td>
                <td style="text-align:left">&nbsp;<?php echo $mem_model->category_name?></td>
              </tr>
              <tr>
                <td style="text-align:right">&nbsp;报名时间</td>
                <td style="text-align:left">&nbsp;<?php echo date('Y-m-d H:i:s',$mem->apply_t);?></td>
              </tr>
              <tr>
                <td style="text-align:right">&nbsp;信息入口</td>
                <td style="text-align:left">&nbsp;<?php echo $mem->entrance?></td>
              </tr>
              <tr>
                <td style="text-align:right">&nbsp;归属地</td>
                <td style="text-align:left">&nbsp;<?php echo $mem->belong?></td>
              </tr>
              <tr>
                <td style="text-align:right">&nbsp;备注</td>
                <td style="text-align:left">&nbsp; <textarea name="" cols="20" rows="3" id="notes"><?php echo $mem_model->notes?></textarea></td>
              </tr>
              <tr>
                <td style="text-align:right">&nbsp;</td>
                <td style="text-align:left">&nbsp;
                <!-- 如果是要把备注信息保存到另一张表，把另一张表的id带到ajax里面去 -->
                <input type="hidden" id="allotid" value="<?php echo isset($mem_model)?$mem_model->id:'';?>"/>
                <input type="hidden" id="memberid" value="<?php echo $mem->id;?>"/>
                <input type="button" class="btn btn-primary" id="allot" value="确认分配" />
                </td>
              </tr>
              </tbody>
            </table>
     </div>      
       <div class="pageBG"></div>	
</div>
<script>
	function changeht(){
		var mid = $('option:selected').val();
		if(mid){
			$.ajax({
				type: "POST",
				url: "/admin/member/member/ajaxallotht",
				data: {'mid':mid},
				dataType:'json',
				success:function(data){
					if(data){
						$('#contid').empty();
						for(var s in data){
							var op = "<option value='"+data[s].id+"'>合同"+data[s].id+"号</option>";
							$(op).appendTo($('#contid'));
						}
					}else{
						alert('读取失败');
					}
				}
			}); 
		}
	}
</script>
</body>
</html>