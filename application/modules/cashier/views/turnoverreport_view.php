<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left"><i class="fa fa-table"></i> Turnover Report</h1>
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
                    <tr>
                      <td>1</td>
                      <td>1</td>
                      <td>223 Lucban, Carmelo</td>
                      <td>PWS-463</td>
                      <td><button id="editturnover-button" class="btn btn-primary">1</button></td>
                      <td>880.00</td>
                      <td>Jan 08 2016 07:21 AM</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>2</td>
                      <td>247 San Miguel, Benjo</td>
                      <td>PXD-158</td>
                      <td><button id="editturnover-button" class="btn btn-primary">1</button></td>
                      <td>730.00</td>
                      <td>Jan 08 2016 07:39 AM</td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>2</td>
                      <td>232 Osayen, Melecio</td>
                      <td>TWH-726</td>
                      <td><button id="editturnover-button" class="btn btn-primary">6</button></td>
                      <td>1390.00</td>
                      <td>Jan 08 2016 10:22 AM</td>
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
                      <option value="" disabled>Select batch</option>
                      <option value="1" selected>1</option>
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