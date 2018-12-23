<?php
/* @var $this PatientController */

$this->breadcrumbs=array(
	'Patient'=>array('/patient'),
	'Menu',
);
?>
 <h2>Todays
    Collection</h2> <?php $user= User::model()->notsafe()->findbyPk(Yii::app()->user->id) ; if($user->role==="patient"){ ?> <h4>
    </h4> <?php } ?>
<div
    class="row">

        <div class="col-md-12"  id="selectable">


            <?php $this->renderPartial('_productview',
                array('model'=>$model)

            ); ?>

</div>
</div> <?php $user= User::model()->notsafe()->findbyPk(Yii::app()->user->id) ; if($user->role=="patient"){ ?>
<div class="row">  <div class="col-md-10">   <a data-toggle="modal" data-original-title="Request a Caregiver"
                                                data-placement="bottom" class="btn btn-success
           btn-block" href="#helpModal">
        <i class="fa fa-ambulance"></i> Initiate CareGiver Request
    </a></div></div><?php } ?>

<!-- #helpModal -->
<div id="helpModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Note to Caregiver</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">

                            <div class="body">
                                <div id="strainsd"></div>
                                <form class="form-horizontal" id="oform" action="<?php echo $this->createUrl
                                    ('/orders/create');?>" type="POST">
                                <h5>Is there anything you would like your caregiver to know prior to arrival? (ie:
                                    Looking for Sativas, etc)
                                </h5>
                                    <div class="form-group">

                                        <div class="col-lg-12">
                                            <input type="hidden" name="orders[status]"  value="open" /> <input type="hidden"  name="orders[requestedStrains]" value="" id="requestedStrains" />
                                            <input type="hidden" name="orders[patient_id]"  value="<?php echo Yii::app()->user->id; ?>" />      <textarea class="form-control" name="orders[patientnote]" id="autosize" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 70px;"></textarea>
                                    <select name="orders[driver_id]">  <option value=""></option>  <?php
                                        foreach
                                        ($dri as $t) {

                                            $id = $t['driver_id'];

                                            $do = User::model()->findbyPk($id);
                                            $name = $do->getFullName();
                                       echo "<option value='$id'>$name</option>";
} ?></select>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
            <div class="modal-footer">

            <button type="button" type="submit" id="btninv" class="btn btn-block btn-success"><i class="fa
            fa-thumbs-up"></i>Get My Caregiver!!</button></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --><!-- /#helpModal -->
<style>
.glass {
  width: 175px;
  height: 175px;
  position: absolute;
  border-radius: 50%;
  cursor: crosshair;
  
  /* Multiple box shadows to achieve the glass effect */
  box-shadow:
    0 0 0 7px rgba(255, 255, 255, 0.85),
    0 0 7px 7px rgba(0, 0, 0, 0.25), 
    inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
  
  /* hide the glass by default */
  display: none;
}

</style>
<script type="text/javascript">

    $('document').ready(function(){
        $("#btninv").click(function(){
            $('#oform').submit();
        })
    });
    </script>