<div id="loading-overlay">
    <div id="loading-spinner"></div>
</div>
<div class="container events">
    <form id="form_checkout" method="post">
        <input type="hidden" name="events_id" value="<?= $event['id_events'] ?>">
        <input type="hidden" name="tiket" value="<?= $quantity ?>">
        <div class="row">
            <div class="col-12 col-md-8 mb-3">
                <div class="detail__event padding shadow-sm">
                    <h4 class="mb-3">Data Diri</h4>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" id="name_peserta" name="name_peserta" class="form-control" placeholder="beserta gelar lengkap" value="<?= set_value('name_peserta') ?>">
                        <?= form_error('name_peserta', '<span class="text-danger pl-3">', '</span>'); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" id="email" placeholder="pastikan tidak ada kesalahan penulisan email" class="form-control" value="<?= set_value('email') ?>">
                        <?= form_error('email', '<span class="text-danger pl-3">', '</span>'); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No WhatsApp</label>
                        <input type="text" name="nowa" id="nowa" value="08" class="form-control" value="<?= set_value('nowa') ?>">
                        <?= form_error('nowa', '<span class="text-danger pl-3">', '</span>'); ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Domisili</label>
                        <input type="text" id="domisili" name="domisili" class="form-control" value="<?= set_value('domisili') ?>">
                        <?= form_error('domisili', '<span class="text-danger pl-3">', '</span>'); ?>
                    </div>
                    <h4 class="mb-3 mt-4">Metode Pembayaran</h4>
                    <?php foreach ($rekening as $rekening) : ?>
                        <div class="form-check mb-3">
                            <input type="radio" id="bank" class="form-check-input" name="bank" value="<?= $rekening['name_bank'] ?>">
                            <label class="form-check-label" for="<?= $rekening['name_bank'] ?>"><?= $rekening['name_bank'] ?></label>
                        </div>
                    <?php endforeach ?>
                    <?= form_error('bank', '<span class="text-danger pl-3">', '</span>'); ?>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="sidebar__event">
                    <!-- Step -->
                    <div class="detail__event padding shadow-sm mb-4">
                        <div class="card-body">
                            <div class="border-bottom pb-4 mb-4">
                                <h3 class="card-header-title">Detail Pesanan</h3>
                            </div>
                            <input type="hidden" name="" value="<?= $event['title'] ?>">
                            <div class="border-bottom pb-4 mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Masukan Kode Promo" aria-label="Masukan Kode Promo">
                                <div class="d-grid mt-3">
                                    <button class="btn btn-secondary" href="../demo-shop/checkout.html">Submit</button>
                                </div>
                            </div>

                            <div class="border-bottom pb-4 mb-4">
                                <div class="d-grid gap-3">
                                    <dl class="row">
                                        <dt class="col-sm-6">Item subtotal (<?= $quantity ?>)</dt>
                                        <dd class="col-sm-6 text-sm-end mb-0" id="subtotal"><?= isset($subtotal) ? rupiah($subtotal) : 'FREE' ?></dd>
                                    </dl>
                                    <!-- End Row -->

                                    <dl class="row">
                                        <dt class="col-sm-6">Kode Unik</dt>
                                        <dd class="col-sm-6 text-sm-end mb-0" id="kodeunik"><?= kodeunik() ?></dd>
                                    </dl>
                                    <!-- End Row -->
                                </div>
                            </div>

                            <div class="d-grid gap-3 mb-4">
                                <dl class="row">
                                    <dt class="col-sm-6">Diskon</dt>
                                    <dd class="col-sm-6 text-sm-end mb-0">Rp. 0</dd>
                                </dl>
                                <!-- End Row -->

                                <dl class="row">
                                    <dt class="col-sm-6">Total</dt>
                                    <dd class="col-sm-6 text-sm-end mb-0" id="total"></dd>
                                    <input type="hidden" name="nominal" id="nominal">
                                </dl>
                                <!-- End Row -->
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="ceksnk" name="ceksnk" required checked>
                                <label class="form-check-label small" for="ceksnk"> Saya telah menyetujui dan mamahami <a href="#">Syarat dan Ketentuan</a> yang berlaku.</label>
                                <span class="invalid-feedback">Harap terima Syarat dan Ketentuan kami.</span>
                            </div>
                            <div class="d-grid">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#submitModal">Bayar</button>

                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                    <!-- Media -->
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="svg-icon svg-icon-sm text-primary">
                                <img src="<?= base_url('assets/frontend/vendor/duotone-icons/com/com012.svg') ?>" alt="">
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <span class="small me-1">Butuh Bantuan?</span>
                            <a class="link small" href="https://wa.me/<?= get_setting('whatsapp') ?>">Hubungi Kami</a>
                        </div>
                    </div>
                    <!-- End Media -->
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div id="submitModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="submitModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="submitModalTitle"><i class="bi bi-exclamation-octagon"></i> Periksa sekali lagi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3 class="text-warning">Kesalahan email menyebabkan e-ticket tidak terkirim.</h3>
                        <p id="emailverif"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-bs-dismiss="modal">Edit</button>
                        <button type="submit" class="btn btn-primary">Lanjut</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Modal -->
    </form>
</div>
<script src="<?= base_url('assets/frontend/') ?>js/event/checkout.js"></script>