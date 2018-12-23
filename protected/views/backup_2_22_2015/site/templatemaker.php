<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'inventory-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'strain',
        	array(
			'name' => 'thumbimage',
			'type' => 'raw',
			'value' => 'CHtml::image("images/inventory/" . $data->thumbimage)',
			'sortable' => false,
			'filter' => false,
			'htmlOptions' => array('style'=>'text-align: center')
		),
		'grade',
		'currentweight',
		'cpg',
'twograms',
'eigth',
        'fourgrams',
		/*
		'id',
		'operationalmargin',
		
		'daterecieved',
	

		'employee_id',
		*/

	),
)); ?>
