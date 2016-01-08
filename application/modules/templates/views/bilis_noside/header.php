
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BILIS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php echo $css; ?>
  </head>

  <body class="page-<?php echo($this->uri->segment(1)); ?> hold-transition skin-blue layout-top-nav">

<div class="spinner-cont">
   <div class="sk-circle">
      <div class="sk-circle1 sk-child"></div>
      <div class="sk-circle2 sk-child"></div>
      <div class="sk-circle3 sk-child"></div>
      <div class="sk-circle4 sk-child"></div>
      <div class="sk-circle5 sk-child"></div>
      <div class="sk-circle6 sk-child"></div>
      <div class="sk-circle7 sk-child"></div>
      <div class="sk-circle8 sk-child"></div>
      <div class="sk-circle9 sk-child"></div>
      <div class="sk-circle10 sk-child"></div>
      <div class="sk-circle11 sk-child"></div>
      <div class="sk-circle12 sk-child"></div>
    </div> 
</div>
  <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <a href="<?php echo base_url() ?>dispatcher/dashboard" class="navbar-brand"><b>BILIS</b></a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
              <ul class="nav navbar-nav">
                <li class="<?php if($this->uri->segment(2)=='dashboard'){echo 'active';} ?>"><a href="<?php echo base_url() ?>dispatcher/dashboard">Home</a></li>
                <li class="<?php if($this->uri->segment(2)=='available'){echo 'active';} ?>"><a href="<?php echo base_url() ?>dispatcher/available">Available for Dispatch</a></li>

                <li class="<?php if($this->uri->segment(2)=='activetrips'){echo 'active';} ?>"><a href="<?php echo base_url() ?>dispatcher/activetrips">Active Trips</a></li>

                <li class="dropdown <?php if($this->uri->segment(2)=='scheduling'){echo 'active';} ?>">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Scheduling <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="<?php if($this->uri->segment(3)=='previous'){echo 'active';} ?>"><a href="<?php echo base_url() ?>dispatcher/scheduling/previous">Previous 7 Days</a></li>
                    <li class="<?php if($this->uri->segment(3)=='next'){echo 'active';} ?>"><a href="<?php echo base_url() ?>dispatcher/scheduling/next">Next 7 Days</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
            <!-- Navbar Right Menu -->
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
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper">
        <div class="container-fluid">
          <!-- Content Header (Page header) -->
         <!--  <section class="content-header">
            <h1>
              Top Navigation
              <small>Example 2.0</small>
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li><a href="#">Layout</a></li>
              <li class="active">Top Navigation</li>
            </ol>
          </section> -->

          <!-- Main content -->