<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <?php
    if ($this->uri->segment(1) == '') {
        echo '<title>' . get_setting('title_web') . ' - ' . get_setting('sub_title') . '</title>';
    } else {
        echo '<title>' . $title . ' - ' . get_setting('title_web') . '</title>';
    }
    ?>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/backend/dist/img/') . get_setting('logo_web') ?>">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>vendor/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>vendor/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>vendor/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>vendor/hs-mega-menu/dist/hs-mega-menu.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>vendor/quill/dist/quill.snow.css">

    <!-- CSS Front Template -->
    <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>css/theme.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>css/custom.css">

    <!-- JS Global Compulsory  -->
    <script src="<?= base_url('assets/frontend/') ?>vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- ========== HEADER ========== -->
    <header id="header" class="navbar navbar-expand-lg navbar-end navbar-light">
        <div class="container">
            <nav class="js-mega-menu navbar-nav-wrap">
                <!-- Default Logo -->
                <a class="navbar-brand" href="<?= site_url('/') ?>" aria-label="Front">
                    <img class="navbar-brand-logo" src="<?= base_url('assets/backend/dist/img/') . get_setting('logo_web') ?>" alt="Logo"> <?= get_setting('title_web') ?>
                </a>
                <!-- End Default Logo -->
                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-default">
                        <i class="bi-list"></i>
                    </span>
                    <span class="navbar-toggler-toggled">
                        <i class="bi-x"></i>
                    </span>
                </button>
                <!-- End Toggler -->

                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link " href="<?= site_url('/') ?>">Homes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="<?= site_url('/') ?>"><i class="bi bi-compass-fill"></i> Jelajahi</a>
                        </li>

                        <li class="nav-item">
                            <!-- Search -->
                            <button class="btn btn-ghost-secondary btn-sm btn-icon" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbarSearch" aria-controls="offcanvasNavbarSearch">
                                <i class="bi-search"></i>
                            </button>
                            <!-- End Search -->

                            <a href="<?= site_url('auth') ?>" class="btn btn-primary btn-transition">Login</a>
                        </li>
                    </ul>
                </div>
                <!-- End Collapse -->
            </nav>
        </div>
    </header>

    <!-- ========== END HEADER ========== -->
    <!-- ========== MAIN CONTENT ========== -->
    <main id="content" role="main" class="bg-light">