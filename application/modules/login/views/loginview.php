
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

  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><b>BILIS</b> Login</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <div class="text-center" style="margin-bottom: 20px;" id="notif_message_log"></div>
        <form name="loginForm" id="loginForm" method="POST">
          <div id="errmsg" class="callout callout-danger">
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" id="emp_no" name="emp_no" placeholder="Enter employee number">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
<!--           <div class="form-group has-feedback">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div> -->
          <div class="row">
            <div class="col-xs-12">
              <table class="table table-bordered text-center">
                    <tbody>
                      <tr>
                        <td width="33%"><button type="button" class="btn btn-block btn-primary btn-sm btn-block" value="1" onClick="addNumber(this)">1</button></td>
                        <td width="33%"><button type="button" class="btn btn-block btn-primary btn-sm btn-block" value="2" id="2" onClick="addNumber(this)">2</button></td>
                        <td width="33%"><button type="button" class="btn btn-block btn-primary btn-sm btn-block" value="3" id="3" onClick="addNumber(this)">3</button></td>
                      </tr>
                      <tr>
                        <td width="33%"><button type="button" class="btn btn-block btn-primary btn-sm btn-block" value="4" id="4" onClick="addNumber(this)">4</button></td>
                        <td width="33%"><button type="button" class="btn btn-block btn-primary btn-sm btn-block" value="5" id="5" onClick="addNumber(this)">5</button></td>
                        <td width="33%"><button type="button" class="btn btn-block btn-primary btn-sm btn-block" value="6" id="6" onClick="addNumber(this)">6</button></td>
                      </tr>
                      <tr>
                        <td width="33%"><button type="button" class="btn btn-block btn-primary btn-sm btn-block" value="7" id="7" onClick="addNumber(this)">7</button></td>
                        <td width="33%"><button type="button" class="btn btn-block btn-primary btn-sm btn-block" value="8" id="8" onClick="addNumber(this)">8</button></td>
                        <td width="33%"><button type="button" class="btn btn-block btn-primary btn-sm btn-block" value="9" id="9" onClick="addNumber(this)">9</button></td>
                      </tr>
                      <tr>
                        <td width="33%"><button type="button" class="btn btn-block btn-danger btn-sm btn-block" value="CLR" id="CLR" onClick="clrNumber(this)">CLR</button></td>
                        <td width="33%"><button type="button" class="btn btn-block btn-primary btn-sm btn-block" value="0" id="0" onClick="addNumber(this)">0</button></td>
                        <td width="33%"><button type="button" id="log_btn" class="btn btn-block btn-success btn-sm btn-block" onclick="log_username()">OK</button></td>
                      </tr>
                    </tbody>
                  </table>
            </div><!-- /.col -->
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
    <script type='text/javascript'>
      function addNumber(element){
        document.getElementById('emp_no').value = document.getElementById('emp_no').value+element.value;
      }
      function clrNumber(element){
        document.getElementById('emp_no').value = '';
      }

      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>