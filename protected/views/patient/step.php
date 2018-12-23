    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patient-form',
	'enableAjaxValidation'=>false,
));
          $baseUrl = Yii::app()->baseUrl;
  //$cs = Yii::app()->getClientScript();
  //$cs->registerScriptFile($baseUrl.'/js/jquery.main.js');


  ?>




    <div class="row">
        <div class="col-xs-12 col-md-12">
    <?php echo $form->errorSummary(array($Patient,$User)); ?>
</div></div>
    <legend>New Member Application</legend>  <div class="row">
        <div class="col-xs-12 col-md-12">	<span
                class="help-block">First and Last Name (ie: John Smith)</span>
            <?php echo $form->textField($Patient,'name',array('class'=>"form-control",
                "placeholder"=>"Name","id"=>"Patient_name",
                "required"=>"required"));
            ?>	</div></div>
    <div class="row">
        <div class="col-xs-12 col-md-12">



            <input type="hidden" name="User[superuser]" id="User_superuser" value="0">
            <input type="hidden" name="User[sponsor_id]" id="User_sponsor_id" value="<?php echo Yii::app()->user-id;?>">
            <input type="hidden" name="User[lat]" id="User_lat" value="<?php echo $User->lat; ?>">
            <input type="hidden" name="User[lon]" id="User_lon" value="<?php echo $User->lon; ?>">
            <input type="hidden" name="User[role]" id="User_role" value="patient" />

                  <span
                      class="help-block">Full Address <?php echo $form->error($Patient,'address'); ?></span>
            <?php echo $form->textField($Patient,'address',array('class'=>"form-control",
                "placeholder"=>"Address","onblur"=>"validate();","id"=>"Patient_address",
                "required"=>"required"));
            ?>

        </div></div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Is this the correct address?</h4>
                </div>
                <div class="modal-body">
                    <div class="row" id="slidedown">
                        <div class="col-xs-5 col-md-5" id="addressconfirmation"></div>
                        <div class="col-xs-5 col-md-5"><div id="mapholder"></div></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Yup thats me!!</button>

                </div>
            </div>
        </div>
    </div><!--END Modal-->

    <div class="row">
        <div class="col-xs-6 col-md-6"><span
                class="help-block">City</span><input type="text" class="form-control" name="Patient[city]" id="Patient_city" value="<?php
            echo
            $Patient->city; ?>" placeholder="City" /></div><div class="col-xs-6 col-md-6"><span
                class="help-block">Zip</span>  <input type="text" name="Patient[zip]" id="Patient_zip"
                                                      placeholder="Zipcode" value="<?php echo
            $Patient->zip; ?>" class="form-control" /></div></div>

    <div class="row">
                                    <div class="col-xs-12 col-md-12">


<span class="help-block">Username</span>
                                        <?php echo $form->textField($User,'username',array('class'=>"form-control",
                                            "placeholder"=>"Username",
                                            "required"=>"required"));
                                        ?>

                                   </div>     <div class="col-xs-6 col-md-6">     <span class="help-block">Password
                <?php echo $form->error($User,'password'); ?>
            </span>

                                        <?php echo $form->passwordField($User,'password',array('class'=>"form-control",
                                            "placeholder"=>"Password",
                                            "required"=>"required"));
                                        ?>
        </div>     <div class="col-xs-6 col-md-6">
<span class="help-block">Re-enter Password</span>
                    <input type="password" name="cpassword" id="cpassword" class="form-control"
                           placeholder="Re-enter password" value="" />

</div> </div><div class="row">
                            <div class="col-xs-6 col-md-6"><span
                                            class="help-block">Medical Condition<?php echo $form->error($Patient,
                                                'condition'); ?></span>
                    <?php echo CHTML::activeDropDownList($Patient,'condition',$Patient->getConditionOptions(),array
                        ('class'=>'form-control')
                        ); ?> 
                            </div><div class="col-xs-6 col-md-6"><span
                                            class="help-block">Patient Phone Number   <?php echo $form->error
                ($Patient,'phone'); ?></span>
        <?php echo $form->telField($Patient,'phone',array('class'=>"form-control",
            "placeholder"=>"Phone Number",
            "required"=>"required"));
        ?>

    </div></div><div class="row"> <div class="col-xs-12 col-md-12">
<span
                                            class="help-block">Patient Email Address   <?php echo $form->error
    ($User,'email'); ?></span>
        <?php echo $form->emailField($User,'email',array('class'=>"form-control",
            "placeholder"=>"Email",
            "required"=>"required"));
        ?>
        <span id="avatar"></span>


             </div></div>

  

                

             	<div class="row">   <div class="col-xs-12 col-md-12"><br/><br/> <button class="send submit btn btn-lg btn-primary btn-block signup-btn"
                       name="submit_fourth" id="submit_fourth" type="submit">Click to apply</button>


                    
                    

            
            
           
        </div></div><!-- Modal -->

 <?php $this->endWidget(); ?>
<script type="text/javascript">
function avatar(){
	var email=jQuery("#Patient_email").val();
$.get('<?php echo Yii::app()->request->baseUrl; ?>/patient/AjaxAvatar',{ User_email : email }, function(data) {
  $('#avatar').html(data);
});

	
}



</script>


