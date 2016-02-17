<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left"><i class="fa fa-truck"></i> Cash Pick-Up</h1>
<div id="cooperativeselect" class="pull-right">
  <p>Location:</p> 
  <select class="form-control" id="loc_select">
  	<option value="" selected>All Locations</option>
    <?php foreach ($locations as $location ): ?>
      <option value="<?php echo $location->loc_no; ?>"><?php echo $location->loc_name; ?></option>
    <?php endforeach ?>
  </select>
</div>
</section>
<!-- Main content -->
<section class="content clearfix no-gutter">
  <div class="col-md-12 no5-gutter">
    	<div class="col-sm-6 col-xs-12">
    		<div class="box box-danger">
	    		<div class="box-header text-center text-uppercase"><h3 class="box-title"><strong>Uncollected Sacks</strong></h3></div>
	            <div class="box-body">
	            	<table id="table-uncollected-sacks" class="table table-bordered dt-responsive nowrap">
			          <thead>
			            <tr>
			              <th>Action</th>
			              <th>Turnover Date</th>
			              <th>Location</th>
			              <th>Batch</th>
			              <th>Sack</th>
			              <th>Total Bags</th>
			            </tr>
			          </thead>
			          <tbody id="uncollected_sacks"></tbody>
			          <tfoot>
	                    <tr>
	                      <th colspan="4" style="text-align: right">TOTAL:</th>
	                      <th colspan="1"><span id="totalsacks">0</span> sacks</th>
	                      <th colspan="1"><span id="totalbags">0</span> bags</th>    
	                    </tr>
	                  </tfoot>
			        </table>
				</div> <!-- .box-body -->
			</div>
    	</div>
    	<div class="col-sm-6 col-xs-12">
    		<div class="box box-success">
	    		<div class="box-header text-center text-uppercase"><h3 class="box-title"><strong>Collected Sacks</strong></h3></div>
	            <div class="box-body">
	            	<table id="table-collected-sacks" class="table table-bordered dt-responsive nowrap">
			          <thead>
			            <tr>
			              <th>Turnover Date</th>
			              <th>Location</th>
			              <th>Batch</th>
			              <th>Sack</th>
			              <th>Total Bags</th>
			            </tr>
			          </thead>
	                  <tbody id="collected_sacks">
	                  </tbody>
	                  <!-- <tfoot>
	                    <tr>
	                      <th colspan="1" style="text-align: right">TOTAL:</th>
	                      <th colspan="1"><span id="totalbags">0</span> bags</th>
	                      <th colspan="3"> </th>
	                      <th colspan="2"><span id="totalvalue"></span></th>    
	                    </tr>
	                  </tfoot> -->
			        </table>
				</div> <!-- .box-body -->
			</div>
    	</div>
  </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
