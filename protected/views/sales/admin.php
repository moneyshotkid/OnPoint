<?php
$this->breadcrumbs=array(
	'Sales'=>array(Yii::t('app', 'main')),
	Yii::t('app', 'Manage'),
);

$this->menu=array(
		array('label'=>Yii::t('app',
				'Prescription History'), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Place a Prescription'),
				'url'=>array('create')),
			);

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('sales-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
		?>

<h1>Prescription History</h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sales-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        'status',
        array('name'=>'date','value'=>'date("F j Y g:i a",strtotime($data->date))'),
		array('name'=>'employee_id','value'=>'$data->employee->username'),
        array('name'=>'patient_id','value'=>'$data->patient->name'),
		'quantity',
	'total',
		/*
		'paymentType',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
