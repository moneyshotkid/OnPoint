<?php
$this->breadcrumbs=array(
	'Sales'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yii::t('app', 'Update'),
);

$this->menu=array(
	array('label'=>'List sales', 'url'=>array('index')),
	array('label'=>'Create sales', 'url'=>array('create')),
	array('label'=>'View sales', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage sales', 'url'=>array('admin')),
);
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sales-form',
	'enableAjaxValidation'=>true,
)); 
<fieldset>
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'form' =>$form
	)); ?>

<div class="row buttons">
<input type="submit" class="easyui-linkbutton" value="<?php echo Yii::t('app', 'Update')); ?>" />
</div>
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- form -->
