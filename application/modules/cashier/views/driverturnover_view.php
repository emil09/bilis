<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left"><i class="fa fa-calendar"></i> Driver Turnover</h1>
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
  <div class="col-md-12 no-gutter">
    	<div class="col-sm-12 col-xs-12">
    		<div class="box">
	    		<div class="box-header"><h3 class="box-title">Active Trips Report (<?php echo date('M d, Y'); ?>)</h3></div>
	            <div class="box-body">
                <table id="table-<?php echo($this->uri->segment(2)); ?>" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Trip</th>
                      <th>Route</th>
                      <th>Unit</th>
                      <th>Driver</th>
                      <th>Dispatched Time</th>
                      <th>Shift</th>
                    </tr>
                  </thead>
                  <tbody id="active_list_data"></tbody>
                </table>
				      </div> <!-- .box-body -->
			  </div>
    	</div>
  </div>
</section><!-- /.content -->
<div id="driverturnoverModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title pull-left">Cash Turnover Form by <strong><?php echo $fname." ".$lname; ?></strong> for </h4>
        </div>
        <div class="modal-body clearfix">
          <div class="col-sm-6 col-xs-12">
            <div id="calculator" class="center-block">
              <div class="top">
                <!-- <div class="screen"></div> -->
                <input class="screen" type="text" value="" id="screen" name="amt" />
              </div>
              
              <div class="keys">
                <button type="button" value="7">7</button>
                <button type="button" value="8">8</button>
                <button type="button" value="9" class="operator">9</button>
                <button type="button" value="4">4</button>
                <button type="button" value="5">5</button>
                <button type="button" value="6" class="operator">6</button>
                <button type="button" value="1">1</button>
                <button type="button" value="2">2</button>
                <button type="button" value="3" class="operator">3</button>
                <button type="button" value="C" class="clear">C</button>
                <button type="button" value="0">0</button>
                <button type="button" class="operator" value=".">.</button>
                <button type="submit" class="turnoverbutton pull-right" value="OK">OK</button>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-xs-12">
            <table class="table table-bordered" id="act_table">
              <tbody>
                <tr>
                  <th>Shift</th>
                  <td>1</td>
                </tr>
                <tr>
                  <th>Trip</th>
                  <td>1</td>
                </tr>
                <tr>
                  <th>Route</th>
                  <td>1</td>
                </tr>
                <tr>
                  <th>Unit</th>
                  <td>1</td>
                </tr>
                <tr>
                  <th>Amount</th>
                  <td>1</td>
                </tr>
                <tr>
                  <th>Departure</th>
                  <td>1</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div><!-- /.content-wrapper