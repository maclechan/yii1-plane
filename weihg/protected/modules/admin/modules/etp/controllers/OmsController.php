<?php
/*
**@version 2015-2-4
**@author  yuzixiu
**@订单管理
*/
class OmsController extends Controller
{
	/**
	 *  初始化函数
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
	 * 	订单列表
	 */
	public function actionOmsOrderList(){
		$model = new CActiveDataProvider('MemberOrder',array(
				'criteria'=>array(
						//	'condition'=>'status=0'
						'order'=>'add_time desc',
						//'condition'=>'status=1',
						),
						'pagination'=>array(
								'pageSize'=>20,
						),
				));
		$this->render('orderlist',array(
				'orderlist'=>$model->getData(),
				'pages'=>$model->getPagination(),
		));			
	}
	/**
	 * 	订单搜索
	 */
	public function actionOmsOrderSearch(){
			$model = new MemberOrder('search');			
			$model->unsetAttributes();
			$orderid=$_GET["search"];	
			$status=$_GET["types"];	
			if(!$orderid && !$status && $status != '0'){
				$this->redirect($this->createUrl("omsorderlist"));
			}else{
				$model->order_id = $orderid;
				if($status || $status == '0'){
					$model->status = $status;
				}
				$this->render("orderlist",array(
					"orderlist"=>$model->search()->getData(),
					"pages"=>$model->search()->getPagination(),
					"itemCount"=>$model->search()->getTotalItemCount(),
					"orderid"=>$orderid
				));
			}	
	}
	/**
	 * 	订单发货
	 */
	public function actionOmsOrderSend(){
		if(isset($_POST['id']) && $_POST['id']){
			$id = intval($_POST['id']);
			$return = MemberOrder::model()->updateByPk($id,array("status"=>2));
			if($return > 0){
				echo 1;	//操作成功
			}else{
				echo 3; //操作失败
			}
		}else{
			echo 2; //数据丢失
		}
	}
	/**
	 * 	订单删除
	 */
	public function actionOmsOrderDel(){
		if(isset($_POST['id']) && $_POST['id']){
			$id = intval($_POST['id']);

			$memorder = new MemberOrder();				
			$model = $memorder->findByPk($id);
			if($model){
				if($model->delete()){
					echo 1; //删除成功
				}else{
					echo 3;
				}	
			}else{
				echo 2;
			}
		}else{
			echo 2; //数据丢失
		}	
	}
	/**
	 * 	交易列表
	 */
	public function actionOmsTradeList(){
		$model = new CActiveDataProvider('MemberOrderTrade',array(
				'criteria'=>array(
						//	'condition'=>'status=0'
						'order'=>'time_end desc',
						//'condition'=>'status=1',
						),
						'pagination'=>array(
								'pageSize'=>20,
						),
				));
		$this->render('tradelist',array(
				'tradelist'=>$model->getData(),
				'pages'=>$model->getPagination(),
		));			
	}
	/**
	 * 	交易搜索
	 */
	public function actionOmsTradeSearch(){
			$model = new MemberOrderTrade('search');			
			$model->unsetAttributes();
			$orderid=$_GET["search"];	
			if(!$orderid){
				$this->redirect($this->createUrl("omstradelist"));
			}else{
				$model->order_id = $orderid;
				$this->render("tradelist",array(
					"tradelist"=>$model->search()->getData(),
					"pages"=>$model->search()->getPagination(),
					"itemCount"=>$model->search()->getTotalItemCount(),
					"orderid"=>$orderid
				));
			}			
	}
	
}
?>