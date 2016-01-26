
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BILIS | Log in</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/font-awesome-4.5.0/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/theme/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/libs/iCheck/square/blue.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/media.css">

  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <!-- <b>BILIS</b> Login -->
        <a href=""><img src="assets/img/beep_logo.JPG" alt=""></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <div id="errmsg" class="callout callout-danger"></div>
        <div class="text-center" style="margin-bottom: 20px;" id="notif_message_log"></div>
        <form name="loginForm" id="loginForm" method="POST">
          <div class="form-group has-feedback">
            <div class="slide-out">
              <input type="text" class="form-control" id="emp_no" name="emp_no" placeholder="Enter employee number" style="margin-bottom: 15px">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
              <div class="row">
                <div class="col-xs-12">
                  <div id="empnokeys" class="keys">
                    <button type="button" value="1">1</button>
                    <button type="button" value="2">2</button>
                    <button type="button" value="3" class="operator">3</button>
                    <button type="button" value="4">4</button>
                    <button type="button" value="5">5</button>
                    <button type="button" value="6" class="operator">6</button>
                    <button type="button" value="7">7</button>
                    <button type="button" value="8">8</button>
                    <button type="button" value="9" class="operator">9</button>
                    <button type="button" value="CLR" class="clear">CLR</button>
                    <button type="button" value="0">0</button>
                    <button type="button" class="operator proceed" value="backspace"><i class="fa fa-long-arrow-left" style="font-size: 11px"></i> Backspace</button>
                  </div>
                </div>
                <!-- <div class="col-xs-8">
                  <div class="checkbox icheck">
                    <label class="">
                      <div class="icheckbox_square-blue" aria-checked="true" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div> Remember Me
                    </label>
                  </div>
                </div> -->
                <div class="col-xs-12">
                  <button id="next-btn" class="btn btn-success btn-block btn-flat">Next</button>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group has-feedback">
            <div class="slide-in hide-form">
              <div class="clearfix" style="position: relative">
                <p id="employeename"></p><p id="notyou">(<span>Not You?</span>)</p>
              </div>
              <div style="position: relative">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" style="margin-bottom: 15px">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-12">
                  <div id="passkeys" class="keys">
                    <button type="button" value="1">1</button>
                    <button type="button" value="2">2</button>
                    <button type="button" value="3" class="operator">3</button>
                    <button type="button" value="4">4</button>
                    <button type="button" value="5">5</button>
                    <button type="button" value="6" class="operator">6</button>
                    <button type="button" value="7">7</button>
                    <button type="button" value="8">8</button>
                    <button type="button" value="9" class="operator">9</button>
                    <button type="button" value="CLR" class="clear">CLR</button>
                    <button type="button" value="0">0</button>
                    <button type="button" class="operator proceed" value="backspace"><i class="fa fa-long-arrow-left" style="font-size: 11px"></i> Backspace</button>
                  </div>
                </div> <!-- /.col -->
                <div class="col-xs-8">
                  <div class="checkbox icheck">
                    <label class="">
                      <div class="icheckbox_square-blue" aria-checked="true" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div> Remember Me
                    </label>
                  </div>
                </div>
                <div class="col-xs-4">
                  <button type="submit" id="signin-btn" class="btn btn-success btn-block btn-flat">Sign In</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/libs/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/icheck/iCheck.min.js"></script>
    <!-- Custom -->
    <!-- <script src="js/js-custom.js"></script>-->
    <script src="<?php echo base_url(); ?>assets/js/login.js"></script>
  </body>
</html>