<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'order-form',
    'enableAjaxValidation'=>false,
)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>


<?php echo $form->errorSummary($model); ?>



<input type="hidden" name="orders[requestedStrains]"  value="" />

	<div class="row">
		<?php echo $form->labelEx($model,'PrefDeliveryTime'); ?>
<?php echo $form->textField($model,'PrefDeliveryTime'); ?>
<?php echo $form->error($model,'PrefDeliveryTime'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'patientnote'); ?>
<?php echo $form->textField($model,'patientnote',array('size'=>60,'maxlength'=>250)); ?>
<?php echo $form->error($model,'patientnote'); ?>
	</div>
<input type="hidden" name="orders[status]"  value="open" />
<input type="hidden" name="orders[patient_id]"  value="<?php echo Yii::app()->user->id; ?>" />



			