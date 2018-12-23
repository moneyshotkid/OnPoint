<?php
$this->breadcrumbs=array(
	'Driverbalancesheets'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List driverbalancesheet', 'url'=>array('index')),
	array('label'=>'Create driverbalancesheet', 'url'=>array('create')),
	array('label'=>'Update driverbalancesheet', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete driverbalancesheet', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage driverbalancesheet', 'url'=>array('admin')),
);
?>

<h1>View driverbalancesheet #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user.username',
		'manager.username',
		'date',
		'paid',
		'owed',
	),
)); ?>


