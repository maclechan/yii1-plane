<?php
/*
**@version 2015-1-13
**@author  yuzixiu
*/
class HandleController extends Controller
{
	public function actions()
	{
        return array( 
            // captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
				'minLength'=>4,  //最短为4位
				'maxLength'=>6,   //是长为4位
				'testLimit'=>'999',
			),
		); 	
	}
	/**
	 * 	初始化函数
	 */
	public function init(){
		$this->layout = 'application.modules.admin.views.layouts.main';
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
				return array(
					array('deny', 
						"actions"=>array('logout','left','default','uppwd','noticesearch','noticedetail','noticelist','messagelist','messagedetail','messagesearch','messageadd','messagedel'),
						'users'=>array('*'),
					)
				);					
		}else{
				return array(
					array('allow',  // allow all users to access 'index' and 'view' actions.
						'users'=>array('@'),
					)
				);
		}
	}	
	/**
	 * 	后台首页
	 */	
	public function actionIndex(){
 		if(Yii::app()->user->isGuest){
			$this->redirect('/admin/sign');				
		}else{ 	
			$uid = Yii::app()->user->getId();
			$info = AdminUser::model()->find("user_id=$uid");
			$this->render('index',array(
				'info'=>$info,
			));
		}
	}
	/**
	***登录
	*/
	public function actionSign(){
		$this->layout = false;		

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
		//	echo $this->createAction('captcha')->getVerifyCode()."</br>".$_POST['verifyCode'];exit;
			if($this->createAction('captcha')->getVerifyCode()!=$_POST['verifyCode']){
				echo "<script>alert('验证码错误');window.location.href='/admin';</script>";
				exit;
			}			
			if($model->validate() && $model->login()){
				$this->redirect('/admin');
			}else{
				echo '<script>alert("用户名或密码错误");window.location.href="/admin";</script>';
			}
		}else{
			// display the login form
			$this->createAction('captcha')->getVerifyCode(true);
			$this->render('sign',array('model'=>$model));
		}
	}
	/**
	***退出
	*/	
	public function actionLogout(){
		Yii::app()->user->logout();
		$this->redirect('/admin/sign');	
	}
	
	/**
	***左边菜单栏
	*/	
	public function actionLeft(){
		$this->layout = false;
		
		$uid = Yii::app()->user->getId();
		$info = AdminUser::model()->with('role')->find("t.user_id=$uid");
		$ac='';
		if($info->role->role_id == 1){
			//----系统管理员全部权限
			if(isset($_GET['id']) && $_GET['id']){
				$mid = $_GET['id'];
				$model = Nav::model()->with('ac_site')->findAll(array("condition"=>"t.m_id=$mid and t.status=1","order"=>"t.sort,ac_site.sort asc"));
			}else{
				$model = '';
			}
		}else{
			if(Yii::app()->user->getState('role_nav')){
				$nav = substr(Yii::app()->user->getState('role_nav'),0,-1); //授权的二级栏目
				$ac = explode(',',Yii::app()->user->getState('role_ac')); //授权的三级栏目
				if(isset($_GET['id']) && $_GET['id']){
					$mid = $_GET['id'];
					$model = Nav::model()->with('ac_site')->findAll(array("condition"=>"t.m_id=$mid and t.status=1 and t.id in($nav)","order"=>"t.sort asc"));
				}else{
					$model = '';
				}		
			}else{
				$model = '';
			}			
		}
		
		$this->render('left',array(
			"model"=>$model,
			"ac"=>$ac,
			"m_en"=>$_GET['en'],
			"roleid"=>$info->role->role_id
		));
	}	
	/**
	***后台默认页
	*/	
	public function actionDefault(){
		$this->layout = false;
			$uid = Yii::app()->user->getId();
			$user = AdminUser::model()->find("user_id=$uid");
			$roleid = $user->role_id;
			$role =  AdminUserRole::model()->findByPk($roleid);
			$date = mktime(0,0,0,date("m"),01,date("Y"));
/* 			if($roleid == 12){
				//----采集组展示当月采集新人数
				//---自动分表
				$tab_obj = new Submeter('member');
				$mem_model = $tab_obj->fenbiao();	
				$dqcount = $mem_model->count("add_id=$uid and apply_t>$date");
			}elseif($roleid == 13){
				//----分配组展示当月分配新人数
				//---自动分表
				$tab_obj = new Submeter('member');
				$mem_model = $tab_obj->fenbiao();	
				$dqcount = $mem_model->count("operate_id=$uid and operate_t>$date");				
			}else{
				//-----其他组展示当月采集、分配、录入商家等数量
				//---自动分表
				$tab_obj = new Submeter('member');
				$mem_model = $tab_obj->fenbiao();	
				$tab_obj2 = new Submeter('customer');
				$mem_model2 = $tab_obj2->fenbiao();					
				$dqcount[0] = $mem_model->count("add_id=$uid and apply_t>$date");				
				$dqcount[1] = $mem_model->count("operate_id=$uid and operate_t>$date");	
				$dqcount[2] = $mem_model2->count("add_id=$uid and add_time>$date");		
			} */
			//系统公告
			$notice = Notice::model()->findAll(array(
				'select'=>'id,title,content',
				'condition'=>'type=1',
				'order'=>'time desc',
				'limit'=>6,
			));
			$this->render('default',array(
				'user'=>$user,'role'=>$role,'notice'=>$notice,'dqcount'=>0
			));
	}
	/**
	***修改密码
	*/		
	public function actionUppwd(){
		$this->layout = false;
		if($_POST)
		{
			if($_POST['new_pass']==$_POST['new_pass2'])
			{
				$model=AdminUser::model()->findByAttributes(array('password'=>md5($_POST['old_pass']),'user_id'=>Yii::app()->user->getId()));
				if($model)
				{
					$model->password=md5($_POST['new_pass']);
					$return = $model->save();
					if($return > 0){
						Yii::app()->user->logout();
						echo "<script>alert('修改成功');top.location='/admin/sign';</script>";
					}else{
						echo "<script>alert('修改失败');window.location.href='/admin/handle/uppwd';</script>";
					}
				}else{
					echo "<script>alert('原密码不正确');window.location.href='/admin/handle/uppwd';</script>";
				}
			}else{
				echo "<script>alert('两次输入新密码不同');window.location.href='/admin/handle/uppwd';</script>";
			}
		}else{		
			$this->render('uppwd');
		}
	}
	/**
	* 公告列表显示
	*/
	public function actionNoticelist(){
		$this->layout = false;
		$model = new CActiveDataProvider('Notice',array(
					'criteria'=>array(
						'condition'=>'t.type=1',
						'order'=>'t.time desc',
						'with'=>array('na')
					),
					'pagination'=>array(
						'pageSize'=>15,
					),
				));
		$this->render('noticelist',array(
				'notice'=>$model->getData(),
				'pages'=>$model->getPagination(),
		));
	}	
	/**
	* 公告标题搜索
	*/
	public function actionNoticesearch(){
		$this->layout = false;
		$model = new Notice('search');
		$model->unsetAttributes();
		$key=$_GET["keyword"];	
		if(!$key){
			$this->redirect($this->createUrl("noticelist"));
		}else{
			$model->title = $key;
			$this->render("noticelist",array(
				"notice"=>$model->search()->getData(),
				"pages"=>$model->search()->getPagination(),
				"itemCount"=>$model->search()->getTotalItemCount(),
				"key"=>$key,
			));
		}			
	}	
	/**
	*公告的详细信息
	*/
	public function actionNoticedetail(){	
		$this->layout = false;
		if(isset($_GET['id']) && $_GET['id']){
			$id=$_GET['id'];
			$notice=Notice::model()->with('na')->findByPk("$id");
			$this->render('noticedetail',array(
					'notice'=>$notice,
			));
		}else{
			die('error:no get id');
		}
	}	
	/**
	* 我的消息（私信）
	*/
	public function actionMessagelist(){
		$this->layout = false;
		$r_id = Yii::app()->user->getId();
		if(isset($_GET['type']) && $_GET['type']){
			$type = intval($_GET['type']);
			if($type == 1){
				//--收件箱
				$where = "t.recever_id=$r_id and t.receve_status='0'";
			}else{
				//--发件箱
				$where = "t.sender_id=$r_id and t.send_status='0'";
			}
		}else{
			$type = 1;
			$where = "t.recever_id=$r_id and t.receve_status='0'";
		}
		$model = new CActiveDataProvider('Message',array(
			'criteria'=>array(
				'with'=>array('ms','mr'),
				'order'=>'t.send_time desc',
				'condition'=>$where,
			),
			'pagination'=>array(
				'pageSize'=>15,
			),
		));
		$this->render('messagelist',array(
			'message'=>$model->getData(),
			'pages'=>$model->getPagination(),
			'type'=>$type
		));
	}
	/**
	* 我的消息（私信）搜索
	*/
	public function actionMessagesearch(){
		$this->layout = false;
		$uid = Yii::app()->user->getId();
		if(isset($_GET['type']) && $_GET['type']){
			$type = intval($_GET['type']);
		}else{
			$type = 1;
		}		
		$model = new Message('search');
		$model->unsetAttributes();
		$key=$_GET["keyword"];	
		if(!$key){
			$this->redirect($this->createUrl("messagelist"));
		}else{
			$model->title = $key;
			if($type == 1){
				$model->recever_id = $uid;
				$model->receve_status = '0';
			}else{
				$model->sender_id = $uid;
				$model->send_status = '0';
			}
			$this->render("messagelist",array(
				"message"=>$model->search()->getData(),
				"pages"=>$model->search()->getPagination(),
				"itemCount"=>$model->search()->getTotalItemCount(),
				"key"=>$key,
				'type'=>$type
			));
		}			
	}	
	/**
	* 私信详细页
	*/
	public function actionMessagedetail(){
		$this->layout = false;
		if(isset($_GET['id']) && $_GET['id']){	
			if(isset($_GET['type']) && $_GET['type']){
				$type = intval($_GET['type']);
			}else{
				$type = 1;
			}		
			$id=$_GET['id'];
			$message=Message::model()->updateByPk($id,array('read_status'=>'1'));
			$message=Message::model()->with('ms')->findByPk("$id");
			$this->render('messagedetail',array(                 
					'message'=>$message,
					'type'=>$type
				));
		}else{
			die('error:no get id');
		}				
	}
	/**
	* 站内信信息发送
	*/
	public function actionMessageadd(){
		$this->layout = false;
		//判断post中的值
		if(empty($_POST)){
			//回复站内信
			$_GET['sender_id'] = isset($_GET['sender_id']) && $_GET['sender_id'] ? $_GET['sender_id']:'';
			if($_GET['sender_id']){
				$recever_id=$_GET['sender_id'];
				$msg=AdminUser::model()->find("user_id='$recever_id'"); 
				$this->render('messageadd',array('msg'=>$msg));
			}else{ 
				$this->render('messageadd');
			}
		}else{
			//发送给所有的人
			$_POST['allmem'] = isset($_POST['allmem']) && $_POST['allmem'] ? $_POST['allmem']:'';
			if($_POST['allmem']=='allmem'){
				$sender_id=Yii::app()->user->getId();
				$arr=AdminUser::model()->findAll();
				foreach($arr as $v){
					if($sender_id!=$v->user_id){
						//遍历  取出所要发给用户的id
						$recever_id=$v->user_id;
						//实例化对象   写入数据库中
						$message=new Message();
						$message->sender_id=$sender_id;
						$message->recever_id=$recever_id;
						$message->title=$_POST['title'];
						$message->content=$_POST['content'];
						$message->send_time=time();
						//写入数据库中
						if($message->save()>0){
							echo '<script>alert("发送成功");window.location.href="/admin/handle/messagelist";</script>';
						}else{
							echo '<script>alert("发送失败");window.location.href="'.$_SERVER['HTTP_REFERER'].'";</script>';
						}
					}
				}
			}else{
				//给指定的一个人发送信息
				$toMsg=isset($_POST['toMsg']) && $_POST['toMsg'] ? $_POST['toMsg'] : '';
				//发送信息人的id
				$sender_id=Yii::app()->user->getId();
				if($toMsg){
					$arr=AdminUser::model()->find("user_name='$toMsg'");
					//收件人的id					
					if($arr){
						$recever_id=$arr->user_id;
						//实例化对象   写入数据库中
						$message=new Message();
						$message->sender_id=$sender_id;
						$message->recever_id=$recever_id;
						$message->title=$_POST['title'];
						$message->content=$_POST['content'];
						$message->send_time=time();
						//写入数据库中
						if($message->save() > 0){
							echo '<script>alert("发送成功");window.location.href="/admin/handle/messagelist";</script>';
						}else{
							echo '<script>alert("发送失败");window.location.href="'.$_SERVER['HTTP_REFERER'].'";</script>';
						}
					}else{
						echo '<script>alert("该收件人不存在");window.location.href="'.$_SERVER['HTTP_REFERER'].'";</script>';
					}
				}else{
					echo '<script>alert("用户不存在");window.location.href="'.$_SERVER['HTTP_REFERER'].'";</script>';
				} 
			} 
		} 	
	}	
	/**
	* 站内信的删除
	*/
	public function actionMessagedel(){
		$id=isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : '';
		$type = isset($_GET['type']) && $_GET['type'] ? intval($_GET['type']) : 1;
		
		if($id){
			if($type == 1){
				$count=Message::model()->updateByPk($id,array('receve_status'=>'1'));
			}else{
				$count=Message::model()->updateByPk($id,array('send_status'=>'1'));
			}
		}
		if($count){
			echo '<script>alert("删除成功");window.location.href="/admin/handle/messagelist/type/'.$type.'";</script>';
		}else{
			echo '<script>alert("删除失败");window.location.href="/admin/handle/messagelist/type/'.$type.'";</script>';
		} 
	}	

}
?>