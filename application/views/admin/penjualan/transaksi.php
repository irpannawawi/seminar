<div class="content-header">
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
                                    <th>Nama Peserta</th>
                                    <th>Nama Event</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($transaksi as $value) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $value['name_peserta'] ?></td>
                                        <td><?= $value['title'] ?></td>
                                        <td><?= $value['date_transaksi'] ?></td>
                                        <td><?= $value['status_transaksi'] ?></td>
                                        <td class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#detailModal<?= $value['id_transaksi'] ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</a>
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

<!-- add modal -->
<?php foreach ($transaksi as $value) : ?>
    <div class="modal fade" id="detailModal<?= $value['id_transaksi'] ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url('admin/events/category') ?>" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail <?= $value['name_peserta']; ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <tr>
                                <td><b>Nama: </b></td>
                                <td><?= $value['name_peserta']; ?></td><br>
                                <td><b>Nama Event: </b></td>
                                <td><?= $value['title']; ?></td><br>
                                <td><b>Nominal: </b></td>
                                <td><?= rupiah($value['nominal']); ?></td><br>
                                <td><b>Bank Tujuan: </b></td>
                                <td><?= $value['bank_transfer']; ?></td><br>
                                <td><b>Tanggal Transaksi: </b></td>
                                <td><?= $value['date_transaksi']; ?></td><br>
                                <td><b>Jumlah Tiket: </b></td>
                                <td><?= $value['tiket']; ?></td><br>
                                <td><b>Status Pembayaran: </b></td>
                                <td><?= $value['status_transaksi']; ?></td><br>
                                <td><b>Bukti Transfer: </b></td>
                                <td><a href="#">Download</a></td>
                            </tr>
                        </div>
                        <form action="" method=" post">
                            <div class="form-group">
                                <label>Ubah Status Transaksi</label>
                                <select name="" id="" class="form-control">
                                    <option value="Tertunda">Tertunda</option>
                                    <option value="Refund">Refund</option>
                                    <option value="Lunas">Lunas</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach ?>