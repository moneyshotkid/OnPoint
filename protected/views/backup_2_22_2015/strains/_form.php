<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'strain'); ?>
<?php echo $form->textField($model,'strain',array('size'=>60,'maxlength'=>200)); ?>
<?php echo $form->error($model,'strain'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
<?php echo $form->textField($model,'category',array('size'=>6,'maxlength'=>6)); ?>
<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dominant'); ?>
<?php echo $form->textField($model,'dominant',array('size'=>6,'maxlength'=>6)); ?>
<?php echo $form->error($model,'dominant'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'image'); ?>
<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>150)); ?>
<?php echo $form->error($model,'image'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>250)); ?>
<?php echo $form->error($model,'description'); ?>
	</div>


