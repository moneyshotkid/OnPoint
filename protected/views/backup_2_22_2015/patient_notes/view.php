<?php
$this->breadcrumbs=array(
	'Patient Notes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List patient_notes', 'url'=>array('index')),
	array('label'=>'Create patient_notes', 'url'=>array('create')),
	array('label'=>'Update patient_notes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete patient_notes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage patient_notes', 'url'=>array('admin')),
);
?>

<h1>View patient_notes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'date',
		'user.username',
		'patient.name',
		'note',
		'type',
	),
)); ?>


