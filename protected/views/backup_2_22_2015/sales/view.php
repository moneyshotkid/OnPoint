<?php
$this->breadcrumbs=array(
	'Sales'=>array('main'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Place Prescription', 'url'=>array('create')),
	array('label'=>'Search for a Prescription', 'url'=>array('admin')),
);
?>

<h1>View sales #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id0.sales_id',
		'patient.name',
		'quantity',
		'date',
		'employee.username',
		'total',
		'paymentType',
	),
)); ?>


