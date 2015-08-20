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
    <script type="text/javascript" src="<?php echo Yii::app()->homeUrl;?>assets/bootstrap-3.3.0/js/bootstrap.min.js"></script>
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
        <li class="active"><a href='#'>推荐产品</a></li>
        <li class="active">所有推荐</li>
    </ul>
</div>
<!--bread-->

<!--search-->
<nav class="navbar navbar-default navbar-static-top" role="navigation">
  <div class="container">
    <form method="get" action="<?php echo $this->createUrl('search');?>" class="navbar-form navbar-right" role="search">
        <select name="cid" class="form-control">
          <option value="">商品类别</option>
          <?php foreach($category as $list){?>
            <option value="<?php echo $list->c_id?>"><?php echo $list->c_name?></option>
          <?php }?>
        </select>
      <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="产品搜索">
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
                    <th>产品ID</th>
                    <th>推荐人</th>
                    <th>推荐产品</th>
                    <th>产品商家</th>
                    <th>行业类别</th>
                    <th>原价</th>
                    <th>优惠价</th>
                    <th>产品图</th>
                    <th><span class="glyphicon glyphicon-sort"></span>状态</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    if($model){
                        foreach ($model as $v) {
                  ?>
                  <tr>                
                    <td><?php echo $v->goods_id;?></td>
                    <td><?php echo $v->advi_name;?></td>
                    <td><?php echo $v->gdsam->goods_name;?></td>
                    <td><?php echo $v->gdsam->bs_name;?></td>
                     <td><?php echo $v->gdscate->c_name?></td>
                    <td><?php echo $v->gdsam->price?></td>
                    <td><?php echo $v->gdsam->shop_price?></td>
                    <td><a href="<?php echo $v->gdsam->goods_img;?>" target="_blank"><img id="image-cutshow" width="30" src="<?php echo $v->gdsam->goods_img;?>" class="img-circle" alt=""></a></td>
                    <td>
                      <a href="javascript:;">
                        <?php
                          $status = $v->status;
                          if($status == 0){
                        ?>
                        <small><span class="glyphicon glyphicon-ban-circle"></span> 未审核</small>
                        <?php }else{?> 
                        <small><span class="glyphicon glyphicon-ok-circle"></span> 己上架 </small> 
                        <?php }?>
                      </a>
                    </td>
                  </tr>
                  <?php }}else{?>
                  <tr>
                    <td></td>
                    <td colspan="7">
                      暂无数据
                    </td>
                    <td></td>
                  </tr>
                  <?php }?>
                  <tr>
                    <td></td>
                    <td colspan="7">
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
