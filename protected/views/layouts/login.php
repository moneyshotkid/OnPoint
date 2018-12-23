<!doctype html>
<html class="no-js">
<head>
    <meta charset="UTF-8">
    <title>OnPoint - Login</title>

    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
<!--jQuery -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--Bootstrap -->
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>


<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script><script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-4065207-1', 'auto');
  ga('send', 'pageview');

</script></head>
<body>
<div class="container"><script type="text/javascript">
var LHCChatOptions = {};
LHCChatOptions.opt = {widget_height:340,widget_width:300,popup_height:520,popup_width:500,domain:'localhost'};
(function() {
var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
var refferer = (document.referrer) ? encodeURIComponent(document.referrer.substr(document.referrer.indexOf('://')+1)) : '';
var location  = (document.location) ? encodeURIComponent(window.location.href.substring(window.location.protocol.length)) : '';
po.src = '//localhost/Onpoint/connect/index.php/chat/getstatus/(click)/internal/(position)/middle_right/(check_operator_messages)/true/(top)/350/(units)/pixels/(leaveamessage)/true/(department)/1?r='+refferer+'&l='+location;
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();
</script>
    <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row-fluid user-row">
                        <img src="/images/btlogo.png" class="img-responsive" />
                    </div>
                </div>
                <div class="panel-body">

                    <?php echo CHtml::beginForm('','post',array('id'=>'loginform')); ?>
                        <fieldset>
                            <label class="panel-login">
                                <div class="login_result"> <?php
                                    $flashMessages = Yii::app()->user->getFlashes();
                                    if ($flashMessages) {
                                        echo '<div class="row">';
                                        foreach($flashMessages as $key => $message) {
                                            echo '<div class="alert alert-danger flash-' . $key . '" role="alert">' . $message . "</div>\n";
                                        }
                                        echo '</div>';
                                    }?></div>
                            </label>
                            <input type="text" placeholder="Username" name="UserLogin[username]" class="form-control top">
                            <input type="password" placeholder="Password" name="UserLogin[password]" class="form-control bottom">
                            <br></br>
                            <button class="btn btn-lg btn-primary btn-block" onclick="sendform()" type="submit">Sign in</button>
                            <?php echo CHtml::endForm(); ?>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">


    body {
        background-color: #444;
        background: url(<?php echo Yii::app()->request->baseUrl; ?>/images/logo_blank.png);

    }
    .form-signin input[type="text"] {
        margin-bottom: 5px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .form-signin .form-control {
        position: relative;
        font-size: 16px;
        font-family: 'Open Sans', Arial, Helvetica, sans-serif;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .vertical-offset-100 {
        padding-top: 100px;
    }
    .img-responsive {
        display: block;
        max-width: 100%;
        height: auto;
        margin: auto;
    }
    .panel {
        margin-bottom: 20px;
        background-color: rgba(255, 255, 255, 0.75);
        border: 1px solid transparent;
        border-radius: 4px;
        -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

</style>



<script type="text/javascript">
 $(document).ready(function() {
        $(document).mousemove(function(event) {
            TweenLite.to($("body"),
                .5, {
                    css: {
                        backgroundPosition: "" + parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / '12') + "px, " + parseInt(event.pageX / '15') + "px " + parseInt(event.pageY / '15') + "px, " + parseInt(event.pageX / '30') + "px " + parseInt(event.pageY / '30') + "px",
                        "background-position": parseInt(event.pageX / 8) + "px " + parseInt(event.pageY / 12) + "px, " + parseInt(event.pageX / 15) + "px " + parseInt(event.pageY / 15) + "px, " + parseInt(event.pageX / 30) + "px " + parseInt(event.pageY / 30) + "px"
                    }
                })
        })
    })
</script>

</html>
<?php
$form = new CForm(array(
    'elements'=>array(
        'username'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'password'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rememberMe'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
), $model);
?>