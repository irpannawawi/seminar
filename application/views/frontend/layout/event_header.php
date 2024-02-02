<!DOCTYPE html>
<html lang="en" dir="">

<head>
    <!-- Title -->
    <?php
    $description = get_setting('meta_google');
    $title = $title . ' - ' . get_setting('title_web');
    ?>
    <!-- Required Meta Tags Always Come First -->
    <title itemprop="title"><?= $title ?></title>
    <link href="<?= base_url('assets/backend/dist/img/') . get_setting('logo_web') ?>" itemprop="image" />
    <link href="<?= base_url('assets/backend/dist/img/') . get_setting('logo_web') ?>" rel="icon" type="image/ico" />
    <link rel="apple-touch-icon-precomposed" href="<?= base_url('assets/backend/dist/img/') . get_setting('logo_web') ?>">
    <link rel="canonical" href="<?= base_url(uri_string()) ?>" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="title" content="<?= $title ?>" />
    <meta name="description" content="<?= $description ?>" itemprop="description">
    <meta name="thumbnailUrl" content="<?= base_url('assets/backend/dist/img/') . get_setting('logo_web') ?>" itemprop="thumbnazilUrl" />
    <meta name="author" content="" itemprop="author">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base" content="<?= base_url(uri_string()) ?>" />
    <meta name="robots" content="index,follow" />
    <meta name="googlebot-news" content="index,follow" />
    <meta name="googlebot" content="index,follow" />
    <meta name="language" content="id" />
    <meta name="geo.country" content="id" />
    <meta http-equiv="content-language" content="In-Id" />
    <meta name="geo.placename" content="Indonesia" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="content-language" content="In-Id" />
    <meta content=<?= base_url(uri_string()) ?>" itemprop="url" />
    <meta charset="utf-8">
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= base_url(uri_string()) ?>" />
    <meta property="og:title" content="<?= $title ?>" />
    <meta property="og:description" content="<?= $description ?>" />
    <meta property="og:site_name" content="<?= $title ?>" />
    <meta property="og:image" content="<?= base_url('assets/backend/dist/img/') . get_setting('logo_web') ?>" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="fb:app_id" content="" />
    <meta property="fb:pages" content="" />
    <meta property="article:author" content="">
    <meta property="article:section" content="">

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
    <link rel="stylesheet" href="<?= base_url('assets/frontend/') ?>css/home/magnific.css">

    <!-- JS Global Compulsory  -->
    <script src="<?= base_url('assets/frontend/') ?>vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <!-- ========== HEADER ========== -->
    <!-- <header id="header" class="navbar navbar-expand-lg navbar-end navbar-light header__sticky"> -->
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
                            <a class="nav-link maintenance" href="javascript:void(0);"><i class="bi bi-compass-fill"></i> Jelajahi</a>
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