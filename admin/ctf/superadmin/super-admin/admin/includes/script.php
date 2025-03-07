<script src="assests/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assests/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assests/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="assests/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assests/plugins/sparklines/sparkline.js"></script>
<!-- DataTables  & Plugins -->
<script src="assests/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assests/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assests/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assests/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assests/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assests/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assests/plugins/jszip/jszip.min.js"></script>
<script src="assests/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assests/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assests/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assests/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assests/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- JQVMap -->
<script src="assests/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assests/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assests/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assests/plugins/moment/moment.min.js"></script>
<script src="assests/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assests/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assests/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assests/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assests/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assests/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assests/dist/js/pages/dashboard.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
