<?php
/*
**@version 2015-1-14
**@author  yuzixiu
*/
class EmployeeController extends Controller
{
	//初始化函数
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
	/*
	 * 	把员工添加、员工编辑两个功能整合在一个方法里
	 * 	判断有员工id值传过来，表示编辑员工信息，否则是添加新员工信息
	 * */
	public function actionEmployeeAdd() {
		$user_id = yii::app()->user->getId();
		$user_info = AdminUser::model()->find("user_id=$user_id");
		$emp_model = new AdminUser();
		//用于展示分组信息
		$role_model = AdminUserRole::model()->findAll();
		//判断：带id过来表示是编辑数据，没带id是要新增一条数数据
		if(isset($_GET['user_id']) && $_GET['user_id']){
			//编辑员工信息
			$emp_model=$emp_model->findByPk($_GET['user_id']);
			if(!$emp_model){
				echo "<script>alert('暂无该记录');window.history.go(-1);</script>";
			}
			//判断分组的值不能为空，然后数据入库
			if(isset($_POST['AdminUser']) && $_POST['AdminUser']){
				//分组的值不能为空
				if($_POST['role_id']){
					//接收表单提交过来的值
					if($_POST['AdminUser']['password']==''){
						echo "<script>alert('密码不能为空！');window.history.go(-1)</script>";
						exit();
					}else if($_POST['AdminUser']['password']!==$emp_model->password){
						//判断有没有更新密码，有更新则加密，没更新则不加密
						$_POST['AdminUser']['password'] = md5(trim($_POST['AdminUser']['password']));
					}else {
						$_POST['AdminUser']['password'] = trim($_POST['AdminUser']['password']);
					}
					$_POST['AdminUser']['role_id'] = $_POST['role_id'];
					$m = $emp_model -> attributes = $_POST['AdminUser'];
					$return = $emp_model -> updateByPk($_GET['user_id'],$m);
					if($return > 0){
						echo "<script>alert('编辑成功');window.location.href='".$this->createUrl('employeelist')."'</script>";
					}else{
						echo "<script>alert('编辑失败');</script>";
					}
				}else{
					echo "<script>alert('必须给员工分组');</script>";
				}
			}
				$this->render('employee_add',array(
							'emp_model' => $emp_model,
							'user_info' => $user_info,
							'role_model' => $role_model
					));	
			
		}else{
			//添加新员工信息
			//接收添加用户表单
			if(isset($_POST['AdminUser']) && $_POST['AdminUser']){
				//处理权限表提交过来的id
				$_POST['AdminUser']['role_id'] = $_POST['role_id'];
				//处理表单没有提交过来的值，但要入库的默认值
				if($_POST['AdminUser']['password']==''){
					echo "<script>alert('密码不能为空！');window.history.go(-1)</script>";
					exit();
				}else{
					$_POST['AdminUser']['password'] = md5(trim($_POST['AdminUser']['password']));
				}				
				$_POST['AdminUser']['add_time'] = time();
				$_POST['AdminUser']['data_auth'] = 'none';
				//接收表单提交过来的值
				$m = $emp_model -> attributes = $_POST['AdminUser'];
				//判断分组的值不能为空，然后数据入库
				if($_POST['role_id']!='0'){
					if($emp_model->save()){
						//	$this->redirect("/admin/member/employee/impower/iscg/1/user_id/".$emp_model->user_id);
						echo "<script>alert('添加成功！');window.location.href='".$this->createUrl('employeelist')."'</script>";
					}else{
						echo "<script>alert('添加失败！');</script>";
					}				
				}else{
					echo "<script>alert('请给员工分组！');</script>";
				}
			}
				$this->render('employee_add',array('emp_model' => $emp_model, 'role_model' => $role_model, 'user_info'=>$user_info));
			
		}
	}
	
	/*
	 * 员工搜索，当数目达到一定条件有自动分页功能
	* @by Chan
	* */
	public function actionEmpSearch(){
		$user_id = yii::app()->user->getId();
		$user_info = AdminUser::model()->find("user_id=$user_id");	
	//	$type = Yii::app()->user->getState("type");
		$emp_name = isset($_POST['emp_name']) ? $_POST['emp_name'] : '';
		$emp_model = new AdminUser();
		$emp_model->unsetAttributes();
		if(!$emp_name){
			$this -> redirect($this -> createUrl("EmployeeList"));
		}else{
			$emp_model -> user_name = $emp_name;
		//	$emp_model -> type = $type;
			$this -> render('employee_list',array(
					'emp_model'=>$emp_model->search()->getData(),
					'itemCount'=>$emp_model->search()->getTotalItemCount(),
					'pages'=>$emp_model->search()->getPagination(),
					"key"=>$emp_name,
					'user_info'=>$user_info
			));
		}
	}
	
	/*
	 *	员工列表（展示所有员工，实现分页）
	 *	by Chan
	 **/
	public function actionEmployeeList() {
		$user_id = yii::app()->user->getId();
		$user_info = AdminUser::model()->find("user_id=$user_id");
		
		$emp_model = new CActiveDataProvider('AdminUser',array(
				'criteria'=>array(
						'with'=>array('role'),//联表AdminUserRole
						'condition'=>"t.user_id!=$user_id and t.role_id>".$user_info->role_id,
				),
				'pagination'=>array(
						'pageSize'=>20,
				),
		
		));
		$this->render('employee_list',array(
				'emp_model'=>$emp_model->getData(),
				'pages'=>$emp_model->getPagination(),
				'user_info'=>$user_info
		));	
	}
	
	/**
	 * 	员工删除，ajax实现不刷新页面
	 */
	public function actionAjaxEmpDel(){
		if($_POST['user_id']){
			$user_id = $_POST['user_id'];
			AdminUser::model()->deleteByPk($user_id);
			echo 1;
		}
	}
	
	
}
?>