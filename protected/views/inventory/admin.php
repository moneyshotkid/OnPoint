<?php
$this->breadcrumbs=array(
	'Inventories'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Inventory', 'url'=>array('index')),
	array('label'=>'Create Inventory', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('inventory-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="row"> <div class="col-xs-12 col-md-12">
<h1>Inventory Overview</h1>



<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'inventory-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
			'duedate',
		'strain',
		'grade',
		'currentweight',
		'weightrecieved',
		'cpg',

        	array(
					'name' => 'paymentstatus',
					'value' => '($data->paymentstatus ==="paid") ? Yii::t(\'app\', \'Paid\')  : Yii::t(\'app\', \'Owed\')',
					'filter' => array('owed' => Yii::t('app', 'Owed'), 'paid' => Yii::t('app', 'Paid')),
					),

		/*
		'id',
		'operationalmargin',
		
		'daterecieved',
	

		'employee_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?></div></div>
