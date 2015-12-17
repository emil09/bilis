<!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo base_url() ?>assets/libs/theme/img/user.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>test</p>
            <a href="#"><i class="fa fa-circle text-success"></i>Dispatcher</a>
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
        <ul class="sidebar-menu">
          <li class="header">MAIN NAVIGATION</li>
          <li class="active"><a href="welcome.php"><i class="fa fa-home"></i><span>Home</span></a></li>
          <li><a href="attendance.php"><i class="fa fa-check-square-o"></i><span>Available for Dispatch</span></a></li>
          <li><a href="dispatch.php"><i class="fa fa-truck"></i> <span>Scheduling</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-money"></i> <span>Sales</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="sales_by_driver.php"><i class="fa fa-users"></i> Sales by Driver</a></li>
              <li><a href="sales_by_unit.php"><i class="fa fa-car"></i> Sales by Unit</a></li>
              <li>
                <a href="sales_by_time_period.php"><i class="fa fa-clock-o"></i> Sales Time Period <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu" style="display: none;">
                  <li><a href="sales_tp_by_driver.php"><i class="fa fa-users"></i> By Driver</a></li>
                  <li><a href="sales_tp_by_unit.php"><i class="fa fa-car"></i> By Unit</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <!-- <li class="header">LABELS</li>
          <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
          <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
          <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
        </ul>
      </section>
    <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1 style="color:#3C8DBC;">
    <i class="fa fa-home"> Home</i>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="col-md-12">
    <!-- Widget: user widget style 1 -->
    <div class="box box-widget widget-user">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-aqua-active">
        <h3 class="widget-user-username">test</h3>
        <h5 class="widget-user-desc">test</h5>
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-sm-12">
            <div class="text-left">
              <h4 class="description-header">Welcome test to your personal page.</h4>
              </br>
              <span class="description-text">For any problem in the system, contact System Administrator for details. Click the Main Navigation to select operation. It is recommended to logout by clicking the logout button in the upper right of your page everytime you leave your Tablet or PC.</span>
            </div><!-- /.description-block -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div>
    </div><!-- /.widget-user -->
  </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->