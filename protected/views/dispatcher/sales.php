<?php
/* @var $this DispatcherController */

$this->breadcrumbs=array(
	'Dispatcher'=>array('/dispatcher'),
	'Sales',
);
?>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="box">
            <header>
                <h5>Caregiver Report</h5>
                <div class="toolbar">

                </div>
            </header>
            <div id="condensedTable" class="body collapse in">
                <table class="table table-condensed responsive-table">
                    <thead>
                    <tr>
                        <th>Driver</th>
                        <th>Donation Date</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Paid With</th>
                        <th>Patient Name</th>
                        <th>City</th>
                        <th>Notes</th>
                    </tr>
                    </thead>
                    <tbody>



                    <?php $url=Yii::app()->request->baseUrl; foreach($drivers as $a){
                        $d=strtotime($a['date']);

                        echo "  <tr>
                                <td>{$a['username']}</td>
                                   <td>{$a['date']}<?php // echo date('m-d-Y H:i:s',$d); ?></td>
                                <td>{$a['quantity']}</td>
                                   <td>{$a['total']}</td>
                        <td>{$a['paymentType']}</td>
                        <td>{$a['name']}</td>
                        <td>{$a['city']}</td>
                        <td>{$a['notes']}</td>
                            </tr>";

                    }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /.col-lg-6 -->
    </div>