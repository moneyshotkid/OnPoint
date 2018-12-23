 <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">

            <!-- Brand and toggle get grouped for better mobile display -->
            <header class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>                <span
                        class="icon-bar"></span>   <span
                        class="icon-bar"></span>       <span
                        class="icon-bar"></span></button>


                <a href="index.php" class="navbar-brand">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/bg_h1.png" alt="">
                </a>
            </header>
            <div class="topnav">
                <div class="btn-group">
                    <a data-placement="bottom" data-original-title="Fullscreen" data-toggle="tooltip" class="btn btn-default btn-sm" id="toggleFullScreen">
                        <i class="glyphicon glyphicon-fullscreen"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a href='<?php echo Yii::app()->request->baseUrl; ?>/index.php/message/inbox/' data-placement="bottom" data-original-title="Inbox" data-toggle="tooltip" class="btn
                    btn-default btn-sm">
                        <i class="fa fa-envelope"></i>
                        <span class="label label-warning"><?php
                      echo   $this->getUnreadCount();   ?></span>
                    </a>



                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/logout/"
                       data-toggle="tooltip"
                       data-original-title="Logout" data-placement="bottom" class="btn btn-metis-1 btn-sm">
                        <i class="fa fa-power-off"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a data-placement="bottom" data-original-title="Show / Hide Left" data-toggle="tooltip" class="btn btn-primary btn-sm toggle-left" id="menu-toggle">
                        <i class="fa fa-bars"></i>
                    </a>
                    <a data-placement="bottom" data-original-title="Show / Hide Right" data-toggle="tooltip" class="btn btn-default btn-sm toggle-right"> <span class="glyphicon glyphicon-comment"></span>  </a>
                </div>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                <!-- .nav -->
<?php
                    switch($role){
                    case 'owner':
                        ?>

                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/menu"><i
                                    class="fa fa-tree"></i> Collection</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/dispatcher/map"><i
                                    class="fa fa-cogs"></i> Pipeline</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/dispatcher/drivers"><i
                                    class="fa fa-car"></i> Care Givers</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/user/index"><i
                                    class="fa fa-child"></i> Patients</a>
                            <ul class="collapse">
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/create"><i
                                            class="fa fa-group"></i> Register a Patient</a></li>
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/index"><i
                                            class="fa fa-support"></i> Patient Care</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/inventory/admin"><i
                                    class="fa fa-dashboard"></i> Inventory</a>
                            <ul class="collapse">
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/inventory/admin"><i
                                            class="fa fa-tasks"></i> Manage Inventory</a></li>
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/inventory/create"><i
                                            class="fa fa-plus-square"></i> Add Inventory</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/logout"><i class="fa
                fa-sign-out"></i> Logout (<?php echo Yii::app()->user->name; ?>)</a></li>
                        <?php

                    break;
                    case 'dispatcher':
                    ?>

                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/menu"><i
                                    class="fa fa-tree"></i> Collection</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/dispatcher/map"><i
                                    class="fa fa-cogs"></i> Pipeline</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/dispatcher/drivers"><i
                                    class="fa fa-car"></i> Care Givers</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/user/index"><i
                                    class="fa fa-child"></i> Patients</a>
                            <ul class="collapse">
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/create"><i
                                            class="fa fa-group"></i> Register a Patient</a></li>
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/index"><i
                                            class="fa fa-support"></i> Patient Care</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/inventory/admin"><i
                                    class="fa fa-dashboard"></i> Inventory</a>
                            <ul class="collapse">
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/inventory/admin"><i
                                            class="fa fa-tasks"></i> Manage Inventory</a></li>
                                <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/inventory/create"><i
                                            class="fa fa-plus-square"></i> Add Inventory</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/logout"><i class="fa
                fa-sign-out"></i> Logout (<?php echo Yii::app()->user->name; ?>)</a></li>
                    <?php



                    break;

                    case 'driver':



     ?>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/menu"><i class="fa
fa-tree "></i> Collection</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/create"><i class="fa fa-share-alt"></i> New
                                Applicant Form</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/driver/orders"><i class="fa fa-bullseye"></i> My
                                Appointments</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/logout"><i class="fa fa-sign-out"></i> Logout
                                (<?php echo Yii::app()->user->name; ?>)</a></li>

                    <?php
                    break;

                    case 'patient':


                    ?>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/menu"><i class="fa
fa-tree "></i> Collection</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/create"><i class="fa
            fa-share-alt"></i> New Applicant Form</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/records"><i class="fa
            fa-user"></i> My Information</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/patient/files"><i class="fa
            fa-legal"></i> Identification</a></li>
                        <li> <a href="<?php echo Yii::app()->request->baseUrl; ?>/site/page?view=connect"><i class="fa
            fa-link"></i>Connect</a></li>
                        <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php/user/logout"><i class="fa
            fa-sign-out"></i> Logout
                                (<?php echo Yii::app()->user->name; ?>)</a></li>

                    <?php
                    break;



                    }

                    ?></ul>
                <!-- /.nav -->
            </div>
        </div><!-- /.container-fluid -->
    </nav>