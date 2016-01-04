<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  <li class="<?php if($this->uri->segment(2)=='dashboard'){echo 'active';} ?>"><a href="dashboard"><i class="fa fa-home"></i><span>Home</span></a></li>
  <li class="<?php if($this->uri->segment(2)=='available'){echo 'active';} ?>"><a href="available"><i class="fa fa-pause"></i><span>Available for Dispatch</span></a></li>
  <li class="<?php if($this->uri->segment(2)=='activetrips'){echo 'active';} ?>"><a href="activetrips"><i class="fa fa-play"></i> <span>Active Trips</span></a></li>
  <li class="treeview <?php if($this->uri->segment(2)=='schedulinglast'){echo 'active';} ?>"><a href="#"><i class="fa fa-calendar"></i> <span>Scheduling</span><i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="schedulinglast"><i class="fa fa-backward"></i> Previous Days</a></li>
      <li><a href="schedulingnext"><i class="fa fa-forward"></i> Next 7 Days</a></li>
    </ul>
  </li>
  <li><a href="dispatch.php"><i class="fa fa-clone"></i> <span>Dispatch Report</span></a></li>
</ul>