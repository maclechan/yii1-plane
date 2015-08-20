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
     <div class="tabLeft">
     	当前位置：    <a href="javascript:void(0);" class="ccc_color">用户管理</a> > 
     		 	<a href="javascript:void(0);" class="ccc_color">网友管理</a> > 
    		 	<a href="<?php echo Yii::app()->request->url;?>" class="ccc_color">待分配网友</a>
     </div>
     </div>
     <div class="search">
	 	<form class="form-search" method='get' action="<?php echo $this->createUrl('unmemsearch');?>">
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
                <th>网友姓名</th>
                <th>网友需求</th>  
                <th>需求描述</th>          
                <th>性别</th>
                <th>电话</th>
                <th>QQ号码</th>
                <th>婚期</th>                     
                <th>报名时间</th>
                <th>信息入口</th>
                <th>归属地</th>
                <th>备注</th>
                <th><i class="icon-wrench"> </i>操作</th>
            </tr>
		</thead>
        <tbody>
		<?php 
			if($mem_model){
					foreach ($mem_model as $val){
		?>
        <tr class="tr<?php echo $val->mem->id?>">
        	<td><a href="<?php echo $this->createUrl('unmemsearch',array('unnetfriend'=>$val->mem->name));?>"><?php echo $val->mem->name;?></a></td>
        	<td><?php echo $val->category_name;?></td>   
            <td><a onclick="ShowDiv('MyDiv<?php echo $val->id ?>','fade<?php echo $val->id ?>')" /><i class="icon-hand-up"> </i>点击详情</a>
<!--弹出层时背景层DIV-->
<div id="<?php echo 'fade'.$val->id;?>" class="black_overlay">
</div>
<div id="<?php echo 'MyDiv'.$val->id;?>" class="white_content">
<div style="text-align: right; cursor: default; height: 40px;">
<span onclick="CloseDiv('MyDiv<?php echo $val->id ?>','fade<?php echo $val->id ?>')"><img src="<?php echo Yii::app()->homeUrl;?>images/admin_img/close.png" /></span>
</div>
<?php echo $val->allot_desc;?>
</div>
</td>         
            <td><?php echo $val->mem->sex;?></td>          
            <td><?php echo $val->mem->mobile;?></td>
            <td><?php echo $val->mem->qq;?></td>
            <td><?php echo date('Y-m-d',$val->mem->wed_t);?></td>
             
            <td><?php echo date('Y-m-d H:i:s',$val->mem->apply_t);?></td>
            <td><?php echo $val->mem->entrance;?></td>
            <td><?php echo $val->mem->belong;?></td>
            <td><?php echo $val->notes;?></td> 
            <td>
			<span class="b_blue"><a href="/admin/member/member/undonememupd/id/<?php echo $val->mem->id?>">
            <i class="icon-pencil"></i>编辑</a></span>&nbsp;&nbsp;
			<span class="b_blue"><a href="<?php echo $this->createUrl('allot',array('id'=>$val->id,'category_id'=>$val->category_id));?>">
            <i class="icon-share"></i>分配 </a></span>&nbsp;&nbsp;
			<span class="b_blue"><a onclick="del(<?php echo $val->mem->id?>)" href="javascript:void(0);">
            <i class="icon-remove-circle"></i> 打假</a></span>
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
//弹出隐藏层
function ShowDiv(show_div,bg_div){
document.getElementById(show_div).style.display='block';
document.getElementById(bg_div).style.display='block' ;
var bgdiv = document.getElementById(bg_div);
bgdiv.style.width = document.body.scrollWidth;
// bgdiv.style.height = $(document).height();
$("#"+bg_div).height($(document).height());
};
//关闭弹出层
function CloseDiv(show_div,bg_div)
{
document.getElementById(show_div).style.display='none';
document.getElementById(bg_div).style.display='none';
};
</script>
<script type="text/javascript">
$(function(){
	$('.b_search').click(function(){
			if($('.insearch').val()==''){
				alert("关键字不能为空");
			}
	});
    
});

	function del(id){
		var id = id;
		if(id && confirm('确定将该网友数据标记为假的或重复的？')){
			$.ajax({
			type: "POST",
			url: "/admin/member/member/undonememsetdj",
			data: {'id':id},
			success:function(a){
				if(a==1){
					$('.tr'+id).remove();
					alert('打假成功');
				}else if(a==2){
					alert('数据丢失');
				}else{
					alert('打假失败');
				}
			}
			});
		} 	
	}

</script>