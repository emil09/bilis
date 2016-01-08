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