<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="pragma" content="no-cache">  
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">  
<meta http-equiv="expires" content="0">  
<title>顾问列表</title>
    <script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>js/guwen.js"></script>
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/css/buttons.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/whg-admin-common.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>

<!--bread-->
<div class="breadcrumbs breadcrumbs-fixed">
    <ul class="breadcrumb">
        <li><i class="glyphicon glyphicon-home"></i><a href='#'> 首页 > </a></li> 
        <li><a href='#'> 顾问管理 </a></li>
        <li class="active"><a href='#'>顾问信息</a></li>
        <li class="active">顾问列表</li>
    </ul>
</div>
<!--bread-->

<!--search-->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <form method="get" action="<?php echo $this->createUrl('search');?>" class="navbar-form navbar-right" role="search">
      <div class="input-group">
        <input type="text" class="form-control" name="guwen" placeholder="搜索顾问">
        <span class="input-group-btn"><input class="btn btn-default" type="submit" value="搜索"></span>
      </div>
    </form>
  </div>
</nav>
<!--search-->

<div class="whg-admin-wrap">
            <div class="panel panel-default">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>协会登录名</th>
                    <th>会长图片</th>
                    <th>协会名称</th>
                    <th>会长名称</th>
                    <th>手机</th>
                    <th>qq</th>
                    <th>mail</th>
                    <th>操作</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    if($model){
                        foreach ($model as $v) {
                  ?>
                  <tr id="tr<?php echo $v->id;?>">                
                    <td><?php echo $v->id;?></td>
                    <td><?php echo $v->loger;?></td>
                    <td><a href="<?php echo $v->icon;?>" target="_blank"><img id="image-cutshow" width="30" src="<?php echo '/'.$v->icon;?>" class="img-circle" alt=""></a></td>
                    <td><?php echo $v->assoc_name;?></td>
                    <td><?php echo $v->assocer;?> </td>
                    <td><?php echo $v->mobile;?> </td>
                    <td><?php echo $v->qq;?> </td>
                    <td><?php echo $v->mail;?> </td>
                    
                    <td>
                    <a href="<?php echo $this->createUrl('huidel',array("id"=>"$v->id"));?>"><small><span class="glyphicon glyphicon-edit"></span> 删除 </small></a>
                    </td>
                  </tr>
                  <?php }}else{?>
                  <tr>
                    <td></td>
                    <td colspan="9">
                      暂无数据
                    </td>
                    <td></td>
                  </tr>
                  <?php }?>
                  <tr>
                    <td></td>
                    <td colspan="9">
                    <nav class="navbar-right">
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
                    <td></td>
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
