<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="flex-grow-1">
    <!-- Form -->
    <div class="container content-space-3 content-space-b-lg-3">
        <div class="flex-grow-1 mx-auto" style="max-width: 28rem;">
            <!-- Heading -->
            <div class="text-center mb-5 mb-md-7">
                <h1 class="h2">Selamat datang kembali</h1>
                <p>Masuk untuk mengelola akun Anda.</p>
            </div>
            <!-- End Heading -->

            <!-- Form -->
            <form method="post" action="<?= site_url('auth') ?>" class="needs-validation" novalidate>
                <!-- Form -->
                <div class="mb-4">
                    <label class="form-label" for="email">Email Anda</label>
                    <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Masukan email Anda" aria-label="Masukan email Anda" required>
                    <?= form_error('email', '<span class="invalid-feedback">', '</span>'); ?>
                </div>
                <!-- End Form -->

                <!-- Form -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="form-label" for="passowrd">Password</label>

                        <!-- <a class="form-label-link" href="#">Lupa Password?</a> -->
                    </div>

                    <div class="input-group input-group-merge" data-hs-validation-validate-class>
                        <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="passowrd" placeholder="Masukan password Anda" aria-label="8+ characters required" data-hs-toggle-password-options='{
                                        "target": "#changePassTarget",
                                        "defaultClass": "bi-eye-slash",
                                        "showClass": "bi-eye",
                                        "classChangeTarget": "#changePassIcon"
                                    }'>
                        <a id="changePassTarget" class="input-group-append input-group-text" href="javascript:;">
                            <i id="changePassIcon" class="bi-eye"></i>
                        </a>
                    </div>
                    <?= form_error('password', '<span class="invalid-feedback">', '</span>'); ?>
                </div>
                <!-- End Form -->

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">Masuk</button>
                </div>

                <div class="text-center">
                    <p>Ingin bergabung menjadi Leader? <a class="link" href="#">Hubungi Admin</a></p>
                </div>
            </form>
            <!-- End Form -->
        </div>
    </div>
    <!-- End Col -->
    <!-- End Form -->
</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- JS Global Compulsory  -->
<script src="<?= base_url('assets/frontend/') ?>vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS Implementing Plugins -->
<script src="<?= base_url('assets/frontend/') ?>vendor/hs-toggle-password/dist/js/hs-toggle-password.js"></script>

<!-- JS Front -->
<script src="<?= base_url('assets/frontend/') ?>js/theme.min.js"></script>

<!-- JS Plugins Init. -->
<script>
    (function() {
        // INITIALIZATION OF TOGGLE PASSWORD
        // =======================================================
        new HSTogglePassword('.js-toggle-password')
    })()
</script>

<!-- sweetalert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var maintenanceLinks = document.getElementsByClassName('maintenance');

    // Memastikan bahwa ada setidaknya satu elemen dengan class 'maintenance'
    if (maintenanceLinks.length > 0) {
        // Menambahkan event listener pada elemen pertama dengan class 'maintenance'
        maintenanceLinks[0].addEventListener('click', function() {
            // Menampilkan SweetAlert ketika elemen di klik
            Swal.fire({
                title: "Coming Soon",
                icon: "info",
                html: "Features in development",
                showCancelButton: true,
                showConfirmButton: false,
            });
        });
    }
</script>
</body>

</html>