<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left"><i class="fa fa-money"></i> Cash Turnover</h1>
</section>
<!-- Main content -->
<section class="content clearfix">
  <div class="col-md-12">
    	<div class="col-sm-12 col-xs-12">
    		<div class="box">
	    		<div class="box-header"><h3 class="box-title">Available for turnover to <strong><?php echo $fname . ' ' . $lname; ?></strong></h3></div>
	            <div class="box-body">
	            	<table id="table-<?php echo($this->uri->segment(2)); ?>" class="table table-bordered">
			          <thead>
			            <tr>
			              <th>Trip</th>
			              <th>Route</th>
			              <th>Unit</th>
			              <th>Driver</th>
			              <th>Reported</th>
			              <th>End</th>
			            </tr>
			          </thead>
			          <tbody id="available_turnover"></tbody>
			        </table>
				</div> <!-- .box-body -->
			</div>
    	</div>
  </div>
</section><!-- /.content -->
<div id="cashturnoverModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <form id="cashturnoverForm">
	        <div class="modal-header">
	          <h4 class="modal-title pull-left">Cash turnover to <strong><?php echo $fname . ' ' . $lname; ?></strong></h4>
	          <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal" style="margin-left: 5px"><i class="fa fa-times"></i></button>
	        </div>
	        <div class="modal-body clearfix">
	          <div class="left-col col-sm-6">
	          	<h4>Tag Collection</h4>
	          	<table class="table">
	          		<tr>
		          		<td><p>Bag</p></td>
		          		<td><input type="text" id="bag_no" class="form-control" name="bag_no" placeholder="Bag #"></td>
		          	</tr>
		          	<tr>
		          		<td><p>Batch</p></td>
		          		<td>
		          			<select name="batch" id="batch" class="form-control">
		          				<option value="" selected disabled>Select batch</option>
		          				<option value="D">1</option>
		          				<option value="N">2</option>
		          			</select>
		          		</td>
		          	</tr>
		          	<tr>
		          		<td> </td>
		          		<td><button id="accept-turnover" class="btn btn-primary pull-right">Accept</button></td>
		          	</tr>
	          	</table>
	          	<div id="errmsg" class="callout callout-danger"></div>
	          </div>
	          <div class="right-col col-sm-6">
	          	<h4>Selected Trip</h4>
				<table class="selectedtrip table table-bordered">
					<tbody id="selected_details"></tbody>
	          	</table>
	          </div>
	        </div>
	      </form> 
	    </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div><!-- /.content-wrapper -->
