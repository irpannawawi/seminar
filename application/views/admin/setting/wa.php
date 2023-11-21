<div class="content-header pr-lg-5 pl-lg-5">
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
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid pr-lg-5 pl-lg-5">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-default">
                    <form action="<?= site_url('admin/webmanagement/savewagw') ?>" method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Token Fonnte</label>
                                <input type="text" class="form-control" name="token" value="<?= $wagw['token'] ?>">
                                <p class="text-warning"><i>Dapatkan Token <a href="https://md.fonnte.com/new/device.php" target="_blank">Disini</a></i></p>
                            </div>
                            <div class="form-group">
                                <label>Link QR</label>
                                <input type="text" class="form-control" name="link_qr" value="<?= $wagw['link_qr'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Link Send</label>
                                <input type="text" class="form-control" name="link_send" value="<?= $wagw['link_send'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Link Device</label>
                                <input type="text" class="form-control" name="link_device" value="<?= $wagw['link_device'] ?>">
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 ">
                <div class="card card-default">
                    <div class="card-body">
                        <?php if (isset($infodevice)) : ?>
                            <div class="form-group">
                                <div class="d-flex align-items-center status">
                                    <i class="fas fa-mobile-alt mr-1"></i>
                                    <small><?= $infodevice['device'] ?></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex align-items-center status">
                                    <i class="fas fa-user-tie mr-1"></i>
                                    <small><?= $infodevice['name'] ?></small>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex align-items-center status">
                                    <div class="dot rounded-circle me-1 <?= ($infodevice['device_status'] == 'connect') ? 'bg-success' : 'bg-danger' ?>"></div>
                                    <small><?= $infodevice['device_status'] ?></small>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div id="qrContainer"></div>
                            </div>
                        <?php else : ?>
                            <p>Error mengambil informasi perangkat. Harap periksa pengaturan integrasi Anda.</p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer text-center">
                        <?php if (isset($infodevice) && ($infodevice['device_status'] == 'connect')) : ?>
                            <button type="button" class="btn btn-dark" disabled>
                                <i class="fas fa-qrcode"></i> Generate QR Code
                            </button>
                            <a href="<?= site_url('admin/webmanagement/disconnect') ?>" class="btn btn-danger">
                                <i class="fas fa-unlink"></i> Disconnect
                            </a>
                        <?php else : ?>
                            <button type="button" class="btn btn-dark" id="btn-generate-qr">
                                <i class="fas fa-qrcode"></i> Generate QR Code
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Tambahkan script jQuery jika belum dimuat -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#btn-generate-qr').click(function() {
            // Menampilkan efek loading
            $('#qrContainer').html('<div class="loading">Tunggu...</div>');

            $.ajax({
                url: '<?= base_url('admin/webmanagement/generate_qr/') ?>',
                type: 'GET',
                success: function(response) {
                    var qrData = JSON.parse(response);
                    if (qrData.url) {
                        // Menampilkan QR code di qrContainer
                        $('#qrContainer').html('<img src="data:image/png;base64,' + qrData.url + '" alt="QR Code">');
                    } else {
                        handleErrorResponse('Gagal generate QR Code');
                    }
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 401) {
                        handleErrorResponse('Token tidak valid');
                    } else {
                        handleErrorResponse('Perangkat sudah terhubung!');
                    }
                }
            });
        });

        function handleErrorResponse(errorMessage) {
            $('#qrContainer').html('<p>' + errorMessage + '</p>');
            toastr.error(errorMessage);
        }
    });
</script>