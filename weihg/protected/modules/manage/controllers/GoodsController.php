<?php
/*
**@version 2015-1-29
**@author  chan 429140141
**@产品管理
*/
class GoodsController extends Controller
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
				$this->redirect('/manage');						
		}else{
				return array(
					array('allow',  // allow all users to access 'index' and 'view' actions.
						'users'=>array('@'),
					)
				);
		}
	}
	/**
	 * 	微婚购自盈上架的产品列表
	 */	
	public function actionGoodsList(){
		$category = Category::model()->findAll();

		$goods = new Goods();		
		$model = new CActiveDataProvider($goods,array(
				'criteria'=>array(
					'condition'=>'t.status=1',
					'with'=>array('gc'),
					'order'=>'t.goods_id desc'
				),
				'pagination'=>array(
					'pageSize'=>10,
				),
		));
		$this->render('goodslist',array(
			'model'=>$model->getData(),
			'pages'=>$model->getPagination(),
			'category'=>$category,
		));		
	}

	/**
	 * 	产品搜索
	 */		
	public function actionSearch(){			
		$model = new Goods('search');			
		$model->unsetAttributes();
		$goodname=$_GET["search"];	
		$cid=$_GET["cid"];	
		if(!$goodname && !$cid){
			$this->redirect($this->createUrl("goodslist"));
		}else{
			$category = Category::model()->findAll(); //分类列表
			$model->goods_name = $goodname;
			if($cid){
				$model->c_id = $cid;
			}
			$this->render("goodslist",array(
				"model"=>$model->search()->getData(),
				"pages"=>$model->search()->getPagination(),
				"itemCount"=>$model->search()->getTotalItemCount(),
				"category"=>$category
			));
		}		
	}

	//推荐产品
	public function actionRecommend(){
		if(isset($_POST['goods_id']) && $_POST['goods_id']){
			$goodsis = trim($_POST['goods_id']);
			$adviid = Yii::app()->user->getId();
			$model = new AdviserRecommend();
			$r = $model -> findAllByAttributes(array("advi_id"=>$adviid,"goods_id"=>$goodsis));
			if($r){
				echo '<script>alert("你己经推荐过该产品！");window.history.back(-1);</script>';
			}else{
				$_POST['AdviserRecommend']['advi_id'] = $adviid;
				$_POST['AdviserRecommend']['advi_name'] = yii::app()->user->getName();
				$_POST['AdviserRecommend']['goods_id'] = $goodsis;
				$_POST['AdviserRecommend']['recommend_reason'] = $_POST['recommend_reason'];
				$_POST['AdviserRecommend']['add_time'] = time();
				$_POST['AdviserRecommend']['status'] = 0;
				$model -> attributes = $_POST['AdviserRecommend'];
				if($model ->save()){
					echo "<script>alert('推荐成功！');window.location.href='".$this->createUrl('goodslist')."'</script>";
				}else{
					echo '<script>alert("推荐失败，请重新推荐！");window.history.back(-1);</script>';
				}
			}		
		}else{
			echo '<script>alert("产品ID没找到！");window.history.back(-1);</script>';
		}
	}	

	//我的推荐
	public function actionRecommendlist(){
		$adviid = Yii::app()->user->getId();
		$category = Category::model()->findAll();
		$recommend = new AdviserRecommend();		
		$model = new CActiveDataProvider($recommend,array(
				'criteria'=>array(
					'condition'=>"t.advi_id=$adviid",
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
	 * 	我的推荐搜索
	 */		
	public function actionRecommendso(){			
		$model = new AdviserRecommend('search');			
		$model->unsetAttributes();
		$goodname=$_GET["search"];	
		$cid=$_GET["cid"];	
		if(!$goodname && !$cid){
			$this->redirect($this->createUrl("recommendlist"));
		}else{
			$category = Category::model()->findAll(); //分类列表
			$model->goodsname = $goodname;
			$model->advi_id = Yii::app()->user->getId();
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
?>