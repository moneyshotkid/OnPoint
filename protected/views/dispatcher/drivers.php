<?php
/* @var $this DispatcherController */

$this->breadcrumbs=array(
	'Dispatcher'=>array('/dispatcher'),
	'Drivers',
);
?>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <div class="box">
            <header>
                <h5>Caregivers</h5>
                <div class="toolbar">

                </div>
            </header>
            <div id="condensedTable" class="body collapse in">
                <table class="table table-condensed responsive-table">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Last Login</th>
                    </tr>
                    </thead>
                    <tbody>



                    <?php $url=Yii::app()->request->baseUrl; foreach($drivers as $a){
                        $d=strtotime($a['lastvisit']);
                        $status=$a['driverstatus']==1?"Avaliable":"Unavaliable";
                        echo "  <tr>
                                <td>{$a['username']}</td>
                                <td>{$a['email']}</td>
                                <td>{$status}</td>
                                <td><?php echo date('m-d-Y',$d); ?></td>
                            </tr>";

                    }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!-- /.col-lg-6 -->
    </div>