<?php
/* @var $this PatientController */

$this->breadcrumbs=array(
	'Patient'=>array('/patient'),
	'Updatereq',
);
$baseurl="http://".$_SERVER['HTTP_HOST']."".Yii::app()->request->baseUrl."/images/patient/";

?>
<div class="row"> <div class="col-xs-12 col-md-12"><?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'patient-form',
            'enableAjaxValidation'=>false,
        ));?>

        <h1>VERIFICATION UPLOAD</h1>

    <div class="form">
        <div class="row">   <div class="col-xs-6 col-md-6"><?php if(@getimagesize($baseurl.''.$model['recFile'])){ ?> <div class="panel panel-info">  <!-- Default panel contents -->
                    <div class="panel-heading">Physician Recommendation (YOUR VERIFIED!)</div>
                    <div class="panel-body">  <input class="form-control"
                                                     name="Patient[patientlicense]" id="Patient_patientlicense"
                        type="text"
                                                     placeholder="Patient Verification Phone Number" value="<?php echo $model['patientlicense']; ?>" /><br/>  <img src="<?php echo Yii::app()
                            ->request->baseUrl; ?>/images/patient/<?php echo $model['recFile']; ?>"width="200px"
                                                                                                                                                                   height="200px" id="RHolder" /> <span
                            class="help-block"></span></div></div><?php }else{ ?>
                    <div class="panel panel-danger">  <!-- Default panel contents -->
                        <div class="panel-heading">Physician Recommendation (MISSING PLEASE UPLOAD)</div>
                        <div class="panel-body">    <!-- #left side patient License -->
                            <input class="form-control" name="Patient[patientlicense]" id="Patient_patientlicense" type="text"
                                   placeholder="Patient Verification Phone Number" value="<?php echo $model['patientlicense']; ?>" /><span
                                class="help-block"></span>
                            <?php $url=Yii::app()->request->baseUrl; $this->widget('ext.EAjaxUpload.EAjaxUpload',
                                array(
                                    'id'=>'Patient_recFile',
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
                                )); ?><span
                                class="help-block"></span>
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/patient/defaultrec.jpg" alt=""
                                 width="350px" height="200px" id="thumbRecHolder" />
                         <input type='hidden' name="Patient[recFile]" id="PatientFile" value="<?php echo $model['recFile']; ?>" />   <?php // echo $form->hiddenField($model,'recFile',array('id'=>'PatientFile')); ?>
                            <?php // echo $form->error($model,'recFile'); ?></div></div><?php } ?>

                <!-- #END left side patient License --></div>   <div class="col-xs-6 col-md-6">
                <!-- #right side drivers License --><?php if(@getimagesize($baseurl.''.$model['dlCopy'])){ ?> <div class="panel panel-info">  <!-- Default panel contents -->
                    <div class="panel-heading">Proof Of Identity (YOUVE BEEN VERFIED!)</div>
                    <div class="panel-body">   <input class="form-control" name="Patient[driverslicense]" id="Patient_driverslicense" type="text"
                                                      placeholder="Divers License/ID  Number" value="<?php echo $model['driverslicense'];
                        ?>"><br/> <span
                            class="help-block"></span>      <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/patient/<?php echo
                        $model['dlCopy']; ?>" width="200px" height="200px" alt=""  id="DHolder" /> <span
                            class="help-block"></span></div></div>
<?php }else{ ?><div class="panel panel-danger">  <!-- Default panel contents -->
                    <div class="panel-heading">Proof of Identity (MISSING PLEASE UPLOAD)</div>
                    <div class="panel-body">
                        <input class="form-control" name="Patient[driverslicense]" id="Patient_driverslicense" type="text"
                               placeholder="Divers License/ID  Number" value="<?php echo $model['driverslicense']; ?>"><span
                            class="help-block"></span>



                        <?php $url=Yii::app()->request->baseUrl; $this->widget('ext.EAjaxUpload.EAjaxUpload',
                            array(
                                'id'=>'Patient_dlCopy',
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
                            )); ?><span
                            class="help-block"></span>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/patient/defaultid.jpg"
                             width="350px" height="200px" alt=""
                             id="thumbDlHolder" /><span
                            class="help-block"></span>
<input type='hidden' id="Patientdl" name="Patient[dlCopy]" value="<?php echo $model['dlCopy']; ?>" />
                        <?php // echo $form->hiddenField($model,'dlCopy',array('id'=>'Patientdl')); ?>
                        <?php // echo $form->error($model,'dlCopy'); ?></div></div><?php } ?>

                <!-- #END of DL License --></div></div>

    </div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix --><?php if(!$disabled){ ?>
    <button class="btn btn-lg btn-primary btn-block signup-btn submit" name="submit_third"
            id="submit_third" type="submit">Update</button>
<?php } ?>
        <?php $this->endWidget(); ?> </div>
    </div> <!-- /row -->

<script type="text/javascript">

    $('document').ready(function(){
        $("#submit_third").click(function(){
            $('#patient-form').submit();
        })
    });
    function addDLImage(fileName){
        $('#Patientdl').val(fileName);  $('#thumbDlHolder').attr('src','<?php echo Yii::app()->request->baseUrl; ?>/images/patient/'+fileName); $('#mainDlImage').attr('src','<?php echo Yii::app()->request->baseUrl; ?>/images/patient/'+fileName);
    }
    function addRecFile(fileName){
        $('#PatientFile').val(fileName);  $('#thumbRecHolder').attr('src','<?php echo Yii::app()->request->baseUrl; ?>/images/patient/'+fileName); $('#mainrecImage').attr('src','<?php echo Yii::app()->request->baseUrl; ?>/images/patient/'+fileName);
    }

</script>