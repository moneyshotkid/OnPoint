<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'promotions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'promotion'); ?>
		<?php echo $form->textField($model,'promotion',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'promotion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'startdate'); ?>
		<?php echo $form->textField($model,'startdate'); ?>
		<?php echo $form->error($model,'startdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'enddate'); ?>
		<?php echo $form->textField($model,'enddate'); ?>
		<?php echo $form->error($model,'enddate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'purchasetotal'); ?>
		<?php echo $form->textField($model,'purchasetotal',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'purchasetotal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cost'); ?>
		<?php echo $form->textField($model,'cost',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'cost'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'inventory_id'); ?>
		<?php echo $form->textField($model,'inventory_id',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'inventory_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'grade'); ?>
		<?php echo $form->textField($model,'grade',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'grade'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'count'); ?>
		<?php echo $form->textField($model,'count'); ?>
		<?php echo $form->error($model,'count'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->