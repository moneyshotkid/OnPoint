<?php
/* @var $this PatientController */

$this->breadcrumbs=array(
	'Patient'=>array('/patient'),
	'Records',
);
?>

       <div class="row">
	<div class="panel panel-info">  <!-- Default panel contents -->
  <div class="panel-heading">Patient Records</div>
  <div class="panel-body">
	
	
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-form',
	'enableAjaxValidation'=>true,
)); 

$baseUrl = Yii::app()->baseUrl;
  $cs = Yii::app()->getClientScript();
 // $cs->registerCssFile($baseUrl.'/css/styles.css'); 

?>









<form class="form-horizontal" role="form">




<!--
  <div class="form-group">
         <label for="User_status" class="col-sm-3 control-label">Status</label>      <div class="col-sm-9">   <select name="User[status]" id="User_status">
<option value="0" selected="selected">Not active</option>
<option value="1">Active</option>
<option value="-1">Banned</option>
</select>             
  </div>
      </div>	-->
	


	
	  <div class="form-group">
	<label class="col-sm-3 control-label">Patient Full Name</label> <div class="col-sm-9">
			<?php echo $form->textField($model,'name',array('class'=>"form-control",'disabled'=>'disabled')); ?>
	
  </div>
      </div>		
	  <div class="form-group"><label class="col-sm-3 control-label">Street Address</label> <div class="col-sm-9">
		<?php echo $form->textField($model,'address',array('class'=>"form-control",'disabled'=>'disabled')); ?>
	
  </div>
      </div>		
		  <div class="form-group">	<label class="col-sm-3 control-label">Zip Code</label> <div class="col-sm-9">
		<?php echo $form->textField($model,'zip',array('class'=>"form-control",'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'zip'); ?>
	  </div>
      </div>
    <div class="form-group">
        <label for="User_email" class="col-sm-3 control-label">E-mail</label>  <div class="col-sm-9"> 	<?php echo
            $form->textField($model,'email',array('class'=>"form-control",'disabled'=>'disabled')); ?>          <span id="avatar"></span>
        </div>
    </div>
	  <div class="form-group"><label class="col-sm-3 control-label">Phone</label> <div class="col-sm-9">
	<?php echo $form->textField($model,'phone',array('class'=>"form-control",'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'phone'); ?>
  </div>
      </div>		
		
		  <div class="form-group"><label class="col-sm-3 control-label">Medical Condition</label> <div
                  class="col-sm-9">
	<?php echo CHTML::activeDropDownList($model,'condition',$model->getConditionOptions(),array('class'=>"form-control",'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'condition'); ?>
	  </div>
      </div>		



		        <div class="form-group">	<label class="col-sm-3 control-label">Notes to Caregiver  </label>
                    <div
                        class="col-sm-9">
		<?php echo $form->textArea($model,'notes',array('class'=>"form-control")); ?>
		<?php echo $form->error($model,'notes'); ?>

  </div>
      </div>		
		  <div class="form-group"><label class="col-sm-3 control-label">Recommendation Expiration</label>	 <div
                  class="col-sm-9"><?php $this->widget('zii.widgets.jui.CJuiDatePicker',
						 array(
								 'model'=>'$model',
								 'name'=>'Patient[expiration]',
								 //'language'=>'de',
								 'value'=>$model->expiration,
								 'htmlOptions'=>array('size'=>10, 'style'=>'width:80px !important','disabled'=>'disabled'),
									 'options'=>array(
									 'showButtonPanel'=>true,
									 'changeYear'=>true,
									 ),
								 )
							 );
					; ?>
		<?php echo $form->error($model,'expiration'); ?>
	  </div>
      </div>		


		  <div class="form-group">      <div class="col-sm-offset-9 col-sm-3"> <input type="hidden"
                                                                                      name="User[superuser]" id="User_superuser" value="0">
  <input type="hidden" name="User[role]" id="User_role" value="patient" />
<!--<input type="submit" id="btn" class="btn btn-success" value="Update" />-->

</div>
  </div>

</div>
  </div>

</div>
		


<?php $this->endWidget(); ?>
<script type="text/javascript">
function avatar(){
	var email=jQuery("#User_email").val();
$.get('<?php echo Yii::app()->request->baseUrl; ?>/patient/AjaxAvatar',{ User_email : email }, function(data) {
  $('#avatar').html(data);
});

	
}

  $(document).ready(function(){
    $('#btn').on('click',function(){
      var formdata=  $(form).serializeArray();
  $.ajax({
            type: "POST",
            url: "patient/records",
            data: formdata
        })
            .done(function( msg ) {
                alert( "Data Saved: " + msg );
            });});



  });






</script>
<!-- form -->