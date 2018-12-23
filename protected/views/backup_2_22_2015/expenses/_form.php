<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
						 array(
								 'model'=>'$model',
								 'name'=>'expenses[date]',
								 //'language'=>'de',
								 'value'=>$model->date,
								 'htmlOptions'=>array('size'=>10, 'style'=>'width:80px !important'),
									 'options'=>array(
									 'showButtonPanel'=>true,
									 'changeYear'=>true,                                      
									 'changeYear'=>true,
									 ),
								 )
							 );
					; ?>
<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'expense'); ?>
<?php echo $form->textArea($model,'expense',array('rows'=>6, 'cols'=>50)); ?>
<?php echo $form->error($model,'expense'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'amount'); ?>
<?php echo $form->textField($model,'amount',array('size'=>6,'class'=>'small','maxlength'=>6)); ?>
<?php echo $form->error($model,'amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paymentMethod'); ?><?php echo CHTML::activeDropDownList($model,'paymentMethod',$model->getPaymentOptions(),array('class'=>'med')); ?>

<?php echo $form->error($model,'paymentMethod'); ?>
	</div>



	<div class="row">
		<?php echo $form->labelEx($model,'recurring'); ?>
<?php echo $form->checkBox($model,'recurring'); ?>
<?php echo $form->error($model,'recurring'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'monthly'); ?>
<?php echo $form->textField($model,'monthly',array('size'=>6,'class'=>'small','maxlength'=>6)); ?>
<?php echo $form->error($model,'monthly'); ?>
	</div>


