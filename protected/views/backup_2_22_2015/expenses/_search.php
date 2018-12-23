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
                <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
						 array(
								 'model'=>'$model',
								 'name'=>'expenses[date]',
								 //'language'=>'de',
								 'value'=>$model->date,
								 'htmlOptions'=>array('size'=>10, 'style'=>'width:80px !important'),
									 'options'=>array(
									 'showButtonPanel'=>true,
									 'changeYear'=>true,                                      
									 'changeYear'=>true,
									 ),
								 )
							 );
					; ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'expense'); ?>
                <?php echo $form->textArea($model,'expense',array('rows'=>6, 'cols'=>50)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'amount'); ?>
                <?php echo $form->textField($model,'amount',array('size'=>6,'maxlength'=>6)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'paymentMethod'); ?>
                <?php echo $form->textField($model,'paymentMethod',array('size'=>6,'maxlength'=>6)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'timestamp'); ?>
                <?php echo $form->textField($model,'timestamp'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'recurring'); ?>
                <?php echo $form->checkBox($model,'recurring'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'monthly'); ?>
                <?php echo $form->textField($model,'monthly',array('size'=>6,'maxlength'=>6)); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
