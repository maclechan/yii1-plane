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
                    <th>姓名</th>
                    <th>手机</th>
                    <th>微信</th>
                    <th>图像</th>
                    <th>等级</th>
                    <th>职责</th>
                    <th>风格</th>
                    <th>经验</th>
                    <th>价格</th>
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
                    <td><?php echo $v->name;?></td>
                    <td><?php echo $v->mobile;?></td>
                    <td><?php echo $v->weixin;?></td>
                    <td> <a href="<?php echo $v->icon;?>" target="_blank"><img id="image-cutshow" width="30" src="<?php echo $v->icon;?>" class="img-circle" alt=""></a></td>
                    <td>
                      <?php 
                         $level = $v->level;
                         if($level == 1){
                          echo '初级';
                         }elseif ($level == 2) {
                           echo '中级';
                         }else{
                           echo '高级';
                         }
                      ?>
                    </td>
                    <td><?php 
                         $job = $v->job;
                         if($job == 1){
                          echo '司仪';
                         }elseif ($job == 2) {
                           echo '策划';
                         }
                      ?></td>
                    <td><?php 
                         $style = $v->style;
                         if($style == 1){
                          echo '个性';
                         }elseif ($style == 2) {
                           echo '时尚';
                         }elseif ($style == 3) {
                           echo '奢华';
                         }elseif ($style == 4) {
                           echo '草坪';
                         }elseif ($style == 5) {
                           echo '清新';
                         }elseif ($style == 6) {
                           echo '浪漫';
                         }elseif ($style == 7) {
                           echo '童话';
                         }elseif ($style == 8) {
                           echo '唯美';
                         }elseif ($style == 9) {
                           echo '中式';
                         }elseif ($style == 10) {
                           echo '西式';
                         }elseif ($style == 11) {
                           echo '庄重';
                         }elseif ($style == 12) {
                           echo '复古';
                         }
                      ?></td>
                    <td><?php 
                         $work_exp = $v->work_exp;
                         if($work_exp == 1){
                          echo '1-5年';
                         }elseif ($work_exp == 2) {
                           echo '5-10年';
                         }elseif ($work_exp == 3) {
                           echo '10-15年';
                         }elseif ($work_exp == 4) {
                           echo '15-20年';
                         }elseif ($work_exp == 5) {
                           echo '20年以上';
                         }
                      ?></td>
                    <td><?php 
                         $price_fw = $v->price_fw;
                         if($price_fw == 1){
                          echo '800元-1500元';
                         }elseif ($price_fw == 2) {
                           echo '1500元-3000元';
                         }elseif ($price_fw == 3) {
                           echo '3000元-5000元';
                         }elseif ($price_fw == 4) {
                           echo '5000元-8000元';
                         }elseif ($price_fw == 5) {
                           echo '8000元-10000元';
                         }elseif ($price_fw == 6) {
                           echo '10000元以上';
                         }
                      ?></td>
                    <td>
                    <a href="<?php echo $this->createUrl('gwenedit',array("id"=>"$v->id"));?>"><small><span class="glyphicon glyphicon-edit"></span> 编辑 |</small></a>
                    <a href="javascrtip:void(0);" onclick="adviserdel(<?php echo $v->id;?>)"><small><span class="glyphicon glyphicon-remove"></span>删除 |</small></a>
                    <a href="<?php echo $this->createUrl('gwenanli',array('id'=>"$v->id"));?>"><small><span class="glyphicon glyphicon-plus"></span>案例</small></a>
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
