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
        <li class="active">模块管理</li>
    </ul>
</div>
<!--bread-->



<div class="whg-admin-wrap">
            <div class="panel panel-default">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>模块标题</th>
                    <th>一句简介</th>
                    <th>倒计月份</th>
                    <th><i class="glyphicon glyphicon-wrench"> </i>操作</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                  <td colspan="4"></td>
                  <td><a data-toggle="modal" data-target="#tm-add"href="javascript:;">
                      <small><span class="glyphicon glyphicon-plus"></span>添加模块 </small>
                    </a></td>
                </tr>
                <?php
                    if($model){
                        foreach ($model as $v) {
                  ?>
                  <tr id="tr<?php echo $v->id;?>">  
                    <td><?php echo $v->id?></td>
                    <td><?php echo $v->cname;?></td>
                    <td><?php echo $v->cword;?></td>
                    <td><?php echo $v->tminus;?></td>
                    <td>
                    
                   <a data-toggle="modal" data-target="#tm-edit" data-id="<?php echo $v->id;?>" data-cname="<?php echo $v->cname;?>" data-tminus="<?php echo $v->tminus;?>" data-cword="<?php echo $v->cword;?>" href="javascript:;">
                      <small><span class="glyphicon glyphicon-edit"></span> 编辑 |</small>
                    </a>
                    <a href="javascript:void(0);" onclick="show_confirm(<?php echo $v->id;?>)"><small><span class="glyphicon glyphicon-remove"></span>删除 </small></a>
                    </td>
                  </tr>
                  <?php }}else{?>
                  <tr>
                    <td></td>
                    <td colspan="3">暂无数据</td>
                    <td></td>
                  </tr>
                  <?php }?>
                  <tr>
                    <td colspan="5">
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

<!-- 添加 -->
<div class="modal fade" id="tm-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>婚礼倒计时-版块添加</h4>
      </div>
      <form method="post" action="<?php echo $this->createUrl('tminusmadd');?>">
      <input type="hidden" name="tm-add" value="tm-add" />
      <div class="modal-body">
          <div class="form-group input-group">
            <label for="cname" class="control-label">模块标题:</label>
            <input type="text" class="form-control"name="cname" placeholder="标题不能为空">
          </div>
          <div class="form-group input-group">
            <label for="tminus" class="control-label">倒计月份:</label>
            <input type="text" class="form-control" name="tminus" placeholder="倒计时月份">
          </div>
          <div class="form-group">
            <label for="cword" class="control-label">一句简介:</label>
            <textarea name="cword" class="form-control"rows="3" placeholder="一句简介 60个字以内"></textarea>
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
<!-- 添加 -->
<!-- 编辑 -->
<div class="modal fade" id="tm-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4>婚礼倒计时-版块编辑</h4>
      </div>
     <form method="post" action="<?php echo $this->createUrl('tminusmedit');?>">
      <div class="modal-body">
          <div class="form-group input-group">
            <label for="id" class="control-label">ID:</label>
            <input class="form-control" type="text"  disabled="" id="id">
            <input type="hidden" class="form-control" id="id" name="id">
          </div>
          <div class="form-group input-group">
            <label for="cname" class="control-label">模块标题:</label>
            <input type="text" class="form-control" id="cname" name="cname" placeholder="标题不能为空">
          </div>
          <div class="form-group input-group">
            <label for="tminus" class="control-label">倒计月份:</label>
            <input type="text" class="form-control" id="tminus" name="tminus" placeholder="请填写一个数字">
          </div>
          <div class="form-group">
            <label for="cword" class="control-label">一句简介:</label>
            <textarea name="cword" class="form-control" rows="3" id="cword" placeholder="一句简介 60个字以内"></textarea>
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
  $('#tm-edit').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) 
  var id = button.data('id')
  var cname = button.data('cname')
  var cword = button.data('cword')
  var tminus = button.data('tminus')

  var modal = $(this)
  modal.find('.modal-body #id').val(id)
  modal.find('.modal-body #cname').val(cname)
  modal.find('.modal-body #cword').val(cword)
  modal.find('.modal-body #tminus').val(tminus)
});
 //删除提示信息 
function show_confirm(id)
{
var r=confirm("所有相关模块的文章将全问删除，请慎重！");
if (r==true)
  {
    var cid = id;
    window.location.href='/admin/guwen/tminus/tminusmdel/id/'+cid;
  }
else
  {alert("取消删除！");}
}
</script>
<!-- 编辑 -->
</body>
</html>
