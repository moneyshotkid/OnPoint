<?php
$this->breadcrumbs=array(
	'Promotions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Promotions', 'url'=>array('index')),
	array('label'=>'Manage Promotions', 'url'=>array('admin')),
);
?>

<h1>Create Promotions</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>