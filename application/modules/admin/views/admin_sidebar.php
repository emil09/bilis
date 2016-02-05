<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  <li class="treeview <?php echo $this->uri->segment(2) == 'dashboard'? 'active': ''; ?>">
    <a href="<?php echo base_url() ?>admin/dashboard"><i class="fa fa-home"></i><span>Home</span></a>
  </li>
  <li>
    <a href="payroll.php"><i class="fa fa-credit-card"></i><span>Payroll</span></a>
  </li>
  <li>
    <a href="payroll.php"><i class="fa fa-calendar"></i><span>Scheduling</span></a>
  </li>
  <li class="treeview <?php echo $this->uri->segment(2) == 'dispatch'? 'active': ''; ?>">
    <a href="#">
      <i class="fa fa-truck"></i> <span>Dispatch</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu <?php echo $this->uri->segment(3) == 'driver'? 'menu_open': ''; ?>">
      <li class="treeview <?php echo $this->uri->segment(3) == 'driver'? 'active': ''; ?>">
        <a href="<?php echo base_url() ?>admin/dispatch/driver">
          <i class="fa fa-car"></i> Dispatch by Driver
        </a>
      </li>
      <li>
        <a href=""><i class="fa fa-clock-o"></i> Dispatch Time Period <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu" style="display: none;">
          <li><a href="dispatch_tp_by_driver.php"><i class="fa fa-users"></i> By Driver</a></li>
        </ul>
      </li>
    </ul>
  </li>
  <li class="treeview <?php echo $this->uri->segment(2) == 'sales'? 'active': ''; ?>">
    <a href="#">
      <i class="fa fa-money"></i> <span>Sales</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu <?php echo $this->uri->segment(3) == 'driver'? 'menu_open': ''; ?>">
      <li class="treeview <?php echo $this->uri->segment(3) == 'driver'? 'active': ''; ?>">
        <a href="<?php echo base_url() ?>admin/sales/driver">
          <i class="fa fa-users"></i> Sales by Driver
        </a>
      </li>
      <li class="treeview <?php echo $this->uri->segment(3) == 'unit'? 'active': ''; ?>">
        <a href="<?php echo base_url() ?>admin/sales/unit">
          <i class="fa fa-car"></i> Sales by Unit
        </a>
      </li>
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
    <ul class="treeview-menu <?php echo $this->uri->segment(3) == 'employee' && $this->uri->segment(2) == 'register'? 'menu_open': ''; ?>" >
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
  <li class="treeview <?php echo $this->uri->segment(2) == 'update'? 'active': ''; ?>">
    <a href="#">
      <i class="fa fa-edit"></i> <span>Update</span>
      <i class="fa fa-angle-left pull-right"></i>
    </a>
    <ul class="treeview-menu <?php echo $this->uri->segment(3) == 'employee' && $this->uri->segment(2) == 'update'? 'menu_open': ''; ?>" >
      <li class="treeview <?php echo $this->uri->segment(3) == 'employee'? 'active': ''; ?>">
        <a href="<?php echo base_url() ?>admin/update/employee">
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