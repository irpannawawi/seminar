<div class="content-header pr-lg-5">
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
<section class="content pr-lg-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo 'Data ' . $title ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table-data" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID ORDER</th>
                                    <th>Nama Event</th>
                                    <th>Tiket</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($transaksi as $key) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $key['id_order'] ?></td>
                                        <td><?= $key['title'] ?></td>
                                        <td><?= $key['tiket'] ?></td>
                                        <td><?= rupiah($key['nominal']) ?></td>
                                        <td><?= status_transaksi($key['status_transaksi']) ?></td>
                                        <td class="text-center">
                                            <?php if ($key['status_transaksi'] = 'Dibatalkan') : ?>
                                                <a href="javascript:;" data-toggle="modal" data-target="#tiketModal<?= $key['id_transaksi']  ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-shopping-basket"></i> Bayar
                                                </a>
                                            <?php else : ?>
                                                <a href="javascript:;" data-toggle="modal" data-target="#tiketModal<?= $key['id_transaksi']  ?>" class="btn btn-success btn-sm">
                                                    <i class="fas fa-shopping-basket"></i> Bayar
                                                </a>
                                                <a href="<?= base_url('leader/tiket/deleteTiket/' . $key['id_order']); ?>" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i> Batal</a>
                                            <?php endif ?>
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

<!-- <?php foreach ($events as $event) : ?>
    <div class="modal fade" id="tiketModal<?= $event['id_events'] ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url('leader/events') ?>" method="post">
                    <input type="hidden" name="price" value="<?= $event['price'] ?>">
                    <input type="hidden" name="id_events" value="<?= $event['id_events'] ?>">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= $event['title'] ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jumlah Tiket</label>
                            <input type="text" name="jml_tiket" id="jml_tiket" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Bank Transfer</label>
                            <select name="bank_transfer" id="bank_transfer" class="form-control">
                                <option disabled selected>Pilih Bank Transfer</option>
                                <?php foreach ($rekening as $key) : ?>
                                    <option value="<?= $key['name_bank'] ?>"><?= $key['name_bank'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="action" value="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach ?> -->