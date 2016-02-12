<div class="navbar-header">
  <a href="<?php echo base_url() ?>counter/dashboard" class="navbar-brand"><b>BILIS</b></a>
  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
    <i class="fa fa-bars"></i>
  </button>
</div>
<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
  <ul class="nav navbar-nav">
    <li class="<?php if($this->uri->segment(2)=='dashboard'){echo 'active';} ?>"><a href="<?php echo base_url() ?>counter/dashboard">Home</a></li>
    <li class="<?php if($this->uri->segment(2)=='accept_batch'){echo 'active';} ?>"><a href="<?php echo base_url() ?>counter/accept_batch">Accept Batch</a></li>

    <li class="<?php if($this->uri->segment(2)=='count_cash'){echo 'active';} ?>"><a href="<?php echo base_url() ?>counter/count_cash">Count Cash</a></li>
       

  </ul>
</div><!-- /.navbar-collapse -->