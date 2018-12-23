<?php
$this->breadcrumbs=array(
	'Expenses'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Manage'),
);

$this->menu=array(
		array('label'=>Yii::t('app',
				'List expenses'), 'url'=>array('index')),
		array('label'=>Yii::t('app', 'Create expenses'),
				'url'=>array('create')),
			);

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('expenses-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
		?>

<h1> Manage&nbsp;Expenses</h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'expenses-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(

		'date',
		'expense',
		'amount',

          array(
					'name' => 'paymentMethod',
					'value' => '$data->paymentMethod',
					'filter' => array('cash' => Yii::t('app', 'Cash'), 'credit' => Yii::t('app', 'Credit Card'), 'check' => Yii::t('app', 'Check')),
					),

        array(
					'name' => 'recurring',
					'value' => '($data->recurring ===0) ? Yii::t(\'app\', \'No\')  : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'monthly',
		/*
		 *	'id',
		 *  'timestamp',
		'recurring',
		'monthly',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
