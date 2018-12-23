<?php
$this->breadcrumbs=array(
	'Driverbalancesheets'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>'List driverbalancesheet', 'url'=>array('index')),
	array('label'=>'Manage driverbalancesheet', 'url'=>array('admin')),
);
?>

<h1> Create driverbalancesheet </h1>
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
	<?php echo CHtml::submitButton(Yii::t('app', 'Create')); ?>
</div>

<?php $this->endWidget(); ?>

</div>
