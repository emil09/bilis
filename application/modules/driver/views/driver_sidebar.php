<div class="navbar-header">
  <a href="<?php echo base_url() ?>dispatcher/dashboard" class="navbar-brand"><b>BILIS</b></a>
  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
    <i class="fa fa-bars"></i>
  </button>
</div>
<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
  <ul class="nav navbar-nav">
    <li class="<?php if($this->uri->segment(2)=='dashboard'){echo 'active';} ?>"><a href="<?php echo base_url() ?>driver/dashboard">Home</a></li>
    <li class="<?php if($this->uri->segment(2)=='cashturnover'){echo 'active';} ?>"><a href="<?php echo base_url() ?>driver/cashturnover">Cash Turnover</a></li>
    <li class="<?php if($this->uri->segment(2)=='joborder'){echo 'active';} ?>"><a href="<?php echo base_url() ?>driver/joborder">Job Order</a></li>
  </ul>
</div>