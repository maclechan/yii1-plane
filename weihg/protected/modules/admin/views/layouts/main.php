<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="off">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>坛城文化后台管理系统</title>
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/system.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body scroll="no">
<div class="header">
	<div class="logo lf"><a href="javascript:;"><span class="invisible">坛城文化内容管理系统</span></a></div>
    <div class="rt">
    	<div class="tab_style white cut_line text-r"><img src="images/admin_img/adminlogo.png" width="25px" height="25px">欢迎您,<?php echo Yii::app()->user->name?>&nbsp;
	<a href="javascript:;" onclick='window.open("<?php echo Yii::app()->createUrl("/admin/handle/messagelist")?>","conFrame");'>我的消息<?php $this->widget("MessageWidget")?></a><span>|</span><a href="javascript:;" onclick='window.open("<?php echo Yii::app()->createUrl('/admin/handle/left',array('id'=>101,'en'=>'admin'));?>","leftFrame"); window.open("<?php echo Yii::app()->createUrl("/admin/handle/uppwd")?>","conFrame")' hidefocus="true">修改密码</a><span>|</span><a href="<?php echo Yii::app()->createUrl("/admin/handle/logout")?>" target="_top">退出</a>
        </div>
        <div class="style_but"></div>
    </div>
    <div class="col-auto" style="overflow: visible">
    	<div class="log white cut_line">@maclechan 版权所有<span>|</span><a>技术支持：maclechan</a>
    	</div>
        <ul class="nav white" id="top_menu">
		<li id="_M10" class="on top_menu"><a href="/admin" hidefocus="true" style="outline:none;">我的首页</a></li>
		<?php 
		if(Yii::app()->user->getState('menuarr')){
			$menu = Yii::app()->user->getState('menuarr');			
			for($n=0;$n<count($menu);$n++){
				$mval = explode('|',$menu[$n]);				
		?>		
        <li id="_M<?php echo $n?>" class="top_menu"><a href="javascript:_M(<?php echo $n?>);" onclick='window.open("<?php echo Yii::app()->createUrl('/admin/handle/left',array('id'=>$mval[0],'en'=>$mval[2]));?>","leftFrame");' hidefocus="true" style="outline:none;"><?php echo $mval[1];?></a></li>
		<?php }
		}
		?>
        </ul>
    </div>
</div>
<div id="content">
	<IFRAME id="leftFrame" name="leftFrame" width="136px" height="600px" frameBorder="no" scrolling="no" src="<?php echo Yii::app()->createUrl('/admin/handle/left',array('en'=>'admin'));?>"  style=" display: block;margin-right: 8px;padding: 0px;position: relative;float:left;"></IFRAME>
	
	<div class="col-1 lf cat-menu" id="display_center_id" style="display:none" height="100%">
		<div class="content">
        	<iframe name="center_frame" id="center_frame" src="" frameborder="false" scrolling="auto" style="border:none" width="100%" height="auto" allowtransparency="true"></iframe>
        </div>
    </div>    
	
    <div class="col-auto mr8">
    <!--    <div class="crumbs">当前位置：<span id="current_pos">我的首页>系统设置</span></div>-->
        
            <div class="col-1">
                <div class="content" style="position:relative; overflow:hidden">
                    <iframe name="conFrame" id="conFrame" src="<?php echo Yii::app()->createUrl('admin/handle/default');?>" frameborder="false" scrolling="auto" style="overflow-x:hidden;border:none; margin-bottom:30px" width="100%" height="600px" allowtransparency="true"></iframe>
                    <div class="fav-nav">
                        <div id="panellist"></div>
                        <div id="paneladd"><a class="panel-add" href="javascript:add_panel();"><em>添加</em></a></div>
                    </div>
                </div>
            </div>
    </div>
</div>
<script type="text/javascript"> 
function _M(menuid) {
	$('.top_menu').removeClass("on");
	$('#_M'+menuid).addClass("on");

	//当点击顶部菜单后，隐藏中间的框架
	$('#display_center_id').css('display','none');
}
$(document).ready(function(){
	var lr_systembtn = $(".lr_abtn");
	var lr_systembtnout = $('#lr_systembtn');
	var lr_menu = $("#lr_menu");
	lr_systembtn.mouseenter(function(){
		t_delay= setTimeout(function(){
			lr_menu.fadeIn("slow");
		},200);
	});
	lr_systembtnout.mouseleave(function(){
		clearTimeout(t_delay);
		lr_menu.fadeOut("slow");
	});

});
</script>
</body>
</html>