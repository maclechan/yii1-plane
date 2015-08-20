<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="pragma" content="no-cache">  
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">  
<meta http-equiv="expires" content="0">  
<title>结婚倒计时模块管理</title>
    <script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/bootstrap.min.js"></script>  
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/whg-admin-common.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/html5shiv.js"></script>
    <![endif]-->
</head>
<style type="text/css">
  nav.navbar-center {text-align: center;}
</style>
<body>

<!--bread-->
<div class="breadcrumbs breadcrumbs-fixed">
    <ul class="breadcrumb">
        <li><i class="glyphicon glyphicon-home"></i><a href='#'> 首页 > </a></li> 
        <li><a href='#'> 顾问管理 </a></li>
        <li class="active"><a href='#'>结婚倒计时</a></li>
        <li class="active">倒计时管理</li>
    </ul>
</div>
<!--bread-->

<!--search-->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <form method="get" action="<?php //echo $this->createUrl('search');?>" class="navbar-form navbar-right" role="search">
      <div class="input-group">
        <input type="text" class="form-control" name="guwen" placeholder="模块搜索">
        <span class="input-group-btn"><input class="btn btn-default" type="submit" value="搜索"></span>
      </div>
    </form>
  </div>
</nav>
<!--search-->

<div class="whg-admin-wrap">
            <div class="panel panel-default">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>文章标题</th>
                    <th>封面图</th>
                    <th>浏览量</th>
                    <th>点赞数</th>
                    <th>发布时间</th>
                    <th><i class="glyphicon glyphicon-wrench"> </i>操作</th>
                  </tr>
                </thead>
                <tbody>
                 <tr>
                  <td colspan="6"></td>
                  <td>
                    <a href="<?php echo $this->createUrl('tminusadd');?>">
                      <small><span class="glyphicon glyphicon-plus"></span>添加文章 </small>
                    </a>
                </td>
                </tr>
                <?php
                    if($model){
                        foreach ($model as $v) {
                  ?>
                  <tr id="tr<?php echo $v->id;?>">  
                    <td><?php echo $v->id?></td>
                    <td><?php echo $v->title;?></td>
                    <td> <img width="30" src="<?php echo $v->cover;?>" class="img-circle" alt=""></td>
                    <td><?php echo $v->browse;?></td>
                    <td><?php echo $v->like;?></td>
                    <td><?php echo date('Y-m-d',$v->pubtime);?></td>
                    <td>
                   <a href="<?php echo $this->createUrl('tminusedit',array('id'=>$v->id));?>">
                      <small><span class="glyphicon glyphicon-edit"></span> 编辑 |</small>
                    </a>
                    <a href="<?php echo $this->createUrl('tminusdel',array('id'=>$v->id));?>">
                      <small><span class="glyphicon glyphicon-remove"></span>删除 </small>
                    </a>
                    </td>
                  </tr>
                  <?php }}else{?>
                  <tr>
                    <td></td>
                    <td colspan="5">暂无数据</td>
                    <td></td>
                  </tr>
                  <?php }?>
                  <tr>
                    <td colspan="7">
                    <nav class="navbar-center">
                      <?php $pages->itemCount = isset($itemCount) ? $itemCount : $pages->itemCount;?>
                          <?php $this->widget("CLinkPager",array(
                                'pages'=>$pages,
                                'firstPageLabel'=>"首页",
                                'prevPageLabel'=>'上一页',
                                'nextPageLabel'=>'下一页',
                                'lastPageLabel'=>'末页',
                                'header'=>false,
                                'htmlOptions'=>array(
                                    'class'=>'pagination',
                                  ),
                        ));?>
                    </nav>
                    </td>
                  </tr>         
                </tbody>
              </table>
              
            </div>       
</div>


<!--footer message-->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
      <div class="input-group navbar-right">
         <?php if($pages->pageCount):?>
           <div class="alert alert-info " role="alert">
                  <small>                     
                      <div class="pageBG_R fr">
                        <i class="glyphicon glyphicon-bullhorn"></i>：
                        共<?php echo $pages->pageCount;?>页 / 
                        当前页<?php echo $pages->currentPage+1;?> /
                        总记录数 <?php echo $pages->itemCount;?>
                      </div>
                </small>
            </div>
          <?php endif;?>
      </div>
  </div>
</nav>
<!--footer message-->

</body>
</html>
