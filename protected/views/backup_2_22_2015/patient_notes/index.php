<?php
$this->breadcrumbs = array(
	'Patient Notes',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' patient_notes', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' patient_notes', 'url'=>array('admin')),
);
?>

<h1>Patient Notes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
