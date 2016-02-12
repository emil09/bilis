<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left"><i class="fa fa-calendar"></i> Sales by Driver</h1>
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
	    		<div class="box-header"><h3 class="box-title">Sales by Driver Report (<?php echo date('M d, Y'); ?>)</h3></div>
	            <div class="box-body">
                <table id="table-<?php echo($this->uri->segment(2)); ?>" class="table table-bordered dt-responsive nowrap">
                  <thead id="activetrips-thead"></thead>
                  <tfoot id="activetrips-tfoot"></tfoot>
                  <tbody id="active_list_data"></tbody>
                </table>
				      </div> <!-- .box-body -->
			  </div>
    	</div>
  </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper