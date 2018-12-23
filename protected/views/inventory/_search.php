<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'strain'); ?>
		<?php echo $form->textField($model,'strain',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'grade'); ?>
		<?php echo $form->textField($model,'grade',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'weightrecieved'); ?>
		<?php echo $form->textField($model,'weightrecieved'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vendor_id'); ?>
		<?php echo $form->textField($model,'vendor_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cost'); ?>
		<?php echo $form->textField($model,'cost',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'operationalmargin'); ?>
		<?php echo $form->textField($model,'operationalmargin',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'currentweight'); ?>
		<?php echo $form->textField($model,'currentweight'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'daterecieved'); ?>
		<?php echo $form->textField($model,'daterecieved'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'duedate'); ?>
		<?php echo $form->textField($model,'duedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'paymentstatus'); ?>
		<?php echo $form->textField($model,'paymentstatus',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employee_id'); ?>
		<?php echo $form->textField($model,'employee_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->