<?php
$this->breadcrumbs=array(
	'Patient Notes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List patient_notes', 'url'=>array('index')),
	array('label'=>'Create patient_notes', 'url'=>array('create')),
	array('label'=>'View patient_notes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage patient_notes', 'url'=>array('admin')),
);
?>

<h1> Update patient_notes #<?php echo $model->id; ?> </h1>
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
	<?php echo CHtml::submitButton(Yii::t('app', 'Update')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
