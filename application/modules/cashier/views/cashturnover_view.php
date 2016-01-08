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
			          <tbody id="driver_data">
			          	<tr>
			          		<td><button id="cashturnover-button" class="btn btn-primary">2</button></td>
			          		<td>Lagro - Cubao</td>
			          		<td>CWE-498</td>
			          		<td>998 Abad, Alvin</td>
			          		<td>200.00</td>
			          		<td>Aug 05 2015 08:00 AM</td>
			          	</tr>
			          	<tr>
			          		<td><button id="cashturnover-button" class="btn btn-primary">3</button></td>
			          		<td>Lagro - Cubao</td>
			          		<td>CWE-498</td>
			          		<td>998 Abad, Alvin</td>
			          		<td>300.00</td>
			          		<td>Aug 05 2015 08:00 AM</td>
			          	</tr>
			          	<tr>
			          		<td><button id="cashturnover-button" class="btn btn-primary">4</button></td>
			          		<td>Lagro - Cubao</td>
			          		<td>CWE-498</td>
			          		<td>998 Abad, Alvin</td>
			          		<td>400.00</td>
			          		<td>Aug 05 2015 08:00 AM</td>
			          	</tr>
			          </tbody>
			        </table>
				</div> <!-- .box-body -->
			</div>
    	</div>
  </div>
</section><!-- /.content -->
<div id="cashturnoverModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <form id="schedForm">
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
		          		<td><input type="text" class="form-control" placeholder="Bag #"></td>
		          	</tr>
		          	<tr>
		          		<td><p>Batch</p></td>
		          		<td>
		          			<select name="batch" id="batch" class="form-control">
		          				<option value="" selected disabled>Select batch</option>
		          				<option value="1">1</option>
		          				<option value="2">2</option>
		          			</select>
		          		</td>
		          	</tr>
		          	<tr>
		          		<td> </td>
		          		<td><button id="accept-turnover" class="btn btn-primary pull-right">Accept</button></td>
		          	</tr>
	          	</table>
	          </div>
	          <div class="right-col col-sm-6">
	          	<h4>Selected Trip</h4>
				<table class="selectedtrip table table-bordered">
	          		<tr>
		          		<th>Trip</th>
		          		<td>2</td>
		          	</tr>
		          	<tr>
		          		<th>Route</th>
		          		<td>Lagro-Cubao</td>
		          	</tr>
		          	<tr>
		          		<th>Unit</th>
		          		<td>CWE-498</td>
		          	</tr>
		          	<tr>
		          		<th>Driver</th>
		          		<td>(998) Abad, Alvin</td>
		          	</tr>
		          	<tr>
		          		<th>Amount Turnover</th>
		          		<td>200.00</td>
		          	</tr>
		          	<tr>
		          		<th>Arrival</th>
		          		<td>2015-08-05 08:00:00</td>
		          	</tr>
	          	</table>
	          </div>
	        </div>
	      </form> 
	    </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div><!-- /.content-wrapper -->
