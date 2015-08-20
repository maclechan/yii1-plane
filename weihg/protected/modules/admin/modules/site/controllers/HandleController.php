<?php
/*
**@version 2013-11-21
**@author  yuzixiu
**@update  yangruiqin
*/
class HandleController extends Controller
{
	/*
	 * 初始化函数
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
/* 				return array(
					array('deny',  // allow all users to access 'index' and 'view' actions.
						'users'=>array('*'),
					)
				);	 */		
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
	public function actionIndex()
	{
		$this->render('index');
	}
/**
* 站内信信息发送
*/
	public function actionMessageadd(){
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
							echo '<script>alert("发送成功");window.location.href="/admin/site/handle/messagelist";</script>';
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
							echo '<script>alert("发送成功");window.location.href="/admin/site/handle/messagelist";</script>';
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
*显示后台所有私信
*/
	public function actionMessageshow(){
		$model = new CActiveDataProvider('Message',array(
				'criteria'=>array(
						'order'=>'t.send_time desc',
						'with'=>array('ms','mr'),
				),
				'pagination'=>array(
						'pageSize'=>15,
				),
		));
		$this->render('messageshow',array(
				'message'=>$model->getData(),
				'pages'=>$model->getPagination(),
		));		
			/*$keyword=$_POST[keyword];
			$M=Message::model()->findAllBySql('select * from message where title like "%$keyword%"');
			var_dump($M);
			echo "<hr />";
			*/
	}
/**
 * 显示搜索后所有后台私信
 */	
	public function actionMessageadminsearch(){
		//得到关键字
		$keyword=$_GET['keyword'];
		if(empty($keyword)){
			$this->redirect($this->createUrl("messageshow"));
		}else{
			$r_id=Yii::app()->user->getId();
			$model = new CActiveDataProvider('Message',array(
					'criteria'=>array(
							//	'condition'=>'status=0'
							'order'=>'send_time desc',
							'with'=>array('ms','mr'),
							'condition'=>"title like '%{$keyword}%'",
							),
							'pagination'=>array(
									'pageSize'=>15,
							),
							));
			$this->render('messageshow',array(
					'message'=>$model->getData(),
					'pages'=>$model->getPagination(),
					'keyword'=>$keyword,
			));
		}
	}	
/**
 * 后台私信彻底删除
 */	
	public function actionMessageadmindel(){
		$id=isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : '';
		if($id){
			$count=Message::model()->deleteByPk($id);
		}
		if($count){
			echo '<script>alert("删除成功");window.location.href="/admin/site/handle/messageshow";</script>';
		}else{
			echo '<script>alert("删除失败");window.location.href="/admin/site/handle/messageshow";</script>';
		}
	}		
/**
* 显示用户私信  (收件箱)
*/
	public function actionMessagelist(){
			//$user_id=$message->sender_id;
			//$arr=AdminUser::model()->find("user_id='$user_id'");
			//得到后台用户的id
			$r_id = Yii::app()->user->getId();
			$model = new CActiveDataProvider('Message',array(
				'criteria'=>array(
						'with'=>array('ms','mr'),
						'order'=>'t.send_time desc',
						'condition'=>"t.recever_id=$r_id and t.receve_status='0'",
				),
				'pagination'=>array(
						'pageSize'=>15,
				),
			));
			$this->render('messagelist',array(
				'message'=>$model->getData(),
				'pages'=>$model->getPagination(),
			));
	}
/**
* 显示用户搜索后的私信
*/
	public function actionMessagesearch(){
		//得到关键字
		$keyword=$_GET['keyword'];
		if(empty($keyword)){
			$this->redirect($this->createUrl("messagelist"));
		}else{
			$r_id=Yii::app()->user->getId();
			$model = new CActiveDataProvider('Message',array(
					'criteria'=>array(
							//	'condition'=>'status=0'
							'order'=>'send_time desc',
							'with'=>array('ms','mr'),
							'condition'=>"title like '%{$keyword}%' and t.receve_status='0' and t.recever_id=$r_id",
							),
							'pagination'=>array(
									'pageSize'=>15,
							),
							));
			$this->render('messagelist',array(
					'message'=>$model->getData(),
					'pages'=>$model->getPagination(),
					'keyword'=>$keyword,
			));
		} 	
	}
/**
* 显示用户发送的私信  (发件箱)
*/	
	public function actionMessagesendlist(){
		//$user_id=$message->sender_id;
		//$arr=AdminUser::model()->find("user_id='$user_id'");
		//得到后台用户的id
		$r_id = Yii::app()->user->getId();
		$model = new CActiveDataProvider('Message',array(
				'criteria'=>array(
						'with'=>array('ms','mr'),
						'order'=>'t.send_time desc',
						'condition'=>"t.sender_id=$r_id and t.send_status='0'",
				),
				'pagination'=>array(
						'pageSize'=>15,
				),
		));
		$this->render('messagesendlist',array(
				'message'=>$model->getData(),
				'pages'=>$model->getPagination(),
		));
	}
/**
* 显示用户发送后搜索后的私信(发件箱)
*/
	public function actionMessagesendsearch(){
		//得到关键字
		$keyword=$_GET['keyword'];
		if(empty($keyword)){
			$this->redirect($this->createUrl("messagesendlist"));
		}else{
			$r_id=Yii::app()->user->getId();
			$model = new CActiveDataProvider('Message',array(
					'criteria'=>array(
							//	'condition'=>'status=0'
							'order'=>'send_time desc',
							'with'=>array('ms','mr'),
							'condition'=>"title like '%{$keyword}%' and t.send_status='0' and t.sender_id=$r_id",
							),
							'pagination'=>array(
									'pageSize'=>15,
							),
							));
			$this->render('messagesendlist',array(
					'message'=>$model->getData(),
					'pages'=>$model->getPagination(),
					'keyword'=>$keyword,
			));
		}
	}	
/**
* 私信详细页
*/
	public function actionMessagedetail(){
		//接受后台用户id
		$id=$_GET['id'];
		$message=Message::model()->updateByPk($id,array('read_status'=>'1'));
		$message=Message::model()->with('ms')->findByPk("$id");
		$this->render('messagedetail',array(                 
				'message'=>$message,
				));
	}	
/**
* 私信详细页(发件箱)
*/
	public function actionMessagesenddetail(){
		//接受后台用户id
		$id=$_GET['id'];
		//$message=Message::model()->updateByPk($id,array('read_status'=>'1'));
		$message=Message::model()->with('ms')->findByPk("$id");
		$this->render('messagesenddetail',array(
				'message'=>$message,
		));
	}	
	
/**
* 站内信的删除既status状态的修改（收件箱）
*/
	public function actionMessagedel(){
		$id=isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : '';
		if($id){
			$count=Message::model()->updateByPk($id,array('receve_status'=>'1'));
		}
		if($count){
			echo '<script>alert("删除成功");window.location.href="/admin/site/handle/messagelist";</script>';
		}else{
			echo '<script>alert("删除失败");window.location.href="/admin/site/handle/messagelist";</script>';
		} 
	}
/**
* 站内信的删除既status状态的修改（发件箱）
*/
	public function actionMessagesenddel(){
		$id=isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : '';
		if($id){
			$count=Message::model()->updateByPk($id,array('send_status'=>'1'));
		}
		if($count){
			echo '<script>alert("删除成功");window.location.href="/admin/site/handle/messagesendlist";</script>';
		}else{
			echo '<script>alert("删除失败");window.location.href="/admin/site/handle/messagesendlist";</script>';
		}
	}	
	
//************************公告部分 **************************
/**
*公告的添加
*/
	public function actionNoticeadd(){
		//得到post传过来的值
		$type=isset($_POST['type']) && $_POST['type'] ? $_POST['type'] : '';
		$title=isset($_POST['title']) && $_POST['title'] ? $_POST['title'] : '';
		$content=isset($_POST['content']) && $_POST['content'] ? $_POST['content'] : '';
		$sender_id=Yii::app()->user->getId();
		if(!empty($title)){
			if(!empty($content)){
				//实例化对象向数据库里写入数据
				$notice=new Notice();
				$notice->type=$type;
				$notice->title=$title;
				$notice->content=$content;
				$notice->sender=$sender_id;
				$notice->time=time();
				if($notice->save()>0){
					echo '<script>alert("公告发布成功");window.location.href="/admin/site/handle/noticelist";</script>';
				}else{
					echo '<script>alert("公告发布失败");window.location.href="'.$_SERVER['HTTP_REFERER'].'";</script>';
				}
			}else{
				echo '<script>alert("公告内容不能为空");window.location.href="/admin/site/handle/noticeadd";</script>';
			}  
		}else{
			$this->render('noticeadd');
		} 	
	}
/**
* 公告列表显示
*/
	public function actionNoticelist(){
		$sender_id=Yii::app()->user->getId();
		$model = new CActiveDataProvider('Notice',array(
				'criteria'=>array(
						//	'condition'=>'status=0'
						'order'=>'time desc',
						'with'=>array('na'),
						//'condition'=>'receve_status=0',
						//'condition'=>"recever_id={$r_id}",
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
*公告的删除 
*/
	public function actionNoticedel(){
		$id=$_GET['id'];
		if($id){
			$count=Notice::model()->deleteByPk($id);
		}
		if($count>0){
			echo '<script>alert("删除成功");window.location.href="/admin/site/handle/noticelist";</script>';
		}else{
			echo '<script>alert("删除失败");window.location.href="'.$_SERVER['HTTP_REFERER'].'";</script>';
		}
	}
/**
*公告的详细信息
*/
	public function actionNoticedetail(){
		$id=$_GET['id'];//接受后台用户id
		$notice=Notice::model()->with('na')->findByPk("$id");
		$this->render('noticedetail',array(
				'notice'=>$notice,
		));
	}
/**
* 公告标题搜索
*/
	public function actionNoticesearch(){
		$keyword=$_GET['keyword'];//得到关键字
		if(empty($keyword)){
			$this->redirect($this->createUrl("noticelist"));
		}else{
			//$r_id=Yii::app()->user->getId();
			$model = new CActiveDataProvider('Notice',array(
					'criteria'=>array(
							//	'condition'=>'status=0'
							'order'=>'time desc',
							'with'=>array('na'),
							'condition'=>"title like '%{$keyword}%'",
							),
							'pagination'=>array(
									'pageSize'=>15,
							),
							));
			$this->render('noticelist',array(
					'notice'=>$model->getData(),
					'pages'=>$model->getPagination(),
					'keyword'=>$keyword,
			));
		}
	}
/**
*公告内容修改
*/
	public function actionNoticeupdate(){//根据id得到公告的信息传给模版
		$id=$_GET['id'];//得到id 
		$notice=Notice::model()->find("id=$id");
		$this->render('noticeupdate',array(
					'notice'=>$notice,
				));
	}
	public function actionNoticeaddupdate(){//修改要修改的公告信息
		$notice_id=$_POST['notice_id'];//得到公告的id
		$type=isset($_POST['type']) && $_POST['type'] ? $_POST['type'] : '';
		$title=isset($_POST['title']) && $_POST['title'] ? $_POST['title'] : '';
		$content=isset($_POST['content']) && $_POST['content'] ? $_POST['content'] : '';
		if(!empty($title)){
			$count=Notice::model()->updateByPk($notice_id,array(
					'type'=>"$type",
					'title'=>"$title",
					'content'=>"$content",
					));
			if($count){
				echo '<script>alert("修改成功");window.location.href="/admin/site/handle/noticelist";</script>';
			}else{
				echo '<script>alert("修改失败");window.location.href="/admin/site/handle/noticelist";</script>';
			} 
		}
		
	
	}
	
}