<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user=AdminUser::model()->with('role')->find('LOWER(user_name)=?',array(strtolower($this->username)));
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if($user->status != 1)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;			
		else
		{
			$this->_id=$user->user_id;
			$this->username=$user->user_name;
			$this->errorCode=self::ERROR_NONE;
			//---更新登录信息
			$admupd = AdminUser::model()->updateByPk($user->user_id,array(
				"last_login"=>time(),
				"last_ip"=>Yii::app()->request->userHostAddress,
			));		
			Yii::app()->user->setState('type',$user->type);
			Yii::app()->user->setState('roleid',$user->role->role_id);
			if($user->role->role_id == 1){
				//----系统管理员全部权限
				$menu = Menu::model()->findAll("status=1 order by sort asc");
				foreach($menu as $mval){
					$menuarr[] = $mval->id.'|'.$mval->menu_cn.'|'.$mval->menu_en;
				}
				Yii::app()->user->setState('menuarr',$menuarr);
			}else{
				$role = AdminUserRole::model()->find("role_id=$user->role_id");
				if($role->role_menu){
					$role_menu = substr($role->role_menu,0,-1);
					$menu = Menu::model()->findAll("id in($role_menu) and status=1 order by sort asc");
					foreach($menu as $mval){
						$menuarr[] = $mval->id.'|'.$mval->menu_cn.'|'.$mval->menu_en;
					}		
				}else{
					$menuarr = '';
				}
				Yii::app()->user->setState('menuarr',$menuarr);				
				Yii::app()->user->setState('role_nav',$role->role_nav);
				Yii::app()->user->setState('role_ac',$role->role_action);
			}			
		}
		return $this->errorCode==self::ERROR_NONE;
	}
	
	/**
	 * @return integer the ID of the user record
	 */
	public function getId()
	{
		return $this->_id;
	}	
}