<?php
/**
 * @结婚倒计时
 * @author [macle] <[429140141]>
 * @time(2015-02-05)
 */
class TminusController extends Controller
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
	 * 倒计时文章封面图片
	 * @method {[Tminusave]} {[Tminuscut]}
	 * @return [imgpath]
	 */
	public function actionTminusave(){
			if($_FILES){			
				if (isset($_GET['m']) && $_GET['m']=='anli'){
					//案例封面图裁剪前路径
					$data = yii::app()->UploadReceive->receive($_FILES['upload'],'/upload/tminus/');
					echo json_encode($data);
				}else{
					//顾问图像裁剪前路径
					$data = yii::app()->UploadReceive->receive($_FILES['upload'],'/upload/tminus/');
					echo json_encode($data);
				}
		}
	}

	//顾问图像裁剪
	public function actionTminuscut(){
		//案例封面图裁剪后路径
		if(isset($_GET['m']) && $_GET['m']=='anli'){
			$filename = $_POST['name'];
			$file = $_SERVER['DOCUMENT_ROOT'].'/upload/tminus/'.$filename;
			//裁剪后以日期文件夹保存图
			$folder = date('Ymd')."/";
			$cutPicfolder = '/upload/tminus/'.$folder;
			$newpath = $_SERVER['DOCUMENT_ROOT'].'/upload/tminus/'.$folder;
			if(!is_dir($newpath))
			{
				if(!mkdir($newpath, 0777, true))
				{
					die('创建失败');
				}
			}
		}else{
			$filename = $_POST['name'];
			$file = $_SERVER['DOCUMENT_ROOT'].'/upload/tminus/'.$filename;
			//裁剪后以日期文件夹保存图
			$folder = date('Ymd')."/";
			$cutPicfolder = '/upload/tminus/'.$folder;
			$newpath = $_SERVER['DOCUMENT_ROOT'].'/upload/tminus/'.$folder;
			if(!is_dir($newpath))
			{
				if(!mkdir($newpath, 0777, true))
				{
					die('创建失败');
				}
			}
		}
		$cutPicPath = $_SERVER['DOCUMENT_ROOT'].$cutPicfolder;
		$urlPath = yii::app()->UploadReceive->get_current_url();
		$urlPath = rtrim($urlPath,'/').'/'; 
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

	/**
	 * @倒计时模块管理
	 * @method {Tminusmlist} {Tminusmadd} {Tminusmedit} {Tminusmdel} 
	 * 
	 */
	public function actionTminusmlist(){
		$model = new CActiveDataProvider('TminusCate',array(
				'criteria'=>array(
					//'condition'=>'t.advi_id='.Yii::app()->user->getId(),
				),
				'pagination'=>array(
						'pageSize'=>10,
				),	
		));
		$this->render('tminusmlist',array(
				'model'=>$model->getData(),
				'pages'=>$model->getPagination()
		));	
	}

	//模块添加
	public function actionTminusmadd(){
		if ($_POST['tm-add']=='tm-add') {
			$model = new TminusCate();
			$_POST['TminusCate']['cname'] = trim($_POST['cname']);
			$_POST['TminusCate']['cword'] = trim($_POST['cword']);
			$_POST['TminusCate']['tminus'] = trim($_POST['tminus']);
			$model -> attributes = $_POST['TminusCate'];
			if($model -> save()){
				echo "<script>alert('添加成功！');window.location.href='".$this->createUrl('tminusmlist')."'</script>";
			}else{
				echo "<script>alert('添加失败，请重试！');window.location.href='".$this->createUrl('tminusmlist')."'</script>";
			}
		}else{
			echo "<script>alert('你怎么跑到地球的另一端了！');window.location.href='".$this->createUrl('tminusmlist')."'</script>";
		}	
	}

	//模块编辑
	public function actionTminusmedit(){
		if ($_POST['id']) {
			$id = $_POST['id'];
			$model = TminusCate::model()->findByPk($id);
			$_POST['TminusCate']['cname'] = trim($_POST['cname']);
			$_POST['TminusCate']['cword'] = trim($_POST['cword']);
			$_POST['TminusCate']['tminus'] = trim($_POST['tminus']);
			$result = $model -> attributes = $_POST['TminusCate'];
			$return = $model -> updateByPk($id,$result);
			if($return > 0){
					echo "<script>alert('编辑成功');window.location.href='".$this->createUrl('tminusmlist')."'</script>";
			}else{
				echo '<script>alert("编辑失败");window.history.back(-1);</script>';
			}
		}else{
			echo "<script>alert('你怎么跑到地球的另一端了！');window.location.href='".$this->createUrl('tminusmlist')."'</script>";
		}	
	}

	//模块删除
	public function actionTminusmdel(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = $_GET['id'];
			$Tcate = TminusCate::model()->findByPk($id);
			if($Tcate -> delete()){
				$tminus = Tminus::model()->findAll("cid=$id");
				foreach ($tminus as $k => $v) {
					if($v->cover){
						if(unlink(substr($v->cover,1))){
							$return = Tminus::model()->deleteByPk($v->id);	
						}
					}
				}
				echo "<script>alert('删除成功！！');window.location.href='".$this->createUrl('tminusmlist')."'</script>";
			}else{
				echo "<script>alert('操作失败！');window.location.href='".$this->createUrl('tminusmlist')."'</script>";
			}
		}else{
			echo "<script>alert('未找到数据！');window.location.href='".$this->createUrl('tminusmlist')."'</script>";
		}
	}
	
	/**
	 * @倒计时文章管理
	 * @method {Tminuslist} {Tminusadd} {Tminusedit} {Tminusdel} 
	 * 
	 */
	public function actionTminuslist(){
		$model = new CActiveDataProvider('Tminus',array(
				'criteria'=>array(
					//'condition'=>'t.advi_id='.Yii::app()->user->getId(),
				),
				'pagination'=>array(
						'pageSize'=>10,
				),	
		));
		$this->render('tminuslist',array(
				'model'=>$model->getData(),
				'pages'=>$model->getPagination()
		));	
	}

	//倒计时文章添加
	public function actionTminusadd(){
			$tcate = TminusCate::model() -> findAll();
			$model = new Tminus();
			if(isset($_POST['Tminus']) && $_POST['Tminus']){
				//$_POST['Tminus']['cid'] = $id;
				$_POST['Tminus']['desc'] = $_POST['desc'];
				$_POST['Tminus']['pubtime'] = time();
				$model -> attributes = $_POST['Tminus'];
				if($model -> save()){
					Yii::app()->user->setFlash('success','录入成功，可继续录入！');							
					$model->unsetAttributes();
					$this -> redirect('tminusadd');
				}else{
					//录入失败，删除上传成功的图像
					if($_POST['Tminus']['cover']){
						unlink(substr($_POST['Tminus']['cover'],1));
					}
				}
			}
			$this->render('tminusadd',array('list'=>$model,'tcate'=>$tcate));
	}

	//倒计时文章编辑
	public function actionTminusedit(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = $_GET['id'];
			$tcate = TminusCate::model() -> findAll();
			$model = Tminus::model()->findByPk($id);
			if(isset($_POST['Tminus']) && $_POST['Tminus']){
				$_POST['Tminus']['desc'] = $_POST['desc'];
				$_POST['Tminus']['editime'] = time();
				//更新图像并删除原图
				if($_POST['Tminus']['cover'] !== $model->cover){
					unlink(substr($model->cover,1));
				}
		
				$result = $model -> attributes = $_POST['Tminus'];
				$return = $model -> updateByPk($id,$result);
				if($return > 0){
					echo "<script>alert('编辑成功');window.location.href='".$this->createUrl('tminuslist')."'</script>";
				}else{
					//删除上传成功的新图像
					if($_POST['Tminus']['cover'] !== $model->cover){
						unlink(substr($_POST['Tminus']['cover'],1));
					}
					echo '<script>alert("编辑失败");window.history.back(-1);</script>';
				}
			}
		$this->render('tminusedit',array('list'=>$model,'tcate'=>$tcate));
		}
	}

	//倒计时文章删除
	public function actionTminusdel(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = $_GET['id'];
			$Tminus = Tminus::model()->findByPk($id);
			if($Tminus -> delete()){
				//删除顾问案例封面图
				if($Tminus->cover){
					unlink(substr($Tminus->cover,1));
				}
				echo "<script>alert('删除成功！！');window.location.href='".$this->createUrl('tminuslist')."'</script>";
			}else{
				echo "<script>alert('操作失败！');window.location.href='".$this->createUrl('tminuslist')."'</script>";
			}
		}else{
			echo "<script>alert('未找到数据！');window.location.href='".$this->createUrl('tminuslist')."'</script>";
		}
	}
		
}