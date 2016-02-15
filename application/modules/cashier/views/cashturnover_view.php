<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left"><i class="fa fa-money"></i> Cash Turnover</h1>
<div id="cooperativeselect" class="pull-right">
  <p>Cooperative:</p> 
  <select class="form-control" id="coo_select">
    <?php foreach ($cooperatives as $cooperative ): ?>
      <option value="<?php echo $cooperative->coo_no_fk; ?>"><?php echo $cooperative->coo_name; ?></option>
    <?php endforeach ?>
  </select>
</div>
</section>
<!-- Main content -->
<section class="content clearfix no-gutter">
  <div class="col-md-12 no5-gutter">
    	<div class="col-sm-6 col-xs-12">
    		<div class="box box-danger">
	    		<div class="box-header text-center text-uppercase"><h3 class="box-title"><strong>Unassigned Bags</strong></h3></div>
	            <div class="box-body">
	            	<table id="table-unassigned-bags" class="table table-bordered dt-responsive nowrap">
			          <thead>
			            <tr>
			              <th>Trip</th>
			              <th>Route</th>
			              <th>Unit</th>
			              <th>Driver</th>
			              <th>Amount</th>
			              <th>Turnover Date</th>
			            </tr>
			          </thead>
			          <tbody id="unassigned_bags"></tbody>
			        </table>
				</div> <!-- .box-body -->
			</div>
    	</div>
    	<div class="col-sm-6 col-xs-12">
    		<div class="box box-success">
	    		<div class="box-header text-center text-uppercase"><h3 class="box-title"><strong>Assigned Bags</strong></h3></div>
	            <div class="box-body">
	            	<table id="table-assigned-bags" class="table table-bordered dt-responsive nowrap">
			          <thead>
	                    <tr>
	                      <th>Batch</th>
	                      <th>Bag</th>
	                      <th>Driver</th>
	                      <th>Unit</th>
	                      <th>Trip</th>
	                      <th>Amount</th>
	                      <th>Date Assigned</th>
	                    </tr>
	                  </thead>
	                  <tbody id="driver_data">
	                  </tbody>
	                  <tfoot>
	                    <tr>
	                      <th colspan="1" style="text-align: right">TOTAL:</th>
	                      <th colspan="1"><span id="totalbags">0</span> bags</th>
	                      <th colspan="3"> </th>
	                      <th colspan="2"><span id="totalvalue"></span></th>    
	                    </tr>
	                  </tfoot>
			        </table>
				</div> <!-- .box-body -->
			</div>
    	</div>
  </div>
</section><!-- /.content -->
<div id="unassignedModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
	    <div class="modal-content">
	      <form id="cashturnoverForm" autocomplete="off">
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
		          		<td><input type="number" id="bag_no" min="1" class="form-control" name="bag_no" placeholder="Bag #"></td>
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
		          		<td><button type="submit" id="accept-turnover" class="btn btn-primary pull-right">Accept</button></td>
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
