<?php
$this->breadcrumbs = array(
	'Orders',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Orders', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Orders', 'url'=>array('admin')),
);
?>

<h1>Orders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
