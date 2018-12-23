<!DOCTYPE html>
<html class="no-js">
<head>
    <meta charset="UTF-8">
    <title><?php echo $this->pageTitle; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/assets/css/main.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery-ui.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker3.min.css">
    <link rel="stylesheet"
          href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css">
    <!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/lib/html5shiv/html5shiv.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/lib/respond/respond.min.js"></script>
    <![endif]-->
    <style>
        #selectable .ui-selecting {
            background: #ccc;
        }

        #selectable .ui-selected {
            background: #999;
        }

        .ui-selectee {
            padding-top: 25px;
        }
    </style>
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
</head>
<body>  <?php $new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
if (isset($new_password->role)){
$role = $new_password->role; ?>
<div class="bg-dark dk container-fluid" id="wrap">
    <div id="top">

        <!-- .navbar --><?php include('topmenu.php'); ?>
        <!-- /.navbar -->
        <header class="head">
            <div class="search-bar">

            </div>
            <!-- /.search-bar -->
            <div class="main-bar">
                <!--     <h3>
            <i class="fa fa-map-marker"></i>&nbsp;<?php #echo "";
                ?> </h3>-->
            </div>
            <!-- /.main-bar -->
        </header>
        <!-- /.head -->
    </div>
    <!-- /#top -->
    <div id="left">
        <div class="media user-media bg-dark dker">
            <div class="user-media-toggleHover">

                <span class="fa fa-user"></span>
            </div>
            <div class="user-wrapper bg-dark">
                <a class="user-link" href="">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo Yii::app()
                        ->request->baseUrl; ?>/assets/img/<?php switch ($role) {
                        case "driver":
                            echo "driver.png";
                            break;
                        case "dispatcher":
                            echo "dispatcher.png";
                            break;
                        case'patient':
                            echo "patient.png";
                            break;
                        default:
                            echo "user.gif";
                    }
                    ?>"
                        /></a>
                <!-- <span class="label label-danger user-label">0</span> -->

                <div class="media-body">
                    <h5 class="media-heading"><?php echo Yii::app()->user->name; ?></h5>
                    <ul class="list-unstyled user-info">
                        <li> <?php
                            echo $role;
                            } ?>  </li>
                        <?php if ($role == "driver" && $new_password->driverstatus == 1) { ?>
                            <li><a data-placement="bottom" data-original-title="Click here to checkout"
                                   data-toggle="tooltip" class="
                    driverstatus btn btn-success btn-sm" id="checkin"><i id="ico" class="fa fa-link"></i> Checked
                                    In</a></li>
                        <?php } else if ($role == "driver" && $new_password->driverstatus == 0) { ?>
                            <li><a data-placement="top"
                                   data-original-title="Click to Checkin" data-toggle="tooltip"
                                   class="driverstatus btn btn-danger btn-sm" id="checkout"><i
                                        class="fa fa-chain-broken"></i> Offline</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        <!-- #menu -->

        <?php

        include('sidemenu.php');


        ?>
    </div>
    <!-- /#left -->
    <div id="content">
        <div class="outer">
            <div class="inner bg-light lter">
                <?php
                $flashMessages = Yii::app()->user->getFlashes();
                if ($flashMessages) {
                    echo '<div class="row">';
                    foreach ($flashMessages as $key => $message) {
                        echo '<div class="alert alert-' . $key . '">' . $message . "</div>\n";
                    }
                    echo '</div>';
                }
                ?>

                <?php echo $content; ?>

            </div>
            <!-- /.inner -->
        </div>
        <!-- /.outer -->
    </div>
    <!-- /#content -->
    <div id="right" class="bg-dark lter">


        <div id="lhc_status_container_page"></div>

        <!-- Place this tag after the Live Helper Plugin tag. -->
        <script type="text/javascript">
            var LHCChatOptionsPage = {};
            LHCChatOptionsPage.opt = {};
            (function () {
                var po = document.createElement('script');
                po.type = 'text/javascript';
                po.async = true;
                po.src = '//<?php echo $_SERVER[HTTP_HOST]; ?><?php echo Yii::app()->request->baseUrl;
            ?>/connect/chat/getstatusembed/(leaveamessage)/+//true//+/(department)/1';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(po, s);
            })();
        </script>

    </div>
    <!-- /#right -->
</div>
<!-- /#wrap -->
<footer class="Footer bg-dark dker">


    <p>2017 &copy; NickNguyen.com</p>
</footer>
<!-- /#footer -->


<!--jQuery -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//maps.google.com/maps/api/js?sensor=true"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.12/gmaps.min.js"></script>-->
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
<!--Bootstrap -->
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<!-- Menu -->
<script src="//cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.js"></script>

<!-- Screenfull -->
<script src="//cdnjs.cloudflare.com/ajax/libs/screenfull.js/2.0.0/screenfull.min.js"></script>
<script
    src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js"></script>

<!-- core scripts -->
<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/core.min.js"></script>

<script type="text/javascript">
    var map;
    <?php $url=Yii::app()->request->baseUrl; if($role=="driver" && $new_password->driverstatus==1){ ?>
    var watchID = null;

    function f() {

        var options = {enableHighAccuracy: false, timeout: 5000, maximumAge: 0, desiredAccuracy: 0, frequency: 1};
        watchID = navigator.geolocation.watchPosition(onSuccess, onError, options);
    }
    function onSuccess(position) {
        $.ajax({
            url: '<?php echo $url; ?>/index.php/driver/Checkin',
            type: 'POST',
            data: {
                lat: position.coords.latitude,
                lon: position.coords.longitude,
                status:<?php echo $new_password->driverstatus; ?>
            },
            dataType: 'text'
        })

    }

    function clearWatch() {
        if (watchID != null) {
            navigator.geolocation.clearWatch(watchID);
            watchID = null;
        }
    }

    // onError Callback receives a PositionError object
    //
    function onError(error) {
        alert('code: ' + error.code + '\n' +
        'message: ' + error.message + '\n');
    }
    $(document).ready(function () {
        setInterval(f(), 15000);
    });
    <?php }else{ ?>



    <?php } ?>

</script>

<script>
    $(function () {
        //   Metis.MetisMaps();
        //   Metis.formGeneral();
    });
</script>

</body>
</html>