<?php
$this->breadcrumbs=array(
	'Driverbalancesheets'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List driverbalancesheet', 'url'=>array('index')),
	array('label'=>'Create driverbalancesheet', 'url'=>array('create')),
	array('label'=>'View driverbalancesheet', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage driverbalancesheet', 'url'=>array('admin')),
);
?>

<h1> Update driverbalancesheet #<?php echo $model->id; ?> </h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'driverbalancesheet-form',
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
