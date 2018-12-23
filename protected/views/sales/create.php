<?php
$this->breadcrumbs=array(
	'Sales'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Contribution'),
);

?>


<div class="form center-block">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sales',
	'enableAjaxValidation'=>true,
)); 

echo $this->renderPartial('_form', array(
	'model'=>$model,
    'order'=>$order,
	'form' =>$form
	)); ?>
<div class='clear'></div>
<div class="row"><div class="col-md-12">
<button type="submit" class="btn btn-success btn-block"  name="yt1">Complete Order</button></div>
</div>

<?php $this->endWidget(); ?>

</div>
