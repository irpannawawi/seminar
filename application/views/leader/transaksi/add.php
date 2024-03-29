<div class="content-header pr-lg-5 pl-lg-5">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="javascript:history.back()" class="btn btn-default float-r"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid pr-lg-5 pl-lg-5">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="card card-default">
                    <form action="<?= site_url('leader/transaksi/add') ?>" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Events</label>
                                        <select class="form-control select2" name="event" id="event">
                                            <option selected disabled>Pilih events</option>
                                            <?php foreach ($events as $event) : ?>
                                                <option value="<?= $event['id_events'] ?>"><?= tanggal($event['date_start'])  . ' - ' . $event['title'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="list_peserta_group list_peserta_group_template">
                                        <span class="peserta_list">Peserta 1</span>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="qty">Qty</label>
                                                    <input type="text" class="form-control" readonly value="1" name="qty" id="qty" value="<?= set_value('qty') ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="no_whatsapp">No. Whatsapp Aktif</label>
                                                    <input type="text" class="form-control" name="nowa" id="nowa" value="<?= set_value('nowa') ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="email">Alamat Email Aktif</label>
                                                    <input type="email" class="form-control" name="email" id="email" value="<?= set_value('email') ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control" name="name" id="name" value="<?= set_value('name') ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="no_whatsapp">Domisili</label>
                                                    <input type="text" class="form-control" name="domisili" id="domisili" value="<?= set_value('domisili') ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer justify-content-between">
                            <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Simpan</button>
                            <a type="button" class="btn btn-info"><i class="fas fa-plus"></i> Tambah Field</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="<?= base_url('assets/backend') ?>/dist/js/leader/transaksi.js"></script>