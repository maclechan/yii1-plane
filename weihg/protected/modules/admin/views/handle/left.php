<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左边栏</title>
<link href="<?php echo Yii::app()->homeUrl;?>css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php echo Yii::app()->homeUrl;?>css/system.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/jquery.min.js"></script>
</head>
<body>
<div class="col-left left_menu">
		<div id="leftMain">
			<?php 
				if($model){
					foreach($model as $nval){				
			?>		
            <h3 class="f14"><span class="switchs cu on" title="<?php echo $nval->nav_cn?>"></span><?php echo $nval->nav_cn?></h3>			
            <ul>
				<?php 
					foreach($nval->ac_site as $acval){
						if($roleid == 1 || in_array($acval->action_en,$ac)){
				?>
                <li id="_MP<?php echo $acval->id?>" class="sub_menu">
                	<a href="<?php echo $this->createUrl('/admin/'.$m_en.'/'.$acval->default_ctl.'/'.$acval->action_en);?>" onclick="javascript:_MP('<?php echo $acval->id?>');" target="conFrame" hidefocus="true" style="outline:none;"><?php echo $acval->action_cn?></a>
				</li>
				<?php } }?>
            </ul>
			<?php 
					}
				}else{
			?>
            <h3 class="f14"><span class="switchs cu on" title="我的管理"></span>我的管理</h3>
            <ul>
				<li id="_MP4" class="sub_menu">
                	<a href="<?php echo $this->createUrl('noticelist');?>" onclick="javascript:_MP('4');" target="conFrame" hidefocus="true" style="outline:none;">公告信息</a></li>
				<li id="_MP8" class="sub_menu">
                	<a href="<?php echo $this->createUrl('messagelist');?>" onclick="javascript:_MP('8');" target="conFrame" hidefocus="true" style="outline:none;">我的消息</a></li>					
                <li id="_MP5" class="sub_menu">
                	<a href="<?php echo $this->createUrl('uppwd');?>" onclick="javascript:_MP('5');" target="conFrame" hidefocus="true" style="outline:none;">修改密码</a></li>
                <li id="_MP6" class="sub_menu">
                	<a href="<?php echo $this->createUrl('logout');?>" onclick="javascript:_MP('6');" target="_top" hidefocus="true" style="outline:none;">安全退出</a></li>
            </ul>
			<?php }?>
		</div>
        <a href="javascript:;" id="openClose" style="outline-style: none; outline-color: invert; outline-width: medium; width:316px;" hideFocus="hidefocus" class="open" title="展开与关闭"><span class="hidden">展开</span></a>	
</div>
<script type="text/javascript">
            $(".switchs").each(function(i){
                var ul = $(this).parent().next();
                $(this).click(
                function(){
                    if(ul.is(':visible')){
                        ul.hide();
                        $(this).removeClass('on');
                            }else{
                        ul.show();
                        $(this).addClass('on');
                    }
                })
            });
	
function _MP(menuid){
	$('.sub_menu').removeClass("on fb blue");
	$('#_MP'+menuid).addClass("on fb blue");
}			
</script>
</body>
</html>
