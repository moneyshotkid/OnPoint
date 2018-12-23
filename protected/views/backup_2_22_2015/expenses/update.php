<?php
$this->breadcrumbs=array(
	'Expenses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List expenses', 'url'=>array('index')),
	array('label'=>'Create expenses', 'url'=>array('create')),
	array('label'=>'View expenses', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage expenses', 'url'=>array('admin')),
);
?>

<h1> Update expenses #<?php echo $model->id; ?> </h1>
<div id="container" class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'expenses-form',
	'enableAjaxValidation'=>true,
)); 
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'form' =>$form
	)); ?>

<div class="row buttons">
	<?php echo CHtml::submitButton(Yii::t('app', 'Update')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
