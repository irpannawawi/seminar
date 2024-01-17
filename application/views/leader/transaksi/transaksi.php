<div class="content-header ">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="javascript:history.back()" class="btn btn-default float-r"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                    <a class="btn btn-info" href="<?= site_url('leader/transaksi/add') ?>"><i class="fas fa-user-plus"></i> Tambah Transaksi</a>
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
                            <form action="<?= base_url('leader/transaksi') ?>" method="post">
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
                                    <th>ID ORDER</th>
                                    <th>Event</th>
                                    <th>Nama Peserta</th>
                                    <th>Tiket</th>
                                    <th>Status</th>
                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($transaksi)) : ?>
                                    <tr class="text-center bg-red">
                                        <td colspan="7">Data <b><?= set_value('keyword') ?></b> tidak ditemukan!</td>
                                    </tr>
                                <?php endif ?>
                                <?php foreach ($transaksi as $key) : ?>
                                    <tr>
                                        <td><?= ++$offset ?></td>
                                        <td><?= $key['id_order'] ?></td>
                                        <td><?= $key['title'] ?></td>
                                        <td><?= $key['name'] ?></td>
                                        <td><?= $key['tiket'] ?></td>
                                        <td><?= status_transaksi($key['status_transaksi']) ?></td>
                                        <td class="text-center">
                                            <!-- <a href="javascript:;" data-toggle="modal" data-target="#lihatModal<?= $key['id_transaksi'] ?>" class="btn btn-info btn-sm"><i class="far fa-eye"></i></i> Lihat Bukti Transfer</a> -->
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <?= $pagination ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>