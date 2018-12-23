<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'id'); ?>
                <?php echo $form->textField($model,'id'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'date'); ?>
                <?php echo $form->textField($model,'date'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'user_id'); ?>
                <?php ; ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'patient_id'); ?>
                <?php ; ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'note'); ?>
                <?php echo $form->textField($model,'note',array('size'=>60,'maxlength'=>250)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'type'); ?>
                <?php echo $form->textField($model,'type',array('size'=>7,'maxlength'=>7)); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
