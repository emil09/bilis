<div class="navbar-header">
  <a href="<?php echo base_url() ?>collector/dashboard" class="navbar-brand"><b>BILIS</b></a>
  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
    <i class="fa fa-bars"></i>
  </button>
</div>
<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
  <ul class="nav navbar-nav">
    <li class="<?php if($this->uri->segment(2)=='dashboard'){echo 'active';} ?>"><a href="<?php echo base_url() ?>collector/dashboard">Home</a></li>
    <li class="<?php if($this->uri->segment(2)=='cashpickup'){echo 'active';} ?>"><a href="<?php echo base_url() ?>collector/cashpickup">Cash Pick-Up</a></li>
    <li class="<?php if($this->uri->segment(2)=='bankdelivery'){echo 'active';} ?>"><a href="<?php echo base_url() ?>collector/bankdelivery">Bank Delivery</a></li>
    <li class="<?php if($this->uri->segment(2)=='bankdeposit'){echo 'active';} ?>"><a href="<?php echo base_url() ?>collector/bankdeposit">Bank Deposit</a></li>
  </ul>
</div>