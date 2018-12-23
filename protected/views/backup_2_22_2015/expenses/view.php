<?php
$this->breadcrumbs=array(
	'Expenses'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List expenses', 'url'=>array('index')),
	array('label'=>'Create expenses', 'url'=>array('create')),
	array('label'=>'Update expenses', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete expenses', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage expenses', 'url'=>array('admin')),
);
?>

<h1>View expenses #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date',
		'expense',
		'amount',
		'paymentMethod',
		'timestamp',
		'recurring',
		'monthly',
	),
)); ?>


