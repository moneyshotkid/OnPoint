<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-form',
	'enableAjaxValidation'=>false,
)); 

$baseUrl = Yii::app()->baseUrl;
  $cs = Yii::app()->getClientScript();
  $cs->registerCssFile($baseUrl.'/css/styles.css'); 

?>

<div id="wrapper">
<div class="info">
	<h2>Patient/Member Registration</h2>
	<div>Please use this form to apply for membership. If you need assistance please let us know.</div>
	</div><ul>

<?php echo $form->errorSummary($model); ?>


		<li class="complex">
	<label class="desc">User Information</label>
	<div>
		<span class="left">
          <input size="20" maxlength="20" name="User[username]" class="small" id="User_username" type="text" />           <label for="User_username" class="required">username <span class="required">*</span></label>     </span>
      	<span class="right">
        <input size="60" maxlength="128" name="User[password]" id="User_password" class="small" type="password" />   <label for="User_password">password</label>    	
        
</span>

 
      	<span class="left">
         <input size="60" maxlength="128" name="User[email]" id="User_email" onchange="avatar();" type="text" />           <label for="User_email" class="required">E-mail <span class="required">*</span></label>   <span id="avatar"></span>
         
   <input type="hidden" name="User[superuser]" id="User_superuser" value="0">


  <input type="hidden" name="User[role]" id="User_role" value="patient" />
</span>
   <span class="right">
            <select name="User[status]" id="User_status">
<option value="0" selected="selected">Not active</option>
<option value="1">Active</option>
<option value="-1">Banned</option>
</select>                 <label for="User_status" class="required">Status <span class="required">*</span></label>  
</span>
	

<span class="full">
	
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</span>
<span class="full">
		<?php echo $form->textField($model,'address'); ?>
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->error($model,'address'); ?>
	</span><span class="left">
		<?php echo $form->textField($model,'zip'); ?>
		<?php echo $form->labelEx($model,'zip'); ?>
		<?php echo $form->error($model,'zip'); ?>
		</span><span class="right">
	<?php echo $form->textField($model,'phone'); ?>
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->error($model,'phone'); ?>
	</span><span class="left">
		
	<?php echo CHTML::activeDropDownList($model,'condition',$model->getConditionOptions()); ?>
		<?php echo $form->labelEx($model,'condition'); ?>
		<?php echo $form->error($model,'condition'); ?>
		</span><span class="right">

		<?php echo $form->textField($model,'licenseNumber'); ?>
		<?php echo $form->labelEx($model,'licenseNumber'); ?>
		<?php echo $form->error($model,'licenseNumber'); ?>
	</span><span class="full">
			
		<?php echo $form->error($model,'dlCopy'); ?><?php $url=Yii::app()->request->baseUrl; $this->widget('ext.EAjaxUpload.EAjaxUpload',
array(
        'id'=>'Patient_dlCopy',
        'config'=>array(
               'action'=>Yii::app()->request->baseUrl.'/patient/upload',
               'allowedExtensions'=>array("jpg","png","gif"),
               'sizeLimit'=>10*1024*1024,
               
              'onComplete'=>"js:function(id, fileName, responseJSON){ addDLImage(responseJSON.thumbname); }",
               'messages'=>array(
                                'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                               'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                           'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                               'emptyError'=>"{file} is empty, please select files again without it.",
                              'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                             ),
              // 'showMessage'=>"js:function(message){ alert(message); }"
              )
)); ?><?php echo $form->labelEx($model,'dlCopy'); ?>
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/patient/default.jpg" width="200px" height="200px" alt=""
     id="thumbDlHolder" />

<?php echo $form->hiddenField($model,'dlCopy',array('id'=>'Patient_dlCopy')); ?>
		<?php echo $form->error($model,'dlCopy'); ?>
	
		</span>	<span class="full">
		<?php echo $form->textField($model,'driverslicense'); ?>
<?php echo $form->labelEx($model,'driverslicense'); ?>
		<?php echo $form->error($model,'driverslicense'); ?>
</span>
			<span class="full">
		<?php echo $form->textField($model,'patientlicense'); ?>
		<?php echo $form->labelEx($model,'patientlicense'); ?>
		<?php echo $form->error($model,'patientlicense'); ?>
</span>
			<span class="full">
	 <?php $url=Yii::app()->request->baseUrl; $this->widget('ext.EAjaxUpload.EAjaxUpload',
array(
        'id'=>'Patient_recFile',
        'config'=>array(
               'action'=>Yii::app()->request->baseUrl.'/patient/upload',
               'allowedExtensions'=>array("jpg","png","gif"),
               'sizeLimit'=>10*1024*1024,

              'onComplete'=>"js:function(id, fileName, responseJSON){ addRecFile(responseJSON.thumbname); $(this).val(responseJSON.thumbname); }",
               'messages'=>array(
                                'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                               'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                           'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                               'emptyError'=>"{file} is empty, please select files again without it.",
                              'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                             ),
              // 'showMessage'=>"js:function(message){ alert(message); }"
              )
)); ?>		<?php echo $form->labelEx($model,'recFile'); ?>
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/patient/default.jpg" alt="" id="thumbRecHolder" /> 
  	<?php echo $form->hiddenField($model,'recFile',array('id'=>'Patient_recFile')); ?>
		<?php echo $form->error($model,'recFile'); ?>
</span>
	<span class="full">
		<?php echo $form->textArea($model,'notes'); ?>
        		<?php echo $form->labelEx($model,'notes'); ?>
		<?php echo $form->error($model,'notes'); ?>

</span><span class="left">
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
						 array(
								 'model'=>'$model',
								 'name'=>'Patient[expiration]',
								 //'language'=>'de',
								 'value'=>$model->expiration,
								 'htmlOptions'=>array('size'=>10, 'style'=>'width:80px !important'),
									 'options'=>array(
									 'showButtonPanel'=>true,
									 'changeYear'=>true,
									 ),
								 )
							 );
					; ?>
		<?php echo $form->labelEx($model,'expiration'); ?>
		<?php echo $form->error($model,'expiration'); ?>
	
</span><span class="right">

		<?php echo $form->checkBox($model,'appointed'); ?>
        		<?php echo $form->labelEx($model,'appointed'); ?>
		<?php echo $form->error($model,'appointed'); ?>
	</span><span class="left">

	
</span><span class="right"><input type="submit" class="easyui-linkbutton" value="Create" /></span>




		
</li><ul>
<div class="clear"></div>
<?php $this->endWidget(); ?>
<script type="text/javascript">
function avatar(){
	var email=jQuery("#User_email").val();
$.get('<?php echo Yii::app()->request->baseUrl; ?>/patient/AjaxAvatar',{ User_email : email }, function(data) {
  $('#avatar').html(data);
});

	
}

function addDLImage(fileName){
     $('#Patient_dlCopy').val(fileName);  $('#thumbDlHolder').attr('src','<?php echo Yii::app()->request->baseUrl; ?>/images/patient/'+fileName); $('#mainDlImage').attr('src','<?php echo Yii::app()->request->baseUrl; ?>/images/patient/'+fileName);
}
    function addRecFile(fileName){
     $('#Patient_recFile').val(fileName);  $('#thumbRecHolder').attr('src','<?php echo Yii::app()->request->baseUrl; ?>/images/patient/'+fileName); $('#mainrecImage').attr('src','<?php echo Yii::app()->request->baseUrl; ?>/images/patient/'+fileName);
}

</script>
<!-- form -->