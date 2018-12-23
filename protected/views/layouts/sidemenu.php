<?php

    switch($role){
        case 'owner':
            $this->widget('zii.widgets.CMenu',array('htmlOptions'=>array('class'=>'bg-dark dker','id'=>'menu'),
                'items'=>array(
                    array('label'=>'Public Menu', 'url'=>array('/patient/menu')),
                    array('label'=>'Map', 'url'=>array('/dispatcher/map')),
                    array('label'=>'Balance Sheet', 'url'=>array('/dispatcher/balancesheet')),
                    array('label'=>'Caregivers', 'url'=>array('/dispatcher/drivers')),
                    array('label'=>'Vendors', 'url'=>array('/vendor/admin'), 'items'=>array(
                        array('label'=>'Add a Vendor', 'url'=>array('/vendor/create')),), 'visible'=>!Yii::app()->user->isGuest),
 array('label'=>'Patients', 'url'=>array('/dispatcher/patients'), 'items'=>array(
                        array('label'=>'Register a Patient', 'url'=>array('/patient/create')),
                        array('label'=>'Patient Care', 'url'=>array('/patient/admin')),),
                        'visible'=>!Yii::app()->user->isGuest),
 array('label'=>'Users', 'url'=>array('/user/admin'), 'items'=>array(
                        array('label'=>'Create', 'url'=>array('/user/create')))),

array('label'=>'Inventory', 'url'=>array('/inventory/admin'),'items'=>array(
                        array('label'=>'Add Inventory', 'url'=>array('/inventory/create')),), 'visible'=>!Yii::app()->user->isGuest),
array('label'=>'Report', 'url'=>array('/sales/admin'), 'visible'=>!Yii::app()->user->isGuest),
 array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ),
            ));

            break;
        case 'dispatcher':
            ?>
            <ul id="menu" class="bg-dark dker">
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/menu"><i
                            class="fa fa-tree"></i>   <span class="link-title"> Collection</span></a></li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/dispatcher/map"><i
                            class="fa fa-cogs"></i>   <span class="link-title"> Pipeline</span></a></li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/dispatcher/drivers"><i
                            class="fa fa-car"></i>    <span class="link-title">Care Givers</span></a></li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/user/index"><i
                            class="fa fa-child"></i>   <span class="link-title"> Patients</span></a>
                    <ul class="collapse">
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/create"><i
                                    class="fa fa-group"></i>   Register a Patient</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/user/index"><i
                                    class="fa fa-support"></i>  Patient Care</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/inventory/admin"><i
                            class="fa fa-dashboard"></i>   <span class="link-title"> Inventory</span></a>
                    <ul class="collapse">
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/inventory/admin"><i
                                    class="fa fa-tasks"></i> Manage Inventory</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/inventory/create"><i
                                    class="fa fa-plus-square"></i> Add Inventory</a></li>
                    </ul>
                </li>
                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/logout"><i class="fa
                fa-sign-out"></i>   <span class="link-title"> Logout (<?php echo Yii::app()->user->name; ?>)</span></a></li>
            </ul>  <?php



            break;

        case 'driver':



     ?><ul id="menu" class="bg-dark dker">
<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/menu"><i class="fa
fa-tree "></i>    <span class="link-title">Collection</span></a></li>
<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/create"><i class="fa fa-share-alt"></i>
        <span class="link-title">New Applicant Form</span></a></li>
<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/driver/orders"><i class="fa fa-bullseye"></i>
        <span class="link-title"> My Appointments</span></a></li>
<li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/logout"><i class="fa fa-sign-out"></i>   <span class="link-title"> Logout
        (<?php echo Yii::app()->user->name; ?>)</span></a></li>
</ul>
    <?php
break;

        case 'patient':


            ?><ul id="menu" class="bg-dark dker">
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/menu"><i class="fa
fa-tree "></i>    <span class="link-title">Collection</span></a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/create"><i class="fa
            fa-share-alt"></i>    <span class="link-title">New Applicant Form</span></a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/records"><i class="fa
            fa-user"></i>    <span class="link-title">My Information</span></a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/files"><i class="fa
            fa-legal"></i>    <span class="link-title">Identification</span></a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/site/page?view=connect"><i class="fa
            fa-link"></i>    <span class="link-title">Instant Message</span></a></li>
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/logout"><i class="fa
            fa-sign-out"></i>    <span class="link-title">Logout
                    (<?php echo Yii::app()->user->name; ?>)</span></a></li>
            </ul>
            <?php
            break;



    }
	
	?>