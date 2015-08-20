<?php
/*
 * 用户管理
 * by chan
 * */
class MemberController extends Controller{
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
	/*
	 * 		网友搜索  
	 * 		by Chan 2013/11/28
	 * */
	public function actionMemSearch(){
		//-----数据权限匹配
		$uid = Yii::app()->user->getId();
		$info = AdminUser::model()->find("user_id=$uid");
		
		//---自动分表
		$tab_obj = new Submeter('memberallot');
		$mem_model = $tab_obj->fenbiao();
		$mem_name = isset($_GET['mem_name'])?$_GET['mem_name']:'';
		$cid=$_GET["cid"];
		$mem_model->unsetAttributes();
		if(!$mem_name && !$cid){
			$this->redirect($this->createUrl("donemem"));
		}else{
			$category = CustomerCategory::model()->findAll(); //分类列表
			$mem_model->name=$mem_name;
			$mem_model->catid = $info->data_auth;
			$mem_model->status=2;
			$mem_model->category_id=$cid;
			$this->render('donemem',array(
					'category'=>$category,
					'mem_model'=>$mem_model->search()->getData(),
					'itemCount'=>$mem_model->search()->getTotalItemCount(),
					'pages'=>$mem_model->search()->getPagination(),
					"key"=>$mem_name
			));
		}
	}
	/*
	 * 		待分配网友搜索
	* 		by Chan 2014/1/14
	* */
	public function actionUnMemSearch(){
		//-----数据权限匹配
		$uid = Yii::app()->user->getId();
		$info = AdminUser::model()->find("user_id=$uid");
		
		//---自动分表
		$tab_obj = new Submeter('memberallot');
		$mem_model = $tab_obj->fenbiao();
		$mem_name = isset($_GET['unnetfriend'])?$_GET['unnetfriend']:'';
		$cid=isset($_GET["cid"])?$_GET["cid"]:'';
		$mem_model->unsetAttributes();
		if(!$mem_name && !$cid){
			$this->redirect($this->createUrl("undonemem"));
		}else{
			$category = CustomerCategory::model()->findAll(); //分类列表
			$mem_model->name=$mem_name;
			$mem_model->category_id=$cid;
			$mem_model->catid = $info->data_auth;
			$mem_model->status=0;
			$mem_model->mstatus = 1; //1为真实网友
			if($cid){
				$mem_model->category_id = $cid;
			}
			$this->render('undone_mem',array(
					'category'=>$category,
					'mem_model'=>$mem_model->search()->getData(),
					'itemCount'=>$mem_model->search()->getTotalItemCount(),
					'pages'=>$mem_model->search()->getPagination(),
					"key"=>$mem_name,
			));
		}
	}
	/*
	 * 		待审核网友搜索
	* 		by Chan 2014/1/14
	* */
	public function actionCheckMemSearch(){
		//-----数据权限匹配
		$uid = Yii::app()->user->getId();
		$info = AdminUser::model()->find("user_id=$uid");
	
		//---自动分表
		$tab_obj = new Submeter('memberallot');
		$mem_model = $tab_obj->fenbiao();
		$mem_name = isset($_GET['unnetfriend'])?$_GET['unnetfriend']:'';
		$cid=$_GET["cid"];
		$mem_model->unsetAttributes();
		if(!$mem_name && !$cid){
			$this->redirect($this->createUrl("checkmem"));
		}else{
			$category = CustomerCategory::model()->findAll(); //分类列表
			$mem_model->name=$mem_name;
			$mem_model->category_id=$cid;
			$mem_model->catid = $info->data_auth;
			$mem_model->status=1;
			if($cid){
				$mem_model->category_id = $cid;
			}
			$this->render('check_mem',array(
					'category'=>$category,
					'mem_model'=>$mem_model->search()->getData(),
					'itemCount'=>$mem_model->search()->getTotalItemCount(),
					'pages'=>$mem_model->search()->getPagination(),
					"key"=>$mem_name,
			));
		}
	}
	/*
	 * ajax单个修改备注信息（己审核己分配网友列表）
	 * */
	public function actionAjaxNotes(){
			if($_POST['id'] && $_POST['notes']){
				$model = MemberAllot::model()->updateByPk($_POST['id'],array(
					'notes' => trim($_POST['notes']),
				));
				if($model>0){
					echo 1;//更新成功
				}else{
					echo 2;//更新失败
				}
			}		
	}
	/* 
	 * 己审核己分配的网友列表
	 * @by Chan
	 */
	public function actionDoneMem() {
		//---自动分表
		$model = new Submeter('memberallot');
		$memberal = $model->fenbiao();
		$category = CustomerCategory::model()->findAll(); //分类列表
		$userId = Yii::app()->user->getId();
		$userinfo = AdminUser::model()->find("user_id=$userId");
		if($userinfo->role_id == 1){
			//---
			$where = '';
		}else{
			$dataauth = substr($userinfo->data_auth,0,-1);
			$where = " and t.category_id in($dataauth)";
		}
		$mem_model = new CActiveDataProvider($memberal,array(
				'criteria'=>array(
						'with'=>array('mem','bu'),//联表customer
						'condition'=>'t.status=2'.$where,
						'order'=>'t.id DESC',
				),
				'pagination'=>array(
						'pageSize'=>10,
				),
	
		));
		$this->render('donemem',array(
				'category'=>$category,
				'mem_model'=>$mem_model->getData(),
				'pages'=>$mem_model->getPagination(),
		));
	}
	/*
	 * 待分配网友（待分配网友展示列表）
	* @by Chan
	*/
	public function actionUndoneMem() {
		//---自动分表
		$model = new Submeter('memberallot');
		$memberal = $model->fenbiao();
		$category = CustomerCategory::model()->findAll(); //分类列表
		$userId = Yii::app()->user->getId();
		$userinfo = AdminUser::model()->find("user_id=$userId");
		if($userinfo->role_id == 1){
			//---
			$where = '';
		}else{
			$dataauth = substr($userinfo->data_auth,0,-1);
			$where = " and t.category_id in($dataauth)";
		}
		$mem_model = new CActiveDataProvider($memberal,array(
				'criteria'=>array(
						'with'=>array('mem'),//联表customer
						'condition'=>"t.status=0 and mem.status=1".$where,
						'order' => 't.id desc'
				),
				'pagination'=>array(
						'pageSize'=>15,
				),
		
		));
		$this->render('undone_mem',array(
				'mem_model'=>$mem_model->getData(),
				'category'=>$category,
				'pages'=>$mem_model->getPagination(),
		));
	}
	/*
	 * 给某一个具体的网友分配一个商家的提交页面，最后实现通过如下AjaxAllot方法（ajax实现）
	 * @$id  当前网友id(注：是member_allot表的id)
	 * @$category_id（商家类别id去匹配商家表中对应所有商家）
	 * by Chan
	 * */
	public function actionAllot($id,$category_id){
		//---自动分表
		$model = new Submeter('memberallot');
		$memberal = $model->fenbiao();
		$mem_model=$memberal->findByPk($id);
		
		$model1 = new Submeter('member');
		$memauto = $model1->fenbiao();
		$mem=$memauto->find('id='.$mem_model->m_id);
		
		$model2 = new Submeter('customer');
		$cusauto = $model2->fenbiao();
		$cus=$cusauto->with('contract')->findAll('cid='.$mem_model->category_id);

		$this->render('allot',array(
				'mem_model' => $mem_model,
				'cus' => $cus,
				'mem' => $mem,
		));
	}
	/**
	 * 	ajax下拉合同菜单
	 */	
	public function actionAjaxAllotht(){
		if(isset($_POST['mid']) && $_POST['mid']){
			$id = intval($_POST['mid']);
			$time = time();
			//---自动分表
			$tab_obj = new Submeter('contract');
			$contract = $tab_obj->fenbiao();			
			$data_c = $contract->findAll("shops_id=$id and end_time>$time order by id desc");
			echo CJSON::encode($data_c);
		}else{
			echo 2;//数据丢失
		}
	}	
	/*
	 * 实现ajax对网友分配商家的提交，保存到数据库
	 * @by Chan
	 * */
	public function actionAjaxAllot(){
		if(isset($_POST['b_id']) && $_POST['b_id'] && isset($_POST['allotid']) && $_POST['allotid'] && isset($_POST['contid']) && $_POST['contid']){
			//---自动分表
			$model = new Submeter('memberallot');
			$memberal = $model->fenbiao();
				$model = $memberal->updateByPk($_POST['allotid'],array(
					'b_id' => $_POST['b_id'],
					'contract_id' => $_POST['contid'],
					'notes' => $_POST['notes'],
					'status' => 1
				));
				if($model>0){
					//---自动分表会员表
					$model = new Submeter('member');
					$member = $model->fenbiao();	
					$model = new Submeter('contract');
					$contract = $model->fenbiao();						
					if(isset($_POST['memberid']) && $_POST['memberid']){
						$member->updateByPk($_POST['memberid'],array("operate_id"=>Yii::app()->user->getId(),"operate_t"=>time())); //更新网友操作记录
						$contract->updateCounters(array("mem_count_c"=>1),'id='.$_POST['contid']); //更新合同分配客户数
					}
					echo 1;//更新成功
				}else{
					echo 2;//更新失败
				}				
		}else{
			echo 3;//数据丢失
		}
	}
	/*
	 * 己分配待审核网友（展示列表页）
	* @by Chan
	*/
	public function actionCheckMem() {
		//---自动分表
		$model = new Submeter('memberallot');
		$memberal = $model->fenbiao();
		$category = CustomerCategory::model()->findAll(); //分类列表
		$userId = Yii::app()->user->getId();
		$userinfo = AdminUser::model()->find("user_id=$userId");
		if($userinfo->role_id == 1){
			//---
			$where = '';
		}else{
			$dataauth = substr($userinfo->data_auth,0,-1);
			$where = " and t.category_id in($dataauth)";
		}
		$mem_model = new CActiveDataProvider($memberal,array(
				'criteria'=>array(
						'with'=>array('mem','bu'),//联表customer
						'condition'=>'t.status=1'.$where,
						'order'=>'t.id DESC',
				),
				'pagination'=>array(
						'pageSize'=>20,
				),
		
		));
		$this->render('check_mem',array(
				'category'=>$category,
				'mem_model'=>$mem_model->getData(),
				'pages'=>$mem_model->getPagination(),
		));
	}
	/*
	 * ajax批量审核
	 * by Chan
	 * */
	public function actionAjaxCheck(){
		if($_POST['allot_id']){
			//判断ajax请求的值是不是多个
                $check=explode('&',$_POST['allot_id'],-1);
				$model = MemberAllot::model()->updateByPk($check,array(
					'status' => 2
			));
			if($model>0){
				echo 1;//更新成功
			}else{
				echo 2;//更新失败
			}
		}
	}
	
	/*
	 * 审核网友
	 * */
	public function actionCheck($id,$category_id){
		$mem_model=MemberAllot::model()->findByPk($id);
		$mem=Member::model()->find('id='.$mem_model->m_id);
		$cus=Customer::model()->findAll('cid='.$mem_model->category_id);
		
		$this->render('check',array(
				'mem_model' => $mem_model,
				'cus' => $cus,
				'mem' => $mem,
		));
	}
	
	/**
	 * 网友手动录入
	 **/	
	public function actionMemberAdd(){
		//查询类别表
		$category = CustomerCategory::model()->findAll(); 
		$this->render('memberadd',array(
 					'category' => $category,
				));
	}	
	public function actionMemberAddsave(){
		//自动分表 网友表
		$model = new Submeter('member');
		$member_model = $model->fenbiao();
		$model2 = new Submeter('memberallot');
		
		$userId = Yii::app()->user->getId();
		$add_man = Yii::app()->user->getName();
		$type = Yii::app()->user->getState("type");
		if($type==1){
			$belong = '杭州';
		}elseif($type==2){
			$belong = '南京';
		}elseif($type==3){
			$belong = '上海';
		}
		if($_POST){
			$name = $_POST['name'];
			$mobile = $_POST['mobile'];
			$sex = $_POST['sex'];
			$qq = $_POST['qq'];
			$cid = $_POST['cid']; //需求
			$wed_t = strtotime($_POST['wed_t']);
			$address = $_POST['address'];
			$from = $_POST['from'];
		//	echo $cid;exit;
			if($name && $mobile && $cid && $wed_t){
				$member_model->setAttributes(array(
					"name"=>$name,
					"sex"=>$sex,
					"mobile"=>$mobile,
					"qq"=>$qq,
					"address"=>$address,
					"wed_t"=>$wed_t,
					"apply_t"=>time(),
					"entrance"=>$from."(后台录入)",
					"belong"=>isset($belong)?$belong:'杭州',
					"add_id"=>$userId,
				));
				if($member_model->save() > 0){
					$cid = substr($cid,0,-1);
					$cidarr = explode(',',$cid);
					$mid = $member_model->id;
					//------录入需求信息
					for($i=0;$i<count($cidarr);$i++){
						$cid_val = explode('+',$cidarr[$i]);
						$member_alt = $model2->fenbiao();
						$member_alt->setAttributes(array(
							"m_id"=>$mid,
							"category_name"=>$cid_val[1],
							"category_id"=>$cid_val[0],
							"allot_desc"=>$_POST['allot_desc'],
							"status"=>0
						));
						$return = $member_alt->save();						
					}
					if($return > 0){
						echo 1;
					}else{
						echo 2;
					}
				}else{
					echo 2;//添加失败
				}
			}else{
				echo 3; //必填项必填
			}
		}else{
			die("error:no post!");
		}	 
		
	}
	/**
	 * 我添加的网友
	 **/	
	public function actionMemberMylist(){
		$uid = Yii::app()->user->getId();
		//---自动分表
		$tab_obj = new Submeter('member');
		$member = $tab_obj->fenbiao();		
	//	$category = CustomerCategory::model()->findAll();
		$model = new CActiveDataProvider($member,array(
				'criteria'=>array(
					'with'=>array('alot','memb'),
					'condition'=>'t.add_id='.$uid
				),
				'pagination'=>array(
					'pageSize'=>20,
				),
		));
		$this->render('mylist',array(
			'mymodel'=>$model->getData(),
			'pages'=>$model->getPagination()
		));				
	}
	/**
	 * 我添加的网友编辑
	 **/	
	public function actionMemberMylupd(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = intval($_GET['id']);
			//---自动分表
			$tab_obj = new Submeter('member');
			$member = $tab_obj->fenbiao();
			$memupd = $member->with('alot')->findByPk($id);
			$category = CustomerCategory::model()->findAll(); 			
			$this->render('mylupd',array("memupd"=>$memupd,"category"=>$category));
		}else{
			die("no get id!");
		}
	}	
	public function actionMemberMylupdSave(){
		if($_POST){
			if($_POST['mid']){
				$id = intval($_POST['mid']);
				//---自动分表
				$tab_obj = new Submeter('member');
				$member = $tab_obj->fenbiao();	
				$model2 = new Submeter('memberallot');		
				$member_alt = $model2->fenbiao();				
				//---查看是否已被操作分配				
				$row = $member->with('alot')->findByPk($id);
				if($row->operate_id == ''){
					$name = $_POST['name'];
					$mobile = $_POST['mobile'];
					$sex = $_POST['sex'];
					$qq = $_POST['qq'];
					$cid = $_POST['cid']; //需求
					$wed_t = strtotime($_POST['wed_t']);
					$address = $_POST['address'];	
					$from = $_POST['from'];					
					$memupd = $member->updateByPk($id,array(
						"name"=>$name,
						"sex"=>$sex,
						"mobile"=>$mobile,
						"qq"=>$qq,
						"address"=>$address,
						"wed_t"=>$wed_t,
						"apply_t"=>time(),
						"entrance"=>$from."(后台录入)"
					));
					if($memupd > 0){
						$cid = substr($cid,0,-1);
						$cidarr = explode(',',$cid);
						$cidyarr = array();
						$i=1;
						foreach($row->alot as $alval){
							if($i == 1){
								$alodesc = $alval->allot_desc;
							}
							$cidyarr[] = $alval->category_id.'+'.$alval->category_name;
							$steed = $alval->category_id.'+'.$alval->category_name;
							if(!in_array($steed,$cidarr)){
								//----原数据有的提交的数据没有则删除
								$member_alt->deleteByPk($alval->id);								
							}
							$i++;
						}
						for($n=0;$n<count($cidarr);$n++){
							if(!in_array($cidarr[$n],$cidyarr)){
								//----原数据没有的提交的数据有则添加
								$member_alt2 = $model2->fenbiao();
								$cid_val = explode('+',$cidarr[$n]);
								$member_alt2->setAttributes(array(
									"m_id"=>$id,
									"category_name"=>$cid_val[1],
									"category_id"=>$cid_val[0],
									"status"=>0
								));		
								if($member_alt2->save() <= 0){
									echo 2; //修改需求失败
									exit;
								}
							}							
						}
						if(isset($alodesc) && $alodesc != $_POST['allot_desc']){
							$memupdr = $member_alt->updateAll(array(
								"allot_desc"=>$_POST['allot_desc']
							),"m_id=$id");	
							if($memupdr <= 0){
								echo 2; //修改需求失败
								exit;
							}							
						}
						echo 1;						
					}else{
						echo 2; //编辑失败
					}
				}else{
					echo 4; //--已分配或在分配
				}
			}else{
				echo 3;
			}
		}else{
			die("error:no post!");
		}
	}
	/**
	 * 	我添加的网友搜索
	 */		
	public function actionMemberMylSoso(){
			$uid = Yii::app()->user->getId();
			
			//---自动分表
			$tab_obj = new Submeter('member');
			$model = $tab_obj->fenbiao();				
			$model->unsetAttributes();
			$mname=$_GET["search"];		
			if(!$mname){
				$this->redirect($this->createUrl("membermylist"));
			}else{
				$model->add_id = $uid;
				$model->name = $mname;
				$this->render("mylist",array(
					"mymodel"=>$model->search()->getData(),
					"pages"=>$model->search()->getPagination(),
					"itemCount"=>$model->search()->getTotalItemCount(),
					"mname"=>$mname
				));
			}		
	}
	/**
	 * 待分配网友编辑
	 **/	
	public function actionUndonememUpd(){
		if(isset($_GET['id']) && $_GET['id']){
			$id = intval($_GET['id']);
			//---自动分表
			$tab_obj = new Submeter('member');
			$member = $tab_obj->fenbiao();
			$memupd = $member->with('alot')->findByPk($id);
			$category = CustomerCategory::model()->findAll(); 			
			$this->render('undoneupd',array("memupd"=>$memupd,"category"=>$category));
		}else{
			die("no get id!");
		}
	}	
	public function actionUndonememupdSave(){
		if($_POST){
			if($_POST['mid']){
				$id = intval($_POST['mid']);
				//---自动分表
				$tab_obj = new Submeter('member');
				$member = $tab_obj->fenbiao();	
				$model2 = new Submeter('memberallot');		
				$member_alt = $model2->fenbiao();				
				
				$row = $member->with('alot')->findByPk($id);

					$name = $_POST['name'];
					$mobile = $_POST['mobile'];
					$sex = $_POST['sex'];
					$qq = $_POST['qq'];
					$cid = $_POST['cid']; //需求
					$wed_t = strtotime($_POST['wed_t']);
					$address = $_POST['address'];					
					$memupd = $member->updateByPk($id,array(
						"name"=>$name,
						"sex"=>$sex,
						"mobile"=>$mobile,
						"qq"=>$qq,
						"address"=>$address,
						"wed_t"=>$wed_t,
						"operate_id"=>Yii::app()->user->getId(),
						"operate_t"=>time()						
					));
					if($memupd > 0){
						$cid = substr($cid,0,-1);
						$cidarr = explode(',',$cid);
						$cidyarr = array();
						$i=1;
						foreach($row->alot as $alval){
							if($i == 1){
								$alodesc = $alval->allot_desc;
							}
							$cidyarr[] = $alval->category_id.'+'.$alval->category_name;
							$steed = $alval->category_id.'+'.$alval->category_name;
							if(!in_array($steed,$cidarr)){
								//----原数据有的提交的数据没有则删除
								$member_alt->deleteByPk($alval->id);								
							}
							$i++;
						}
						for($n=0;$n<count($cidarr);$n++){
							if(!in_array($cidarr[$n],$cidyarr)){
								//----原数据没有的提交的数据有则添加
								$member_alt2 = $model2->fenbiao();
								$cid_val = explode('+',$cidarr[$n]);
								$member_alt2->setAttributes(array(
									"m_id"=>$id,
									"category_name"=>$cid_val[1],
									"category_id"=>$cid_val[0],
									"status"=>0
								));		
								if($member_alt2->save() <= 0){
									echo 2; //修改需求失败
									exit;
								}
							}							
						}
						if(isset($alodesc) && $alodesc != $_POST['allot_desc']){
							$memupdr = $member_alt->updateAll(array(
								"allot_desc"=>$_POST['allot_desc']
							),"m_id=$id");	
							if($memupdr <= 0){
								echo 2; //修改需求失败
								exit;
							}							
						}
						echo 1;						
					}else{
						echo 2; //编辑失败
					}
			}else{
				echo 3;
			}
		}else{
			die("error:no post!");
		}
	}
	/**
	 * 待分配网友打假
	 **/	
	public function actionUndonememSetdj(){
		if(isset($_POST['id']) && $_POST['id']){
			$id = $_POST['id'];
			//---自动分表
			$tab_obj = new Submeter('member');
			$member = $tab_obj->fenbiao();				
			$model = $member->updateByPk($id,array("operate_t"=>time(),"status"=>0));

			if($model > 0){
				echo 1; //删除成功
			}else{
				echo 3;
			}			
		}else{
			echo 2; //数据丢失
		}	
	}	
	/**
	 * 二次分配网友
	 **/
	public function actionUndoneTwo(){
		//---自动分表
		$model = new Submeter('memberallot');
		$memberal = $model->fenbiao();
		$category = CustomerCategory::model()->findAll(); //分类列表
		$userId = Yii::app()->user->getId();
		$userinfo = AdminUser::model()->find("user_id=$userId");
		if($userinfo->role_id == 1){
			//---
			$where = '';
		}else{
			$dataauth = substr($userinfo->data_auth,0,-1);
			$where = " and t.category_id in($dataauth)";
		}
		$mem_model = new CActiveDataProvider($memberal,array(
				'criteria'=>array(
						'with'=>array('mem','bu'),//联表customer
						'condition'=>'t.status=4'.$where,
						'order'=>'t.id DESC',
				),
				'pagination'=>array(
						'pageSize'=>10,
				),
	
		));
		$this->render('undonetwo',array(
				'category'=>$category,
				'mem_model'=>$mem_model->getData(),
				'pages'=>$mem_model->getPagination(),
		));
	}
	/**
	 * 二次分配网友搜索
	 **/
	public function actionUndoneTwosh(){
		//-----数据权限匹配
		$uid = Yii::app()->user->getId();
		$info = AdminUser::model()->find("user_id=$uid");
		
		//---自动分表
		$tab_obj = new Submeter('memberallot');
		$mem_model = $tab_obj->fenbiao();
		$mem_name = isset($_GET['mem_name'])?$_GET['mem_name']:'';
		$cid=$_GET["cid"];
		$mem_model->unsetAttributes();
		if(!$mem_name && !$cid){
			$this->redirect($this->createUrl("undonetwo"));
		}else{
			$category = CustomerCategory::model()->findAll(); //分类列表
			$mem_model->name=$mem_name;
			$mem_model->catid = $info->data_auth;
			$mem_model->status=4;
			$mem_model->category_id=$cid;
			$this->render('undonetwo',array(
					'category'=>$category,
					'mem_model'=>$mem_model->search()->getData(),
					'itemCount'=>$mem_model->search()->getTotalItemCount(),
					'pages'=>$mem_model->search()->getPagination(),
					"key"=>$mem_name
			));
		}
	}

}
?>