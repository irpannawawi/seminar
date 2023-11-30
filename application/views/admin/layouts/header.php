<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?> | <?php echo get_setting('title_web'); ?></title>

    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/backend/dist/img/') . get_setting('logo_web') ?>">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/dist/css/custom.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/select2/css/select2.min.css">
    <script src="https://cdn.tiny.cloud/1/esu5z25uowjyn5k82a5wt5d72d8cnaj99cywlqyny4km65wi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/toastr/toastr.min.css">
    <style>
        .hidden {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">