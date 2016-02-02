<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header clearfix">
      <h1 class="pull-left"><i class="fa fa-money"></i> Sales <small>Report of sales by driver per day</small></h1>
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
                    <div class="col-md-8 col-sm-12">
                    	<div class="col-sm-6 col-md-6">
                    		<div class="form-group">
                    			<label>Date</label>
                    			<div id="pickdate" class="input-group date">
                    				<div class="input-group-addon">
                    					<i class="fa fa-calendar"></i>
                    				</div>
                    				<input type="text" id="sales-date" class="form-control pull-right">
                    			</div>
                    		</div>
                    	</div>
                    	<div class="col-sm-6 col-md-6">
                    		<div class="form-group">
                    			<label>Dispatched Shift</label>
                    			<div class="input-group">
                    				<div class="input-group-addon">
                    					<i class="fa fa-cog"></i>
                    				</div>
                    				<select name="shift" id="shift" class="form-control">
                    					<option value="D">Day Shift</option>
                    					<option value="N">Night Shift</option>
                    				</select>
                    			</div>
                    		</div>
                    	</div>
                    	<div class="col-sm-6 col-md-6">
                    		<div class="form-group">
                                <label>Cooperative</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-sitemap"></i>
                                    </div>
                                    <select class="form-control" id="coo_select">
                                      <?php foreach ($cooperatives as $cooperative ): ?>
                                        <option value="<?php echo $cooperative->coo_no; ?>"><?php echo $cooperative->coo_name; ?></option>
                                      <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                    	</div>
                        <div class="col-sm-6 col-md-6">
                            <div class="form-group">
                                <label>Route</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-exchange"></i>
                                    </div>
                                    <select name="route" id="route" class="form-control"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                	<div class="col-md-4 col-sm-12">
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
                                    <div class="col-sm-12 col-md-3">
                                        <button type="button" id="display-report" class="btn btn-block btn-info"><i class="fa fa-file-o"></i> CSV</button>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <button type="button" id="display-report" class="btn btn-block btn-success"><i class="fa fa-file-excel-o"></i> Excel</button>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <button type="button" id="display-report" class="btn btn-block btn-danger"><i class="fa fa-file-pdf-o"></i> PDF</button>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <button type="button" id="display-report" class="btn btn-block btn-warning"><i class="fa fa-print"></i> Print</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
          </div><!-- /.box-primary -->
        </div>
      </div>
      <div id="sales-panel" class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">All Routes Sales Report in Day Shift (<?php echo date('M j Y'); ?>)</h3>
            </div>
            <div class="box-body">
            	<table id="sales-by-driver" class="table table-bordered">
            		<thead id="sales-by-driver-thead">
            		</thead>
                    <tfoot id="sales-by-driver-tfoot">
                    </tfoot>
            		<tbody id="sales-by-driver-tbody">
            		</tbody>
            	</table>
            </div>
          </div><!-- /.box-primary -->
        </div>
      </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->