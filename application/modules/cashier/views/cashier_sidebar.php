<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
  <ul class="nav navbar-nav">
    <li class="<?php if($this->uri->segment(2)=='dashboard'){echo 'active';} ?>"><a href="<?php echo base_url() ?>dispatcher/dashboard">Home</a></li>
    <li class="<?php if($this->uri->segment(2)=='cashturnover'){echo 'active';} ?>"><a href="<?php echo base_url() ?>dispatcher/cashturnover">Cash Turnover</a></li>

    <li class="<?php if($this->uri->segment(2)=='turnoverreport'){echo 'active';} ?>"><a href="<?php echo base_url() ?>dispatcher/turnoverreport">Turnover Report</a></li>
  </ul>
</div>