
<style type="text/css">
.sk-spinner-circle .sk-circle12 {
  -webkit-transform: rotate(330deg);
  -ms-transform: rotate(330deg);
  transform: rotate(330deg);
}
.sk-spinner-circle .sk-circle {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
   <h1><i class="fa fa-home"></i> Home</h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="col-md-12">
<div class="sk-circle12 sk-circle"> asdf</div>
    <!-- Widget: user widget style 1 -->
    <div class="dashboard-wrapper clearfix">
      <div id="availabledash" class="dashcons col-sm-4 col-xs-12">
        <img class="dashboard-logo" src="../assets/img/dispatcher/pause.png" alt="">
        <h4>Available Dispatch</h4>
        <p>List of vehicles and drivers currently at the terminal awaiting dispatch.</p>
        <a class="btn btn-primary btn-md" href="available">Select</a>
      </div>
      <div id="activedash" class="dashcons col-sm-4 col-xs-12">
        <img class="dashboard-logo" src="../assets/img/dispatcher/play.png" alt="">
        <h4>Active Trips</h4>
        <p>List of dispatched vehicles and drivers currently on a route.</p>
        <a class="btn btn-primary btn-md" href="activetrips">Select</a>
      </div>
      <div id="scheduling" class="dashcons col-sm-4 col-xs-12">
        <img class="dashboard-logo" src="../assets/img/dispatcher/schedule.png" alt="">
        <h4>Scheduling</h4>
        <p>Review and update work schedule for drivers and vehicles.</p>
        <a class="btn btn-warning btn-md" href="schedulinglast">Previous Days</a>
        <a class="btn btn-primary btn-md" href="schedulingnext">Next 7 Days</a>
      </div>
    </div><!-- /.widget-user -->
  </div>
</section><!-- /.content -->
</div><!-- /.content-wrapper -->