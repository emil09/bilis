
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BILIS</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <?php echo $css; ?>
  </head>
  <body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
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

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Scheduling <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url() ?>dispatcher/schedulinglast">Previous 7 Days</a></li>
                    <li><a href="<?php echo base_url() ?>">Next 7 Days</a></li>
                  </ul>
                </li>
              </ul>
              <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                  <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                </div>
              </form>
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