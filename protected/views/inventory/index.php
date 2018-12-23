<?php
$this->breadcrumbs = array(
	'Inventories',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Inventory', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Inventory', 'url'=>array('admin')),
);
?>

<h1>Inventories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
