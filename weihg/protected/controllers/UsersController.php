<?php
/*
**@version 2015-2-9
**@author  yuzixiu
**@微婚购用户中心
*/
class UsersController extends Controller
{
	/**
	 * 	初始化函数
	 */
	public function init(){
		$this->layout = 'application.views.layouts.main';
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
		//-----判断是否来自微信公众号
		if($this->getAction()->id != 'proorderpay'){
			if(isset($_GET['authid']) && $_GET['authid']){
				if(!Yii::app()->user->getState("openid")){
					Yii::app()->user->setState("openid",$_GET['authid']);
				}
				return array(
					array('allow',
						'users'=>array('*'),
					)
				);				
			}else{
				if(!Yii::app()->user->getState("openid")){				
					//echo '请关注微婚购公众账号';exit;做跳转关注页面
					return array(
						array('deny',  // deny all users
							'users'=>array('*'),
						)
					);					
				}else{
					return array(
						array('allow',
							'users'=>array('*'),
						)
					);				
				}
			}	
		}else{
			return array(
				array('allow',
					'users'=>array('*'),
				)
			);			
		}		
	}
	/**
	 * 	用户中心首页
	 */
	public function actionUsersIndex(){
		$check = new CheckUrl();
		$check->checkRule(); //判断对否新用户	
		
		$uid = Yii::app()->user->getState("uid"); //用户id
		$openid = Yii::app()->user->getState("openid"); //微信openid
		
		$info = array();
		$row = Member::model()->findByPk($uid);
		if(!$row->uname && !$row->icon){
			//----通过微信公共平台接口获取个人信息
			Yii::import('ext.wechat.Wechat',true);		
			$weObj = new Wechat(null);		
			$weObj->token = 'whgwhg'; //填写你设定的key
			$weObj->appid = 'wx95f6bdf230047a68'; //填写高级调用功能的app id
			$weObj->appsecret = 'ffe1eb21c7976986caa9813ead47fab7'; //填写高级调用功能的密钥
			$weObj->debug = true;		
			$userinfo2 = $weObj->getUserInfo($openid);
			$userinfo = json_decode($userinfo2);
			//echo $userinfo->nickname;exit;
			Member::model()->updateByPk($uid,array(
				"uname"=>$userinfo->nickname,
				"sex"=>$userinfo->sex,
				"icon"=>$userinfo->headimgurl,
			));
			$info['uname'] = $userinfo->nickname;
			$info['icon'] = $userinfo->headimgurl;
			$info['uid'] = $uid;			
		}else{
			$info['uname'] = $row->uname;
			$info['icon'] = $row->icon;
			$info['uid'] = $uid;
		}	
		$gwrows = MemberCart::model()->count("uid=$uid");
		$this->render("index",array("info"=>$info,"gwrows"=>$gwrows));
	}
	/**
	 * 	用户中心个人资料
	 */
	public function actionUsersInfo(){
		$check = new CheckUrl();
		$check->checkRule(); //判断对否新用户	
		

	}
	/**
	 * 	用户中心购物车
	 */
	public function actionUsersCart(){
		$check = new CheckUrl();
		$check->checkRule(); //判断对否新用户	
		
		$uid = Yii::app()->user->getState("uid"); //用户id
		$cart_data = MemberCart::model()->findAll("uid=$uid");

		$this->render("cart",array("cart_data"=>$cart_data));
	}
	/**
	 * 	用户中心购物车提交订单
	 */
	public function actionUsersCartSub(){
		if(isset($_GET['cartid']) && $_GET['cartid']){
			$check = new CheckUrl();
			$check->checkRule(); //判断对否新用户	
			
			$cartid = intval($_GET['cartid']);
			$uid = Yii::app()->user->getState("uid"); //用户id
			$cart_data = MemberCart::model()->findByPk($cartid);
			if($cart_data){
				$order = CJSON::decode($cart_data->cart_desc);	
				$this->render('tjorder',array(
					"order"=>$order
				));
			}else{
				echo '链接错误';
			}
		}else{
			echo '链接错误';
		}
	}
	/**
	 * 	用户中心我喜欢的
	 */
	public function actionUsersFav(){
		$check = new CheckUrl();
		$check->checkRule(); //判断对否新用户	
		
		$uid = Yii::app()->user->getState("uid"); //用户id
		$set = isset($_GET['set']) && $_GET['set'] ? $_GET['set'] : 1;
		$fav_anli = MemberFavAnli::model()->with('anli','advi')->findAll("uid=$uid");
		$fav_goods = MemberFavGoods::model()->with('gds','advi')->findAll("uid=$uid");
		
		//-----根据顾问组合案例数据
		$anli_arr = array();
		$mm = 0;
		foreach($fav_anli as $data){
			$anli_arr[$data['advi_id']][$mm]['id'] = $data->anli->id;
			$anli_arr[$data['advi_id']][$mm]['img'] = $data->anli->cover;
			$anli_arr[$data['advi_id']][$mm]['title'] = $data->anli->title;
			$anli_arr[$data['advi_id']][$mm]['zans'] = $data->anli->zans;
			$anli_arr[$data['advi_id']]['adviname'] = $data->anli->advi_name;
			$anli_arr[$data['advi_id']]['icon'] = $data->advi->icon;
			$mm++;
		}
		//print_r($anli_arr);exit;
		$this->render('fav',array(
			"anli_arr"=>$anli_arr,
			"fav_goods"=>$fav_goods,
			"set"=>$set
		));
	}
	/**
	 * 	用户中心我的订单
	 */
	public function actionUsersOrder(){
		$check = new CheckUrl();
		$check->checkRule(); //判断对否新用户	
		
		$uid = Yii::app()->user->getState("uid"); //用户id
		$wheresql = isset($_GET['type']) ? ' and t.status='.intval($_GET['type']) : ''; //订单状态条件
		$type = isset($_GET['type']) ? $_GET['type'] : 'all';
		$order_data = MemberOrder::model()->with('odadvi')->findAll("uid=$uid".$wheresql);
		$this->render('order',array("order_data"=>$order_data,"type"=>$type));
	}
	/**
	 * 	用户中心我的订单-取消订单
	 */
	public function actionUsersOrderQx(){
		if($_POST && $_POST['id']){
			$id = intval($_POST['id']);
			$return = MemberOrder::model()->updateByPk($id,array("status"=>5));
			if($return > 0){
				echo 1;
			}else{
				echo 2;
			}
		}
	}
	/**
	 * 	用户中心我的订单-确认收货
	 */
	public function actionUsersOrderReceive(){
		if($_POST && $_POST['id']){
			$id = intval($_POST['id']);
			$return = MemberOrder::model()->updateByPk($id,array("status"=>3));
			if($return > 0){
				echo 1;
			}else{
				echo 2;
			}
		}
	}
	/**
	 * 	用户中心我的订单-评价
	 */
	public function actionUsersOrderComments(){
		if(isset($_GET['id']) && $_GET['id']){
			$check = new CheckUrl();
			$check->checkRule(); //判断对否新用户	
			
			$id = intval($_GET['id']); //订单id
			$order = MemberOrder::model()->with('odadvi')->findByPk($id);			
			$this->render("comments",array("order"=>$order));
		}else{
			echo '链接错误';
		}
	}	
	/**
	 * 	用户中心我的订单-评价保存
	 */
	public function actionUsersCommentsSave(){
		if(isset($_POST['goods_id']) && $_POST['goods_id'] && $_POST['order_id']){
			$uid = Yii::app()->user->getState("uid"); //用户id
			$orderid = intval($_POST['order_id']);
			$cmt = new Comments();
			$cmtphoto = new CommentsImg();
			$image_url = Yii::app()->uploadimg->UploadPhotos($cmtphoto,'upload/comments/');
			//评论图片上传成功
			if($image_url){
				//----事务处理 保持数据统一性
				$transaction=$cmt->dbConnection->beginTransaction();
				try{
					$cmt->setAttributes(array(
						"goods_id" => $_POST['goods_id'],
						"adviser_id" => $_POST['adviser_id'],
						"service" => $_POST['service'],
						"skill" => $_POST['skill'],
						"guide" => $_POST['guide'],
						"goods_c" => $_POST['goods_c'],
						"adviser_c" => $_POST['adviser_c'],
						"user_id" => $uid,//评论人ID
						"ip" => Yii::app()->request->userHostAddress, 
						"add_time" => time(),
					));
					if($cmt -> save()){
							$image = explode('#',$image_url);
							$row = count($image)-1; //张数
							for($m=0;$m<$row;$m++){
								$photoimg = new CommentsImg();			
								$photoimg->setAttributes(array(
										"comments_id"=>$cmt->id,
										"img_path"=>$image[$m],
									));
								$rest = $photoimg->save();	
							}
					//	if($rest > 0){
							//$this->redirect("/users/usersorder");
							$updret = MemberOrder::model()->updateByPk($orderid,array("status"=>6));
							$transaction->commit(); //提交事务会真正的执行数据库操作
							if($updret > 0){
								echo '<script>alert("发表成功");window.location.href="/users/usersorder";</script>';
							}
						//}
					}
				}catch(Exception $e){
					$transaction->rollBack(); //如果操作失败, 数据回滚
					echo '<script>alert("发表失败,请重试");window.history.go(-1);</script>';
				}
			}else{
				echo '<script>alert("请上传图片");window.history.go(-1);</script>';
			}
		}else{			
			echo '链接错误';
		}
	}
	
}
?>