	<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BEEP INTEGRATED LOGISTICS INFORMATION SYSTEM</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>assets/libs/theme/img/favicon.ico">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php echo $css; ?>
  </head>
  <!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
  <!-- the fixed layout is not compatible with sidebar-mini -->
  <body class="page-<?php echo($this->uri->segment(1)); ?> hold-transition skin-blue fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
		<header class="main-header">
	        <!-- Logo -->
	        <a href="attendance.php" class="logo">
	          <!-- mini logo for sidebar mini 50x50 pixels -->
	          <span class="logo-mini"><b>B</b>ILIS</span>
	          <!-- logo for regular state and mobile devices -->
	          <span class="logo-lg"><b>B</b>ILIS</span>
	        </a>
	        <!-- Header Navbar: style can be found in header.less -->
	        <nav class="navbar navbar-static-top" role="navigation">
	          <!-- Sidebar toggle button-->
	          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </a>
	          <div class="navbar-custom-menu">
	            <ul class="nav navbar-nav">
	              <!-- User Account: style can be found in dropdown.less -->
	              <li class="dropdown user user-menu">
	                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	                  <img src="<?php echo base_url() ?>assets/libs/theme/img/user.jpg" class="user-image" alt="User Image">
	                  <span class="hidden-xs">test<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp</span></span>
	                </a>
	                <ul class="dropdown-menu">
	                  <!-- User image -->
	                  <li class="user-header">
	                    <img src="<?php echo base_url() ?>assets/libs/theme/img/user.jpg" class="img-circle" alt="User Image">
	                    <p>
	                      test
	                      <small>test</small>
	                    </p>
	                  </li>
	                  <!-- Menu Footer-->
	                  <li class="user-footer">
	                    <div class="pull-left">
	                      <a href="#" class="btn btn-default btn-flat fa fa-user"> Profile</a>
	                    </div>
	                    <div class="pull-right">
	                      <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat fa fa-sign-out"> Sign out</a>
	                    </div>
	                  </li>
	                </ul>
	              </li>
	            </ul>
	          </div>
	        </nav>
      	</header>


      