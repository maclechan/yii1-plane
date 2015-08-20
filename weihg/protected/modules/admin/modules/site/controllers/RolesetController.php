<?php
/*
**@version 2013-11-21
**@author  yuzixiu
*/
class RolesetController extends Controller
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
	/**
	 * 	二级导航设置
	 */	
	public function actionIndex()
	{
		$model = new CActiveDataProvider('Nav',array(
				'criteria'=>array(
					'with'=>array('md'),
					'condition'=>'t.status=1'
				),
				'pagination'=>array(
					'pageSize'=>20,
				),
		));
		$this->render('index',array(
			'model'=>$model->getData(),
			'pages'=>$model->getPagination(),
		));
	}
	/**
	 * 	二级导航添加
	 */	
	public function actionNavadd(){		
		$model = Menu::model()->findAll("status=1 order by sort asc");
		if(isset($_GET['id']) && $_GET['id']){
			//更新
			$nav = Nav::model()->with('md')->findByPk($_GET['id']);
			$this->render('navadd',array(
				'model'=>$model,
				'nav'=>$nav
			));			
		}else{			
			//新增加
			$this->render('navadd',array(
				"model"=>$model,
			));
		}
	}
	/**
	 * 	二级导航保存
	 */		
	public function actionAjaxNavSave(){
		if($_POST['nid']){
			$nav = Nav::model()->findByPk($_POST['nid']);
		}else{
			$nav = new Nav();
			$nav->status = 1;
		}
		$nav->m_id = $_POST['mid'];
		$nav->nav_cn = $_POST['name'];
		$nav->sort = $_POST['sort'];
		if($nav->save()){
			unset($nav->id);
			echo 1; //保存成功
		}else{
			echo 2;
		}
	}
	/**
	 * 	二级导航删除
	 */		
	public function actionAjaxNavDel(){
		if($_POST['id']){
			Nav::model()->updateByPk($_POST['id'],array('status'=>0));
			echo 1;
		}
	}	
	/**
	 * 	三级导航设置
	 */	
	public function actionAclist(){
		$menu = Menu::model()->findAll('status=1 order by sort asc');
		$model = new CActiveDataProvider('Action',array(
				'criteria'=>array(
					'with'=>array('nav','md'),
					'condition'=>'t.status=1'
				),
				'pagination'=>array(
					'pageSize'=>20,
				),
		));
		$this->render('aclist',array(
			'model'=>$model->getData(),
			'pages'=>$model->getPagination(),
			'menu'=>$menu,
		));	
	}
	/**
	 * 	三级导航搜索
	 */		
	public function actionAcSearch(){
		$menu = Menu::model()->findAll('status=1 order by sort asc');
		$model = new Action();
		$model->unsetAttributes();
		$mid = $_POST['menu_id']>0?$_POST['menu_id']:'';
		if(!$mid){
			$this->redirect($this->createUrl("aclist"));
		}else{
			$model->m_id = $mid;		
			$this->render('aclist',array(
				'model'=>$model->search()->getData(),
				'itemCount'=>$model->search()->getTotalItemCount(),
				'pages'=>$model->search()->getPagination(),
				'menu'=>$menu,
			));
		}
	}	
	/**
	 * 	三级导航添加
	 */		
	public function actionAcadd(){
		$menu = Menu::model()->findAll("status=1 order by sort asc");
		if(isset($_GET['id']) && $_GET['id']){
			$ac = Action::model()->with('nav','md')->findByPk($_GET['id']);
			if($ac){
				$nav = Nav::model()->findAll('m_id='.$ac->md->id.' and status=1');
			}
			$this->render('acadd',array(
				'menu'=>$menu,
				'ac'=>$ac,
				'nav'=>$nav
			));
		}else{
			$nav = Nav::model()->findAll("status=1 and m_id=1");
			$this->render('acadd',array(
				'menu'=>$menu,
				'nav'=>$nav
			));
		}
	}
	/**
	 * 	ajax下拉二级菜单
	 */	
	public function actionAjaxNav(){
		if($_POST['mid']){
			$nav = Nav::model()->findAll('m_id='.$_POST['mid'].' and status=1');
			echo CJSON::encode($nav);
		}
	}
	/**
	 * 	三级导航保存
	 */		
	public function actionAjaxAcSave(){
		if($_POST['acid']){
			$ac = Action::model()->findByPk($_POST['acid']);
		}else{
			$ac = new Action();
			$ac->status = 1;
		}
		$ac->m_id = $_POST['mid'];
		$ac->nav_id = $_POST['navid'];
		$ac->action_cn = $_POST['accn'];
		$ac->action_en = $_POST['acen'];
		$ac->default_ctl = $_POST['ctl'];
		$ac->action_belonging = str_replace(' ','',$_POST['acbeling']);
		$ac->sort = $_POST['sort'];
		if($ac->save()){
			unset($ac->id);
			echo 1;
		}else{
			echo 2;
		}
	}	
	/**
	 * 	三级导航删除
	 */		
	public function actionAjaxAcDel(){
		if($_POST['id']){
			Action::model()->updateByPk($_POST['id'],array('status'=>0));
			echo 1;
		}
	}
	/**
	 * 	角色管理
	 */		
	public function actionRole(){
		$model = AdminUserRole::model()->findAll();
		$this->render('role',array(
			'model'=>$model
		));		
	}
	/**
	 * 	角色添加
	 */		
	public function actionRoleAdd(){
		if(isset($_GET['id']) && $_GET['id']){
			//更新
			$role = AdminUserRole::model()->findByPk($_GET['id']);
			$this->render('roleadd',array(
				'role'=>$role
			));			
		}else{			
			//新增加
			$this->render('roleadd');
		}
	}	
	/**
	 * 	角色保存
	 */		
	public function actionRoleSave(){
		if($_POST['name']!=''){
			$where = isset($_POST['id']) ? ' and role_id!='.$_POST['id'] : ''; //修改时可用
			$model = AdminUserRole::model()->find("role_name='".$_POST['name']."'$where");
			if($model){
				echo 3; //角色名已存在
			}else{
				if(isset($_POST['id']) && $_POST['id']){
					$role = AdminUserRole::model()->findByPk($_POST['id']);
				}else{
					$role = new AdminUserRole();
				}
				$role->role_name = $_POST['name'];
				$role->intro = $_POST['intro'];
				$role->add_time = time();
				$role->add_id = Yii::app()->user->getId();
				$role->add_man = Yii::app()->user->name;
				$role->status = $_POST['status'];
				if($role->save()){
					unset($role->role_id);
					echo 1; //成功
				}else{
					echo 2;
				}
			}
		}	
	}	
	/**
	 * 	角色编辑
	 */		
	public function actionRoleEdit(){
		if(isset($_GET['id']) && $_GET['id']){
			$model = AdminUserRole::model()->findByPk($_GET['id']);
			$this->render('roleedit',array(
				'model'=>$model
			));
		}	
	}	
	/**
	 * 	角色删除
	 */		
	public function actionRoleDel(){
		if(isset($_POST['id']) && $_POST['id']){
			$model = AdminUserRole::model()->findByPk($_POST['id']);
			if($model->delete()){
				echo 1;
			}else{
				echo 2;
			}
		}
	}	
	/**
	 * 	角色内人员
	 */		
	public function actionRoleList(){
		if($_GET['id']!=''){
			$role = AdminUserRole::model()->findByPk($_GET['id']);
			//该角色下人员
			$model = AdminUser::model()->with('role')->findAll("t.role_id=".$_GET['id']);

			$this->render('rolelist',array(
				'role'=>$role,
				'model'=>$model,
			));
		}		
	}	
	/**
	 * 	角色内人员删除
	 */		
	public function actionUserDel(){
		if(isset($_POST['role']) && $_POST['role']){
			$userid = substr($_POST['role'],0,-1);
			$model = AdminUser::model()->deleteAll("user_id in($userid)");
			if($model > 0){
				echo 1;
			}else{
				echo 2;
			}
		}	
	}
	/**
	 * 	角色内人员删除全部
	 */		
	public function actionUserDelall(){
		if(isset($_POST['rid']) && $_POST['rid']){
			$role_id = $_POST['rid'];
			$model = AdminUser::model()->deleteAll("role_id=$role_id");
			if($model > 0){
				echo 1;
			}else{
				echo 2;
			}			
		}
	}
	/**
	 * 	角色授权
	 */		
	public function actionRoleAuth(){
		$model = AdminUserRole::model()->findAll();
		$this->render('auth',array(
			'model'=>$model
		));		
	}
	/**
	 * 	角色授权管理
	 */		
	public function actionAuthadd(){
		if(isset($_GET['id']) && $_GET['id']){
			$role = AdminUserRole::model()->findByPk($_GET['id']);
			$model = Menu::model()->with('nav','nav.ac')->findAll('t.status=1');
			$this->render('authadd',array(
				'model'=>$model,
				'role'=>$role,
			));
		}		
	}	
	/**
	 * 	角色授权保存
	 */		
	public function actionAuthSave(){
		if(isset($_POST['id']) && $_POST['id']){
			$role = AdminUserRole::model()->updateByPk($_POST['id'],array(
				'role_menu'=>$_POST['menu'],
				'role_nav'=>$_POST['nav'],
				'role_action'=>$_POST['ac'],
			));	
			if($role > 0){
				echo 1; //保存成功
			}else{
				echo 2;
			}
		}else{
			echo 3;
		}
	}
	
}