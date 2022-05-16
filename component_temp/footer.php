<footer class="main-footer">
    <strong>Copyright &copy; 2021 <?= $title->title(); ?>.</strong>
    <div class="float-right d-none d-sm-inline-block">
    </div>
</footer>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>


<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<!--SWEET ALERT-->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
});
$(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
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

    $("#example3").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

    $("#menu_penjualan").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "paging" : false 
    }).buttons().container().appendTo('#menu_penjualan_wrapper .col-md-6:eq(0)');

    $("#menu_pembelian").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "paging" : false 
    }).buttons().container().appendTo('#menu_pembelian_wrapper .col-md-6:eq(0)');
    
    $("#retur").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "paging" : false 
    }).buttons().container().appendTo('#retur_wrapper .col-md-6:eq(0)');

    $('#laporan_penjualan').DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      buttons: [{
       extend: 'pdf',
       text : 'EXPORT PDF',
       pageSize	: 'LEGAL',
       className: 'btn btn-danger',
       title : 'LAPORAN PENJUALAN - BINTANG 89'
      }
    ]
    }).buttons().container().appendTo('#laporan_penjualan_wrapper .col-md-6:eq(0)');
    
    $('#laporan_pembelian').DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      buttons: [{
       extend: 'pdf',
       text : 'EXPORT PDF',
       pageSize	: 'LEGAL',
       className: 'btn btn-danger',
       title : 'LAPORAN PEMBELIAN - BINTANG 89'
      }
    ]
    }).buttons().container().appendTo('#laporan_pembelian_wrapper .col-md-6:eq(0)');
    
    $('#laporan_retur').DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      buttons: [{
       extend: 'pdf',
       text : 'EXPORT PDF',
       pageSize	: 'LEGAL',
       className: 'btn btn-danger',
       title : 'LAPORAN DATA RETUR - BINTANG 89'
      }
    ]
    }).buttons().container().appendTo('#laporan_retur_wrapper .col-md-6:eq(0)');
    
    $('#laporan_barang').DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      buttons: [{
       extend: 'pdf',
       text : 'EXPORT PDF',
       pageSize	: 'LEGAL',
       className: 'btn btn-danger',
       title : 'LAPORAN DATA BARANG - BINTANG 89'
      }
    ]
    }).buttons().container().appendTo('#laporan_barang_wrapper .col-md-6:eq(0)');
    
    $('#laporan_barang_rakit').DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      buttons: [{
       extend: 'pdf',
       text : 'EXPORT PDF',
       pageSize	: 'LEGAL',
       className: 'btn btn-danger',
       title : 'LAPORAN DATA BARANG RAKIT - BINTANG 89'
      }
    ]
    }).buttons().container().appendTo('#laporan_barang_rakit_wrapper .col-md-6:eq(0)');
    
    $('#laporan_profit_sales_peritem').DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      buttons: [{
       extend: 'pdf',
       text : 'EXPORT PDF',
       pageSize	: 'LEGAL',
       className: 'btn btn-danger',
       title : 'LAPORAN PROFIT SALES PER BARANG - BINTANG 89'
      }
    ]
    }).buttons().container().appendTo('#laporan_profit_sales_peritem_wrapper .col-md-6:eq(0)');
    
    $('#laporan_potongan_sales_peritem').DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      buttons: [{
       extend: 'pdf',
       text : 'EXPORT PDF',
       pageSize	: 'LEGAL',
       className: 'btn btn-danger',
       title : 'LAPORAN POTONGAN SALES PER BARANG - BINTANG 89'
      }
    ]
    }).buttons().container().appendTo('#laporan_potongan_sales_peritem_wrapper .col-md-6:eq(0)');

});
$(function() {
    $('[data-mask]').inputmask();
})
</script>
</body>
</html>