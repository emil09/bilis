	</div><!-- end of wrapper -->
    
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>2015 &copy; BEEP INTEGRATED LOGISTICS INFORMATION SYSTEM</strong>
    </footer>

<?php echo $js; ?>

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
