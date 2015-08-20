<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>坛城文化后台管理系统</title>
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
     <a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">己审核分配网友</a></div>
     </div>
     
     <div class="clear"></div>
     <table class="mem_show" width="99%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <th width="6%">姓名</th>
            <th width="4%">性别</th>
            <th width="6%"><span>电话</span></th>
            <th width="6%"><span>QQ号码</span></th>
            <th width="6%"><span>婚期</span></th>
            <th width="8%"><span>分配商家</span></th>
            <th width="8%"><span>需求</span></th>
            <th width="8%"><span>报名时间</span></th>
            <th width="8%"><span>信息入口</span></th>
            <th width="6%"><span>归属地</span></th>
            <th width="10%"><span>备注</span></th>
            <th width="10%"><span>操作</span></th>
        </tr>
		
		
        <tr>
            <td><?php echo $mem->name?></td>
            <td><?php echo $mem->sex?></td>          
            <td><?php echo $mem->mobile?></td>
            <td><?php echo $mem->qq?></td>
            <td><?php echo date('Y-m-d',$mem->wed_t);?></td>
                      
            <td> 
            	<select name="b_id" id="b_id" class="lab_160">
            	<option value="0">--请给网友分配商家--</option>
				<?php foreach($cus as $val):?>			
					<option value="<?php echo $val->id;?>">
						<?php echo $val->name;?>				
					</option>
				<?php endforeach;?>
              </select>
          </td>
           
             <td><?php echo $mem_model->category_name?></td>
            <td><?php echo date('Y-m-d H:i:s',$mem->apply_t);?></td>
            <td><?php echo $mem->entrance?></td>
            <td><?php echo $mem->belong?></td>
          <td>
           <textarea name="" cols="20" rows="2" id="notes"><?php echo $mem_model->notes?></textarea>
     </td> 　
     <input type="hidden" id="allotid" value="<?php echo isset($mem_model)?$mem_model->id:'';?>"/>
     
     <!-- 如果是要把备注信息保存到另一张表，把另一张表的id带到ajax里面去 -->
     <input type="hidden" id="memberid" value="<?php echo isset($mem)?$mem->id:'';?>"/>
            <td><input type="button" id="allot" value="确定分配" /></td>            
        </td>
       </tr>
		
      </table>  
</div>
</body>
</html>