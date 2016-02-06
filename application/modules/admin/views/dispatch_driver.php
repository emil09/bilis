<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header clearfix">
      <h1 class="pull-left"><i class="fa fa-truck"></i> Dispatch <small>Summary of dispatch by day and route</small></h1>
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
                    			<label>Shift</label>
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
                                      <option value='' selected>All Cooperatives</option>
                                      <?php foreach ($cooperatives as $cooperative ): ?>
                                        <option value="<?php echo $cooperative->coo_no; ?>"><?php echo $cooperative->coo_name; ?></option>
                                      <?php endforeach ?>
                                    </select>
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
                    </div>
                </form>
            </div>
          </div><!-- /.box-primary -->
        </div>
      </div>
      <div id="dispatch-panel" class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><span id="route-header"></span> Dispatch Report in <span id="shift-header"></span></h3>
            </div>
            <div class="box-body">
            	<table id="dispatch-by-driver" class="table table-bordered dt-responsive nowrap">
            		<thead id="dispatch-by-driver-thead"></thead>
                    <!-- <tfoot id="dispatch-by-driver-tfoot">
                    </tfoot> -->
            		<tbody id="dispatch-by-driver-tbody"></tbody>
            	</table>
            </div>
          </div><!-- /.box-primary -->
        </div>
      </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->