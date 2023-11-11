<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/backend') ?>/dist/css/adminlte.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= site_url('/login') ?>"><b>AcaraKu</b>.com</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <form action="<?= site_url('auth') ?>" method="post" id="loginform">
                    <p class="login-box-msg">Masuk untuk memulai sesi</p>
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="login-email" class="form-control" placeholder="Email" value="admin@gmail.com">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="admin">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Ingat saya
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>

                    <p class="mb-1">
                        <a href="forgot-password.html">Lupa password?</a>
                    </p>
                    <p class="mb-0">
                        <a href="javascript:void(0)" id="to-regis" class="text-center">Daftar akun partnership</a>
                    </p>
                </form>
                <!-- regis form -->
                <form action="<?= site_url('auth/registration') ?>" method="post" id="regisform">
                    <p class="login-box-msg">Daftar akun partnership</p>
                    <div class="input-group mb-3">
                        <input type="user" name="name" id="name" class="form-control" placeholder="Nama Lengkap">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="regis-email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password1" id="password1" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password2" id="password2" class="form-control" placeholder="Konfirmasi Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    I agree to the terms
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <p class="mb-0">
                        <a href="javascript:void(0)" id="to-login" class="text-center">Masuk jika sudah punya akun</a>
                    </p>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/backend') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/backend') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/backend') ?>/dist/js/adminlte.min.js"></script>

    <script>
        $('#to-regis').on("click", function() {
            $("#loginform").slideUp();
            $("#regisform").slideDown();
        });

        $('#to-login').on("click", function() {
            $("#regisform").slideUp();
            $("#loginform").slideDown();
        });
    </script>
</body>

</html>