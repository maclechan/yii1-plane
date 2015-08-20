<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>坛城文化后台管理系统</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/base_new.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/font.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/member.css"/>
<script  src="<?php echo Yii::app()->homeUrl;?>js/jquery.min.js"></script>

</head>
<body>
<div class="tab">
             <div class="tabLeft">
                当前位置：    <a href="javascript:void(0);" class="ccc_color">我的首页</a> 
             </div>
</div>

<div class="default_wrap">
	<div class="c_width">
    		<h2>我的个人信息</h2>
    		<ul>
            		<li>你好，<b class="blue"><?php echo $user->user_name?></b></li>
                    <li>所属角色：<?php echo $role->role_name;?></li>
                     <li><hr /></li>
                    <li>上次登陆时间：<?php echo date('Y-m-d H:i:s',$user->last_login)?></li>
                    <li>上次登陆IP：<?php echo $user->last_ip?></li>
            </ul>
    </div>
    <div class="c_width m_l">
    	<h2>待办事项</h2>
		<ul>
			<li>当月共录入<b class="blue"><?php echo $dqcount?></b>个顾问</li>
			<li>当月共录入<b class="blue"><?php echo $dqcount?></b>个产品</li>
		</ul>
    </div>
    <div class="c_width m_t">
    		<h2>工作日志</h2>
    
    </div>
    <div class="c_width m_l m_t">
    	<h2>系统公告<a style="float:right;padding-right:10px" href="/admin/handle/noticelist">更多</a></h2>
    	<ul>
        <?php
				 foreach($notice as $notice){
			
		?>
        	<li><a href="<?php echo '/admin/handle/noticedetail/id/'.$notice->id;?>"><?php echo $notice->title?></a></li>
            <?php }?>
        </ul>
    </div>
</div>
</body>
</html>