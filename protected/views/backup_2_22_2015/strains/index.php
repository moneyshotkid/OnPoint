<?php
$this->breadcrumbs = array(
	'Strains',
	Yii::t('app', 'Index'),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'Create') . ' Strains', 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') . ' Strains', 'url'=>array('admin')),
);
?>

<h1>Strains</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
