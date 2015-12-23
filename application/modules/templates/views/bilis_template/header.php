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
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
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
	                  <span class="hidden-xs"><?php echo $fname . ' ' . $lname; ?><span></span></span>
	                </a>
	                <ul class="dropdown-menu">
	                  <!-- User image -->
	                  <li class="user-header">
	                    <img src="<?php echo base_url() ?>assets/libs/theme/img/user.jpg" class="img-circle" alt="User Image">
	                    <p>
	                      <?php echo $fname . ' ' . $lname; ?><span></span>
	                      <small><?php echo $position ?></small>
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
      	<aside class="main-sidebar">
		  <!-- sidebar: style can be found in sidebar.less -->
		  <section class="sidebar">
		    <!-- Sidebar user panel -->
		    <div class="user-panel">
		      <div class="pull-left image">
		        <img src="<?php echo base_url() ?>assets/libs/theme/img/user.jpg" class="img-circle" alt="User Image">
		      </div>
		      <div class="pull-left info">
		        <p><?php echo $fname . ' ' . $lname ?></p>
		        <a href="#"><i class="fa fa-circle text-success"></i><?php echo $position ?></a>
		      </div>
		    </div>
		    <!-- search form -->
		    <form action="#" method="get" class="sidebar-form">
		      <div class="input-group">
		        <input type="text" name="q" class="form-control" placeholder="Search...">
		        <span class="input-group-btn">
		          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
		        </span>
		      </div>
		    </form>
		    <!-- /.search form -->
		    <!-- sidebar menu: : style can be found in sidebar.less -->
		    
		    <?php isset($sidebar) ? $this->load->view($sidebar): ''; ?>
		  </section>
		  <!-- /.sidebar -->
		</aside>
