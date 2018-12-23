<div class="row"> <div class="col-xs-12 col-md-12"><div class="row"> <div
                    class="col-xs-12 col-md-12"><input name="Inventory[strain]"
                                                                                 id="Inventory_strain"
                                                                                 type="text" class="form-control"
                                                                                 placeholder="Strain Name/Product Name
                                                                                 "/><span
                        class="help-block"></span></div></div><div class="row">

<?php echo $form->errorSummary($model);           $baseUrl = Yii::app()->baseUrl;
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery.onemain.js');
$cs->registerScript("typedrop","function answers(){
var answer=document.getElementById('typedrop');
 if(answer[answer.selectedIndex].value=='Hybrid' || answer[answer.selectedIndex].value=='Sativa' || answer[answer
 .selectedIndex].value=='Indica'){  $('.trees').show(); $('#Inventory_cpg').attr({placeholder:'Cost Per Gram'});$
 ('#Inventory_cpg').attr({name:'Inventory[cpg]'});$('#weight').attr
 ({placeholder:'Total Grams Aquired'});$('Inventory_cost').attr({placeholder:'Total Amount Paid'});
 }else{
$('.trees').hide();$('#weight').attr({placeholder:'Number of Units'});$('Inventory_cost').attr({placeholder:'Cost Per Unit'});
$('#Inventory_cpg').attr({placeholder:'Price'});$
 ('#Inventory_cpg').attr({name:'Inventory[productprice]'});
 }
}",CClientScript::POS_HEAD);
  
   ?>





    <div class="col-xs-6 col-md-6">
<?php echo CHTML::activeDropDownList($model,'type',$model->getTypeOptions(),array('class'=>'form-control',
    'id'=>'typedrop',"onchange"=>"javascript:answers();")); ?> <span
            class="help-block"></span> </div>  <div class="col-xs-12 col-md-6"><?php echo CHTML::activeDropDownList($model,'grade',$model->getQualityGradeOptions(),
            array('class'=>'form-control')); ?><span
                        class="help-block"></span></div></div> <div class="row"> <div class="col-xs-12 col-md-6"><input
            id="weight" class="form-control" onchange="$('#currentweight').val(this.value);"
            name="Inventory[weightrecieved]" type="text" placeholder="Total Weight Acquired in grams"/><span
                        class="help-block"><?php echo
                        $form->error($model,
                            'weightrecieved'); ?> </span></div>  <div class="col-xs-12 col-md-6"><input name="Inventory[cost]" id="Inventory_cost"
                                                                       type="text" class="form-control"
                                                                       placeholder="Total amount paid"/><a href="#"
                                                                                                           onClick="$('#margin').css('visibility','visible'); return false;">*</a><?php echo $form->textField($model,'operationalmargin',array('id'=>'margin','class'=>'form-control')); ?><span
                        class="help-block"></span>
    </div></div> <div class="row"> <div class="col-xs-6 col-md-6">


 <?php echo  CHTML::activeDropDownList($model,'paymentstatus',$model->getPaymentStatusOptions(),
     array('class'=>'form-control','placeholer'=>'Payment Status')); ?><?php echo $form->error($model,
     'paymentstatus'); ?><span
                        class="help-block"></span>
   <input type="hidden" name="Inventory[currentweight]" id="currentweight"  value="" />

<input type="hidden" name="Inventory[daterecieved]" value="<?php echo strftime('%c'); ?>" />
    </div>  <div class="col-xs-12 col-md-6">

<?php $date=(isset($model->duedate))?$model->duedate:"Due Date"; ?>
		
<?php $this->widget('zii.widgets.jui.CJuiDatePicker',
						 array(
								 'model'=>'$model',
								 'name'=>'Inventory[duedate]',
								 'value'=>$date,
								 'htmlOptions'=>array('class'=>'form-control','placeholder'=>'Due Date'),
									 'options'=>array(
									 'showButtonPanel'=>true,
									 'changeYear'=>true,
									 ),

							 ));
				 ?>
<?php echo $form->error($model,'duedate'); ?>
<!--<input type="hidden" name="Inventory[mainImage]" id="img" value="" />-->
    </div></div> <span
                class="help-block"></span><div class="row"> <div class="col-xs-12 col-md-6">
  <input name="Inventory[cpg]" id="Inventory_cpg" type="text" class="form-control" placeholder="Price per Gram"/>
  <span
      class="help-block"></span>  </div>  <div
        class="col-xs-12  col-md-6"><input name="Inventory[twograms]" id="Inventory_twograms" type="text" class="form-control
        trees" placeholder="Price for 1/8"/>	</div></div><span
                class="help-block"></span> <div class="row"> <div
        class="col-xs-12 col-md-6"><input name="Inventory[eigth]" id="Inventory_eigth" type="text" class="form-control trees"
                                placeholder="Price for 1/4" /> </div>  <div class="col-md-6"><input
            name="Inventory[fourgrams]" id="Inventory_fourgrams" type="text" class="form-control trees" value=""
            placeholder="Price for 1/2"/>
    </div></div> <span
                class="help-block">Upload an Product Image</span><div class="row">  <div
                class="col-xs-12 col-md-6"> <?php $url=Yii::app()->request->baseUrl; $this->widget('ext.EAjaxUpload.EAjaxUpload',
                array(
                    'id'=>'minImag',
                    'config'=>array(
                        'action'=>Yii::app()->createUrl('inventory/upload'),
                        'allowedExtensions'=>array("jpg","png","gif"),
                        'sizeLimit'=>10*1024*1024,

                        'onComplete'=>"js:function(id, fileName, responseJSON){ addImage(fileName); }",
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
                )); ?></div> <div
                class="col-xs-12 col-md-6">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/patient/default.jpg" alt=""
                 width="200px" height="200px" id="thumbHolder" />
            <?php echo $form->hiddenField($model,'mainImage',array('id'=>'img')); ?></div>
</div><div class="clear-fix"></div>
 <div class="row"> <div class="col-xs-12 col-md-12"><textarea name="Inventory[description]" class="form-control"
                                                    placeholder="Product Description"
             ></textarea></div></div><div class="clear-fix"></div>
        <div class="row"> <div class="col-xs-12 col-md-12">  <input name="submit" class="btn btn-lg btn-primary btn-block signup-btn"
type="submit"          value="submit" id="btninv" /></div></div>
  </div></div>

   
<script type="text/javascript">
    $("#btninv").click(function(){
        $('#inventory-form').submit();
    });
$('#margin').css('visibility','hidden');
                $('document').ready(function(){

                    $('#weight').focusout(function(){
                var weight=$(this).val();
                parseFloat(weight);
                if(weight<20){
                    var grams=453*weight;
                    parseInt(grams);
                    $('#weight').val(grams);
                    $('#currentweight').val(grams);
                }else{
                    $('#currentweight').val(grams);
                }
                 });
                    });
function addImage(fileName){
     $('#img').val(fileName);  $('#thumbHolder').attr('src','<?php echo Yii::app()->request->baseUrl; ?>/images/inventory/'+fileName);
}
			</script>