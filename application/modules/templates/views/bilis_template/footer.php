	</div><!-- end of wrapper -->
    
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>2015 &copy; BEEP INTEGRATED LOGISTICS INFORMATION SYSTEM</strong>
    </footer>

    <!-- jQuery 1.11.2 -->
    <script src="<?php echo base_url(); ?>assets/libs/jQuery/jquery-1.11.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/jQuery/jquery-migrate-1.2.1.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/libs/bootstrap/js/bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url() ?>assets/libs/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url() ?>assets/libs/fastclick/fastclick.min.js"></script>

    <!-- dataTables -->
    <script src="<?php echo base_url() ?>assets/libs/dataTables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/dataTables/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url() ?>assets/libs/dataTables/js/dataTables.responsive.js"></script>  

    <script src="<?php echo base_url() ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>  
    <script src="<?php echo base_url() ?>assets/libs/datepicker/bootstrap-datepicker.js"></script> 


    
    <!-- Select2 -->
    <script src="<?php echo base_url(); ?>assets/libs/select2/js/select2.full.min.js"></script>

    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>assets/libs/theme/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url() ?>assets/libs/theme/js/demo.js"></script>
    <!-- register.js -->
    <script src="<?php echo base_url() ?>assets/js/admin/register.js"></script>

    <script>
        jQuery('.table-res').DataTable({
            scrollY:        "410px",
            scrollCollapse: false,
            paging:         false,
            responsive:     true
        });
        jQuery(".editModal").click(function(){
            jQuery("#editModalWindow").modal({backdrop: 'static'});
        });
        jQuery(".select2").select2({
            placeholder: "Select a vehicle",
            allowClear: true
        });
    </script>
    <script type="text/javascript">
      $(function () {
        var currentDate = new Date();  
        $('#pickdate').datepicker();
      });
  </script>
  </body>
</html>
