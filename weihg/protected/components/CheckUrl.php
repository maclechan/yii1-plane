<?php 
/*
**@version 2015-1-29
**@author  yuzixiu
**@微婚购url检查是否第一次到访
*/
class CheckUrl{
	
	public function checkRule(){
		if(!Yii::app()->user->getState("auth_status")){
			$openid = Yii::app()->user->getState("openid"); //微信标示
			//---判断是否是第一次到访
			$row = Member::model()->find("openid='$openid'");
			if($row){
				Yii::app()->user->setState("auth_status",1); //标示为老用户
				Yii::app()->user->setState("uid",$row->uid); //存储用户id
			}else{
				//--用户资料保存--不存在则添加
				$member = new Member();
				$member->setAttributes(array(
					"reg_time"=>time(),
					"openid"=>$openid
				));	
				$member->save();				
				//---第一次到访跳转到引导页
				echo '<script>window.location.href="/site/loading";</script>';		
			}
		}
	}
}

?>