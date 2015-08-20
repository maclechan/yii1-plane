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
				if($id == 1){			
			?>		
            <h3 class="f14"><span class="switchs cu on" title="产品中心"></span>资讯管理</h3>
            <ul>
                <li id="_MP1" class="sub_menu">
                	<a href="<?php echo $this->createUrl('/assocer/member/hnewsadd');?>" onclick="javascript:_MP('1');" target="conFrame" hidefocus="true" style="outline:none;">会长风采</a></li>
                <li id="_MP2" class="sub_menu">
                	<a href="<?php echo $this->createUrl('/assocer/member/hnewsadd');?>" onclick="javascript:_MP('2');" target="conFrame" hidefocus="true" style="outline:none;">协会活动</a></li>
                    <li id="_MP5" class="sub_menu">
                    <a href="<?php echo $this->createUrl('/assocer/member/hnewslist');?>" onclick="javascript:_MP('5');" target="conFrame" hidefocus="true" style="outline:none;">活动列表</a></li>
            </ul>
            <h3 class="f14"><span class="switchs cu on" title="产品中心"></span>协会成员</h3>
            <ul>
                <li id="_MP3" class="sub_menu">
                    <a href="<?php echo $this->createUrl('/assocer/member/memadd');?>" onclick="javascript:_MP('3');" target="conFrame" hidefocus="true" style="outline:none;">添加成员</a></li>
                <li id="_MP4" class="sub_menu">
                    <a href="<?php echo $this->createUrl('/assocer/member/memlist');?>" onclick="javascript:_MP('4');" target="conFrame" hidefocus="true" style="outline:none;">成员列表</a></li>
            </ul>			
			<?php 
				}elseif($id == 10){
			?>	
            <h3 class="f14"><span class="switchs cu on" title="我的管理"></span>我的管理</h3>
            <ul>
                <li id="_MP10" class="sub_menu">
                    <a href="<?php echo $this->createUrl('/assocer/member/huiedit');?>" onclick="javascript:_MP('10');" target="conFrame" hidefocus="true" style="outline:none;">信息修改</a>
                </li>
                <li id="_MP11" class="sub_menu">
                	<a href="<?php echo $this->createUrl('uppwd');?>" onclick="javascript:_MP('11');" target="conFrame" hidefocus="true" style="outline:none;">修改密码</a>
                </li>
                <li id="_MP6" class="sub_menu">
                	<a href="<?php echo $this->createUrl('logout');?>" target="_top" hidefocus="true" style="outline:none;">安全退出</a>
                </li>
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
