<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left"><i class="fa fa-truck"></i> Cash Pick-Up</h1>
<div id="cooperativeselect" class="pull-right">
  <p>Location:</p> 
  <select class="form-control" id="coo_select">
    <?php foreach ($locations as $location ): ?>
      <option value="<?php echo $location->loc_no; ?>"><?php echo $location->loc_name; ?></option>
    <?php endforeach ?>
  </select>
</div>
</section>
<!-- Main content -->
<section class="content clearfix">
  <div class="col-md-12">
    	<div class="col-sm-12 col-xs-12">
    		<div class="box">
	    		<div class="box-header"><h3 class="box-title">Available for pick-up by <strong><?php echo $fname . ' ' . $lname; ?></strong></h3></div>
	            <div class="box-body">
	            	<table id="table-<?php echo($this->uri->segment(2)); ?>" class="table table-bordered">
	            		<thead>
	            			<tr>
	            				<th>Batch</th>
	            				<th>Bag</th>
	            			</tr>
	            		</thead>
	            		<tbody>
	            			<tr>
	            				<td>1</td>
	            				<td>1958</td>
	            			</tr>
	            			<tr>
	            				<td>2</td>
	            				<td>1808</td>
	            			</tr>
	            		</tbody>
			        </table>
				</div> <!-- .box-body -->
			</div>
    	</div>
  </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
