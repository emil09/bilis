<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left"><i class="fa fa-money"></i> Cash Turnover</h1>
</section>
<!-- Main content -->
<section class="content clearfix">
  <div class="col-md-12">
    
    	<div class="col-sm-6 col-xs-12">
    		<div class="box">
    			<form id="turnoverForm" method="post" autocomplete="off">
		    		<div class="box-header">
		    			<h3 class="box-title">Enter turnover amount</h3>
		    			<div id="locationselect" class="pull-right">
					    	<p>Location:</p>
					    	<select class="form-control" id="loc_select" name="loc_select">

					    	</select>
						</div>
					</div>
		            <div class="box-body">
		            	
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
				</form>
			</div>
    	</div>
    	<div class="col-sm-6 col-xs-12">
			<div class="box" style="min-height: 380px;">
	            <div class="box-header">
	              <h3 class="box-title">Active Trips</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	              <table class="table table-bordered" id="act_table"><tbody></tbody></table>
	            </div>
	            <!-- /.box-body -->
	        </div>
    	</div>
  </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->
