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
                <?php echo $form->label($model,'strain'); ?>
                <?php echo $form->textField($model,'strain',array('size'=>60,'maxlength'=>200)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'category'); ?>
                <?php echo $form->textField($model,'category',array('size'=>6,'maxlength'=>6)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'dominant'); ?>
                <?php echo $form->textField($model,'dominant',array('size'=>6,'maxlength'=>6)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'image'); ?>
                <?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>150)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'description'); ?>
                <?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>250)); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
