<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('driver_id')); ?>:</b>
	<?php echo CHtml::encode($data->driver_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_id')); ?>:</b>
	<?php echo CHtml::encode($data->patient_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sales_id')); ?>:</b>
	<?php echo CHtml::encode($data->sales_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('requestedStrains')); ?>:</b>
	<?php echo CHtml::encode($data->requestedStrains); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Timein')); ?>:</b>
	<?php echo CHtml::encode($data->Timein); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PrefDeliveryTime')); ?>:</b>
	<?php echo CHtml::encode($data->PrefDeliveryTime); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patientnote')); ?>:</b>
	<?php echo CHtml::encode($data->patientnote); ?>
	<br />

	*/ ?>

</div>
