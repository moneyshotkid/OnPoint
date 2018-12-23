<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inventory-form',
	'enableAjaxValidation'=>false,'htmlOptions' => array('enctype' => 'multipart/form-data'),
));

?><h2>Add Inventory</h2><?php
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'form' =>$form
	)); ?>




<?php $this->endWidget(); ?>


