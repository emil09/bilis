
<div class="content-wrapper">
<!-- Content Header (Page header) -->
    <section class="content-header clearfix">
      <h1 class="pull-left"><i class="fa fa-clock-o"></i> Sales Time Period <small>Report of sales by driver</small></h1>
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
                                    <input type="text" id="sales-date" name="filter_date" class="form-control pull-right">
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
                                        <option value="A">All Shift</option>
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
                                    <select class="form-control" name="coo_select" id="coo_select">
                                      <option value='A' selected>All Cooperatives</option>
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

                                    <select name="route" id="route" class="form-control">
                                      <option value='A' selected>All Routes</option>
                                      <!--<?php foreach ($routes as $route ): ?>
                                        <option value="<?php echo $route->rte_no; ?>"><?php echo $route->rte_nam; ?></option>
                                      <?php endforeach ?> -->
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
      <div id="sales-panel" class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><span id="route-header"></span> Sales Report in <span id="shift-header"></span> (<span id="date-header"></span>)</h3>
            </div>
            <div class="box-body">
                
            	<table id="tp_driver_table" class="order-column nowrap" cellspacing="0" width="100%">
                    <thead>
                      <tr id="tp_driver_table_header">
                      </tr>
                    </thead>
                    <tbody id="tp_driver_table_detail">
                        
                    </tbody>
                    <tfoot>
                      <tr id="tp_driver_table_footer">
                      </tr>
                    </tfoot>
            	</table> 
            </div>
          </div><!-- /.box-primary -->
        </div>
      </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->