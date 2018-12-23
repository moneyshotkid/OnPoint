<?php
$this->breadcrumbs = array(
	'Expenses',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' expenses', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' expenses', 'url'=>array('admin')),
);
?>

<h1>Expenses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
