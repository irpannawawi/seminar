<div class="content-header pr-lg-5 pl-lg-5">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="javascript:history.back()" class="btn btn-default float-r"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                    <a class="btn btn-info" href="javascript:;" data-toggle="modal" data-target="#addModal"><i class="far fa-calendar-plus"></i> <?php echo 'Tambah ' . $title ?></a>
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
                                    <th>Nama Pengguna</th>
                                    <th>Role</th>
                                    <th>No HP</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($user as $key) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $key['name'] ?></td>
                                        <td>
                                            <span class="badge badge-pill status-badge badge-success"><?= $key['name_role'] ?></span>
                                        </td>
                                        <td><?= $key['no_hp'] ?></td>
                                        <td><?= $key['email'] ?></td>
                                        <td class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#editModal<?= $key['id_user'] ?>" class="btn btn-secondary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            <button onclick="confirmDelete('<?= base_url('admin/usermanagement/deleteuser/' . $key['id_user']); ?>')" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
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
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('admin/usermanagement') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo 'Tambah ' . $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="name" id="name" class="form-control">
                        <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                        <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role_id" id="role_id">
                            <option selected disabled>Pilih role pengguna</option>
                            <?php foreach ($role as $key) : ?>
                                <option value="<?= $key['id_role'] ?>"><?= $key['name_role'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('role_id', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="action" value="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- edit modal -->
<?php foreach ($user as $key) : ?>
    <div class="modal fade" id="editModal<?= $key['id_user'] ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url('admin/usermanagement') ?>" method="post">
                    <input type="hidden" name="id_user" value="<?= $key['id_user'] ?>">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit <?= $title; ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?= $key['name'] ?>">
                            <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" disabled name="email" id="email" class="form-control" value="<?= $key['email'] ?>">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <p class="text-danger"><i>Kosongkan jika tidak di ubah</i></p>
                            <?= form_error('password1', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password2" id="password2" class="form-control">
                            <?= form_error('password2', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select class="form-control" name="role_id" id="role_id">
                                <option selected disabled>Pilih role pengguna</option>
                                <?php foreach ($role as $roles) : ?>
                                    <option value="<?= $roles['id_role'] ?>" <?php if ($key['role_id'] ==  $roles['id_role']) echo "selected"; ?>><?= $roles['name_role'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('role_id', '<small class="text-danger">', '</small>') ?>
                        </div>
                        <div class="form-group">
                            <label>No Hp/WhatsApp</label>
                            <input type="text" name="no_hp" id="no_hp" class="form-control" value="<?= $key['no_hp'] ?>">
                            <?= form_error('no_hp', '<small class="text-danger">', '</small>') ?>
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