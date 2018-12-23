<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('expense')); ?>:</b>
	<?php echo CHtml::encode($data->expense); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paymentMethod')); ?>:</b>
	<?php echo CHtml::encode($data->paymentMethod); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timestamp')); ?>:</b>
	<?php echo CHtml::encode($data->timestamp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recurring')); ?>:</b>
	<?php echo CHtml::encode($data->recurring); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('monthly')); ?>:</b>
	<?php echo CHtml::encode($data->monthly); ?>
	<br />

	*/ ?>

</div>
