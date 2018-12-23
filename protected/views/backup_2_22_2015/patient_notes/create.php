<?php
$this->breadcrumbs=array(
	'Patient Notes'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>'List patient_notes', 'url'=>array('index')),
	array('label'=>'Manage patient_notes', 'url'=>array('admin')),
);
?>

<h1> Create patient_notes </h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-notes-form',
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
