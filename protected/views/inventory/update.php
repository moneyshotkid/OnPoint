<?php
$this->breadcrumbs=array(
	'Inventories'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List Inventory', 'url'=>array('index')),
	array('label'=>'Create Inventory', 'url'=>array('create')),
	array('label'=>'View Inventory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Inventory', 'url'=>array('admin')),
);
?>

<h1> Update Inventory #<?php echo $model->id; ?> </h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'inventory-form',
	'enableAjaxValidation'=>true,
)); 
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'form' =>$form
	)); ?>

<li class="buttons">
	<?php echo CHtml::submitButton(Yii::t('app', 'Update')); ?>
</li>
</ul>
<?php $this->endWidget(); ?>

</div><!-- form -->
