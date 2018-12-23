<?php
$this->breadcrumbs=array(
	'Strains'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Strains', 'url'=>array('index')),
	array('label'=>'Create Strains', 'url'=>array('create')),
	array('label'=>'Update Strains', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Strains', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Strains', 'url'=>array('admin')),
);
?>

<h1>View Strains #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'strain',
		'category',
		'dominant',
		'image',
		'description',
	),
)); ?>


