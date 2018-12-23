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
                <?php echo $form->label($model,'user_id'); ?>
                <?php ; ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'manager_id'); ?>
                <?php ; ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'date'); ?>
                <?php echo $form->textField($model,'date'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'paid'); ?>
                <?php echo $form->textField($model,'paid',array('size'=>8,'maxlength'=>8)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'owed'); ?>
                <?php echo $form->textField($model,'owed',array('size'=>8,'maxlength'=>8)); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
