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
                                    <th>Nama Pemilik</th>
                                    <th>No Rekening</th>
                                    <th>Nama Bank</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($rekening as $key) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $key['name_rekening'] ?></td>
                                        <td><?= $key['nomor_rekening'] ?></td>
                                        <td><?= $key['name_bank'] ?></td>
                                        <td class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#editModal<?= $key['id_rekening'] ?>" class="btn btn-secondary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            <a href="<?= base_url('admin/rekening/deleterekening/' . $key['id_rekening']); ?>" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i> Delete</a>
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
            <form action="<?= base_url('admin/rekening') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title"></i> <?php echo 'Buat ' . $title ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Rekening</label>
                        <input type="text" name="name_rekening" id="name_rekening" class="form-control" value="<?= set_value('name_rekening') ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Rekening</label>
                        <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" value="<?= set_value('nomor_rekening') ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Bank</label>
                        <select name="name_bank" id="name_bank" class="form-control select2" style="width: 100%;">
                            <option selected disabled>Pilih Bank Anda</option>
                            <?php foreach ($bank as $bank) : ?>
                                <option value="<?= $bank['name']; ?>"><?= $bank['name']; ?></option>
                            <?php endforeach ?>
                        </select>
                        <input type="hidden" name="code" id="code">
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
<?php foreach ($rekening as $key) : ?>
    <div class="modal fade" id="editModal<?= $key['id_rekening'] ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url('admin/rekening') ?>" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title"></i> <?php echo 'Edit ' . $title ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nama Rekening</label>
                            <input type="text" name="name_rekening" id="name_rekening" class="form-control" value="<?= set_value('name_rekening', $key['name_rekening']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Nomor Rekening</label>
                            <input type="text" name="nomor_rekening" id="nomor_rekening" class="form-control" value="<?= set_value('nomor_rekening', $key['nomor_rekening']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Bank</label>
                            <select name="name_bank" disabled id="name_bank" class="form-control select2" style="width: 100%;">
                                <option selected value="<?= $key['name_bank'] ?>"><?= $key['name_bank'] ?></option>
                            </select>
                            <input type="hidden" name="code" id="code">
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
<?php endforeach ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen select
        var selectBank = document.getElementById('name_bank');

        // Tambahkan event listener untuk memantau perubahan pada select
        selectBank.addEventListener('change', function() {
            // Ambil nilai terpilih dari select
            var selectedBank = selectBank.value;

            // Ambil elemen input dengan nama "code"
            var codeInput = document.getElementById('code');

            // Temukan data bank yang sesuai dalam array bank (diambil dari PHP)
            var bankData = <?php echo json_encode($bank); ?>; // Gantilah dengan data bank yang sesuai

            // Loop melalui array bank untuk mencari data yang sesuai dengan bank yang dipilih
            for (var i = 0; i < bankData.length; i++) {
                if (bankData[i].name === selectedBank) {
                    // Isi input dengan nama "code" dengan nilai code yang sesuai
                    codeInput.value = bankData[i].code;
                    break;
                }
            }
        });
    });
</script>