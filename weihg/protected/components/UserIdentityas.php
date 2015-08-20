<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentityas extends CUserIdentity
{
	private $_id;
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		
		$assoc = new Assoc();
		$user=$assoc->find('LOWER(loger)=?',array(strtolower($this->username)));
		if($user===null)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if(!$user->validatePassword($this->password))
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
		{
			$this->_id=$user->id;
			$this->username=$user->loger;
		//	if($user->status == 1){
				$this->errorCode=self::ERROR_NONE;
		//	}else{
		//		$this->errorCode=self::ERROR_PASSWORD_INVALID;
		//	}
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