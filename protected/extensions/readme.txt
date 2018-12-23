Jgrowl form errors widget
=====================

This widget show form errors with jgrowl jquery plugin. 



###Resources
* http://plugins.jquery.com/project/jGrowl

###Requirements
* Yii 1.1 or above
* not tested with Yii 1.0 

###Installation
* Extract the release file under `protected/extensions`.
* Add the following to your config file 'import' section:

'class'=>''application.extensions.RJGFormErrors.RJGFormErrors',

should be : 
~~~
[php]
 'import'=>array(
 	//...
     'class'=>''application.extensions.RJGFormErrors.RJGFormErrors',
  ),
~~~

###Usage
Add
<?php  $this->widget('RJGFormErrors', array('form' => $model, 'flash' => '', 'caption' => 'caption','css' => Yii::app()->basePath.'/../css/jquery.jgrowl.css')); ?>
into view file with form

Parameters: 
 * form - required, form or model 
 * flash = optional, flash string to show ( it can show flash messages with growl, but flash message will be deleted ) 
 * css => optional, custom css file  
