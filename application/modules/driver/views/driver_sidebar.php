<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
  <ul class="nav navbar-nav">
    <li class="<?php if($this->uri->segment(2)=='dashboard'){echo 'active';} ?>"><a href="<?php echo base_url() ?>driver/dashboard">Home</a></li>
    <li class="<?php if($this->uri->segment(2)=='cashturnover'){echo 'active';} ?>"><a href="<?php echo base_url() ?>driver/cashturnover">Cash Turnover</a></li>
    <li class="<?php if($this->uri->segment(2)=='joborder'){echo 'active';} ?>"><a href="<?php echo base_url() ?>driver/joborder">Job Order</a></li>
  </ul>
</div>