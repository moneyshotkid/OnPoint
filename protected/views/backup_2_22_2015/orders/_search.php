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
                <?php echo $form->label($model,'driver_id'); ?>
                <?php ; ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'patient_id'); ?>
                <?php ; ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'sales_id'); ?>
                <?php ; ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'requestedStrains'); ?>
                <?php echo $form->textField($model,'requestedStrains',array('size'=>60,'maxlength'=>250)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'Timein'); ?>
                <?php echo $form->textField($model,'Timein'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'PrefDeliveryTime'); ?>
                <?php echo $form->textField($model,'PrefDeliveryTime'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'status'); ?>
                <?php echo $form->textField($model,'status',array('size'=>8,'maxlength'=>8)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'patientnote'); ?>
                <?php echo $form->textField($model,'patientnote',array('size'=>60,'maxlength'=>250)); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
