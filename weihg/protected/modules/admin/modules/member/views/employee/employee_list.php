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
<script type="text/javascript">
$(function(){
	$('.b_search').click(function(){
			if($('.insearch').val()==''){
				alert("搜索关键字不能为空");
			}
	});
    
});
</script>
</head>
<body>
    <div class="main">
     <div class="tab">
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">用户管理</a> > 
     <a href="javascript:void(0);" class="ccc_color">员工管理</a> > 
     <a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">员工管理</a>
     </div>
     </div>
     <div class="search">
	 	<form method='post' class="form-search" action="<?php echo $this->createUrl('empsearch');?>">
		<ul class="searchSub">
        	<input class="insearch input-large" name="emp_name" type="text" placeholder="员工搜索">
          	<input name="search" type="submit" value="员工搜索" class="b_search btn" />
          <?php 
          	if(isset($key)){
          		echo "您搜索的关键词为&nbsp;<font color='red'>'".$key."'</font>";
          	}
          ?>
        </ul>
		</form>
        <div class="clear"></div>
     </div>	 
     <div class="clear"></div>
     <div class="linellae"></div>	
     <table class="same_t table table-bordered table-hover" >
     <thead>
        <tr>
        	<th>员工姓名</th>
       	 	<th>所属组</th>
       		<th>手机</th>           
            <th>邮箱</th>
            <th>状态</th>
            <th><i class=" icon-wrench"> </i> 操作</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        	if ($emp_model){
					foreach ($emp_model as $k => $v){
		?>
        <tr id="<?php echo 'tr'.$v->user_id;?>">
        	<td><?php echo $v->user_name;?></td>
        	<td><?php echo $v->role->role_name;?></td>            
            <td><?php echo $v->mobile;?></td>          
            <td><?php echo $v->email;?></td>
            <td><?php echo $v->status==1 ? '正常' : '己禁用'; ?></td>
            <td>
            	<span class="b_blue"><a href="<?php echo $this->createUrl('employeeadd',array('user_id'=>$v->user_id));?>"><i class="icon-pencil"></i> 修改</a></span>  &nbsp;&nbsp;|            
            &nbsp;&nbsp;<span class="b_blue"><a href="javascript:void(0);" onclick="empDel(<?php echo $v->user_id;?>)"> <i class="icon-remove"></i> 删除 </a></span></td>
         </tr> 
		<?php 
          	}}
          	else{
          		echo "<tr><td align='center' colspan='11'><span style='color:red;'>sorry，没有找到有关信息哦！</span></td></tr>";
          	}
		
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