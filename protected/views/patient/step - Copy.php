<style>
  #second_step, #third_step, #fourth_step {
        display: none;
    }

 #first_step, #second_step, #third_step, #fourth_step {
        padding-left: 35px;
        w/idth: 700px;
    }



    #progress_bar {
        background: url("<?php echo Yii::app()->request->baseUrl; ?>/images/progress_bar.png") no-repeat scroll 0 0
        transparent;
        width: 339px;
        height: 24px;
        margin: 0 auto;
        position: relative;
    }

    #progress {
        background: url("<?php echo Yii::app()->request->baseUrl; ?>/images/progress.png") repeat-x scroll 0 0 transparent;
        width: 0;
        height: 23px;
        border-radius: 20px 20px 20px 20px;
    }

    #progress_text {
        position: relative;
        line-height: 21px;
        text-align: center;
        font-weight: bold;
        color: white;
        text-shadow: 1px 1px 2px #222222;
        width: 339px;
        height: 24px;
        top: -23px;
        left: 0;
    }

</style>

     <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-form',
	'enableAjaxValidation'=>false,
));
          $baseUrl = Yii::app()->baseUrl;
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery.main.js');


   //Display status output for manager, owners, and admins
        //Display hidden inactive for all others

   $user = User::model()->notsafe()->findbyPk(Yii::app()->user->id) ;
$role=$user->role;
switch($role){
    case 'owner':
	$status=" <select name='User[status]'' id='User_status'>
<option value='0' >Not active</option>
<option value='1'>Active</option>
<option value='-1'>Banned</option>
</select> ";

        break;
        case 'manager':
$status=" <select name='User[status]'' id='User_status'>
<option value='0' >Not active</option>
<option value='1'>Active</option>
<option value='-1'>Banned</option>
</select> ";

        break;
    default:
        $status="<input type='hidden' name='User[status]' value='0' />";

        break;




}

        ?>






	


                <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <!-- #first_step -->
                            <div id="first_step">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                            <legend>New Member Application</legend>
                            <span class="help-block">Applicants complete this portion of the application.
                                </span>
<span class="help-block">Username</span>
                    <input type="text" name="User[username]" id="User_username" value=""  class="form-control
                            input-lg"
                           placeholer="username"
                        />   


                     <span class="help-block">Password</span>

                    <input type="password" name="User[password]" id="User_password" class="form-control input-lg"
                           placeholder="password" value="" /> 
<span class="help-block">Re-enter Password</span>
                    <input type="password" name="cpassword" id="cpassword" class="form-control input-lg"
                           placeholder="password" value="" /> 

</div> </div><div class="row">
                            <div class="col-xs-6 col-md-6"><span
                                            class="help-block">Medical Condition<?php echo $form->error($model,
                                                'condition'); ?></span>
                    <?php echo CHTML::activeDropDownList($model,'condition',$model->getConditionOptions(),array('class'=>'form-control input-lg')
                        ); ?> 
                            </div><div class="col-xs-6 col-md-6"><span
                                            class="help-block">Patient Phone Number</span>
        <input  class="form-control input-lg" name="Patient[phone]" id="Patient_phone" type="text" maxlength="15"
                placeholder="phone" />
 </div></div><div class="row"> <div class="col-xs-12 col-md-12">
<span
                                            class="help-block">Patient Email Address</span>
                    <input type="text" name="Patient[email]" id="Patient_email" onchange="avatar();"
                           placeholder="email address" value="" class="form-control input-lg" /> <span id="avatar"></span>

                                <span class="help-block">Click next and have your sponsor complete the remaining
                                steps.</span>
                <button class="btn btn-lg btn-primary btn-block signup-btn"  id="submit_first"  type="submit" name="submit_first"
                    >Next Step</button></div></div>
</div></div></div>
          <!-- clearfix --><div class="clear"></div><!-- /clearfix -->

                        <div class="row">
                            <div class="col-xs-12 col-md-12">
            <!-- #second_step -->
            <div id="second_step">

                    <div class="row">
                        <div class="col-xs-12 col-md-12">


                                <legend>New Member Application</legend>
                               <span
                                   class="help-block">Sponsors Please verify and complete the following portion for
                                   applicants </span>

                                <input type="hidden" name="User[superuser]" id="User_superuser" value="0">
  <input type="hidden" name="User[sponsor_id]" id="User_sponsor_id" value="<?php echo Yii::app()->user-id;?>">

  <input type="hidden" name="User[role]" id="User_role" value="patient" />

                  <span
                                    class="help-block">Full Address Address</span>
                    <input class="form-control input-lg" onblur="validate();" type="text" name="Patient[address]" id="Patient_address"
                           value="" placeholder="Street Address" /> <input type="hidden" name="Patient[city]" id="Patient_city" value=""> 
                              </div></div> <div class="row" id="slidedown">
                                    <div class="col-xs-6 col-md-6" id="addressconfirmation"></div>
                                    <div class="col-xs-6 col-md-6"><div id="mapholder"></div></div>
</div>				  <div class="row">
                        <div class="col-xs-12 col-md-12">	<span
                                    class="help-block">First and Last Name (ie: John Smith)</span>
                    <input class="form-control input-lg" type="text" name="Patient[name]" id="Patient_name" value=""
                           placeholder="Full Legal Name" /> 	</div></div>		<div class="row">   <div class="col-xs-12 col-md-12"><br/><br/>



                    
                    

                    <button class="btn btn-lg btn-primary btn-block signup-btn"  name="submit_second"
                            id="submit_second">Next</button></div></div>
                </div>

</div></div>
<div class="clear"></div><!-- /clearfix -->
            <!-- #third_step -->
<div class="row">
    <div class="col-xs-12 col-md-12">     <div id="third_step">
                <h1>VERIFICATION UPLOAD</h1>


    <div class="row">   <div class="col-xs-6 col-md-6"><div class="row"><div class="col-xs-6 col-md-6">  <?php $this->widget('zii.widgets.jui.CJuiDatePicker',
                                                array(
                                                        'model'=>'$model',
                                                        'name'=>'Patient[expiration]',
                                                        //'language'=>'de',
                                                        'value'=>$model->expiration,
                                                        'htmlOptions'=>array('class'=>'form-control input-lg',
                                                            'placeholder'=>'Expiration Date'),

                                                            'options'=>array(
                                                            'showButtonPanel'=>true,
                                                            'changeYear'=>true,
                                                            ),
                                                        )
                                                    );
                                            ?>  <span
                                            class="help-block">Date Dr Rec Expires<?php echo $form->error($model,'expiration'); ?>
 </span></div><div class="col-xs-6 col-md-6">
           <!-- #left side patient License -->
  <input class="form-control" name="Patient[patientlicense]" id="Patient_patientlicense" type="text"
         placeholder="Patient Verification Phone Number" value="" /></div></div><br/>
                   <?php $url=Yii::app()->request->baseUrl; $this->widget('ext.EAjaxUpload.EAjaxUpload',
                       array(
                           'id'=>'Patient_rFile',
                           'config'=>array(
                               'action'=>Yii::app()->createUrl('patient/upload'),
                               'allowedExtensions'=>array("jpg","png","gif"),
                               'sizeLimit'=>10*1024*1024,

                               'onComplete'=>"js:function(id, fileName, responseJSON){ addRecFile(fileName); }",
                               //var obj=new Object(); obj= $.parseJSON(responseJSON); $('#Products_mainImage').val({obj.filename}); $('#Products_thumbnailImage').val({obj.thumbname}); $('#mainImageHolder').attr('src','{$url}/images/products/{obj.filename}'); $('#thumbImageHolder').attr('src','{$url}/images/products/{obj.thumbname}');
                               'messages'=>array(
                                   'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                   'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                   'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                   'emptyError'=>"{file} is empty, please select files again without it.",
                                   'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                               ),
                               // 'showMessage'=>"js:function(message){ alert(message); }"
                           )
                       )); ?>
                   <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/patient/defaultrec.jpg" alt=""
                        width="300px" height="200px" id="thumbRecHolder" />
  	<?php echo $form->hiddenField($model,'recFile',array('id'=>'Patient_recFile')); ?>
		<?php echo $form->error($model,'recFile'); ?>

                  <!-- #END left side patient License --></div>   <div class="col-xs-6 col-md-6">
   <!-- #right side drivers License -->
 <input class="form-control" name="Patient[driverslicense]" id="Patient_driverslicense" type="text"
        placeholder="Divers License/ID  Number" value=""><br/>



<?php $url=Yii::app()->request->baseUrl; $this->widget('ext.EAjaxUpload.EAjaxUpload',
array(
        'id'=>'Patient_dCopy',
        'config'=>array(
               'action'=>Yii::app()->createUrl('patient/upload'),
               'allowedExtensions'=>array("jpg","png","gif"),
               'sizeLimit'=>10*1024*1024,

              'onComplete'=>"js:function(id, fileName, responseJSON){ addDLImage(fileName); }",
               'messages'=>array(
                                'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                               'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                           'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                               'emptyError'=>"{file} is empty, please select files again without it.",
                              'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
                             ),
              // 'showMessage'=>"js:function(message){ alert(message); }"
              )
)); ?>
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/patient/defaultid.jpg" width="300px" height="200px" alt=""
     id="thumbDlHolder" />

<?php echo $form->hiddenField($model,'dlCopy',array('id'=>'Patient_dlCopy')); ?>
		<?php echo $form->error($model,'dlCopy'); ?>


                   <!-- #END of DL License --></div></div>


                <button class="btn btn-lg btn-primary btn-block signup-btn submit" name="submit_third"
                       id="submit_third" >One Last Step. No More Typing. Next>> </button>

            </div>     </div></div>     <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
            
            
            <!-- #fourth_step -->
<div class="row">
    <div class="col-xs-12 col-md-12">     <div id="fourth_step"><div class="row">
                <div class="col-xs-12 col-md-12">
                <h1><span>CONFIRM</span> INFORMATION</h1>


                    <h4>Is this information correct?</h4>
                    
                    <table>
                        <tr><td>Username</td><td></td></tr>
                        <tr><td>Password</td><td></td></tr>
                        <tr><td>Email</td><td></td></tr>
                        <tr><td>Name</td><td></td></tr>

                    </table>
                  <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
               <button class="send submit btn btn-lg btn-primary btn-block signup-btn"
                       name="submit_fourth" id="submit_fourth" type="submit">Click to apply</button>
            </div></div></div><div class="row">
            <div class="col-xs-12 col-md-12 center-block"><div id="progress_bar">
            <div id="progress"></div>
            <div id="progress_text">0% Complete</div>
        </div></div></div></div></div>
 <?php $this->endWidget(); ?>
<script type="text/javascript">
function avatar(){
	var email=jQuery("#Patient_email").val();
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


