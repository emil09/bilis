<style type="text/css">
	#act_table tr th{
		padding-left: 20px;
	}
	#act_table tr th, #act_table tr td{
		border:0;
	}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header clearfix">
  <h1 class="pull-left" style="color:#3C8DBC">
    <i class="fa fa-pause"> Cash Turnover</i>
  </h1>
</section>
<!-- Main content -->
<section class="content clearfix">
  <div class="col-md-12">
    
    	<div class="col-sm-6 col-xs-12">
    		<div class="box">
	    		<div class="box-header">
		            <h3 class="box-title">Enter turnover amount</h3>
	            </div>
	            <!-- <h4><strong>Enter turnover amount</strong></h4> -->
	           
	            <div class="box-body">
	            	<form id="turnoverForm" method="post" autocomplete="off">
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
								<button type="button">0</button>
								<button type="button" class="operator" value=".">.</button>
								<button type="submit" class="turnoverbutton pull-right" value="OK">OK</button>
								<!-- <span class="operator">x</span> -->
							</div>
						</div>
					</form>
				</div>
				
			</div>
    	</div>
    	<div class="col-sm-6 col-xs-12">
			<!-- <h4><strong>Active Trips</strong></h4> -->
			<div class="box" style="min-height: 380px;">
	            <div class="box-header">
	              <h3 class="box-title">Active Trips</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body no-padding">
	              <table class="table" id="act_table">
	                <tbody>
	              	</tbody>
	            </table>
	            </div>
	            <!-- /.box-body -->
	        </div>
    	</div>
  </div>
</section><!-- /.content -->
</div><!-- /.modal -->
</div><!-- /.content-wrapper -->
