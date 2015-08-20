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
        <li><a href='#'> 产品管理 </a></li>
        <li class="active"><a href='#'>推荐产品</a></li>
        <li class="active">我要推荐</li>
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
                    <th>产品名称</th>
                    <th>所属商家</th>
                    <th>行业类别</th>
                    <th>原价</th>
                    <th>优惠价</th>
                    <th>产品图</th>
                    <th><span class="glyphicon glyphicon-cog"></span>操作</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    if($model){
                        foreach ($model as $v) {
                  ?>
                  <tr id="tr<?php echo $v->goods_id;?>">                
                    <td><?php echo $v->goods_id;?></td>
                    <td><?php echo $v->goods_name;?></td>
                    <td><?php echo $v->bs_name;?></td>
                     <td><?php echo $v->gc->c_name?></td>
                    <td><?php echo $v->price?></td>
                    <td><?php echo $v->shop_price?></td>
                    <td><a href="<?php echo $v->goods_img;?>" target="_blank"><img id="image-cutshow" width="30" src="<?php echo $v->goods_img;?>" class="img-circle" alt=""></a></td>
                    <td>
                      <a data-toggle="modal" data-target="#tuijian" data-goodsid="<?php echo $v->goods_id;?>" href="javascript:;">
                        <small><span class="glyphicon glyphicon-share-alt"></span>推荐</small>
                      </a>
                    </td>
                  </tr>
                  <?php }}else{?>
                  <tr>
                    <td></td>
                    <td colspan="6">
                      暂无数据
                    </td>
                    <td></td>
                  </tr>
                  <?php }?>
                  <tr>
                    <td></td>
                    <td colspan="6">
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

<div class="modal fade" id="tuijian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>推荐产品</h4>
      </div>
      <form method="post" action="<?php echo $this->createUrl('/manage/goods/recommend');?>" method="post">
      <div class="modal-body">
          <div class="form-group input-group">
            <label for="goods-id" class="control-label">产品ID:</label>
            <input type="text" class="form-control" id="goods-id" name="goods_id">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">推荐理由:</label>
            <textarea name="recommend_reason" class="form-control" id="message-text" rows="4" placeholder="推荐理由 255个字以内"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">取消</button>
        <input type="submit" class="btn btn-primary" value="提交" />
      </div>
    </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#tuijian').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var goods = button.data('goodsid')

  var modal = $(this)
  modal.find('.modal-body #goods-id').val(goods)
})
</script>

</body>
</html>
