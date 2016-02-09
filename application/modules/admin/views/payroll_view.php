<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header clearfix">
      <h1 class="pull-left"><i class="fa fa-credit-card"></i> Payroll <small>Report of driver attendance per route</small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div id="filter-panel" class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Filter Panel</h3>
              <div class="box-tools pull-right">
              	<button class="btn btn-box-tool" data-widget="collapse">
              		<i class="fa fa-minus"></i>
              	</button>
              </div>
            </div>
            <div class="box-body">
                <form id="filterForm" action="post" autocomplete="off">
                    <div class="col-md-9 col-sm-12">
                    	<div class="col-sm-4 col-md-4">
                    		<div class="form-group">
                    			<label>Date</label>
                    			<div id="pickdate" class="input-group date">
                    				<div class="input-group-addon">
                    					<i class="fa fa-calendar"></i>
                    				</div>
                    				<input type="text" id="payroll-date" name="payroll_date" class="form-control pull-right" placeholder="Select Date">
                    			</div>
                    		</div>
                    	</div>
                    	<div class="col-sm-4 col-md-4">
                    		<div class="form-group">
                    			<label>Dispatched Shift</label>
                    			<div class="input-group">
                    				<div class="input-group-addon">
                    					<i class="fa fa-cog"></i>
                    				</div>
                    				<select name="shift" id="shift" class="form-control">
                    					<option value='' disabled selected>Select Shift</option>
                    					<option value="D">Day Shift</option>
                    					<option value="N">Night Shift</option>
                    				</select>
                    			</div>
                    		</div>
                    	</div>
                    	<div class="col-sm-4 col-md-4">
                    		<div class="form-group">
                                <label>Cooperative</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-sitemap"></i>
                                    </div>
                                    <select class="form-control" id="coo_select" name="coo_select">
                                      <option value='' disabled selected>Select Cooperative</option>
                                      <?php foreach ($cooperatives as $cooperative ): ?>
                                        <option value="<?php echo $cooperative->coo_no; ?>"><?php echo $cooperative->coo_name; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                    	</div>
                    </div>
                	<div class="col-md-3 col-sm-12">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label style="visibility: hidden">Action</label>
                                <button type="button" id="display-report" class="btn btn-block btn-primary">View Report</button>
                            </div>
                        </div>
                        <div id="export-group" class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label>Export to</label>
                                <div class="no5-gutter">
                                    <div class="col-sm-12 col-md-4">
                                        <button type="button" id="excel-report" class="btn btn-block btn-success"><i class="fa fa-file-excel-o"></i> Excel</button>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <button type="button" id="pdf-report" class="btn btn-block btn-danger"><i class="fa fa-file-pdf-o"></i> PDF</button>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <button type="button" id="print-report" class="btn btn-block btn-warning"><i class="fa fa-print"></i> Print</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
          </div><!-- /.box-primary -->
        </div>
        <div class="col-xs-12">
	    	<div class="text-center" style="margin-bottom: 20px;" id="notif_table">
	      		<div id="alert-error-status" class="alert alert-danger" role="alert"></div>
	      	</div>
	    </div>
      </div>
      <div id="payroll-panel" class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 id="file-title" class="box-title">Honorarium (<span id="coo_header"></span>) <span id="date_header"></span> <span id="shift_header"></span></h3>
            </div>
            <div class="box-body">
            	<table id="payroll-table" class="table dt-responsive nowrap">
            		<thead id="payroll-thead">
            			<tr>
            				<th>Surname</th>
            				<th>Middle Name</th>
            				<th>First Name</th>
            				<th>Group</th>
            				<th>Daily Pay</th>
            				<th>Deduction</th>
            				<th>Cash Advances</th>
            				<th>Net Pay</th>
            				<th>Plate Number</th>
            				<th>Signature</th>
            				<th>Total</th>
            			</tr>
            		</thead>
            		<tbody id="payroll-tbody"></tbody>
            	</table>
            </div>
          </div><!-- /.box-primary -->
        </div>
      </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->