<?php
$this->breadcrumbs=array(
	'Strains'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List Strains', 'url'=>array('index')),
	array('label'=>'Create Strains', 'url'=>array('create')),
	array('label'=>'View Strains', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Strains', 'url'=>array('admin')),
);
?>

<h1> Update Strains #<?php echo $model->id; ?> </h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'strains-form',
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
