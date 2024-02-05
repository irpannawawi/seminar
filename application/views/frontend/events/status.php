<?php
$cookie_name = "trxId";
$cookie_value = $trxId;
if(!isset($_COOKIE[$cookie_name])){
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}

?>
<div id="loading-overlay">
    <div id="loading-spinner"></div>
</div>
<div class="container events">
    <form id="frmSearch" action="<?=site_url('status')?>" name="frmSearch" role="form" class="was-validated">
        <div class="row">
            <h3>Cari transaksi</h3>
        </div>
        <div class="row mb-4">
            <div class="col d-flex">
                <input type="search" ID="trxId" name="trxId" class="form-control rounded text-black" value="<?= isset($_COOKIE[$cookie_name])?$_COOKIE[$cookie_name]:'' ?><?= !isset($_COOKIE[$cookie_name])&&$trxId!=null?$trxId:'' ?>" required />
            </div>
            <div class="col mx-auto">
                <button type="submit" ID="btnSearch" class="btn-success btn text-white">Search</button>
            </div>
        </div>
    </form>

    <?php if ($event) : ?>
        <h1>Transaction Status #<?= $event['id_order'] ?> <a href="<?= base_url('/status/' . $event['id_order']) ?>"><i class="bi-arrow-clockwise"></i></a></h1>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button mb-2
                        <?= $event['bukti_tf'] == null ? 'bg-warning text-white' : 'bg-success text-white' ?>
                        " type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Upload Bukti transfer
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <!-- Jika belum ada bukti -->
                        <?php if ($event['bukti_tf'] == null) : ?>
                            <p>Belum ada bukti transfer, silahkan transfer sejumlah <strong><?= rupiah($event['nominal']) ?></strong> ke rekening berikut:</p>
                            <p><strong>Bank: <?= $event['bank_transfer'] ?></strong></p>
                            <p><strong>No Rekening: <?= $this->db->where('name_bank', $event['bank_transfer'])->get('rekening')->result_array()[0]['nomor_rekening']; ?></strong></p>
                            <form action="<?= base_url('frontend/event/upload_bukti_tf/' . $event['id_order']) ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="bukti_tf">Upload bukti transfer</label>
                                    <input class="form-control" type="file" name="bukti_tf">
                                </div>

                                <div class="form-group mt-2">
                                    <input class="btn btn-xs btn-success" type="submit" name="submit" value="Kirim">
                                </div>
                            </form>
                        <?php else : ?>
                            <div class="col-4">
                                <img src="<?= base_url('assets/bukti/') . $event['bukti_tf'] ?>" class="img-fluid" alt="">
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed mb-2
                        <?= $event['status_transaksi'] == 'Lunas' ? 'bg-success text-white' : '' ?>
                        <?= $event['status_transaksi'] == 'Prosses' ? 'bg-warning text-white' : '' ?>
                        <?= $event['status_transaksi'] == 'Refund' ? 'bg-info text-white' : '' ?>
                        <?= $event['status_transaksi'] == 'Dibatalkan' ? 'bg-danger text-white' : '' ?>
                        " <?= $event['bukti_tf'] == null ? 'disabled' : '' ?> type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Verifikasi Pembayaran
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>
                            <?= $event['status_transaksi'] == 'Prosses' ? 'Proses Verifikasi Pembayaran' : '' ?>
                            <?= $event['status_transaksi'] == 'Lunas' ? 'Proses Verifikasi selesai' : '' ?>
                            <?= $event['status_transaksi'] == 'Refund' ? 'Dana telah dikembalikan' : '' ?>
                            <?= $event['status_transaksi'] == 'Dibatalkan' ? 'Transaksi dibatalkan' : '' ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php if ($event['status_transaksi'] == 'Lunas') : ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button bg-success text-white collapsed" <?= $event['bukti_tf'] == null ? 'disabled' : '' ?> type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Lunas
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>Pembayaran telah dikonfirmasi</p>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    <?php endif ?>
</div>