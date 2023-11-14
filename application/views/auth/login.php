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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
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
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" placeholder="Email" id="email" name="email" value="<?= set_value('email') ?>">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="admin">
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
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url('assets/backend') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- jquery-validation -->
    <script src="<?= base_url('assets/backend') ?>/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?= base_url('assets/backend') ?>/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/backend') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/backend') ?>/dist/js/adminlte.min.js"></script>
    <!-- toastr -->
    <script src="<?= base_url('assets/backend') ?>/plugins/toastr/toastr.min.js"></script>

    <!-- <script>
        $('#to-regis').on("click", function() {
            $("#loginform").slideUp();
            $("#regisform").slideDown();
        });

        $('#to-login').on("click", function() {
            $("#regisform").slideUp();
            $("#loginform").slideDown();
        });
    </script> -->
    <script>
        <?php if ($this->session->flashdata('error')) { ?>
            var message = <?= json_encode($this->session->flashdata('error')) ?>;
            toastr.error(message)
        <?php } ?>
    </script>
    <script>
        $(function() {
            $('#loginform').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 3
                    },
                    terms: {
                        required: false
                    },
                },
                messages: {
                    email: {
                        required: "Harap masukkan alamat email",
                        email: "Masukkan alamat email yang valid"
                    },
                    password: {
                        required: "Harap masukan kata sandi",
                        minlength: "Kata sandi Anda harus terdiri dari minimal 8 karakter"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
</body>

</html>