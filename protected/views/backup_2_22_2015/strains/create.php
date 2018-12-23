<?php
$this->breadcrumbs=array(
	'Strains'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>'List Strains', 'url'=>array('index')),
	array('label'=>'Manage Strains', 'url'=>array('admin')),
);
?>

<h1> Create Strains </h1>
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
	<?php echo CHtml::submitButton(Yii::t('app', 'Create')); ?>
</div>

<?php $this->endWidget(); ?>

</div>
