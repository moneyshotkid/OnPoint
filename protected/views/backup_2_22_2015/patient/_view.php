<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('address')); ?>:</b>
	<?php echo CHtml::encode($data->address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('zip')); ?>:</b>
	<?php echo CHtml::encode($data->zip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone')); ?>:</b>
	<?php echo CHtml::encode($data->phone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('condition')); ?>:</b>
	<?php echo CHtml::encode($data->condition); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('licenseNumber')); ?>:</b>
	<?php echo CHtml::encode($data->licenseNumber); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('dlCopy')); ?>:</b>
	<?php echo CHtml::encode($data->dlCopy); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driverslicense')); ?>:</b>
	<?php echo CHtml::encode($data->driverslicense); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patientlicense')); ?>:</b>
	<?php echo CHtml::encode($data->patientlicense); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recFile')); ?>:</b>
	<?php echo CHtml::encode($data->recFile); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
	<?php echo CHtml::encode($data->notes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expiration')); ?>:</b>
	<?php echo CHtml::encode($data->expiration); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('appointed')); ?>:</b>
	<?php echo CHtml::encode($data->appointed); ?>
	<br />

	*/ ?>

</div>