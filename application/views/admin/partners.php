<div class="content-header pr-lg-5 pl-lg-5">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="javascript:history.back()" class="btn btn-default float-r"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                    <a class="btn btn-info" href="<?= site_url('admin/usermanagement') ?>"><i class="far fa-calendar-plus"></i> Tambah Leader</a>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content pr-lg-5 pl-lg-5">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col 12">
                <select id="eventsId" name="eventsId" class="select2" data-placeholder="Pilih events" style="width: 100%;">
                    <option selected disabled>Pilih events terlebih dahulu</option>
                    <?php foreach ($events as $key) : ?>
                        <option value="<?= $key['id_events'] ?>"><?= $key['title'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
</section>
<section class="content pr-lg-5 pl-lg-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo 'Data ' . $title ?></h3>
                    </div>
                    <div id="loading-overlay" class="overlay">
                        <div class="loading"></div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table-data" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kuota Tiket</th>
                                    <th>Tiket Terjual</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($partner as $key) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $key['name'] ?></td>
                                        <td><?= $key['kuota_tiket'] ?></td>
                                        <td><?= $key['tiket_terjual'] ?></td>
                                        <td class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#tambahModal<?= $key['id_leader'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Tiket</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- edit modal -->
<?php foreach ($partner as $key) : ?>
    <div class="modal fade" id="tambahModal<?= $key['id_leader'] ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url('admin/partnership') ?>" method="post">
                    <input type="hidden" name="id_leader" value="<?= $key['id_leader'] ?>">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Tiket</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kuota Tiket</label>
                            <input type="text" name="kuota_tiket" id="kuota_tiket" class="form-control" value="<?= $key['kuota_tiket'] ?>">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="action" value="simpan" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach ?>