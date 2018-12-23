<?php
$this->breadcrumbs=array(
	'Promotions',
);

$this->menu=array(
	array('label'=>'Create Promotions', 'url'=>array('create')),
	array('label'=>'Manage Promotions', 'url'=>array('admin')),
);
?>

<h1>Promotions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
