<?php
$this->breadcrumbs=array(
	'Expenses'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->menu=array(
	array('label'=>'List expenses', 'url'=>array('index')),
	array('label'=>'Manage expenses', 'url'=>array('admin')),
);
?>

<h1> Expenses </h1>
<div id="container">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'expenses-form',
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
