<?php
/**
 * 	微喜帖功能模块
 * 	@author [chan] 
 * 	@time(2015-3-30)
 */
class WcardController extends Controller
{
	/**
	 * 	初始化函数
	 */
	public function init(){
		$this->layout = 'application.views.layouts.main';
	}
	
	/**
	 * 	网友微喜帖定制
	 */
	public function actionWcardSave(){
		
		if(isset($_POST) && $_POST){
			$user_id = 4;//  Yii::app()->user->getState("uid"); //用户id
			$wcard = new WeddingCard();
			$cphoto = new WeddingPhoto();
			/*事务*/
			$r = $wcard -> findByAttributes(array("user_id"=>$user_id));
			if(!$r){
			/**/
			$image_url = Yii::app()->uploadimg->UploadPhotos($cphoto,'upload/wcard/');
			$cover = $_POST['cover'];
			//图片上传成功
			if($image_url){
				//----事务处理 保持数据统一性
				$transaction=$wcard->dbConnection->beginTransaction();
				try{
			 		$wcard->setAttributes(array(
						"theme_id" => $_POST['themeid'],
						"user_id" => 4,//$user_id,
						"groom" => $_POST['male_nm'],
						"bride" => $_POST['fem_nm'],
						"wedday" => strtotime($_POST['wed_tm']),
						"address" => $_POST['wed_ad'],
						"toguest" => $_POST['to_per'],
						"cashpacket" => $_POST['cashpacket'],
						"music" => $_POST['music'], 
						"addtime" => time(),
					));
					if($wcard -> save()){
							$image = explode('#',$image_url);
							$row = count($image)-1; //张数
							for($m=0;$m<$row;$m++){
								$photoimg = new WeddingPhoto();	
								if($cover == $m){
									$iscover = 1;
								}else{
									$iscover = 0;
								}
								$photoimg->setAttributes(array(
										"x_id"=>$wcard->id,
										"imgsrc"=>$image[$m],
										"cover"=>$iscover
								));							
								$rest = $photoimg->save();	
							}
						$transaction->commit(); //提交事务会真正的执行数据库操作													
					}
				}catch(Exception $e){
					$transaction->rollBack(); 
					echo '<script>alert("操作失败，请重新操作！");window.history.go(-1);</script>';
				}					
			}
			/**/
			}else{
				echo '<script>alert("您可以尝试换个主题风格！");window.history.go(-1);</script>';
			}
			/**/
		}
		$this -> render('fstep');
	}

	//查看微喜帖
	public function actionWcarde(){
		$user_id = 4;//  Yii::app()->user->getState("uid"); //用户id
		//$r = $wcard -> findByAttributes(array("user_id"=>$user_id));

		$wcard = new WeddingCard();
		$cphoto = new WeddingPhoto();

		$this->render('fstepedit');
	}

	//微喜帖预览
	public function actionCardshow(){	
		$this->render('xtshow');
	}

	public function actionCardjson(){
		$user_id = 7;//  Yii::app()->user->getState("uid"); //用户id
		$model = WeddingCard::model()->with('wimg')->find("user_id=$user_id");
		$arr = array();
		//$arr['param_8'] = $model->wimg;
		$arr['param']['param_1'] = $model->groom;
		$arr['param']['param_2'] = $model->bride;
		$arr['param']['param_3'] = date('Y年m月d日',$model->wedday);
		$arr['param']['param_4'] = $model->address;

		$iscover = 1;
		foreach ($model->wimg as $_v) {
			 $arr['param']['param_8'][]['img'] = '/'.$_v['imgsrc'];
			 if($_v['cover'] == 1){
			 	$arr['param']['param_5'] = '/'.$_v['imgsrc'];
			 }
			
		}
		/**
		 * [
	{"param_1":"周杰伦","param_2":"昆凌","param_3":"2015年1月26日17:00PM","param_4":"杭州市下城区庆春路148号","param_5":"../../images/wedimg/11.jpg","param_6":"6","param_7":"110","param_8":[	
		{"img":"../../images/wedimg/1.jpg"},
		{"img":"../../images/wedimg/8.jpg"},
		{"img":"../../images/wedimg/2.jpg"},
		{"img":"../../images/wedimg/4.jpg"},
		{"img":"../../images/wedimg/5.jpg"},
		{"img":"../../images/wedimg/6.jpg"}
	]}
]
		 */

		echo CJSON::encode($arr);
	}
}