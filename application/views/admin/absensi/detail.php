<div class="content-header pr-lg-5">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="javascript:history.back()" class="btn btn-default float-r"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                    <a href="javascript:;" class="btn btn-primary float-r" data-toggle="modal" data-target="#addModal"><i class="fas fa-qrcode"></i> Scan QR Code</a>
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
                        <h3 class="card-title"><?php echo 'Tabel ' . $title ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table-data" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Waktu</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($absensi as $absensi) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $absensi['name'] ?></td>
                                        <td><?= $absensi['date_absensi'] ?></td>
                                        <td><?= status_absensi($absensi['status_kehadiran']) ?></td>
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

<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('admin/rekening') ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Scan QR Code Absensi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <video id="reader" class="scann__qr"></video>
                        <br>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-primary">
                                <input class="custom-control-input" type="radio" name="options" value="1" checked> Camera Depan
                            </label>
                            <label class="btn btn-secondary active">
                                <input class="custom-control-input" type="radio" name="options" value="2"> Camera Belakang
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <p id="id_order"></p>
                        <p id="name"></p>
                        <p id="event_title"></p>
                        <p id="email"></p>
                        <p id="whatsapp"></p>
                        <p id="domisili"></p>
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

<script src="<?= base_url('assets/backend') ?>/dist/js/absensi/scanqr.js"></script>