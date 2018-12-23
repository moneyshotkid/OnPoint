<script type="text/javascript">$(function(){
    //original field values
    var field_values = {
            //id        :  value
            'Username'  : 'Username',
            'password'  : 'password'
			
    };


    //inputfocus
    $('input#UserLogin_username').inputfocus({ value: field_values['Username'] });
    $('input#UserLogin_password').inputfocus({ value: field_values['password'] });
});

        function sendform() {
            document.getElementById("loginform").submit();
        }
    </script>




        <div class="tab-content">
            <div id="login" class="tab-pane active">
                <?php echo CHtml::beginForm('','post',array('id'=>'loginform')); ?>
                    <p class="text-muted text-center">
                        Enter your username and password
                    </p>
                    <input type="text" placeholder="Username" name="UserLogin[username]" class="form-control top">
                    <input type="password" placeholder="Password" name="UserLogin[password]" class="form-control bottom">
                    <div class="checkbox">
                        <label>
                            <input id="ytUserLogin_rememberMe" class="cbox" type="hidden" value="0" name="UserLogin[rememberMe]" /><input name="UserLogin[rememberMe]" id="UserLogin_rememberMe" value="1" type="checkbox" class="cbox" /> Remember Me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block" onclick="sendform()" type="submit">Sign in</button>
                <?php echo CHtml::endForm(); ?>
            </div>
            <div id="forgot" class="tab-pane">
                <form action="index.html">
                    <p class="text-muted text-center">Enter your valid e-mail</p>
                    <input type="email" placeholder="mail@domain.com" class="form-control">
                    <br>
                    <button class="btn btn-lg btn-danger btn-block" type="submit">Recover Password</button>
                </form>
            </div>
            <div id="signup" class="tab-pane">
                <form action="index.html">
                    <input type="text" placeholder="username" class="form-control top">
                    <input type="email" placeholder="mail@domain.com" class="form-control middle">
                    <input type="password" placeholder="password" class="form-control middle">
                    <input type="password" placeholder="re-password" class="form-control bottom">
                    <button class="btn btn-lg btn-success btn-block" type="submit">Register</button>
                  </form>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <ul class="list-inline">
                <li> <a class="text-muted" href="#login" data-toggle="tab">Login</a>  </li>
                <li> <a class="text-muted" href="#forgot" data-toggle="tab">Forgot Password</a>  </li>
                <li> <a class="text-muted" href="#signup" data-toggle="tab">Signup</a>  </li>
            </ul>
        </div>


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