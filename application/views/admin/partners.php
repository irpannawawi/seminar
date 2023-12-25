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
                                    <th>Nama</th>
                                    <th>Tiket Terjual</th>
                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($partner as $key) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $key['name'] ?></td>
                                        <td><?= $key['tiket_terjual'] ?></td>
                                        <!-- <td class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#editModal<?= $key['id_leader'] ?>" class="btn btn-secondary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            <a href="<?= base_url('admin/events/deleteCategory/' . $key['id_leader']); ?>" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i> Delete</a>
                                        </td> -->
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
    <div class="modal fade" id="editModal<?= $key['id_leader'] ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url('admin/events/category') ?>" method="post">
                    <input type="hidden" name="id_leader" value="<?= $key['id_leader'] ?>">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit <?= $title; ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Kategori</label>
                            <input type="text" name="name_category" id="name_category" class="form-control" value="<?= $key['name_category'] ?>">
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