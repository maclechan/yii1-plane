<?php
/*
**@version 2015-1-16
**@author  yuzixiu
*/
class RecommendController extends Controller
{
	/**
	 * 	初始化函数
	 */
	public function init(){
		$this->layout = false;
	}
	/**
	 * @return array action filters
	 */
	public function filters(){
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules(){
		if(Yii::app()->user->isGuest){		
				$this->redirect('/admin');						
		}else{
			$uid = Yii::app()->user->getId();
			$info = AdminUser::model()->with('role')->find("t.user_id=$uid");
			$role_action = explode(',',$info->role->role_action);
			if($info->role->role_id == 1 || (in_array($this->getAction()->id,$role_action) && $info->role->status == 1)){
				return array(
					array('allow',  // allow all users to access 'index' and 'view' actions.
						'users'=>array('@'),
					)
				);
			}else{
				return array(
					array('deny',  // deny all users
						'users'=>array('@'),
					)
				);				
			}
		}
	}

	/**
	 * 	待审核推荐产品搜索
	 */		
	public function actionUnsearch(){			
		$model = new AdviserRecommend('search');			
		$model->unsetAttributes();
		$goodname=$_GET["search"];	
		$cid=$_GET["cid"];	
		if(!$goodname && !$cid){
			$this->redirect($this->createUrl("unrecommend"));
		}else{
			$category = Category::model()->findAll(); //分类列表
			$model->goodsname = $goodname;
			if($cid){
				$model->cid = $cid;
			}
			$this->render("recommencheck",array(
				"model"=>$model->search()->getData(),
				"pages"=>$model->search()->getPagination(),
				"itemCount"=>$model->search()->getTotalItemCount(),
				"category"=>$category
			));
		}	
	}

	//待审核推荐产品
	public function actionUnrecommend(){
		$category = Category::model()->findAll();
		$recommend = new AdviserRecommend();		
		$model = new CActiveDataProvider($recommend,array(
				'criteria'=>array(
					'condition'=>"t.status=0",
					'with'=>array('gdsam','gdscate'),
					'order'=>'t.goods_id desc'
				),
				'pagination'=>array(
					'pageSize'=>10,
				),
		));
		$this->render('recommencheck',array(
			'model'=>$model->getData(),
			'pages'=>$model->getPagination(),
			'category'=>$category,
		));
	}

	//ajax审核推荐产品
	public function actionCheckdone(){
		if($_POST['id']){
			$model = new AdviserRecommend();
			//判断ajax请求的值是不是多个
			$check=explode('&',$_POST['id'],-1);
			$model = $model->updateByPk($check,array(
					'status' => 1
			));
			if($model>0){
				echo 1;//更新成功
			}else{
				echo 2;//更新失败
			}
		}
	}
	
	//推荐产品
	public function actionRecommendlist(){
		$category = Category::model()->findAll();
		$recommend = new AdviserRecommend();		
		$model = new CActiveDataProvider($recommend,array(
				'criteria'=>array(
					'condition'=>"t.status=1",
					'with'=>array('gdsam','gdscate'),
					'order'=>'t.goods_id desc'
				),
				'pagination'=>array(
					'pageSize'=>10,
				),
		));
		$this->render('recommendlist',array(
			'model'=>$model->getData(),
			'pages'=>$model->getPagination(),
			'category'=>$category,
		));
	}

	/**
	 * 	推荐产品搜索
	 */		
	public function actionSearch(){			
		$model = new AdviserRecommend('search');			
		$model->unsetAttributes();
		$goodname=$_GET["search"];	
		$cid=$_GET["cid"];	
		if(!$goodname && !$cid){
			$this->redirect($this->createUrl("recommendlist"));
		}else{
			$category = Category::model()->findAll(); //分类列表
			$model->goodsname = $goodname;
			if($cid){
				$model->cid = $cid;
			}
			$this->render("recommendlist",array(
				"model"=>$model->search()->getData(),
				"pages"=>$model->search()->getPagination(),
				"itemCount"=>$model->search()->getTotalItemCount(),
				"category"=>$category
			));
		}		
	}
}