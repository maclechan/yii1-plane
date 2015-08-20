<?php
/*
**@version 2015-1-16
**@author  chan
*/
class HandleController extends Controller
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
	//会长添加
	public function actionHuiadd(){
		$model = new Assoc();
		if($_POST){
			if($_FILES['Assoc']['name']['g_path']){
				$icon = Yii::app()->uploadimg->UploadPhoto($model,Yii::app()->params['macle']);
				//var_dump($_POST);exit();
				if($icon){
					$model->setAttributes(array(
							"loger"=> $_POST['Assoc']['loger'],	
							"password"=> $_POST['Assoc']['password']?md5(trim($_POST['Assoc']['password'])):md5(123321),
							"icon"=>$icon,
							"assoc_name"=>$_POST['Assoc']['assoc_name'],
							"assocer"=>$_POST['Assoc']['assocer'],
							"mobile"=>$_POST['Assoc']['mobile'],
							"qq"=>$_POST['Assoc']['qq'],
							"mail"=>$_POST['Assoc']['mail'],
							"assocer_jy"=>$_POST['Assoc']['assocer_jy'],
							"assoc_desc"=>$_POST['desc'],
							"add_time"=>time(),
						));
						if($model->save()){
							Yii::app()->user->setFlash('success','录入成功，可继续录入！');							
							$model->unsetAttributes();
							$this -> redirect('huiadd');
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
		$this->render('huiadd',array('list'=>$model));
	}

	//会长删除
	public function actionHuidel(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = $_GET['id'];
			$model = Assoc::model()->findByPk($id);
			if($model -> delete()){
				//删除顾问案例封面图
				if($model->icon){
					unlink($model->icon);
				}
				echo "<script>alert('删除成功！！');window.location.href='".$this->createUrl('huilist')."'</script>";
			}else{
				echo "<script>alert('操作失败！');window.location.href='".$this->createUrl('huilist')."'</script>";
			}
		}else{
			echo "<script>alert('未找到数据！');window.location.href='".$this->createUrl('huilist')."'</script>";
		}
	}

	//会长列表
	public function actionHuilist(){
		$model = new CActiveDataProvider('Assoc',array(
				'criteria'=>array(
					//'condition'=>'t.status=1',
				),
				'pagination'=>array(
						'pageSize'=>10,
				),	
		));
		$this->render('huilist',array(
				'model'=>$model->getData(),
				'pages'=>$model->getPagination()
		));	
	}

	//顾问信息录入
	public function actionGwenAdd(){
		$model = new Adviser();
		$model->unsetAttributes();
		if(isset($_POST['Adviser']) && $_POST['Adviser']){
			$_POST['Adviser']['add_id'] = Yii::app()->user->getId();
			$_POST['Adviser']['add_time'] = time();
			$_POST['Adviser']['name'] = trim($_POST['Adviser']['name']);
			if($_POST['Adviser']['password']==''){
				$_POST['Adviser']['password'] = md5(123321);
			}else {
				$_POST['Adviser']['password'] = md5(trim($_POST['Adviser']['password']));
			}
			$model -> attributes = $_POST['Adviser'];
			if($model -> save()){
				Yii::app()->user->setFlash('success','录入成功，可继续录入！');							
				$model->unsetAttributes();
				$this -> redirect('gwenadd');
			}else{
				//录入失败，删除上传成功的图像
				if($_POST['Adviser']['icon']){
					unlink(substr($_POST['Adviser']['icon'],1));
				}
			}
		}
		$this->render('gwenadd',array('list'=>$model));
	}

	//顾问信息编辑
	public function actionGwenedit(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = $_GET['id'];
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
					echo "<script>alert('编辑成功');window.location.href='".$this->createUrl('gwenlist')."'</script>";
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

	//顾问检索
	public function actionSearch(){
		$model = new Adviser();		
		$model->unsetAttributes();
		$name=$_GET["guwen"];
		if(!$name){
			$this->redirect($this->createUrl("gwenlist"));
		}else{
			$model->name = $name;
			$this->render("gwenlist",array(
				"model"=>$model->search()->getData(),
				"pages"=>$model->search()->getPagination(),
				"itemCount"=>$model->search()->getTotalItemCount(),
				"name"=>$name
			));
		}	
	}
	//顾问列表
	public function actionGwenlist(){
		$model = new CActiveDataProvider('Adviser',array(
				'criteria'=>array(
					'condition'=>'t.status=1',
				),
				'pagination'=>array(
						'pageSize'=>10,
				),	
		));
		$this->render('gwenlist',array(
				'model'=>$model->getData(),
				'pages'=>$model->getPagination()
		));	
	}

	//ajax 顾问信息删除
	public function actionGwendel(){
		if(isset($_POST['id']) && $_POST['id']){
			$id = $_POST['id'];
			$adviser = Adviser::model()->findByPk($id);
			//删除顾问图片
			if($adviser->icon){
				unlink(substr($adviser->icon,1));
			}
			if($adviser -> delete()){
				//删除此顾问所有案例
				$adviseranli = AdviserAnli::model()->findAll("advi_id=$id");
				foreach ($adviseranli as $k => $v) {
					if($v->cover){
						if(unlink(substr($v->cover,1))){
							$return = AdviserAnli::model()->deleteByPk($v->id);	
						}
					}
				}
				if($return){
					echo 1;
				}				
			}else{
				echo 2;
			}
		}
	}

	//司仪审核列表展示
	public function actionGwencheck(){
		$model = new CActiveDataProvider('Adviser',array(
				'criteria'=>array(
					'condition'=>'t.status=0',
				),
				'pagination'=>array(
						'pageSize'=>10,
				),	
		));
		$this->render('gwencheck',array(
				'model'=>$model->getData(),
				'pages'=>$model->getPagination()
		));	
	}

	//ajax审核顾问
	public function actionCheckdone(){
		if($_POST['id']){
			$model = new Adviser();
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

	//案例添加
	public function actionGwenanli(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = intval($_GET['id']);
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
					$this -> redirect('gwenanli/id/'.$id);
				}else{
					//录入失败，删除上传成功的图像
					if($_POST['AdviserAnli']['cover']){
						unlink(substr($_POST['AdviserAnli']['cover'],1));
					}
				}
			}
			$this->render('anliadd',array('list'=>$model,'adviser'=>$adviser));
		}else{
			echo "<script>alert('未找到数据！');window.location.href='".$this->createUrl('gwenlist')."'</script>";
		}	
	}

	
	//所有顾问案例列表
	public function actionExample(){
		$model = new CActiveDataProvider('AdviserAnli',array(
				'criteria'=>array(
					//'condition'=>'t.status=0',
				),
				'pagination'=>array(
						'pageSize'=>10,
				),	
		));
		$this->render('example',array(
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
				echo "<script>alert('删除成功！！');window.location.href='".$this->createUrl('example')."'</script>";
			}else{
				echo "<script>alert('操作失败！');window.location.href='".$this->createUrl('example')."'</script>";
			}
		}else{
			echo "<script>alert('未找到数据！');window.location.href='".$this->createUrl('example')."'</script>";
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
					echo "<script>alert('编辑成功');window.location.href='".$this->createUrl('example')."'</script>";
				}else{
					//删除上传成功的新图像
					if($_POST['AdviserAnli']['cover'] !== $model->cover){
						unlink(substr($_POST['AdviserAnli']['cover'],1));
					}
					echo '<script>alert("编辑失败");window.history.back(-1);</script>';
				}
			}
		$this->render('anliedit',array('list'=>$model));
		}else{
			echo "<script>alert('未找到数据！');window.location.href='".$this->createUrl('example')."'</script>";
		}	
	}

}