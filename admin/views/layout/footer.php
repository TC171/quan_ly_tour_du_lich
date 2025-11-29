<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2024-2025 <a href="#">Tour Admin</a>.</strong> All rights reserved.
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= BASE_URL_ADMIN ?>assets/dist/js/adminlte.min.js"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>