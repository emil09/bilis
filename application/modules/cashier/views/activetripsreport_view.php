<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left"><i class="fa fa-calendar"></i> Active Trips Report</h1>
</section>
<!-- Main content -->
<section class="content clearfix">
  <div class="col-md-12">
    	<div class="col-sm-12 col-xs-12">
    		<div class="box">
	    		<div class="box-header"><h3 class="box-title">All Routes Sales Report (<?php echo date('M d, Y'); ?>)</h3></div>
	            <div class="box-body">
                <table id="table-<?php echo($this->uri->segment(2)); ?>" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Driver</th>
                      <th>Unit</th>
                      <th>Trip 1</th>
                      <th>Trip 2</th>
                      <th>Trip 3</th>
                      <th>Trip 4</th>
                      <th>Trip 5</th>
                      <th>Trip 6</th>
                      <th>Trip 7</th>
                      <th>Total</th>
                      <th>Average</th>
                    </tr>
                  </thead>
                  <!-- <tfoot>
                      <tr>
                          <th colspan="9" style="text-align:right">Total:</th>
                          <th></th>
                      </tr>
                  </tfoot> -->
                  <tbody id="active_list_data">
                  </tbody>
                </table>
				      </div> <!-- .box-body -->
			  </div>
    	</div>
  </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper