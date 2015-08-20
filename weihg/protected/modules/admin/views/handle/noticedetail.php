<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>坛城文化后台管理系统</title>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl?>css/default.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->homeUrl?>css/font.css"/>
</head>
<body> 
<div class="main">	
     <div class="tab">
     <div class="tabLeft">当前位置：<a href="javascript:void(0);" class="ccc_color">我的首页</a> > <a href="javascript:void(0);" class="ccc_color">我的管理</a> > <a href="javascript:void(0);" class="ccc_color">公告信息</a></div>
     </div>
  <div class="def_con">
  
     <div class="def_conT">
        <h2><?php echo $notice->title?> </h2>
        <p>发布时间：<?php echo date('Y-m-d H:i:s',$notice->time)?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发布人：<?php echo $notice->na->user_name;?></p>
     </div>
     <div class="def_conC">
     <?php echo $notice->content?>
     </div>
     <div class="def_conD m10">
         <div class="def_achild next"><a href="/admin/handle/noticelist" class="lan">返回列表</a></div>
      </div>
  </div>
</div>
</body>
</html>

