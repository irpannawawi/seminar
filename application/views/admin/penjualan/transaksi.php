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
                        <div class="card-tools">
                            <form action="<?= base_url('admin/penjualan/transaksi') ?>" method="post">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" value="<?= set_value('keyword') ?>" name="keyword" class="form-control float-right" placeholder="Search" autocomplete="off" autofocus>

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-head-fixed table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
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
                                        <td><?= ($value['user_id'] !== null) ? $value['user_name'] . ' [Leader]' : $value['peserta_name'] ?></td>
                                        <td><?= $value['title'] ?></td>
                                        <td><?= tanggal($value['date_transaksi']) ?></td>
                                        <td><?= status_transaksi($value['status_transaksi']) ?></td>
                                        <td class="text-center">
                                            <?php
                                            $modalTarget = ($value['user_id'] !== null) ? "#leaderDetailModal{$value['id_transaksi']}" : "#detailModal{$value['id_transaksi']}";
                                            ?>
                                            <a href="javascript:;" data-toggle="modal" data-target="<?= $modalTarget ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> Detail</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <?= $pagination ?>
                        </div>
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
                <form action="<?=site_url('admin/penjualan/update_transaksi/'.$value['id_order'])?>" method="POST">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail <?= $value['peserta_name']; ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <tr>
                                <td><b>Order By: </b></td>
                                <td><?= $value['by_order']; ?></td><br>
                                <td><b>Nama: </b></td>
                                <td><?= $value['peserta_name']; ?></td><br>
                                <td><b>Nama Event: </b></td>
                                <td><?= $value['title']; ?></td><br>
                                <td><b>Nominal: </b></td>
                                <td><?= ($value['nominal'] !== null) ? rupiah($value['nominal']) : 0; ?></td><br>
                                <td><b>Bank Tujuan: </b></td>
                                <td><?= $value['bank_transfer']; ?></td><br>
                                <td><b>Tanggal Transaksi: </b></td>
                                <td><?= $value['date_transaksi']; ?></td><br>
                                <td><b>Jumlah Tiket: </b></td>
                                <td><?= $value['tiket']; ?></td><br>
                                <td><b>Status Pembayaran: </b></td>
                                <td><?= $value['status_transaksi']; ?></td><br>
                                <td><b>Bukti Transfer: </b></td>
                                <td><a data-toggle="modal" data-target="#lihatModal<?= $value['id_transaksi'] ?>" href="javascript:;">Lihat Bukti Transfer</a></td>
                            </tr>
                        </div>
                            <div class="form-group">
                                <label>Ubah Status Transaksi</label>
                                <select name="status_transaksi" id="status_transaksi" class="form-control">
                                    <option <?=$value['status_transaksi']=='Tertunda'?'selected':''?> value="Tertunda">Tertunda</option>
                                    <option <?=$value['status_transaksi']=='Refund'?'selected':''?> value="Refund">Refund</option>
                                    <option <?=$value['status_transaksi']=='Lunas'?'selected':''?> value="Lunas">Lunas</option>
                                    <option <?=$value['status_transaksi']=='Prosses'?'selected':''?> value="Prosses">Proses</option>
                                    <option <?=$value['status_transaksi']=='Dibatalkan'?'selected':''?> value="Dibatalkan">Batal</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach ?>
<?php foreach ($transaksi as $value) : ?>
    <div class="modal fade" id="leaderDetailModal<?= $value['id_transaksi'] ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?=site_url('admin/penjualan/update_transaksi/'.$value['id_order'])?>" method="post">
                    <input type="hidden" name="events_id" value="<?= $value['id_events'] ?>">
                    <input type="hidden" name="id_transaksi" value="<?= $value['id_transaksi'] ?>">
                    <input type="hidden" name="user_id" value="<?= $value['user_id'] ?>">
                    <!-- <input type="hidden" name="role_id" value="<?= $users['role_id'] ?>"> -->
                    <div class="modal-header">
                        <h4 class="modal-title">Detail <?= $value['user_name']; ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <tr>
                                <td><b>Order By: </b></td>
                                <td><?= $value['by_order']; ?></td><br>
                                <td><b>Nama: </b></td>
                                <td><?= $value['user_name']; ?></td><br>
                                <td><b>Nama Event: </b></td>
                                <td><?= $value['title']; ?></td><br>
                                <td><b>Nominal: </b></td>
                                <td><?= rupiah($value['nominal']); ?></td><br>
                                <td><b>Bank Tujuan: </b></td>
                                <td><?= $value['bank_transfer']; ?></td><br>
                                <td><b>Tanggal Transaksi: </b></td>
                                <td><?= tanggal($value['date_transaksi']); ?></td><br>
                                <td><b>Jumlah Tiket: </b></td>
                                <td><?= $value['tiket']; ?></td><br>
                                <td><b>Status Pembayaran: </b></td>
                                <td><?= $value['status_transaksi']; ?></td><br>
                                <td><b>Bukti Transfer: </b></td>
                                <td><a data-toggle="modal" data-target="#lihatModal<?= $value['id_transaksi'] ?>" href="javascript:;">Lihat Bukti Transfer</a></td>
                            </tr>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Ubah Status Transaksi</label>
                                    <select name="status_transaksi" id="status_transaksi" class="form-control">
                                        <option <?=$value['status']=='Tertunda'?'selected':''?> value="Tertunda">Tertunda</option>
                                        <option <?=$value['status']=='Refund'?'selected':''?> value="Refund">Refund</option>
                                        <option <?=$value['status']=='Lunas'?'selected':''?> value="Lunas">Lunas</option>
                                        <option <?=$value['status']=='Prosses'?'selected':''?> value="Prosses">Proses</option>
                                        <option <?=$value['status']=='Dibatalkan'?'selected':''?> value="Dibatalkan">Batal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Tiket</label>
                                    <input type="text" name="tiket" id="tiket" value="0" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" value="leader" name="action" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach ?>
<?php foreach ($transaksi as $key) : ?>
    <div class="modal fade" id="lihatModal<?= $key['id_transaksi'] ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bukti Transfer</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <img style="width: 100%;" src="<?= base_url('assets/bukti/') . $key['bukti_tf'] ?>" alt="<?= $key['bukti_tf'] ?>">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>