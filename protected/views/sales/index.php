<?php
$this->breadcrumbs = array(
	'Prescription',
	Yii::t('app', 'History'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Place a') . ' Prescription', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Search for a') . ' Prescription', 'url'=>array('admin')),
);
?>

<h1>Prescription History</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
