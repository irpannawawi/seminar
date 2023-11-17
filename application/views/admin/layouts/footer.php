<svg style="display:none">
    <defs>
        <symbol id="icon-imageUpload" clip-rule="evenodd" viewBox="0 0 96 96">
            <path d="M47 6a21 21 0 0 0-12.3 3.8c-2.7 2.1-4.4 5-4.7 7.1-5.8 1.2-10.3 5.6-10.3 10.6 0 6 5.8 11 13 11h12.6V22.7l-7.1 6.8c-.4.3-.9.5-1.4.5-1 0-2-.8-2-1.7 0-.4.3-.9.6-1.2l10.3-8.8c.3-.4.8-.6 1.3-.6.6 0 1 .2 1.4.6l10.2 8.8c.4.3.6.8.6 1.2 0 1-.9 1.7-2 1.7-.5 0-1-.2-1.3-.5l-7.2-6.8v15.6h14.4c6.1 0 11.2-4.1 11.2-9.4 0-5-4-8.8-9.5-9.4C63.8 11.8 56 5.8 47 6Zm-1.7 42.7V38.4h3.4v10.3c0 .8-.7 1.5-1.7 1.5s-1.7-.7-1.7-1.5Z M27 49c-4 0-7 2-7 6v29c0 3 3 6 6 6h42c3 0 6-3 6-6V55c0-4-3-6-7-6H28Zm41 3c1 0 3 1 3 3v19l-13-6a2 2 0 0 0-2 0L44 79l-10-5a2 2 0 0 0-2 0l-9 7V55c0-2 2-3 4-3h41Z M40 62c0 2-2 4-5 4s-5-2-5-4 2-4 5-4 5 2 5 4Z" />
        </symbol>
    </defs>
</svg>
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
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
<script src="<?= base_url('assets/backend') ?>/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/backend') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/backend') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/backend') ?>/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/backend') ?>/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url('assets/backend') ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/backend') ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/backend') ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/backend') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/backend') ?>/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/backend') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/backend') ?>/dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/backend') ?>/dist/js/custom.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url('assets/backend') ?>/dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/backend') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/pdfmake/vfs_fonts.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/backend') ?>/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url('assets/backend') ?>/plugins/toastr/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if ($this->session->flashdata('success')) { ?>
        var message = <?php echo json_encode($this->session->flashdata('success')) ?>;
        toastr.success(message)
    <?php } ?>
    <?php if ($this->session->flashdata('error')) { ?>
        var message = <?php echo json_encode($this->session->flashdata('error')) ?>;
        toastr.error(message)
    <?php } ?>
    <?php if (validation_errors()) { ?>
        var message = <?php echo json_encode(validation_errors()); ?>;
        toastr.error(message)
    <?php } ?>

    // Switch
    function toggleInput(showId) {
        var showElement = document.getElementById(showId);

        // Hide all elements with class 'hidden'
        var hiddenElements = document.querySelectorAll('.hidden');
        hiddenElements.forEach(function(element) {
            element.style.maxHeight = '0';
        });

        showElement.style.maxHeight = showElement.scrollHeight + 'px';
    }

    $(document).ready(function() {
        $('.status-badge').each(function() {
            var status = $(this).data('status');
            var badgeClass = (status == 'draft') ? 'badge-info' : 'badge-success';
            $(this).addClass(badgeClass);
        });
    });
</script>

<!-- sweet alert delete -->
<script>
    function confirmDelete(url) {
        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, yakin!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>
<script>
    $(function() {
        $("#table-data").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            // "buttons": ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#table-data_wrapper .col-md-6:eq(0)');

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
</body>

</html>