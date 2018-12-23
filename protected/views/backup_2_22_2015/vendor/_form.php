
	<div id="container">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'vendor-form',
	'enableAjaxValidation'=>false,
)); $baseUrl = Yii::app()->baseUrl;
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile($baseUrl.'/js/jquery.onemain.js');
 ?>
	<?php echo $form->errorSummary($model); ?>

  <div id="one_step">
                <h1><span>Canna Cafe</span> Vendors</h1>

	
	<ul><li>	<input name="Vendor[company]" id="Vendor_company" type="text" VALUE="Cultivator Name"/>     </li>
		
<li>

		<input name="Vendor[phone]" id="Vendor_phone" type="text" class="small" value="phone" />
		
<input name="Vendor[approved]" id="Vendor_approved" value="1" type="hidden" />      </li><li>
		Notes: <textarea rows="4" cols="30" name="Vendor[notes]" id="Vendor_notes"></textarea> </li><li> 		  <input class="send submit" type="submit" name="submit_fourth" id="submitnow" value="" /> </li></ul>    </div>


<?php $this->endWidget(); ?>
</div>
<!-- form -->