<p class="note">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<div class="row">
			</div>

	<div class="row">
			</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
<?php echo $form->textField($model,'date'); ?>
<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'paid'); ?>
<?php echo $form->textField($model,'paid',array('size'=>8,'maxlength'=>8)); ?>
<?php echo $form->error($model,'paid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'owed'); ?>
<?php echo $form->textField($model,'owed',array('size'=>8,'maxlength'=>8)); ?>
<?php echo $form->error($model,'owed'); ?>
	</div>


<label for="User">Belonging User</label><?php 
					$this->widget('application.components.Relation', array(
							'model' => $model,
							'relation' => 'manager',
							'fields' => 'username',
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
			