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
     <div class="tabLeft">当前位置：
     <a href="javascript:void(0);" class="ccc_color">用户管理</a> > 
     <a href="javascript:void(0);" class="ccc_color">网友管理</a> > 
     <a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">己审核网友</a></div>
     </div>
     <div class="search">        
	 	<form method='get' class="form-search" action="<?php echo $this->createUrl('memsearch');?>">
		<ul class="searchSub">  
			<li>
			<select name="cid" class="span2">
				<option value="">网友需求</option>
				<?php foreach($category as $list){?>
					<option value="<?php echo $list->c_id?>"><?php echo $list->c_name?></option>
				<?php }?>
			</select>
			</li>        
          <input class="insearch input-large" name="mem_name" type="text" placeholder="搜索网友">
          <input name="search" type="submit" value="搜索网友" class="b_search btn" />
          <?php 
          	if(isset($key)){
          		echo "您搜索的关键词为&nbsp;<font color='red'>'".$key."'</font>";
          	}
          ?>
        </ul>
		</form>
        <div class="clear"></div>
     </div>
     <div class="linellae"></div>	
     <div class="clear"></div>
     <table class="same_t table table-bordered table-hover" >
        <thead>
        <tr>
        	<th>网友姓名</th>
       	 	<th>网友需求</th>
       		<th>网友所属商家</th>           
            <th>性别</th>
            <th>电话</th>
            <th>QQ号码</th>
            <th>婚期</th>                     
            <th>报名时间</th>
            <th>信息入口</th>
            <th>归属地</th>
            <th><i class="icon-hand-down"> </i>备注</th>
        </tr>
		</thead>
        <tbody>
		<?php 
			if($mem_model){
					foreach ($mem_model as $val){
		?>
        <tr>
        	<td><?php echo $val->mem->name;?></td>
        	<td><?php echo $val->category_name;?></td>
        	<td><?php echo isset($val->bu)?$val->bu->name:'';?></td>            
            <td><?php echo $val->mem->sex;?></td>          
            <td><?php echo $val->mem->mobile;?></td>
            <td><?php echo $val->mem->qq;?></td>
            <td><?php echo date('Y-m-d',$val->mem->wed_t);?></td>
             
            <td><?php echo date('Y-m-d H:i:s',$val->mem->apply_t);?></td>
            <td><?php echo $val->mem->entrance;?></td>
            <td><?php echo $val->mem->belong;?></td>
            <td>
            <textarea id="edit_notes" class="edit_notes" rows="2" onmouseout="updatenote(<?php echo $val->id;?>,this.value)" onmouseover="this.style.border='1px solid #4690CF'"><?php echo $val->notes;?></textarea>
	            
	             </td>
         </tr> 
		<?php }}
			else
				echo "<tr><td align='center' colspan='12'><span style='color:red;'>sorry，没有找到有关信息！</span></td></tr>";
		?>
        
       </tbody>
      </table>
     <div class="pageBG">
        <div class="pageY fl">
		<?php $pages->itemCount = isset($itemCount) ? $itemCount : $pages->itemCount;?>
        <?php $this->widget("CLinkPager",array(
      			  'pages'=>$pages,
        		  'firstPageLabel'=>"首页",
      			  'prevPageLabel'=>'上一页',
                  'nextPageLabel'=>'下一页',
        		  'lastPageLabel'=>'末页',
	              'header'=>false,
        		  'cssFile'=>Yii::app()->homeUrl."css/newlink.css",
      ));?>
        </div>
		<?php if($pages->pageCount>1):?>
        <div class="pageBG_R fr">共<?php echo $pages->pageCount;?>页 / 共<?php echo $pages->itemCount ?>条记录</div>
		<?php endif;?>
        <div class="clear"></div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
$(function(){
	$('.b_search').click(function(){
			if($('.insearch').val()==''){
				alert("关键字不能为空");
			}
	});
    
});
</script>
