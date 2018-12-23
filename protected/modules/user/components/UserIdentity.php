<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	const ERROR_EMAIL_INVALID=3;
	const ERROR_STATUS_NOTACTIV=4;
	const ERROR_STATUS_BAN=5;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		if (strpos($this->username,"@")) {
			$user=User::model()->notsafe()->findByAttributes(array('email'=>$this->username));
		} else {
			$user=User::model()->notsafe()->findByAttributes(array('username'=>$this->username));
		}
		if($user===null)
			if (strpos($this->username,"@")) {
				$this->errorCode=self::ERROR_EMAIL_INVALID;
			} else {
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			}
		else if(Yii::app()->controller->module->encrypting($this->password)!==$user->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else if($user->status==0&&Yii::app()->controller->module->loginNotActiv==false)
			$this->errorCode=self::ERROR_STATUS_NOTACTIV;
		else if($user->status==-1)
			$this->errorCode=self::ERROR_STATUS_BAN;
		else {
			$this->_id=$user->id;
			$this->username=$user->username;
	//$userobj = User::model()->findByPk(Yii::app()->user->id);
       // session_start();
        Yii::app()->controller->module->role=$user->role;


    //    $_SESSION['role']=$userobj->role;
                $auth=Yii::app()->authManager;
		   if(!$auth->isAssigned($user->role,$this->_id))
        {
            if($auth->assign($user->role,$this->_id))
            {
                Yii::app()->authManager->save();
            }
        }
            	$this->errorCode=self::ERROR_NONE;
        }
		return !$this->errorCode;
	}
    
    /**
    * @return integer the ID of the user record
    */
	public function getId()
	{
		return $this->_id;
	}
	
	public function lhsession(){
	 $_SESSION['lhc_access_array']="";
      $_SESSION['lhc_access_timestamp']="";
     $_SESSION['lhc_user_id']="";
      $_SESSION['lhc_csfr_token']="";
     $_SESSION['lhc_user_timezone']="";
setcookie('lhc_rm_u','',time()-31*24*3600,'/');
    
	
	}
}