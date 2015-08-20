<?php
/*
**@version 2015-1-16
**@author  yuzixiu
**@产品管理
*/
class HandleController extends Controller
{
	/**
	 *  初始化函数
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
	 * 	产品类别
	 */
	public function actionEtpcategory(){
		$model = new CActiveDataProvider('Category',array(
				'criteria'=>array(
						//	'condition'=>'status=0'
						'order'=>'add_time desc',
						//'condition'=>'status=1',
						),
						'pagination'=>array(
								'pageSize'=>20,
						),
				));
		$this->render('category',array(
				'customercategory'=>$model->getData(),
				'pages'=>$model->getPagination(),
		));		
	}
	/**
	 * 	产品类别标签
	 */
	public function actionEtpTagList(){
		if(isset($_GET['c_id']) && $_GET['c_id']){	
			$c_id = $_GET['c_id'];
			$category = Category::model()->findAll('status=1');		
			
			$model = new CActiveDataProvider('GoodsTag',array(
					'criteria'=>array(
							'condition'=>"t.cat_id=$c_id",
							'with'=>array('cate'),
							'order'=>'sort_order desc',
							),
					'pagination'=>array(
							'pageSize'=>20,
					),
					));
			$this->render('taglist',array(
					'tags'=>$model->getData(),
					'pages'=>$model->getPagination(),
					'category'=>$category,
					'c_id'=>$c_id
			));	
		}else{
			die('数据丢失');
		}
	}
	/**
	 * 	产品类别标签添加
	 */
	public function actionEtpTagadd(){
		$goodstag = new GoodsTag();
		if($_POST && $_POST['tname'] && $_POST['cid']){
			$goodstag->setAttributes(array(
				"tag_name"=>$_POST['tname'],
				"cat_id"=>$_POST['cid'],
				"sort_order"=>$_POST['sort']			
			));
			if($goodstag->save() > 0){
				echo 1;
			}else{
				echo 2;
			}
		}else{
			echo 3;
		}
	}	
	/**
	 * 	产品类别标签修改
	 */
	public function actionEtpTagupd(){
		if($_POST && $_POST['tname'] && $_POST['id'] && $_POST['cid']){
			$id = intval($_POST['id']);
			$attr = array(
				"tag_name"=>$_POST['tname'],
				"cat_id"=>$_POST['cid'],
				"sort_order"=>$_POST['sort']
			);			
			$updreturn = GoodsTag::model()->updateByPk($id,$attr);
			if($updreturn > 0){
				echo 1;
			}else{
				echo 2;
			}
		}else{
			echo 3;
		}		
	}
	/**
	 * 	产品标签搜索
	 */		
	public function actionEtpTagSearch(){			
			$model = new GoodsTag('search');			
			$model->unsetAttributes();
			$tagname=$_GET["keyword"];
			$cid = $_GET["c_id"];
			if(!$tagname){
				$this->redirect($this->createUrl("etptaglist",array("c_id"=>$cid)));
			}else{
				$category = Category::model()->findAll('status=1'); //分类列表
				$model->tag_name = $tagname;
				$model->cat_id = $cid;
				$this->render("taglist",array(
					"tags"=>$model->search()->getData(),
					"pages"=>$model->search()->getPagination(),
					"itemCount"=>$model->search()->getTotalItemCount(),
					"tagname"=>$tagname,
					"category"=>$category,
					"c_id"=>$cid					
				));
			}		
	}
	/**
	 * 	标签删除
	 */		
	public function actionEtpTagDel(){
		if(isset($_POST['id']) && $_POST['id']){
			$tid = $_POST['id'];

			$goodstag = new GoodsTag();				
			$model = $goodstag->findByPk($tid);
			if($model->delete()){
				echo 1; //删除成功
			}else{
				echo 3;
			}			
		}else{
			echo 2; //数据丢失
		}
	}
	
	/**
	 *  产品录入
	 */
	public function actionEtpgoodsAdd(){
		$goods = new Goods();
		if($_POST){
			$goods->setAttributes(array(
				"c_id"=>$_POST['c_id'],
				"goods_name"=>$_POST['goodname'],
				"bs_name"=>$_POST['shangjia'],
				"bs_location"=>$_POST['s_location'],
				"goods_intro"=>$_POST['intro'],
				"price"=>$_POST['price'],
				"shop_price"=>$_POST['shop_price'],
				"goods_img"=>$_POST['icon'],
			//	"goods_thumb"=>$image[1],
				"goods_desc"=>$_POST['desc'],
				"last_update"=>time(),
				"add_time"=>time(),
				"add_id"=>Yii::app()->user->getId(),
				"tag_id"=>$_POST['tags']
			));
			if($goods->save() > 0){
				echo '<script>alert("添加产品成功");window.location.href="'.$this->createUrl("etpgoodslist").'";</script>';
			}else{
				echo '<script>alert("添加产品失败");window.history.back(-1);</script>';
			}	
		}else{
			$category = Category::model()->findAll('status=1');	
			$this->render('goodsadd',array(
				'goods'=>$goods,
				'category'=>$category
			));		
		}
	}
	/**
	 *  产品图片添加
	 */
	public function actionEtpgoodsUpsave(){
			if($_FILES){				
				$data = yii::app()->UploadReceive->receive($_FILES['upload'],'/upload/goodscut/');
				echo json_encode($data);
			}
	}

	public function actionEtpcut(){
		$filename = $_POST['name'];
		$file = $_SERVER['DOCUMENT_ROOT'].'/upload/goodscut/'.$filename;
		//裁剪后的图片路径
		$folder = date('Ymd')."/";
		$path = $_SERVER['DOCUMENT_ROOT'].'/upload/goodscut/'.$folder;
		if(!is_dir($path)){
			if(!mkdir($path, 0777, true)){
				die('创造文件夹失败...');
			}else{
			//	chmod($root.$folder,0777);
			}
		}	
		$cutPicfolder = '/upload/goodscut/'.$folder;
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
	/**
	 *  产品标签载入
	 */
	public function actionEtpLoadtags(){
		if(isset($_POST['cid']) && $_POST['cid']){
			$cid = $_POST['cid'];
			$tagdata = GoodsTag::model()->findAll("cat_id=$cid");
			$tag_input = '<select name="tags" class="form-control"><option value="">--请选择--</option>';
			if($tagdata){
				foreach($tagdata as $tagval){
					$tag_input .= '<option value="'.$tagval->tag_id.'" />'.$tagval->tag_name.'</option>';
				}
			}
			echo $tag_input.'</select>';
		}else{
			echo 1; //数据丢失
		}
	}
	/**
	 * 	产品列表
	 */	
	public function actionEtpGoodsList(){
		$category = Category::model()->findAll();

		$goods = new Goods();		
		$model = new CActiveDataProvider($goods,array(
				'criteria'=>array(
					'with'=>array('gc'),
					'order'=>'t.goods_id desc'
				),
				'pagination'=>array(
					'pageSize'=>20,
				),
		));
		$this->render('goodslist',array(
			'model'=>$model->getData(),
			'pages'=>$model->getPagination(),
			'category'=>$category,
		));		
	}
	/**
	 * 	产品更新
	 */		
	public function actionEtpGoodsUpdate(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = $_GET['id']; //产品id
			$goods_data = Goods::model()->findByPk($id);
			if($_POST){
				$updarr = array(
					"c_id"=>$_POST['c_id'],
					"goods_name"=>$_POST['goodname'],
					"bs_name"=>$_POST['shangjia'],
					"bs_location"=>$_POST['s_location'],
					"goods_intro"=>$_POST['intro'],
					"price"=>$_POST['price'],
					"shop_price"=>$_POST['shop_price'],					
					"goods_desc"=>$_POST['desc'],
					"last_update"=>time(),
				);
				if(isset($_POST['tags']) && $_POST['tags']){
					$updarr["tag_id"]=$_POST['tags'];					
				}
				//---判断头像有无修改
				if($goods_data->goods_img != $_POST['icon']){
					$updarr['goods_img']=$_POST['icon'];
				}
				$goodsupd = Goods::model()->updateByPk($id,$updarr);
				if($goodsupd > 0){
					echo '<script>alert("修改产品成功");window.location.href="'.$this->createUrl("etpgoodslist").'";</script>';
				}else{
					echo '<script>alert("修改产品失败");window.history.back(-1);</script>';
				}
			}else{
				$category = Category::model()->findAll('status=1');	
				$this->render('goodsupd',array("goods_data"=>$goods_data,"category"=>$category));
			}
		}else{
			die('数据参数不存在');
		}
	}
	/**
	 * 	产品删除
	 */		
	public function actionEtpGoodsDel(){
		if(isset($_POST['id']) && $_POST['id']){
			$gid = $_POST['id'];

			$goods = new Goods();				
			$model = $goods->findByPk($gid);
			if($model->goods_thumb){
				unlink(substr($model->goods_thumb,1));
			}
			if($model->goods_img){
				unlink(substr($model->goods_img,1));
			}
			if($model->delete()){
				echo 1; //删除成功
			}			
		}else{
			echo 2; //数据丢失
		}
	}
	/**
	 * 	产品搜索
	 */		
	public function actionEtpGoodsSearch(){			
			$model = new Goods('search');			
			$model->unsetAttributes();
			$goodname=$_GET["search"];	
			$cid=$_GET["cid"];	
			if(!$goodname && !$cid){
				$this->redirect($this->createUrl("etpgoodslist"));
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
					"goodname"=>$goodname,
					"category"=>$category
				));
			}		
	}	
	/**
	 * 	产品上下架
	 */		
	public function actionEtpGoodsAdded(){
		if(isset($_GET['type']) && isset($_GET['id'])){
			$gid = $_GET['id'];

			$goods = new Goods();			
			if($_GET['type'] == 1){
				//-----上架
				$return = $goods->updateByPk($gid,array("status"=>1));
			}elseif($_GET['type'] == 2){
				//-----下架
				$return = $goods->updateByPk($gid,array("status"=>0));
			}
			if(isset($return) && $return == 1){
				echo '<script>alert("操作成功");window.location.href="'.$this->createUrl("etpgoodslist").'"</script>';
			}else{
				echo '<script>alert("操作失败");window.location.href="'.$this->createUrl("etpgoodslist").'"</script>';
			}
		}else{
			echo '<script>alert("数据丢失");window.location.href="'.$this->createUrl("etpgoodslist").'"</script>';
		}
	}
	
}