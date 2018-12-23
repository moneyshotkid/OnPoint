<?php
/* @var $this DispatcherController */

$this->breadcrumbs=array(
	'Dispatcher'=>array('/dispatcher'),
	'Map',
);
?><style>#map{
        height: 450px;
        width: 100%;
    }</style>
<div class="row">
    <div class="col-xs-12 col-lg-12">
        <div id="map"></div>
        </div></div>

        <div class="row">

            <div class="col-xs-12 col-lg-6">
                <div class="box">
                    <header>
                        <h5>Patients awaiting a Caregiver</h5>
                        <div class="toolbar">

                        </div>
                    </header>
                    <div id="condensedTable" class="body collapse in">
                        <table class="table table-condensed responsive-table">
                            <thead>
                            <tr>
                                <th>Time Waiting</th>
                                <th>Patient</th>
                                <th>Strains</th>
                                <th>Address</th>
                            </tr>
                            </thead>
                            <tbody>



                            <?php $url=Yii::app()->request->baseUrl; foreach($openorders as $order){
                                echo "  <tr> <td><abbr class='timeago' title='{$order['Timein']}'></abbr></td>
                                <td><a
                                href='{$url}/index.php/dispatcher/orderDetail/{$order['id']}'>{$order['name']}</a></td>

                                <td>{$order['requestedStrains']}</td>
                                <td>{$order['address']} {$order['city']} </td>
                            </tr>";

                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-xs-12 col-lg-6">
                <div class="box">
                    <header>
                        <h5>Assigned to Driver, Unfullfilled Request</h5>
                        <div class="toolbar">

                        </div>
                    </header>
                    <div id="condensedTable" class="body collapse in">
                        <table class="table table-condensed responsive-table">
                            <thead>
                            <tr>
                                <th>Patient</th>
                                <th>Caregiver</th>
                                <th>Strains</th>
                                <th>Time Waiting</th>
                            </tr>
                            </thead>
                            <tbody>



                            <?php  foreach($assigned as $a){
                                $id=$a['driver_id']; $d=User::model()->findbyPk($id); $name= $d->getFullName();
                                echo "  <tr>
                                <td><a
                                href='{$url}/index.php/dispatcher/orderDetail/{$a['id']}'>{$a['name']}</a></td>
                                <td>{$name} </td>
                                <td>{$a['requestedStrains']}</td>
                                <td><abbr class='timeago' title='{$a['Timein']}'></abbr></td>                          </tr>";

                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- /.col-lg-6 -->
 </div>
