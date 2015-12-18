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
      <li class="treeview <?php echo $this->uri->segment(2) == 'dashboard'? 'active': ''; ?>">
        <a href="<?php echo base_url() ?>admin/dashboard"><i class="fa fa-home"></i><span>Home</span></a>
      </li>
      <li>
        <a href="payroll.php"><i class="fa fa-credit-card"></i><span>Payroll</span></a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-truck"></i> <span>Dispatch</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="display: none;">
          <li><a href="dispatch_by_driver.php"><i class="fa fa-car"></i> Dispatch by Driver</a></li>
          <li>
            <a href=""><i class="fa fa-clock-o"></i> Dispatch Time Period <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="dispatch_tp_by_driver.php"><i class="fa fa-users"></i> By Driver</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-money"></i> <span>Sales</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="display: none;">
          <li><a href="sales_by_driver.php"><i class="fa fa-users"></i> Sales by Driver</a></li>
          <li><a href="sales_by_unit.php"><i class="fa fa-car"></i> Sales by Unit</a></li>
          <li>
            <a href="sales_by_time_period.php">
              <i class="fa fa-clock-o"></i> Sales Time Period <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="sales_tp_by_driver.php"><i class="fa fa-users"></i> By Driver</a></li>
              <li><a href="sales_tp_by_unit.php"><i class="fa fa-car"></i> By Unit</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="treeview <?php echo $this->uri->segment(2) == 'register'? 'active': ''; ?>">
        <a href="#">
          <i class="fa fa-sign-in"></i> <span>Register</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu <?php echo $this->uri->segment(3) == 'employee'? 'menu_open': ''; ?>" >
          <li class="treeview <?php echo $this->uri->segment(3) == 'employee'? 'active': ''; ?>">
            <a href="<?php echo base_url() ?>admin/register/employee">
              <i class="fa fa-users"></i> By Employee
            </a>
          </li>
          <li>
            <a href="register_by_unit.php">
              <i class="fa fa-car"></i> By Unit
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview " >
        <a href="#">
          <i class="fa fa-edit"></i> <span>Update</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu" style="display: none;">
          <li>
            <a href="update_by_employee.php">
              <i class="fa fa-users"></i> By Employee</a>
            </li>
          <li>
            <a href="update_by_unit.php">
              <i class="fa fa-car"></i> By Unit
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
