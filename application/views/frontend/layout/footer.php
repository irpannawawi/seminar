<!-- ========== FOOTER ========== -->
<footer class="bg-light">
    <div class="container pb-1 pb-lg-7">
        <div class="row content-space-t-2">
            <div class="col-lg-3 mb-7 mb-lg-0">
                <!-- Logo -->
                <div class="mb-5">
                    <a class="navbar-brand" href="<?= base_url('assets/frontend/') ?>index.html" aria-label="Space">
                        <img class="navbar-brand-logo" src="<?= base_url('assets/backend/dist/img/') . get_setting('logo_web') ?>" alt="Image Description"> Tenden
                    </a>
                </div>
                <!-- End Logo -->

                <!-- List -->
                <ul class="list-unstyled list-py-1">
                    <li><a class="link-sm link-secondary" href="#"><i class="bi-geo-alt-fill me-1"></i> 153 Williamson Plaza, Maggieberg</a></li>
                    <li><a class="link-sm link-secondary" href="tel:1-062-109-9222"><i class="bi-telephone-inbound-fill me-1"></i> +1 (062) 109-9222</a></li>
                </ul>
                <!-- End List -->

            </div>
            <!-- End Col -->

            <div class="col-sm mb-7 mb-sm-0">
                <h5 class="mb-3">Company</h5>

                <!-- List -->
                <ul class="list-unstyled list-py-1 mb-0">
                    <li><a class="link-sm link-secondary" href="#">About</a></li>
                    <li><a class="link-sm link-secondary" href="#">Careers <span class="badge bg-warning text-dark rounded-pill ms-1">We're hiring</span></a></li>
                    <li><a class="link-sm link-secondary" href="#">Blog</a></li>
                    <li><a class="link-sm link-secondary" href="#">Customers <i class="bi-box-arrow-up-right small ms-1"></i></a></li>
                    <li><a class="link-sm link-secondary" href="#">Hire us</a></li>
                </ul>
                <!-- End List -->
            </div>
            <!-- End Col -->

            <div class="col-sm mb-7 mb-sm-0">
                <h5 class="mb-3">Features</h5>

                <!-- List -->
                <ul class="list-unstyled list-py-1 mb-0">
                    <li><a class="link-sm link-secondary" href="#">Press <i class="bi-box-arrow-up-right small ms-1"></i></a></li>
                    <li><a class="link-sm link-secondary" href="#">Release Notes</a></li>
                    <li><a class="link-sm link-secondary" href="#">Integrations</a></li>
                    <li><a class="link-sm link-secondary" href="#">Pricing</a></li>
                </ul>
                <!-- End List -->
            </div>
            <!-- End Col -->

            <div class="col-sm mb-7 mb-sm-0">
                <h5 class="mb-3">Documentation</h5>

                <!-- List -->
                <ul class="list-unstyled list-py-1 mb-0">
                    <li><a class="link-sm link-secondary" href="#">Support</a></li>
                    <li><a class="link-sm link-secondary" href="#">Docs</a></li>
                    <li><a class="link-sm link-secondary" href="#">Status</a></li>
                    <li><a class="link-sm link-secondary" href="#">API Reference</a></li>
                    <li><a class="link-sm link-secondary" href="#">Tech Requirements</a></li>
                </ul>
                <!-- End List -->
            </div>
            <!-- End Col -->

            <div class="col-sm">
                <h5 class="mb-3">Resources</h5>

                <!-- List -->
                <ul class="list-unstyled list-py-1 mb-5">
                    <li><a class="link-sm link-secondary" href="#"><i class="bi-question-circle-fill me-1"></i> Help</a></li>
                    <li><a class="link-sm link-secondary" href="#"><i class="bi-person-circle me-1"></i> Your Account</a></li>
                </ul>
                <!-- End List -->
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->

        <div class="border-top my-7"></div>


        <!-- Copyright -->
        <div class="w-md-85 text-lg-center mx-lg-auto">
            <p class="text-muted small">&copy; Front. 2021 Htmlstream. All rights reserved.</p>
        </div>
        <!-- End Copyright -->
    </div>
</footer>
<!-- ========== END FOOTER ========== -->

<!-- ========== SECONDARY CONTENTS ========== -->
<!-- Go To -->
<a class="js-go-to go-to position-fixed" href="javascript:;" style="visibility: hidden;" data-hs-go-to-options='{
"offsetTop": 700,
"position": {
    "init": {
    "right": "2rem"
    },
    "show": {
    "bottom": "2rem"
    },
    "hide": {
    "bottom": "-2rem"
    }
}
}'>
    <i class="bi-chevron-up"></i>
</a>
<div class="offcanvas offcanvas-top offcanvas-navbar-search bg-light" tabindex="-1" id="offcanvasNavbarSearch">
    <div class="offcanvas-body">
        <div class="container">
            <div class="w-lg-75 mx-lg-auto">
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="mb-7">
                    <!-- Form -->
                    <form>
                        <!-- Input Card -->
                        <div class="input-card">
                            <div class="input-card-form">
                                <input type="text" class="form-control form-control-lg" placeholder="Search Front" aria-label="Search Front">
                            </div>
                            <button type="button" class="btn btn-primary btn-lg">Search</button>
                        </div>
                        <!-- End Input Card -->
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ========== END SECONDARY CONTENTS ========== -->

<!-- JS Global Compulsory  -->
<script src="<?= base_url('assets/frontend/') ?>vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS Implementing Plugins -->
<script src="<?= base_url('assets/frontend/') ?>vendor/hs-header/dist/hs-header.min.js"></script>
<script src="<?= base_url('assets/frontend/') ?>vendor/hs-mega-menu/dist/hs-mega-menu.min.js"></script>
<script src="<?= base_url('assets/frontend/') ?>vendor/hs-show-animation/dist/hs-show-animation.min.js"></script>
<script src="<?= base_url('assets/frontend/') ?>vendor/hs-go-to/dist/hs-go-to.min.js"></script>
<script src="<?= base_url('assets/frontend/') ?>vendor/aos/dist/aos.js"></script>
<script src="<?= base_url('assets/frontend/') ?>vendor/typed.js/lib/typed.min.js"></script>
<script src="<?= base_url('assets/frontend/') ?>vendor/swiper/swiper-bundle.min.js"></script>

<!-- JS Front -->
<script src="<?= base_url('assets/frontend/') ?>js/theme.min.js"></script>
<script src="<?= base_url('assets/frontend/') ?>js/custom.js"></script>

<!-- JS Plugins Init. -->
<script>
    (function() {
        // INITIALIZATION OF HEADER
        // =======================================================
        new HSHeader('#header').init()


        // INITIALIZATION OF SHOW ANIMATIONS
        // =======================================================
        new HSShowAnimation('.js-animation-link')


        // INITIALIZATION OF BOOTSTRAP DROPDOWN
        // =======================================================
        HSBsDropdown.init()


        // INITIALIZATION OF GO TO
        // =======================================================
        new HSGoTo('.js-go-to')


        // INITIALIZATION OF AOS
        // =======================================================
        AOS.init({
            duration: 650,
            once: true
        });


        // INITIALIZATION OF TEXT ANIMATION (TYPING)
        // =======================================================
        HSCore.components.HSTyped.init('.js-typedjs')

        // INITIALIZATION OF SWIPER
        // =======================================================
        var preloader = new Swiper('.js-swiper-preloader', {
            slidesPerView: 4,
            spaceBetween: 30,
            pagination: {
                el: '.js-swiper-preloader-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.js-swiper-preloader-button-next',
                prevEl: '.js-swiper-preloader-button-prev',
            },
            on: {
                'imagesReady': function(swiper) {
                    const preloader = swiper.el.querySelector('.js-swiper-preloader')
                    preloader.parentNode.removeChild(preloader)
                }
            }
        });
    })();
</script>
</body>

</html>