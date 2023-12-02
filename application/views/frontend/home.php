<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main">

    <div class="container content-space-1">
        <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
            <h2>Event Pilihan Untukmu</h2>
        </div>

        <div class="row gx-3 mx-n2">
            <?php foreach ($event as $event) : ?>
                <div class="col-lg-6">
                    <!-- Card -->
                    <div class="card card-bordered card-transition">
                        <figure>
                            <a href="#">
                                <img class="card-img" src="<?= base_url('assets/frontend/img/events/') . $event['image'] ?>" alt="<?= $event['title'] ?>">
                            </a>
                        </figure>
                        <div class="w-100 h-100 pr-3 pt-3">
                            <div class="text-truncate m-0 p-0">
                                <h5 class="btn-category">Category</h5>
                            </div>
                            <div class="col-12 p-0 text-truncate">
                                <a href="#" class="text-black">
                                    <h5 class="text-truncate"><?= $event['title'] ?></h5>
                                </a>
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

</main>
<!-- ========== END MAIN CONTENT ========== -->