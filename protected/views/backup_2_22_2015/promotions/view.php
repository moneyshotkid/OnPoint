<?php
$this->breadcrumbs=array(
	'Promotions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Promotions', 'url'=>array('index')),
	array('label'=>'Create Promotions', 'url'=>array('create')),
	array('label'=>'Update Promotions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Promotions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Promotions', 'url'=>array('admin')),
);
?>

<h1>View Promotions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'promotion',
		'startdate',
		'enddate',
		'purchasetotal',
		'quantity',
		'cost',
		'inventory_id',
		'grade',
		'count',
	),
)); ?>
