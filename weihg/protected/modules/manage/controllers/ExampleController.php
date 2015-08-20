<?php
/*
**@version 2015-1-29
**@author  chan 429140141
**@产品管理
*/
class ExampleController extends Controller
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

	public function actionGuwensave(){
			if($_FILES){			
				if (isset($_GET['m']) && $_GET['m']=='anli'){
					//案例封面图裁剪前路径
					$data = yii::app()->UploadReceive->receive($_FILES['upload'],'/upload/anli/');
					echo json_encode($data);
				}else{
					//顾问图像裁剪前路径
					$data = yii::app()->UploadReceive->receive($_FILES['upload'],'/upload/guwencut/');
					echo json_encode($data);
				}
		}
	}

	//顾问图像裁剪
	public function actionGuwencut(){
		//案例封面图裁剪后路径
		if(isset($_GET['m']) && $_GET['m']=='anli'){
			$filename = $_POST['name'];
			$file = $_SERVER['DOCUMENT_ROOT'].'/upload/anli/'.$filename;
			//裁剪后以日期文件夹保存图
			$folder = date('Ymd')."/";
			$cutPicfolder = '/upload/anli/'.$folder;
			$newpath = $_SERVER['DOCUMENT_ROOT'].'/upload/anli/'.$folder;
			if(!is_dir($newpath))
			{
				if(!mkdir($newpath, 0777, true))
				{
					die('创建失败');
				}
			}
		}else{
			$filename = $_POST['name'];
			$file = $_SERVER['DOCUMENT_ROOT'].'/upload/guwencut/'.$filename;
			//裁剪后的图片路径	
			$cutPicfolder = '/upload/guwencut/';
		}
		$cutPicPath = $_SERVER['DOCUMENT_ROOT'].$cutPicfolder;
		$urlPath = yii::app()->UploadReceive->get_current_url();
		//$urlPath = self::_get_current_url();  // http://www.tcweb.com/admin/emcee/emcee
		$urlPath = rtrim($urlPath,'/').'/'; //http://www.tcweb.com/admin/emcee/emcee/
		$x1 = $_POST['offsetLeft'];
		$y1 = $_POST['offsetTop'];
		$width = $_POST['width'];
		$height = $_POST['height'];

		$type = exif_imagetype($file);
		$support_type=array(IMAGETYPE_JPEG , IMAGETYPE_PNG , IMAGETYPE_GIF);

		if(!in_array($type, $support_type,true)) {
		    $data['status'] = 0;
		    $data['info'] =  "不支持的格式！";
		    echo json_encode($data);
		    exit;
		}else{
		    switch($type) {
		    case IMAGETYPE_JPEG :
		        $image = imagecreatefromjpeg($file);
		        break;
		    case IMAGETYPE_PNG :
		        $image = imagecreatefrompng($file);
		        break;
		    case IMAGETYPE_GIF :
		        $image = imagecreatefromgif($file);
		        break;
		    default:
		        $data['status'] = 0;
		        $data['info'] =  "不支持的格式！";

		        echo json_encode($data);
		        exit;
		    }

		    //图片裁剪
		    $copy = yii::app()->UploadReceive->PIPHP_ImageCrop($image, $x1, $y1, $width, $height);
		    //$copy = self::_PIPHP_ImageCrop($image, $x1, $y1, $width, $height);
		    $newName = 'cut_'.$filename;
		    $targetPic = $cutPicPath.$newName;

		    //TODO 目录与写文件检测
		    if(false === imagejpeg($copy, $targetPic) ){
		        $data['status'] = 0;
		        $data['info'] =  "生成裁剪图片失败！请确认保存路径存在且可写！";
		        echo json_encode($data);
		        exit;
		    } 

		    @unlink($file);

		    $data['status'] = 1;
		    $data['path'] = $cutPicfolder.$newName;
		    $data['name'] = $newName;
		    $data['url']  = $urlPath.$data['path'];

		    echo json_encode($data);
		    exit;

		}
	}

	//案例添加
	public function actionExampleadd(){
		$id = Yii::app()->user->getId();
		$adviser = Adviser::model()->findByPk($id);
		$model = new AdviserAnli();
		$model->unsetAttributes();
		if(isset($_POST['AdviserAnli']) && $_POST['AdviserAnli']){
			$_POST['AdviserAnli']['advi_id'] = $id;
			$_POST['AdviserAnli']['advi_name'] = $adviser->name;
			$_POST['AdviserAnli']['desc'] = $_POST['desc'];
			$_POST['AdviserAnli']['add_time'] = time();
			$model -> attributes = $_POST['AdviserAnli'];
			if($model -> save()){
				Yii::app()->user->setFlash('success','录入成功，可继续录入！');							
				$model->unsetAttributes();
				$this -> redirect('exampleadd');
			}else{
				//录入失败，删除上传成功的图像
				if($_POST['AdviserAnli']['cover']){
					unlink(substr($_POST['AdviserAnli']['cover'],1));
				}
			}
		}
		$this->render('exampleadd',array('list'=>$model,'adviser'=>$adviser));
	}
	
	//顾问信息编辑
	public function actionGwenedit(){
			$id = Yii::app()->user->getId();
			$model = Adviser::model()->findByPk("$id");
			if(isset($_POST['Adviser']) && $_POST['Adviser']){
				if($_POST['Adviser']['password']==''){
					$_POST['Adviser']['password'] = md5(123321);
				}else if($_POST['Adviser']['password']!==$model->password){
					//更新新密码
					$_POST['Adviser']['password'] = md5(trim($_POST['Adviser']['password']));
				}else {
					//不更新密码
					$_POST['Adviser']['password'] = trim($_POST['Adviser']['password']);
				}
				//更新图像并删除原图
				if($_POST['Adviser']['icon'] !== $model->icon){
					unlink(substr($model->icon,1));
				}
				$_POST['Adviser']['add_id'] = Yii::app()->user->getId();
				$_POST['Adviser']['upd_time'] = time();
				$m = $model -> attributes = $_POST['Adviser'];
				$return = $model -> updateByPk($id,$m);
				if($return > 0){
					echo "<script>alert('编辑成功');window.location.href='".$this->createUrl('gwenedit')."'</script>";
				}else{
					//删除上传成功的新图像
					if($_POST['Adviser']['icon'] !== $model->icon){
						unlink(substr($_POST['Adviser']['icon'],1));
					}
					echo '<script>alert("编辑失败");window.history.back(-1);</script>';
				}
			}
			$this->render('gwenedit',array('list'=>$model));
	}

	//案例列表
	public function actionExamplelist(){
		$model = new CActiveDataProvider('AdviserAnli',array(
				'criteria'=>array(
					'condition'=>'t.advi_id='.Yii::app()->user->getId(),
				),
				'pagination'=>array(
						'pageSize'=>10,
				),	
		));
		$this->render('examplelist',array(
				'model'=>$model->getData(),
				'pages'=>$model->getPagination()
		));	
	}

	//案例删除
	public function actionExampledel(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = $_GET['id'];
			$AdviserAnli = AdviserAnli::model()->findByPk($id);
			if($AdviserAnli -> delete()){
				//删除顾问案例封面图
				if($AdviserAnli->cover){
					unlink(substr($AdviserAnli->cover,1));
				}
				echo "<script>alert('删除成功！！');window.location.href='".$this->createUrl('examplelist')."'</script>";
			}else{
				echo "<script>alert('操作失败！');window.location.href='".$this->createUrl('examplelist')."'</script>";
			}
		}else{
			echo "<script>alert('未找到数据！');window.location.href='".$this->createUrl('examplelist')."'</script>";
		}
	}

	//案例编辑
	public function actionExampledit(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = intval($_GET['id']);
			$model = AdviserAnli::model()->findByPk("$id");
			if(isset($_POST['AdviserAnli']) && $_POST['AdviserAnli']){
				$_POST['AdviserAnli']['desc'] = $_POST['desc'];
				$_POST['AdviserAnli']['upd_time'] = time();
				if($_POST['AdviserAnli']['cover'] !== $model->cover){
					unlink(substr($model->cover,1));
				}
				$m = $model -> attributes = $_POST['AdviserAnli'];
				$return = $model -> updateByPk($id,$m);
				if($return > 0){
					echo "<script>alert('编辑成功');window.location.href='".$this->createUrl('examplelist')."'</script>";
				}else{
					//删除上传成功的新图像
					if($_POST['AdviserAnli']['cover'] !== $model->cover){
						unlink(substr($_POST['AdviserAnli']['cover'],1));
					}
					echo '<script>alert("编辑失败");window.history.back(-1);</script>';
				}
			}
		$this->render('exampledit',array('list'=>$model));
		}else{
			echo "<script>alert('未找到数据！');window.location.href='".$this->createUrl('examplelist')."'</script>";
		}	
	}
	
}
?>