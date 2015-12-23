<ul class="sidebar-menu">
  <li class="header">MAIN NAVIGATION</li>
  <li class="<?php if($this->uri->segment(2)=='dashboard'){echo 'active';} ?>"><a href="dashboard"><i class="fa fa-home"></i><span>Home</span></a></li>
  <li class="<?php if($this->uri->segment(2)=='cashturnover'){echo 'active';} ?>"><a href="cashturnover"><i class="fa fa-money"></i><span>Cash Turnover</span></a></li>
  <li class="<?php if($this->uri->segment(2)=='joborder'){echo 'active';} ?>"><a href="joborder"><i class="fa fa-wrench"></i> <span>Job Order</span></a></li>
</ul>