<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
<?php echo $form->textField($model,'date'); ?>
<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
			</div>

	<div class="row">
			</div>

	<div class="row">
		<?php echo $form->labelEx($model,'note'); ?>
<?php echo $form->textField($model,'note',array('size'=>60,'maxlength'=>250)); ?>
<?php echo $form->error($model,'note'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
<?php echo $form->textField($model,'type',array('size'=>7,'maxlength'=>7)); ?>
<?php echo $form->error($model,'type'); ?>
	</div>


<label for="Patient">Belonging Patient</label><?php 
					$this->widget('application.components.Relation', array(
							'model' => $model,
							'relation' => 'patient',
							'fields' => 'name',
							'allowEmpty' => false,
							'style' => 'dropdownlist',
							)
						); ?>
			<label for="User">Belonging User</label><?php 
					$this->widget('application.components.Relation', array(
							'model' => $model,
							'relation' => 'user',
							'fields' => 'username',
							'allowEmpty' => false,
							'style' => 'dropdownlist',
							)
						); ?>
			