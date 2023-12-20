<div class="container" style="padding-top: 1.5rem!important; padding-bottom: 3rem!important;">
    <div class="row">
        <?php $this->load->view('frontend/layout/breadcrumb'); ?>

        <div class="col-12 col-md-4 order-1 order-md-2 mb-3">
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
                        <p class="cart-ticket-name"><i class="bi bi-ticket-perforated"></i></p>
                        <hr>
                        <div class="event-detail-cart-amount">
                            <div class="event-detail-cart-amount-label" id="hitung">
                                <span id="qty-desktop" class="amount-label-qty">Total Bayar</span>
                                <label class="sub-total-price"><span id="sub-total-price"></span></label>
                            </div>
                            <div class="event-detail-cart-checkout">
                                <button class="btn btn-primary btn-block" id="buy" disabled>Beli Tiket</button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-sm-start align-items-center">
                        <span class="text-cap mb-0 me-2">Bagikan:</span>

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
                    <h1 class="h2" id="title"><?= $event['title'] ?></h1>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6 mb-3">
                            <h1 class="h5">
                                <b>Lokasi Acara</b>
                            </h1>
                            <div class="d-flex mt-2 mb-2">
                                <i class="bi bi-geo-alt-fill text-dark"></i>
                                <span style="margin-left: 8px;" class="text-truncate"><?= $event['location'] ?></span>
                            </div>
                            <h1 class="h5">
                                <b>Tanggal Pelaksanaan</b>
                            </h1>
                            <div class="d-flex mt-2 mb-2">
                                <i class="bi bi-calendar text-dark"></i>
                                <span style="margin-left: 8px;" class="text-truncate"><?= date('d M Y', strtotime($event['date_start'])) ?></span>
                            </div>
                            <div class="d-flex mt-2 mb-2">
                                <i class="bi bi-calendar text-dark"></i>
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
                <hr>
                <div class="text-center">
                    <ul class="nav nav-segment nav-pills mb-7" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="nav-one-eg1-tab" href="#nav-one-eg1" data-bs-toggle="pill" data-bs-target="#nav-one-eg1" role="tab" aria-controls="nav-one-eg1" aria-selected="true">Deskripsi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="nav-two-eg1-tab" href="#nav-two-eg1" data-bs-toggle="pill" data-bs-target="#nav-two-eg1" role="tab" aria-controls="nav-two-eg1" aria-selected="false">Tiket</a>
                        </li>
                    </ul>
                </div>
                <!-- End Nav -->

                <!-- Tab Content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel" aria-labelledby="nav-one-eg1-tab">
                        <h2>Deskripsi</h2>
                        <?= $event['description'] ?>
                        <h2>Syarat dan Ketentuan</h2>
                        <?= $event['snk'] ?>
                    </div>

                    <div class="tab-pane fade" id="nav-two-eg1" role="tabpanel" aria-labelledby="nav-two-eg1-tab">
                        <div class="event-box">
                            <div class="ticket-list">
                                <div>
                                    <div class="ticket-card">
                                        <div class="ticket-hole">
                                            <div class="ticket-stripes">
                                                <div class="ticket-header d-flex align-items-center">
                                                    <h5 class="ticket-card-title flex-grow-1"><?= $event['title'] ?></h5>
                                                </div>
                                                <div class="ticket-date">
                                                    <i class="bi bi-calendar"></i>
                                                    <span>Berakhir <?= $event['date_finish'] ?></span>
                                                </div>
                                                <div class="ticket-footer">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="align-items-center">
                                                            <div class="ticket-price">
                                                                <h5 class="mb-0">Harga Tiket</h5>
                                                                <span id="price" class="price"><?= isset($event['price']) ? rupiah($event['price']) : 'FREE' ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="ticket-buy align-items-center">
                                                            <label for="">Kuota:</label>
                                                            <span id="count-2"><?= $event['kuota'] ?></span>
                                                            <div class="counter">
                                                                <button id="decrement1" class="btn btn-sm btn-warning disabled left" type="button">-</button>
                                                                <span id="counter-1">0</span>
                                                                <button class="btn btn-sm btn-warning" id="increment1" type="button">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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