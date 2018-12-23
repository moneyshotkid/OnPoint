<?php echo $form->errorSummary($model);
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
// $cs->registerCssFile($baseUrl.'/css/style2.css');
$con = Yii::app()->db;
$sql = "SELECT * FROM `inventory` where currentweight>0";
$cmd = $con->createCommand($sql);
$dataReader = $cmd->query();
$data = $cmd->query();
$str = "";
$js = array();
while (($a = $data->read()) !== false) {
    $js[] = $a;
    $str .= "<option value=";
    $str .= $a['id'];
    $str .= ">";
    $str .= $a['strain'];
    $str .= "</option>";
}
$json = CJSON::encode($js);
$arr = $dataReader->readAll();

$user = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
$role = $user->role;
if ($role != "driver" || $role != "owner") {
    $readonly = "readonly";
} else {
    $readonly = "";
}

?>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-3">
        <?php if ($order->patient_id != "" && $order->patient_id < 0) {
            $this->widget('application.components.Relation', array(
                    'model' => 'Sales',
                    'relation' => 'patient',
                    'fields' => 'name',
                    'allowEmpty' => false,
                    'style' => 'dropdownlist',
                )
            );
        } ?>
        <input name="Sales[order_id]" id="Sales_orderid" type="hidden" value="<?php echo $order->id; ?>"/> <input
            name="Sales[patient_id]" id="Sales_Patientid" type="hidden" value="<?php echo $order->patient_id; ?>"/>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <table class="table table-hover">
            <tr>
                <th>Strain</th>
                <th>Qty</th>
                <th>Contribution</th>
                <th></th>

            </tr>

            <tr class="itemrow" id="copyrow">
                <td>
                    <input name="cpg0" id="cpg0" type="hidden" value=""/><input id="grade0" name="grade0" type="hidden"
                                                                                value=""/>
                    <select name="item[inventory_id][]" class="form-control" onChange="details(this.value,0);">
                       <option
                            value="">Choose a
                            strain
                        </option><?php echo $str; ?> </select></td>
                <td><input name="item[quantity][]" type="text" class="qty form-control" onchange="updatecost(this.value,
                0);"
                           id="qty0"
                           value=""/></td>
                <td><input name="item[cost][]" type="text" class="subtotal small form-control"
                           id="cost0" <?php echo $readonly; ?>
                           value=""/><input name="item[systemcost][]" id="systemcost0" type="hidden" value=""/><input
                        id="grade0" name="grade0" type="hidden" value=""/></td>

                <td><span class="remove btn btn-danger" onlick="remove('+v+');"><i
                            class="fa
    fa-trash"></i></span></td>
            </tr>
            <tr class="itemrow">
                <td colspan="4"><span id="details0"></span></td>
            </tr>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12"><a href="#" onClick="addRow();return false;" class="btn btn-default
pull-right"><i class="fa fa-plus"></i>Add</a></div>
</div>


<div class="row">
    <div class="col-md-3 col-md-offset-6">

        <?php echo $form->labelEx($model, 'paymentType'); ?> </div>
    <div class="col-md-3">
        <?php echo CHTML::activeDropDownList($model, 'paymentType', $model->getPaymentOptions()); ?>
        <?php echo $form->error($model, 'paymentType'); ?>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-md-offset-6">
        <label for="Sales_quantity">Quantity </label>

    </div>
    <div class="col-md-3">
        <input id="quantity" name="Sales[quantity]" class="small form-control" type="text"/>

    </div>
</div>


<div class="row">
    <div class="col-md-3 col-md-offset-6">

        <input name="Sales[date]" type="hidden" value="<?php echo strftime('%c'); ?>"/>
        <input name="Sales[employee_id]" type="hidden" value="<?php echo Yii::app()->user->id; ?>"/>
        <?php echo $form->error($model, 'date'); ?>

        <label for="Sales_total" class="required">Total <span class="required">*</span></label></div>
    <div class="col-md-3">


        <input id="total" name="Sales[total]" type="text" class="small form-control"/>

        <div id="Sales_total_em_"
             class="errorMessage"
             style="display:none"></div>
    </div>
</div>


<script type="application/javascript">
    var v = 0;
    function addRow() {
        v++;

        $(".itemrow:last").after('<tr class="itemrow" id="row' + v + '"><input type="hidden" name="item[sales_id][]" ' +
        'value=""/><input name="cpg' + v + '" id="cpg' + v + '" type="hidden" value="" /><input id="grade' + v + '" ' +
        'name="grade' + v + '" type="hidden" value="" />	<td><select name="item[inventory_id][]" ' +
        'class="form-control" onChange="details(this.value,' + v + ');"><option value="">Choose a ' +
        'strain</option><?php echo $str;  ?></select></td><td> <input type="text" name="item[quantity][]" id="qty' +
        v + '" class="small qty form-control" onchange="updatecost(this.value,' + v + ');" value="" /></td><td> ' +
        '<input type="text" id="cost' + v + '" name="item[cost][]" class="small subtotal form-control" value="" ' +
        '/><input name="item[systemcost][]" id="systemcost' + v + '" type="hidden" value="" /><input type="hidden" ' +
        'name="item[sales_id][]" value="" /></td><td><span class="remove btn btn-danger" onlick="remove(' + v + ');' +
        '"><i class="fa fa-trash"></i></span></td></tr><tr class="itemrow" id="rowd' + v + '"><td colspan="4"> <span id="details'
        + v
        + '"></span></td></tr>');
    }
    function details(id, index) {
	
        var currentweight = inventory.stock[id].currentweight;
        var thumbnail = inventory.stock[id].mainImage;
        var grade = inventory.stock[id].grade;
        var type = inventory.stock[id].type;
        var mar = parseInt(inventory.stock[id].operationalmargin);
        var cost = parseInt(inventory.stock[id].cost);
        var totalweight = parseInt(inventory.stock[id].weightrecieved);

        var costpergram = cost / totalweight;
        costpergram.toFixed(2);

        var retailcost = costpergram + mar;
        $('#cpg' + index).val(retailcost);
        var htmlstring = "<br/><img src='<?php echo $baseUrl; ?>/images/inventory/" + thumbnail + "' width='100px' height='100px' /> " + inventory.stock[id]
                .description + " " +
            "Appx:" + currentweight + "(g) " + type + " " + grade + " CPG " + retailcost.toFixed(2);

        $("#details" + index).html(htmlstring);
    }

    function updatecost(val, index) {
        var cpg = $('#cpg' + index).val();
        var cost = cpg * val;
        var money = cost.toFixed(2);
        $('#cost' + index).val(money);
        $('#systemcost' + index).val(money);
    }
    function remove(rowid) {

        $("#row" + rowid).remove();
        $("#rowd" + rowid).remove();
    }

    <?php
        echo "var inventory={stock:".$json."};";
 ?>


    jQuery(document).click(function () {
        var totalQuantity = 0;
        var totalCost = 0;
        $('.qty').each(function () {
            var quantity = parseInt(this.value);
            totalQuantity += quantity;
        });
        if (!isNaN(totalQuantity))$('#quantity').val(totalQuantity);
        $('.subtotal').each(function () {
            var sub = parseFloat(this.value);
            totalCost += sub;
        });
        if (!isNaN(totalCost))$('#total').val(totalCost.toFixed(2));

    });

</script>


		