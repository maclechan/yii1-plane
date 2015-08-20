<?php
/*
**@version 2015-1-29
**@author  chan 429140141
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
		$this->layout = 'application.modules.manage.views.layouts.main';
	}	
	/**
	 * 	后台首页
	 */	
	public function actionIndex(){
 		if(Yii::app()->user->isGuest){
			$this->redirect('/manage/handle/sign');				
		}else{ 	
			$this->render('index');
		}
	}
	/**
	***登录
	*/
	public function actionSign(){
		$this->layout = false;		

		$model=new LoginForms;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForms']))
		{
			$model->attributes=$_POST['LoginForms'];
			if($this->createAction('captcha')->getVerifyCode()!=$_POST['verifyCode']){
				echo "<script>alert('验证码错误');window.location.href='/manage';</script>";
				exit;
			}			
			if($model->validate() && $model->login()){
				$this->redirect('/manage');
			}else{
				echo '<script>alert("用户名或密码错误");window.location.href="/manage";</script>';
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
		$this->redirect('/manage/handle/sign');	
	}	
	/**
	***左边菜单栏
	*/	
	public function actionLeft(){
		$this->layout = false;
		if(isset($_GET['id']) && $_GET['id']){
			$id = $_GET['id'];
			$this->render("left",array("id"=>$id));
		}
	}
	/**
	***后台默认页
	*/	
	public function actionDefault(){
		$this->layout = false;
		$uid = Yii::app()->user->getId();
		$adviser = new Adviser();		
		$user = $adviser->find("id=$uid");
		//系统公告
		$notice = Notice::model()->findAll(array(
			'condition'=>'type=3',
			'select'=>'id,title,content',
			'order'=>'time desc',
			'limit'=>6,
		));
		$this->render('default',array(
			'user'=>$user,
			'notice'=>$notice
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
				$adviser = new Adviser();			
				$model=$adviser->findByAttributes(array('password'=>md5($_POST['old_pass']),'id'=>Yii::app()->user->getId()));
				if($model)
				{
					$return = $adviser->updateByPk($model->id,array(
						"password"=>md5($_POST['new_pass']),					
					));
					
					if($return > 0){
						Yii::app()->user->logout();
						echo "<script>alert('修改成功');top.location='/manage/handle/sign';</script>";						
					}else{
						echo "<script>alert('修改失败');window.location.href='/manage/handle/uppwd';</script>";
					}					
				}else{
					echo "<script>alert('原密码不正确');window.location.href='/manage/handle/uppwd';</script>";
				}
			}else{
				echo "<script>alert('两次输入新密码不同');window.location.href='/manage/handle/uppwd';</script>";
			}
		}else{		
			$this->render('uppwd');
		}
	}
	/**
	***公告的详细信息
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
			echo "error: not defined id";
		}
	}	

	//顾问基本信息完善
	public function actionUpguwen(){
		$this->layout = false;
		
	}
	
}