<div class="container" style="padding-top: 1.5rem!important; padding-bottom: 3rem!important;">
    <div class="row">
        <?php $this->load->view('frontend/layout/breadcrumb'); ?>

        <div class="col-12 col-md-4 order-1 order-md-2">
            <!-- Sticky Block -->
            <div id="stickyBlockStartPoint">
                <div class="js-sticky-block" data-hs-sticky-block-options='{
                        "parentSelector": "#stickyBlockStartPoint",
                        "breakpoint": "lg",
                        "startPoint": "#stickyBlockStartPoint",
                        "endPoint": "#stickyBlockEndPoint",
                        "stickyOffsetTop": 20,
                        "stickyOffsetBottom": 0
                    }'>
                    <!-- Step -->
                    <div class="detail__event card-bordered mb-3">
                        <img src="<?= base_url('assets/frontend/img/events/') . $event['image'] ?>" alt="" class="image card-event-image">
                    </div>
                    <div class="detail__event card-bordered mb-3">
                        <span class="cart-ticket-name"><i class="bi bi-ticket-perforated"></i> Kamu belum memiliki tiket, Silakan pilih tiket terlebih dulu di <b>tab menu TIKET</b></span>
                        <hr>
                        <div class="event-detail-cart-amount">
                            <div class="event-detail-cart-amount-label">
                                <span id="qty-desktop" class="amount-label-qty">Harga mulai dari</span>
                                <label>Rp. <span id="sub-total-price">75.000</span></label>
                            </div>
                            <div class="event-detail-cart-checkout">
                                <button class="btn btn-primary btn-block" disabled>Beli Tiket</button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-sm-start align-items-center">
                        <span class="text-cap mb-0 me-2">Share:</span>

                        <div class="d-flex gap-2">
                            <a class="btn btn-soft-secondary btn-sm btn-icon rounded-circle" href="#">
                                <i class="bi-facebook"></i>
                            </a>
                            <a class="btn btn-soft-secondary btn-sm btn-icon rounded-circle" href="#">
                                <i class="bi-twitter"></i>
                            </a>
                            <a class="btn btn-soft-secondary btn-sm btn-icon rounded-circle" href="#">
                                <i class="bi-instagram"></i>
                            </a>
                            <a class="btn btn-soft-secondary btn-sm btn-icon rounded-circle" href="#">
                                <i class="bi-telegram"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8 order-1 order-md-1">
            <div class="detail__event card-bordered">
                <div class="mb-2">
                    <h1 class="h2"><?= $event['title'] ?></h1>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6 mb-3">
                            <h1 class="h5">
                                <b>Lokasi Acara</b>
                            </h1>
                            <div class="d-flex mt-2 mb-2">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span style="margin-left: 8px;" class="text-truncate"><?= $event['location'] ?></span>
                            </div>
                            <h1 class="h5">
                                <b>Tanggal Pelaksanaan</b>
                            </h1>
                            <div class="d-flex mt-2 mb-2">
                                <i class="bi bi-calendar"></i>
                                <span style="margin-left: 8px;" class="text-truncate"><?= date('d M Y', strtotime($event['date_start'])) ?></span>
                            </div>
                            <div class="d-flex mt-2 mb-2">
                                <i class="bi bi-calendar"></i>
                                <span style="margin-left: 8px;" class="text-truncate"><?= date('d M Y', strtotime($event['date_finish'])) ?></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                            <h1 class="h5">
                                <b>Penyelenggara</b>
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- Nav -->
                <div class="text-center">
                    <ul class="nav nav-segment nav-pills mb-7" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-one-eg1-tab" href="#nav-one-eg1" data-bs-toggle="pill" data-bs-target="#nav-one-eg1" role="tab" aria-controls="nav-one-eg1" aria-selected="true">Deskripsi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-two-eg1-tab" href="#nav-two-eg1" data-bs-toggle="pill" data-bs-target="#nav-two-eg1" role="tab" aria-controls="nav-two-eg1" aria-selected="false">Tiket</a>
                        </li>
                    </ul>
                    <hr>
                </div>
                <!-- End Nav -->

                <!-- Tab Content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel" aria-labelledby="nav-one-eg1-tab">
                        <div class="text-dark">
                            <?= $event['description'] ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-two-eg1" role="tabpanel" aria-labelledby="nav-two-eg1-tab">
                        <div class="text-dark">
                            <?= $event['description'] ?>
                        </div>
                    </div>
                </div>
                <!-- End Tab Content -->
            </div>
        </div>
        <!-- Sticky Block End Point -->
        <div id="stickyBlockEndPoint"></div>
    </div>
</div>