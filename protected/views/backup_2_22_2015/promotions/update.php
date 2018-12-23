<?php
$this->breadcrumbs=array(
	'Promotions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Promotions', 'url'=>array('index')),
	array('label'=>'Create Promotions', 'url'=>array('create')),
	array('label'=>'View Promotions', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Promotions', 'url'=>array('admin')),
);
?>

<h1>Update Promotions <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>