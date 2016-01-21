<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left"><i class="fa fa-table"></i> Turnover Report</h1>
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
<section class="content clearfix">
  <div class="col-md-12">
    	<div class="col-sm-12 col-xs-12">
    		<div class="box">
	    		<div class="box-header"><h3 class="box-title">Cash Turned over to <strong><?php echo $fname . ' ' . $lname; ?></strong></h3></div>
	            <div class="box-body">
                <table id="table-<?php echo($this->uri->segment(2)); ?>" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Batch</th>
                      <th>Bag</th>
                      <th>Driver</th>
                      <th>Unit</th>
                      <th>Trip</th>
                      <th>Amount Received</th>
                      <th>Date & Time Received</th>
                    </tr>
                  </thead>
                  <tbody id="driver_data">
                  </tbody>
                </table>
				      </div> <!-- .box-body -->
			  </div>
    	</div>
  </div>
</section><!-- /.content -->
<div id="turnoverreportsModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="updateturnoverForm" autocomplete="off">
          <div class="modal-header">
            <h4 class="modal-title pull-left">Cash turnovered to <strong><?php echo $fname . ' ' . $lname; ?></strong></h4>
            <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal" style="margin-left: 5px"><i class="fa fa-times"></i></button>
          </div>
          <div class="modal-body clearfix">
            <div class="left-col col-sm-6">
              <h4>Tag Collection</h4>
              <table class="table">
                <tr>
                  <td><p>Bag</p></td>
                  <td><input type="text" id="bag_no" name="bag_no" class="form-control" placeholder="Bag #"></td>
                </tr>
                <tr>
                  <td><p>Batch</p></td>
                  <td>
                    <select name="batch" id="batch" class="form-control">
                      <option value="" disabled selected>Select batch</option>
                      <option value="D">1</option>
                      <option value="N">2</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td> </td>
                  <td><button id="update-turnover" class="btn btn-primary pull-right">Update</button></td>
                </tr>
              </table>
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