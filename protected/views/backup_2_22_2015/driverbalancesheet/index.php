<?php
$this->breadcrumbs = array(
	'Driverbalancesheets',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' driverbalancesheet', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' driverbalancesheet', 'url'=>array('admin')),
);
?>

<h1>Driverbalancesheets</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
