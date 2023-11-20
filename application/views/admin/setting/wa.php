<div class="content-header pr-lg-5 pl-lg-5">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="javascript:history.back()" class="btn btn-default float-r"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                    <a class="btn btn-dark" href="javascript:;" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Tambah Perangkat</a>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid pr-lg-5 pl-lg-5">
        <!-- <form action="<?= site_url('admin/events/create') ?>" method="post"> -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Perangkat</th>
                                    <th>Durasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($wagw as $key) : ?>
                                    <tr>
                                        <td>
                                            <div class="my-2">
                                                <h4 class="h6 mb-0"><i class="fas fa-mobile-alt mr-1"></i> <?= $key['number'] ?></h4>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-user-tie mr-1"></i> <?= $key['name'] ?>
                                                </div>
                                                <div class="d-flex align-items-center status">
                                                    <?php if ($key['status'] == 'disconnect') : ?>
                                                        <div class="dot rounded-circle me-1 bg-danger"></div>
                                                        <?= $key['status'] ?>
                                                    <?php else : ?>
                                                        <div class="dot rounded-circle me-1 bg-success"></div>
                                                        <?= $key['status'] ?>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>21 Dec 2023</td>
                                        <td class="d-flex">
                                            <a href="" class="btn btn-success badge-pill mr-1"><i class="fas fa-link"></i> Connect</a>
                                            <a href="" class="btn btn-primary badge-pill mr-1"><i class="fas fa-link"></i> Reconnect</a>
                                            <a href="" class="btn btn-danger badge-pill mr-1"><i class="fas fa-link"></i> Disconnect</a>
                                            <a href="" class="btn btn-dark badge-pill mr-1"><i class="fas fa-lock"></i> Token</a>
                                            <a href="" class="btn btn-primary badge-pill mr-1"><i class="far fa-edit"></i> Edit</a>
                                            <a href="" class="btn btn-danger badge-pill mr-1"><i class="fas fa-trash-alt"></i> Delete</a>
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
            <form action="<?= base_url('admin/webmanagement/wagw') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo 'Tambah ' . $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Perangkat</label>
                        <input type="text" name="name" id="name" class="form-control">
                        <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                    </div>
                    <div class="form-group">
                        <label>Nomor Perangkat</label>
                        <input type="text" name="number" id="number" class="form-control">
                        <?= form_error('number', '<small class="text-danger">', '</small>') ?>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" name="action" value="submit" id="submit" class="btn btn-primary">Tambah Perangkat</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>
    // Fungsi untuk memeriksa apakah semua formulir telah diisi
    function checkForm() {
        // Ambil nilai input dari kedua formulir
        var nameValue = document.getElementById('name').value;
        var numberValue = document.getElementById('number').value;

        // Periksa apakah kedua formulir tidak kosong
        if (nameValue.trim() !== '' && numberValue.trim() !== '') {
            // Jika tidak kosong, aktifkan tombol
            document.getElementById('submit').disabled = false;
        } else {
            // Jika salah satu atau kedua formulir kosong, nonaktifkan tombol
            document.getElementById('submit').disabled = true;
        }
    }

    // Tambahkan event listener untuk memanggil fungsi checkForm setiap kali nilai formulir berubah
    document.getElementById('name').addEventListener('input', checkForm);
    document.getElementById('number').addEventListener('input', checkForm);
</script>