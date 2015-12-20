<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  <li class="<?php if($this->uri->segment(2)=='dashboard'){echo 'active';} ?>"><a href="dashboard"><i class="fa fa-home"></i><span>Home</span></a></li>
  <li class="<?php if($this->uri->segment(2)=='available'){echo 'active';} ?>"><a href="available"><i class="fa fa-pause"></i><span>Available for Dispatch</span></a></li>
  <li><a href="dispatch.php"><i class="fa fa-play"></i> <span>Active Trips</span></a></li>
  <li><a href="dispatch.php"><i class="fa fa-calendar"></i> <span>Scheduling</span></a></li>
  <li><a href="dispatch.php"><i class="fa fa-clone"></i> <span>Dispatch Report</span></a></li>
  <!-- <li class="header">LABELS</li>
  <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
  <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
  <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->
</ul>