<div class=" container content-space-1">
    <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5">
        <h2>Event Pilihan Untukmu</h2>
    </div>

    <div class="row gx-3 mx-n2">
        <?php foreach ($event as $event) : ?>
            <div class="col-md-6 mb-4">
                <!-- Card -->
                <div class="card card-bordered card-transition list__event">
                    <figure>
                        <a href="<?= base_url('assets/frontend/img/events/') . $event['image'] ?>" class="image-popup-vertical-fit" title="<?= $event['title'] ?>">
                            <img class="card-img" src="<?= base_url('assets/frontend/img/events/') . $event['image'] ?>" alt="<?= $event['title'] ?>">
                        </a>
                    </figure>
                    <div class="w-100 h-100" style="padding: 15px 15px 0 0;">
                        <div class="text-truncate m-0 p-0">
                            <h5 class="btn-category">Category</h5>
                        </div>
                        <div class="col-12 p-0 text-truncate">
                            <a href="<?= site_url('event/' . $event['id_events'] . '/' . $event['slug']) ?>" class="text-black">
                                <h5 class="text-truncate title__event"><?= $event['title'] ?></h5>
                            </a>
                            <div class="d-flex mt-2 mb-2 align-items-center">
                                <i class="bi bi-calendar"></i>
                                <span style="margin-left: 8px;" class="mobile-text-small text-truncate"><?= tanggal($event['date_start']) ?></span>
                            </div>
                            <div class="d-flex mt-2 mb-2 align-items-center">
                                <i class="bi bi-clock"></i>
                                <span style="margin-left: 8px;" class="mobile-text-small text-truncate"><?= $event['time_start'] . ' - ' . $event['time_finish'] ?></span>
                            </div>
                            <div class="d-flex mt-2 mb-2 align-items-center">
                                <?php if ($event['type_event'] == 'offline') : ?>
                                    <i class="bi bi-geo-alt-fill text-dark"></i>
                                    <span style="margin-left: 8px;" class="text-truncate">
                                        <?= $event['location'] ?>
                                    </span>
                                <?php else : ?>
                                    <i class="bi bi-camera-reels text-dark"></i>
                                    <span style="margin-left: 8px;" class="text-truncate">
                                        <?= $event['label'] . '/' . $event['type_event'] ?>
                                    </span>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="d-flex w-100 justify-content-between d-mobile-none d-block position-relative" style="height:60px">
                            <div class="position-absolute" style="bottom:0;left:0">
                                <h5>Harga</h5>
                                <h3 class="btn-price mb-0"><?= isset($event['price']) ? rupiah($event['price'], 0) : 'FREE' ?></h3>
                            </div>
                            <div class="position-absolute" style="bottom:0;right:0">
                                <a href="<?= site_url('event/' . $event['id_events'] . '/' . $event['slug']) ?>" class="btn btn-dark d-flex px-4">Order</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Card -->
            </div>
        <?php endforeach ?>
        <!-- End Col -->
    </div>
    <!-- End Row -->
</div>