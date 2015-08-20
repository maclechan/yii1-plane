<?php
/*
**@version 2015-1-29
**@author  yuzixiu
**@微婚购前台
*/
class ProductController extends Controller
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
	 * 	顾问推荐的产品列表
	 */
	public function actionProTjlist(){	
		if(isset($_GET['id']) && $_GET['id']){
			$check = new CheckUrl();
			$check->checkRule(); //判断对否新用户		
			$id = intval($_GET['id']); //顾问id
			$uid = Yii::app()->user->getState("uid");
			
			$page_index = isset($_POST['page_index'])?$_POST['page_index']:0;
			$start = $page_index*6; //起始值			
			$tjlist = AdviserRecommend::model()->with('gds','fav')->findAll(array('select'=>'id,advi_id,t.goods_id,recommend_reason',"condition"=>"t.advi_id=$id","offset"=>$start,"limit"=>6,"order"=>"t.id desc"));
			$this->render('tjlist',array(
				"tjlist"=>$tjlist
			));
		}else{
			echo '连接错误';
		}
	}
	/**
	 * 	顾问推荐的产品详情
	 */
	public function actionProTjdetail(){
		if(isset($_GET['id']) && $_GET['id']){
			$check = new CheckUrl();
			$check->checkRule(); //判断对否新用户		
			$id = intval($_GET['id']); //顾问id
			//----调用微信jssdk
			$jssdk = new JsSdk("wx95f6bdf230047a68", "ffe1eb21c7976986caa9813ead47fab7");
			$signPackage = $jssdk->GetSignPackage();				
			//----查询有无点赞
			$uid = Yii::app()->user->getState("uid");
			$fav_row = MemberFavGoods::model()->find("uid=$uid and recom_id=$id");
			if($fav_row){
				$fav_status = 1;
			}else{
				$fav_status = 0;
			}				
			$tjdetail = AdviserRecommend::model()->with('gds')->findByPk($id);
			//---查询评论
			$commentsdata = Comments::model()->with('cimg','mem')->findAll("t.goods_id=".$tjdetail->goods_id);
			$this->render('tjdetail',array(
				"tjdetail"=>$tjdetail,
				'signPackage'=>$signPackage,
				"fav_status"=>$fav_status,
				"commentsdata"=>$commentsdata
			));			
		}else{
			echo '连接错误';
		}
	}
	/**
	 * 	顾问推荐的产品点赞
	 */
	public function actionProTjZan(){
		if(isset($_POST['id']) && $_POST['id']){
			$uid = Yii::app()->user->getState("uid");
			$id = intval($_POST['id']);			
			if($_POST['type'] == 1){
				//---点赞
				$recom = AdviserRecommend::model()->findByPk($id);
				if($recom){
					$return = Goods::model()->updateCounters(array("zans"=>1),"goods_id=$recom->goods_id");
					if($return > 0){
						$memfav = new MemberFavGoods();
						$memfav->setAttributes(array(
							"uid"=>$uid,
							"recom_id"=>$id,
							"advi_id"=>$recom->advi_id,
							"goods_id"=>$recom->goods_id,
							"add_time"=>time()
						));
						$memfav->save();
						echo 1;
					}else{
						echo 2;
					}
				}else{
					echo 3; //数据丢失
				}
			}else{
				//---- 取消
				$goods_fav = MemberFavGoods::model()->find("uid=$uid and recom_id=$id");
				if($goods_fav){
					$goods_fav->delete();
				}else{
					echo 3; //数据丢失
				}
			}
		}		
	}
	/**
	 * 	顾问推荐的产品分享
	 */
	public function actionProTjShare(){
		if(isset($_POST['id']) && $_POST['id']){
			$id = intval($_POST['id']);
			$uid = Yii::app()->user->getState("uid");
			$recom = AdviserRecommend::model()->findByPk($id);
			if($recom){
				$return = Goods::model()->updateCounters(array("shares"=>1),"goods_id=$recom->goods_id");
				if($return > 0){
						$memshare = new MemberShareGoods();
						$memshare->setAttributes(array(
							"uid"=>$uid,
							"recom_id"=>$id,
							"advi_id"=>$recom->advi_id,
							"goods_id"=>$recom->goods_id,
							"openid"=>Yii::app()->user->getState("openid"),
							"add_time"=>time()
						));
						$memshare->save();				
					echo 1;
				}else{
					echo 2;
				}
			}else{
				echo 3;
			}
		}	
	}	
	/**
	 * 	顾问推荐的产品- 加入购物车
	 */
	public function actionProTjAddcar(){
		if($_POST){
			$check = new CheckUrl();
			$check->checkRule(); //判断对否新用户		
			
			$uid = Yii::app()->user->getState("uid"); //用户id	
			$is_num = MemberCart::model()->find("uid=$uid and recom_id=".$_POST['t_id']);
			$order = array();
			$order['t_id'] = $_POST['t_id']; //推荐id
			$order['a_id'] = $_POST['a_id']; //顾问id
			$order['g_id'] = $_POST['g_id']; //产品id
			$order['goodsname'] = $_POST['goodsname']; 
			$order['goodsimg'] = $_POST['goodsimg'];
			$order['adviname'] = $_POST['adviname'];
			$order['price'] = $_POST['price'];
			$order['rows'] = $_POST['rows'];
			$cart_desc = CJSON::encode($order);	
		//	echo $cart_desc;exit;
			if(!$is_num){			
				$cart = new MemberCart();
				$cart->setAttributes(array(
					"uid"=>$uid,
					"recom_id"=>$_POST['t_id'],
					"cart_desc"=>$cart_desc,
					));
				if($cart->save() > 0){
					echo 1;
				}else{
					echo 2;
				}
			}else{
				$return = MemberCart::model()->updateByPk($is_num->id,array("cart_desc"=>$cart_desc));
				if($return > 0){
					echo 1;
				}else{
					echo 2;
				}
			}
		}else{
			echo 3;
		}
	}	
	/**
	 * 	顾问推荐的产品- 订单
	 */
	public function actionProTjorder(){
		if($_POST){
			$check = new CheckUrl();
			$check->checkRule(); //判断对否新用户	

			$order = array();
			$order['t_id'] = $_POST['t_id']; //推荐id
			$order['a_id'] = $_POST['a_id']; //顾问id
			$order['g_id'] = $_POST['g_id']; //产品id
			$order['goodsname'] = $_POST['goodsname']; 
			$order['goodsimg'] = $_POST['goodsimg'];
			$order['adviname'] = $_POST['adviname'];
			$order['price'] = $_POST['price'];
			$order['rows'] = $_POST['rows'];
			$this->render('tjorder',array(
				"order"=>$order
			));
		}else{
			echo '连接错误';
		}
	}
	/**
	 * 	顾问推荐的产品- 订单确认
	 */
	public function actionProTjorderqr(){
 		if($_POST && $_POST['ordername'] && $_POST['ordertel'] && $_POST['orderaddr']){
			$check = new CheckUrl();
			$check->checkRule(); //判断对否新用户	

			$uid = Yii::app()->user->getState("uid"); //用户id	
			$order = new MemberOrder();
			$order->setAttributes(array(
				"order_id"=>Yii::app()->wxpay->create_noncestr(),
				"uid"=>$uid,
				"re_name"=>$_POST['ordername'],
				"re_mobile"=>$_POST['ordertel'],
				"re_location"=>$_POST['orderaddr'],
				"remark"=>$_POST['ordermsgg'],
				"goods_name"=>$_POST['goodsname'],
				"goods_img"=>$_POST['goodsimg'],
				"advi_id"=>$_POST['a_id'],
				"advi_name"=>$_POST['adviname'],
				"recom_id"=>$_POST['t_id'],
				"goods_id"=>$_POST['g_id'],
				"price"=>$_POST['price'],
				"rows"=>$_POST['rows'],
				"add_time"=>time()
			));			
			if($order->save() > 0){ 
			//	echo Yii::app()->wxpay->create_native_url("1234");
				//----微信支付信息
				Yii::app()->wxpay->setParameter("bank_type", "WX");
				Yii::app()->wxpay->setParameter("body", "微婚购");
				Yii::app()->wxpay->setParameter("partner", "1220492701");
				Yii::app()->wxpay->setParameter("out_trade_no", $order->order_id);
				Yii::app()->wxpay->setParameter("total_fee", $order->price*$order->rows*100);
				Yii::app()->wxpay->setParameter("fee_type", "1");
				Yii::app()->wxpay->setParameter("notify_url", "http://weihungo.com/product/proorderpay.html");
				Yii::app()->wxpay->setParameter("spbill_create_ip", Yii::app()->request->userHostAddress);
				Yii::app()->wxpay->setParameter("input_charset", "GBK");
				$biz_package = Yii::app()->wxpay->create_biz_package();
				
				//----订单确认信息
				$order_pay = array();
				$order_pay['goodsname'] = $_POST['goodsname']; 
				$order_pay['goodsimg'] = $_POST['goodsimg'];
				$order_pay['price'] = $_POST['price'];
				$order_pay['rows'] = $_POST['rows'];
				//echo $biz_package;exit;
				$this->render("order_pay",array("biz_package"=>$biz_package,"order_pay"=>$order_pay));
			}else{
				echo '下单失败,请重新操作';
			}
		}else{
			echo '连接错误或参数丢失';
		}			
	}	
	/**
	 * 	顾问推荐的产品- 微信支付确认状态
	 */
	public function actionProOrderPay(){
 	//	$postdata = file_get_contents("php://input");
		$postdata = $GLOBALS["HTTP_RAW_POST_DATA"];
		$postObj = simplexml_load_string($postdata, 'SimpleXMLElement', LIBXML_NOCDATA);
		$trade_state = $_GET["trade_state"];//支付状态
		$order_id = $_GET["out_trade_no"];//订单号
		$trans_id = $_GET["transaction_id"];//支付订单号
		$bank_type = $_GET["bank_type"];//银行类型	
	//	$bank_billno = $_GET["bank_billno"];//银行订单号	
		$total_fee = $_GET["total_fee"];//总金额
		$time_end = $_GET["time_end"];//支付完成时间
		$open_id = $postObj->OpenId;//微信唯一标示		
		if($trade_state==0){
			$trade = new MemberOrderTrade();
			$trade->setAttributes(array(
				"order_id"=>$order_id,
				"trans_id"=>$trans_id,
				"bank_type"=>$bank_type,
				"total_fee"=>$total_fee,
				"time_end"=>$time_end,
				"open_id"=>$open_id
			));
			$trade->save();
			MemberOrder::model()->updateAll(array("status"=>1),"order_id='$order_id'"); //更新订单状态
			echo "success";
		}else{
		  echo "false";
		}			 		
	}	
	/**
	 * 	用户中心我的订单-立即支付
	 */
	public function actionUsersOrderPay(){
		if(isset($_POST['oid']) && $_POST['oid']){	
			$id = intval($_POST['oid']);
			$rows = MemberOrder::model()->findByPk($id);
			if($rows){
				//----微信支付信息
				Yii::app()->wxpay->setParameter("bank_type", "WX");
				Yii::app()->wxpay->setParameter("body", "微婚购");
				Yii::app()->wxpay->setParameter("partner", "1220492701");
				Yii::app()->wxpay->setParameter("out_trade_no", $rows->order_id);
				Yii::app()->wxpay->setParameter("total_fee", $rows->price*$rows->rows*100);
				Yii::app()->wxpay->setParameter("fee_type", "1");
				Yii::app()->wxpay->setParameter("notify_url", "http://weihungo.com/product/proorderpay.html");
				Yii::app()->wxpay->setParameter("spbill_create_ip", Yii::app()->request->userHostAddress);
				Yii::app()->wxpay->setParameter("input_charset", "GBK");
				$biz_package = Yii::app()->wxpay->create_biz_package();
				
				//----订单确认信息
				$order_pay = array();
				$order_pay['goodsname'] = $rows->goods_name; 
				$order_pay['goodsimg'] = $rows->goods_img;
				$order_pay['price'] = $rows->price;
				$order_pay['rows'] = $rows->rows;
				//echo $biz_package;exit;
				$this->render("order_pay",array("biz_package"=>$biz_package,"order_pay"=>$order_pay));	
			}else{
				echo '该订单不存在';
			}
		}else{
			echo '链接错误';
		}
	}	

}