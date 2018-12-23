<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';
	public $layout='//layouts/login';
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
                    $this->saveSession();
					if ('/index.php')
                        $this->redirect(array('/patient/menu'));
					else
						$this->redirect(Yii::app()->user->returnUrl);
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model,));
		} else
            $this->redirect(array('/patient/menu'));
	}


    public function saveSession(){
        	$userobj = User::model()->findByPk(Yii::app()->user->id);
      //  session_start();
        $_SESSION['role']=$userobj->role;

    }
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}

}