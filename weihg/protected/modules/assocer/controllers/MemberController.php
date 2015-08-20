<?php
/*
**@version 2015-7-13
**@author  chan
*/
class MemberController extends Controller
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

	//会员信息录入
	public function actionMemAdd(){
		$model = new AssocCy();
		//$model->unsetAttributes();
		if($_POST){
			if($_FILES['AssocCy']['name']['g_path']){
				//print_r($_FILES['AssocCy']);exit;
				$image_t = Yii::app()->uploadimg->UploadPhoto($model,Yii::app()->params['upload']);
				//var_dump($image_t);exit();
				if($image_t){
					$model->setAttributes(array(
						"ass_id"=> Yii::app()->user->getId(),
						"cy_logo"=>$image_t,
						"cy_name"=>trim($_POST['AssocCy']['cy_name']),
						"add_time"=>time()
					));
					if($model -> save()){
						Yii::app()->user->setFlash('success','录入成功，可继续录入！');							
						$model->unsetAttributes();
						$this -> redirect('memadd');
					}
				}else{
					echo '<script>alert("上传图片失败");window.history.back(-1);</script>';
				}
			}
		}
		$this->render('memadd',array('list'=>$model));
	}

	//会员信息列表
	public function actionMemlist(){
		$model = new CActiveDataProvider('AssocCy',array(
				'criteria'=>array(
					//'condition'=>'t.status=1',
				),
				'pagination'=>array(
						'pageSize'=>10,
				),	
		));
		$this->render('memlist',array(
				'model'=>$model->getData(),
				'pages'=>$model->getPagination()
		));	
	}
	//会员信息删除
	public function actionMemdel(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = $_GET['id'];
			$model = AssocCy::model()->findByPk($id);
			if($model -> delete()){
				//删除顾问案例封面图
				if($model->cy_logo){
					unlink($model->cy_logo);
				}
				echo "<script>alert('删除成功！！');window.location.href='".$this->createUrl('memlist')."'</script>";
			}else{
				echo "<script>alert('操作失败！');window.location.href='".$this->createUrl('memlist')."'</script>";
			}
		}else{
			echo "<script>alert('未找到数据！');window.location.href='".$this->createUrl('memlist')."'</script>";
		}
	}
	//会长风采和协会活动添加
	public function actionHnewsadd()
	{
		$model = new AssocNews();
		if($_POST){
			if($_FILES['AssocNews']['name']['g_path']){
				//print_r($_FILES['Emcee']['name']['g_path']);exit;
				//$icon = Yii::app()->uploadimg->UploadPhoto($model,'upload/siyi/icon/');
				$icon = Yii::app()->uploadimg->UploadPhoto($model,Yii::app()->params['upload']);
				// var_dump($icon);
				// var_dump($_POST);
				// exit();
				if($icon){
					$model->setAttributes(array(
							"ass_id"=> Yii::app()->user->getId(),				
							"title"=>$_POST['AssocNews']['title'],
							"pic"=>$icon,
							"type"=>$_POST['AssocNews']['type'],
							"content"=>$_POST['desc'],
							"add_time"=>time(),
						));
						if($model->save()){
							Yii::app()->user->setFlash('success','录入成功，可继续录入！');							
							$model->unsetAttributes();
							$this -> redirect('hnewsadd');
						}else{
							unlink($icon);
						}
				}else{
					unlink($icon);
					echo '<script>alert("上传图片失败");window.history.back(-1);</script>';
				}
			}else{
				echo '<script>alert("请上传图片,大小在1M内");window.history.back(-1);</script>';
			}
		}
		$this->render('hnewsadd',array('list'=>$model));
	}
	//所有活动列表
	public function actionHnewslist(){
		$model = new CActiveDataProvider('AssocNews',array(
				'criteria'=>array(
					//'condition'=>'t.status=0',
				),
				'pagination'=>array(
						'pageSize'=>10,
				),	
		));
		$this->render('hnewslist',array(
				'model'=>$model->getData(),
				'pages'=>$model->getPagination()
		));	
	}
	//活动列表删除
	public function actionExampledel(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = $_GET['id'];
			$model = AssocNews::model()->findByPk($id);
			if($model -> delete()){
				//删除顾问案例封面图
				if($model->pic){
					unlink($model->pic);
				}
				echo "<script>alert('删除成功！！');window.location.href='".$this->createUrl('hnewslist')."'</script>";
			}else{
				echo "<script>alert('操作失败！');window.location.href='".$this->createUrl('hnewslist')."'</script>";
			}
		}else{
			echo "<script>alert('未找到数据！');window.location.href='".$this->createUrl('hnewslist')."'</script>";
		}
	}

	//活动编辑
	public function actionExampledit(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = intval($_GET['id']);
			$model = AssocNews::model()->findByPk("$id");
			if(isset($_POST['AssocNews']) && $_POST['AssocNews']){
				$_POST['AssocNews']['content'] = $_POST['desc'];
				if($_POST['AssocNews']['g_path'] !== $model->pic){
					unlink($model->pic);
				}
				$m = $model -> attributes = $_POST['AssocNews'];
				$return = $model -> updateByPk($id,$m);
				if($return > 0){
					echo "<script>alert('编辑成功');window.location.href='".$this->createUrl('hnewslist')."'</script>";
				}else{
					//删除上传成功的新图像
					if($_POST['AssocNews']['g_path'] !== $model->pic){
						unlink($_POST['AssocNews']['pic']);
					}
					echo '<script>alert("编辑失败");window.history.back(-1);</script>';
				}
			}
		$this->render('hnewsedit',array('list'=>$model));
		}else{
			echo "<script>alert('未找到数据！');window.location.href='".$this->createUrl('hnewslist')."'</script>";
		}	
	}


	//顾问信息编辑
	public function actionHuiedit(){
		$id = Yii::app()->user->getId();
		$model = Assoc::model()->findByPk("$id");
		if(isset($_POST['Assoc']) && $_POST['Assoc']){
			if($_POST['Assoc']['password']==''){
				$_POST['Assoc']['password'] = md5(123321);
			}else if($_POST['Assoc']['password']!==$model->password){
				//更新新密码
				$_POST['Assoc']['password'] = md5(trim($_POST['Assoc']['password']));
			}else {
				//不更新密码
				$_POST['Assoc']['password'] = trim($_POST['Assoc']['password']);
			}
			//更新图像并删除原图
			if($_FILES['Assoc']['name']['g_path']){
				if($_POST['Assoc']['g_path'] !== $model->icon){
					//unlink($model->icon);
					$icon = Yii::app()->uploadimg->UploadPhoto($model,Yii::app()->params['upload']);
					$_POST['Assoc']['icon'] = $icon;
				}
			}
			$m = $model -> attributes = $_POST['Assoc'];
			$return = $model -> updateByPk($id,$m);
			if($return > 0){
				echo "<script>alert('编辑成功');window.location.href='".$this->createUrl('/assocer')."'</script>";
			}else{
				//删除上传成功的新图像
				if($_POST['Assoc']['g_path'] !== $model->icon){
					unlink($_POST['Assoc']['icon']);
				}
				echo '<script>alert("编辑失败");window.history.back(-1);</script>';
			}
		}
		$this->render('huiedit',array('list'=>$model));
	}

}

?>