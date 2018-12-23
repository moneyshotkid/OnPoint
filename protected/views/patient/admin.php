<?php
$this->breadcrumbs=array(
	'Patients'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Patient', 'url'=>array('index')),
	array('label'=>'Create Patient', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('patient-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Patients</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'patient-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'dlCopy',
			'type' => 'raw',
			'value' => 'CHtml::image("images/patients/" . $data->dlCopy)',
			'sortable' => false,
			'filter' => false,
			'htmlOptions' => array('style'=>'text-align: center')
		),
		'name',
		'address',
		'zip',
		'phone',

	array(
					'name' => 'status',
					'value' => '($data->status === 1) ? Yii::t(\'app\', \'OK\')  : Yii::t(\'app\', \'DENY\')',
					'filter' => array('0' => Yii::t('app', 'DENY'), '1' => Yii::t('app', 'OK')),
					),

        	array(
					'name' => 	'appointed',
					'value' => '($data->appointed === 1) ? Yii::t(\'app\', \'Yes\')  : Yii::t(\'app\', \'No\')',
					'filter' => array('0' => Yii::t('app', 'Yes'), '1' => Yii::t('app', 'No')),
					),
        'notes',
		/*
		'id',
		 	'condition',
		'licenseNumber',
		'dlCopy',
		'driverslicense',
		'patientlicense',
		'recFile',

		'expiration',
		'status',
		'appointed',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>