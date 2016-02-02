<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header clearfix">
      <h1 class="pull-left"><i class="fa fa-money"></i> Sales <small>Report of sales by unit per day</small></h1>
      <div id="cooperativeselect" class="pull-right">
        <p>Cooperative:</p> 
        <select class="form-control" id="coo_select">
          <?php foreach ($cooperatives as $cooperative ): ?>
            <option value="<?php echo $cooperative->coo_no; ?>"><?php echo $cooperative->coo_name; ?></option>
          <?php endforeach ?>
        </select>
      </div>
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
            	<div class="col-sm-6 col-md-3">
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
            	<div class="col-sm-6 col-md-3">
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
            	<div class="col-sm-6 col-md-3">
            		<div class="form-group">
            			<label>Route</label>
            			<div class="input-group">
            				<div class="input-group-addon">
            					<i class="fa fa-exchange"></i>
            				</div>
            				<select name="route" id="route" class="form-control">
            					<option value="1">Bagong Silang - Philcoa</option>
            					<option value="2">Lagro - Cubao</option>
            				</select>
            			</div>
            		</div>
            	</div>
            	<!-- <div class="col-sm-6 col-md-3">
            		<div class="form-group"></div>
            	</div> -->
            	<div class="col-sm-6 col-md-3">
                    <label></label>
            		<button class="btn btn-block btn-primary">View Report</button>
            	</div>
            </div>
          </div><!-- /.box-primary -->
        </div>
      </div>
      <div id="sales-panel" class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">All Routes Sales Report in Day Shift (Jan 27 2016)</h3>
            </div>
            <div class="box-body">
            	<table id="sales-by-unit" class="table table-bordered">
                    <thead id="sales-by-unit-thead">
                    </thead>
                    <tfoot id="sales-by-unit-tfoot">
                    </tfoot>
                    <tbody id="sales-by-unit-tbody">
                    </tbody>
            	</table>
            </div>
          </div><!-- /.box-primary -->
        </div>
      </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->