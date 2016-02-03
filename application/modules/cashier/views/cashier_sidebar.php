<div class="navbar-header">
  <a href="<?php echo base_url() ?>cashier/dashboard" class="navbar-brand"><b>BILIS</b></a>
  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
    <i class="fa fa-bars"></i>
  </button>
</div>
<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
  <ul class="nav navbar-nav">
    <li class="<?php if($this->uri->segment(2)=='dashboard'){echo 'active';} ?>"><a href="<?php echo base_url() ?>cashier/dashboard">Home</a></li>
    <li class="<?php if($this->uri->segment(2)=='cashturnover'){echo 'active';} ?>"><a href="<?php echo base_url() ?>cashier/cashturnover">Cash Turnover</a></li>
    <li class="<?php if($this->uri->segment(2)=='turnoverreport'){echo 'active';} ?>"><a href="<?php echo base_url() ?>cashier/turnoverreport">Turnover Report</a></li>
    <li class="<?php if($this->uri->segment(2)=='activetripsreport'){echo 'active';} ?>"><a href="<?php echo base_url() ?>cashier/activetripsreport">Sales by Driver</a></li>
    <li class="<?php if($this->uri->segment(2)=='activetripslist'){echo 'active';} ?>"><a href="<?php echo base_url() ?>cashier/activetripslist">Active Trips Report</a></li>
  </ul>
</div>