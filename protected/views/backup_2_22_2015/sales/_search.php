<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'id'); ?>
                <?php ; ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'patient_id'); ?>
                <?php ; ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'quantity'); ?>
                <?php echo $form->textField($model,'quantity'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'date'); ?>
                <?php echo $form->textField($model,'date'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'employee_id'); ?>
                <?php ; ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'total'); ?>
                <?php echo $form->textField($model,'total',array('size'=>9,'maxlength'=>9)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'paymentType'); ?>
                <?php echo $form->textField($model,'paymentType',array('size'=>60,'maxlength'=>200)); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
