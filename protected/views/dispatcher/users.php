<?php
$this->breadcrumbs=array(
    'Inventories'=>array('index'),
    'Manage',
);

$this->menu=array(
    array('label'=>'List Inventory', 'url'=>array('index')),
    array('label'=>'Create Inventory', 'url'=>array('create')),
);

?>
<h1>Manage Users</h1>




<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'user-grid',
    'dataProvider'=>$model,
    'filter'=>$model,
    'columns'=>array(
        'username',
        'role',
        'email',


        array(
            'name' => 'status',
            'value' => '($data->status ==1) ? Yii::t(\'app\', \'Active\')  : Yii::t(\'app\', \'Inactive\')',
            'filter' => array('0' => Yii::t('app', 'Inactive'), '1' => Yii::t('app', 'Active')),
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
)); ?>
