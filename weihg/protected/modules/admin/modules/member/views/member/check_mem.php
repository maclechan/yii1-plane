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
<script  src="<?php echo JS_URL;?>/bootstrap.js"></script>
</head>
<body>
    <div class="main">
     <div class="tab">
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">用户管理</a> > 
     <a href="javascript:void(0);" class="ccc_color">网友管理</a> > 
     <a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">待审核网友</a></div>
     </div>
     <div class="search">
	 	<form class="form-search" method='get' action="<?php echo $this->createUrl('checkmemsearch');?>">
        <ul class="searchSub ">
			<li>
			<select name="cid" class="span2">
				<option value="">所有分类</option>
				<?php foreach($category as $list){?>
					<option value="<?php echo $list->c_id?>"><?php echo $list->c_name?></option>
				<?php }?>
			</select>
			</li>
			<input class="insearch input-large" name="unnetfriend"  type="text" placeholder="网友搜索">
          	<input type="submit" name="submit" value="网友搜索" class="b_search btn" />			
        </ul>
		</form>		
        <div class="clear"></div>
     </div>		 
     <div class="clear"></div>
     <div class="linellae"></div>	
    <table class="same_t table table-bordered table-hover" >
      <thead>
        <tr>
       		<th>选择</th>
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
            <th>备注</th>
        </tr>
		</thead>
        <tbody>
		<?php 
			if($mem_model){
					foreach ($mem_model as $val){
		?>
        <tr>       	
        	<td><input type="checkbox" value="<?php echo $val->id;?>" name="checkid"></td>        	     	
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
            <td><?php echo $val->notes;?></td>           
         </tr>
		<?php }}
			else
				echo "<tr><td align='center' colspan='12'><span style='color:red;'>sorry，没有找到有关信息！</span></td></tr>";
		?>
        <tr height="50">
        	<td  colspan="13" align="left" valign="middle">
                <div class="btn-group" data-toggle="buttons-checkbox">
               	 	<button type="button" id="CheckedAll" class="btn btn-primary">全选</button>
                	<button type="button"  id="CheckedNo" class="btn btn-primary">全不选</button>
                	<button type="button" id="checkDone" class="btn btn-primary">审核</button>
                </div>
			</td>
       </tr>
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
