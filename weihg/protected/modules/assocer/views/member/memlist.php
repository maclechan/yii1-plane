<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="pragma" content="no-cache">  
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">  
<meta http-equiv="expires" content="0">  
<title>顾问后台管理系统</title>
  <script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/jquery-1.11.1.min.js"></script>
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->homeUrl;?>css/whg-manage-common.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/html5shiv.js"></script>
    <![endif]-->

</head>
<body>

<!--bread-->
<div class="breadcrumbs breadcrumbs-fixed">
    <ul class="breadcrumb">
        <li><i class="glyphicon glyphicon-home"></i><a href='#'> 首页 > </a></li> 
        <li><a href='#'> 协会成员 </a></li>
        <li class="active"><a href='#'>成员列表</a></li>
    </ul>
</div>
<!--bread-->

<div class="whg-admin-wrap">
            <div class="panel panel-default">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>协会成员名称</th>
                    <th>协会logo</th>
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
                    <td><?php echo $v->cy_name;?></td>
                    <td> <a href="<?php echo $v->cy_logo;?>" target="_blank"><img id="image-cutshow" width="30" src="<?php echo "/".$v->cy_logo;?>" class="img-circle" alt=""></a></td>
                    
                    <td>
                    <a href="<?php echo $this->createUrl('gwenedit',array("id"=>"$v->id"));?>"><small><span class="glyphicon glyphicon-edit"></span> 编辑 |</small></a>
                    <a href="<?php echo $this->createUrl('memdel',array("id"=>"$v->id"));?>"><small><span class="glyphicon glyphicon-remove"></span>删除 </small></a>
                    </td>
                  </tr>
                  <?php }}else{?>
                  <tr>
                    <td></td>
                    <td colspan="2">
                      暂无数据
                    </td>
                    <td></td>
                  </tr>
                  <?php }?>
                  <tr>
                    <td></td>
                    <td colspan="2">
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
