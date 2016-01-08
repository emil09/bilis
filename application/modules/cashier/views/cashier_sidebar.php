<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
  <ul class="nav navbar-nav">
    <li class="<?php if($this->uri->segment(2)=='dashboard'){echo 'active';} ?>"><a href="<?php echo base_url() ?>dispatcher/dashboard">Home</a></li>
    <li class="<?php if($this->uri->segment(2)=='cashturnover'){echo 'active';} ?>"><a href="<?php echo base_url() ?>dispatcher/cashturnover">Cash Turnover</a></li>

    <li class="<?php if($this->uri->segment(2)=='turnoverreport'){echo 'active';} ?>"><a href="<?php echo base_url() ?>dispatcher/turnoverreport">Turnover Report</a></li>

    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Scheduling <span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu">
        <li><a href="<?php echo base_url() ?>dispatcher/schedulinglast">Previous 7 Days</a></li>
        <li><a href="<?php echo base_url() ?>">Next 7 Days</a></li>
      </ul>
    </li>
  </ul>
</div>