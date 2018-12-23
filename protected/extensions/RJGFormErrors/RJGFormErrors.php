<?php

class RJGFormErrors extends CWidget
{
	public $form = null; 
	public $caption = '';
	public $flash = ''; 
	public $css = ''; 
	
	public function init() 
	{
		$extensionPath = Yii::getPathOfAlias('application.extensions.RJGFormErrors');
		
		$clientScript = Yii::app()->clientScript;
		$clientScript->registerCoreScript('jquery');//required for jgrowl.js
		
		 
		$jsFile = $extensionPath.'/jquery.jgrowl.js'; 
		$clientScript->registerScriptFile(
			Yii::app()->assetManager->publish($jsFile )
		); 
  		  
		$cssFile = $this->css ? $this->css : $extensionPath.'/jquery.jgrowl.css';  

        /*
        $clientScript->registerCssFile(
			Yii::app()->assetManager->publish($cssFile)
		);
		*/
		$this->caption = addslashes($this->caption);// avoid ' troubles in js
	}
	
	public function run() 
	{
		$flashMsg = ''; // variable for tempalte with flash message text
		if ( $this->flash && Yii::app()->user->hasFlash($this->flash)) // if have flash message id, and exists flash message we will show 
			$flashMsg = Yii::app()->user->getFlash($this->flash); 
		
		Yii::app()->clientScript->registerScript('jgrowlformerrors', $this->render("jgrowlformerrors", array('form' => $this->form, 'caption' => $this->caption, 'flash'=> $flashMsg), true), CClientScript::POS_END);
	}
}