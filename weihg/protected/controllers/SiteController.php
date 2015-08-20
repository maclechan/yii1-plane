<?php
/*
**@version 2015-1-24
**@author  yuzixiu
**@微婚购前台
*/
class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	/**
	 * 	初始化函数
	 */
	public function init(){
		$this->layout = 'application.views.layouts.main';
		//-----判断是否来自微信公众号
		if(isset($_GET['authid']) && $_GET['authid']){
			if(!Yii::app()->user->getState("openid")){
				Yii::app()->user->setState("openid",$_GET['authid']);
			}
		}else{
			if(!Yii::app()->user->getState("openid")){				
				echo '请关注微婚购公众账号';exit;
			}
		}		
	}
	/**
	 * 	微婚购引导页
	 */
	public function actionLoading()
	{	
		$openid = Yii::app()->user->getState("openid"); //微信唯一标示
		$row = Member::model()->find("openid='$openid'");
		if(!$row){	
			//--用户资料保存--不存在则添加(双重过滤 只为单独打开此页面时)
			$member = new Member();
			$member->setAttributes(array(
				"reg_time"=>time(),
				"openid"=>$openid
			));	
			$member->save();	
		}		
		$this->render('loading');		
	}
	/**
	 * 	微婚购首页
	 */
	public function actionIndex()
	{
		$check = new CheckUrl();
		$check->checkRule(); //判断对否新用户	
		$this->render('index');	
	}	
	/**
	 * 	微婚购引导页数据提交
	 */
	public function actionIndexFm()
	{
		if($_POST){
			if($_POST['age']=='' && $_POST['const']=='' && $_POST['fav']=='' && $_POST['hlsty']==''){
				//无回答问卷直接进入首页
				$this->redirect('/site/index');
			}else{
				$style = $_POST['hlsty'];
				$qdata['age'] = $_POST['age']; //年代
				$qdata['const'] = $_POST['const']; //星座
				$qdata['fav'] = $_POST['fav']; //爱好
				$qdata['hlsty'] = $_POST['hlsty']; //婚礼风格
				$nmq = json_encode($qdata);
				Member::model()->updateAll(array("nmq"=>$nmq),"openid='".Yii::app()->user->getState("openid")."'");
				
				if(!$style){
					$style = 1;
				}
				$advi_data = Adviser::model()->findAll(array("select"=>"id,name,icon","condition"=>"style=$style","order"=>"zans desc","limit"=>5)); //推荐的顾问
				$this->render('index_fm',array(
					"advi_data"=>$advi_data
				));				
			}
		}else{
			echo '链接错误';
		}		
	}
	/**
	 * 	顾问列表
	 */
	public function actionGuwList(){
		$check = new CheckUrl();
		$check->checkRule(); //判断对否新用户
		$guw = Adviser::model()->findAll(array("select"=>"id,name,icon,anlis,zans","condition"=>"status=1","limit"=>6,"order"=>"zans desc"));
		$this->render('guwlist',array(
				'guwdata'=>$guw
		));			
	}
	/**
	 * 	顾问列表更多加载、搜索、筛选
	 */
	public function actionGuwListMore(){
		if($_POST){
			$wheresql = ''; //筛选条件
			if(isset($_POST['param_name'])){
				//----名字精确查找
				$wheresql = " name like '%".$_POST['param_name']."%' and";
			}else{
				//----条件查找
				$param_1 = isset($_POST['param_1'])?' style='.intval($_POST['param_1']).' and':''; //风格
				$param_2 = isset($_POST['param_2'])?' sex='.intval($_POST['param_2']).' and':''; //性别
				$param_3 = isset($_POST['param_3'])?' level='.intval($_POST['param_3']).' and':''; //职称
				$param_4 = isset($_POST['param_4'])?' price_fw="'.intval($_POST['param_4']).'" and':''; //婚礼预算

				$wheresql = $param_1.$param_2.$param_3.$param_4;
			}		
			$wheresql = $wheresql." status=1";
			
			$page_index = isset($_POST['page_index'])?$_POST['page_index']:0;
			$start = $page_index*6; //起始值
			$adviser = new Adviser();
			$advi_data = $adviser->findAll(array("select"=>"id,name,icon,anlis,zans","condition"=>$wheresql,"offset"=>$start,"limit"=>6,"order"=>"zans desc"));
			if($advi_data){
				$adv_data = array();
				$ii = 0;
				foreach($advi_data as $advi_val){
					$adv_data[$ii]['param_1'] = $advi_val->id; //ID号
					$adv_data[$ii]['param_2'] = $advi_val->name; //名称
					$adv_data[$ii]['param_3'] = $advi_val->icon; //头像
					$adv_data[$ii]['param_4'] = $advi_val->anlis; //案例数	
					$adv_data[$ii]['param_5'] = $advi_val->zans; //赞数	
					$ii++;
				}
				echo CJSON::encode($adv_data);
			}else{
				echo 2;//暂无数据
			}
		}else{
			echo '链接错误';
		}
	}
	/**
	 * 	顾问主页
	 */
	public function actionGuwHome(){
		if(isset($_GET['id']) && $_GET['id']){
			$check = new CheckUrl();
			$check->checkRule(); //判断对否新用户
			
			$id = intval($_GET['id']);
			$advi_data = Adviser::model()->with("anli")->findByPk($id);
			$this->render('guwhome',array(
					'advi_data'=>$advi_data
			));				
		}else{
			echo '链接出错了';
		}
	}
	/**
	 * 	顾问介绍
	 */
	public function actionGuwHomeIntro(){
		if(isset($_GET['id']) && $_GET['id']){
			$check = new CheckUrl();
			$check->checkRule(); //判断对否新用户
			
			$id = intval($_GET['id']);	
			$advi_data = Adviser::model()->findByPk($id);
			$comments = Comments::model()->findAllBySql("select avg(service) as service,avg(skill) as skill,avg(guide) as guide from comments where adviser_id=$id");
			$commentsdata = Comments::model()->with('mem')->findAll("t.adviser_id=$id");
			$this->render('guwhomeintro',array(
					'advi_data'=>$advi_data,
					"comments"=>$comments,
					"commentsdata"=>$commentsdata
			));				
		}else{
			echo '链接错误';
		}
	}
	/**
	 * 	顾问案例详情
	 */
	public function actionGuwAnlixq(){
		if(isset($_GET['id']) && $_GET['id']){
			$check = new CheckUrl();
			$check->checkRule(); //判断对否新用户
			
			$id = intval($_GET['id']); //详情id
			$uid = Yii::app()->user->getState("uid");
			$advi_anli = AdviserAnli::model()->findByPk($id);
			//----调用微信jssdk
			$jssdk = new JsSdk("wx95f6bdf230047a68", "ffe1eb21c7976986caa9813ead47fab7");
			$signPackage = $jssdk->GetSignPackage();			
			//----查询有无点赞
			$fav_row = MemberFavAnli::model()->find("uid=$uid and anli_id=$id");
			if($fav_row){
				$fav_status = 1;
			}else{
				$fav_status = 0;
			}
			$this->render('anlixq',array(
					'advi_anli'=>$advi_anli,
					'signPackage'=>$signPackage,
					'fav_status'=>$fav_status
			));				
		}else{
			echo '链接出错了';
		}
	}
	/**
	 * 	顾问案例详情分享+1
	 */
	public function actionGuwAnliShare(){
		if(isset($_POST['id']) && $_POST['id']){
			$id = intval($_POST['id']);
			$uid = Yii::app()->user->getState("uid");
			$anli = AdviserAnli::model()->findByPk($id);
			if($anli){
				$return = AdviserAnli::model()->updateCounters(array("shares"=>1),"id=$id");
				if($return > 0){
						$memfav = new MemberShareAnli();
						$memfav->setAttributes(array(
							"uid"=>$uid,
							"anli_id"=>$id,
							"advi_id"=>$anli->advi_id,
							"openid"=>Yii::app()->user->getState("openid"),
							"add_time"=>time()
						));
						$memfav->save();				
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
	 * 	顾问案例详情点赞+1
	 */
	public function actionGuwAnliZan(){
		if(isset($_POST['id']) && $_POST['id']){
			$uid = Yii::app()->user->getState("uid");
			$id = intval($_POST['id']);			
			if($_POST['type'] == 1){
				//---点赞
				$anli = AdviserAnli::model()->findByPk($id);
				if($anli){
					$return = AdviserAnli::model()->updateCounters(array("zans"=>1),"id=$id");
					if($return > 0){
						$memfav = new MemberFavAnli();
						$memfav->setAttributes(array(
							"uid"=>$uid,
							"anli_id"=>$id,
							"advi_id"=>$anli->advi_id,
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
				$anli_fav = MemberFavAnli::model()->find("uid=$uid and anli_id=$id");
				if($anli_fav){
					$anli_fav->delete();
				}else{
					echo 3; //数据丢失
				}
			}
		}
	}	

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
}