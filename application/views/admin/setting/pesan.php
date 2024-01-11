<form action="<?= site_url('admin/webmanagement/pesan') ?>" method="post">

    <div class="content-header pr-lg-5 pl-lg-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php echo $title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-right">
                        <a href="javascript:history.back()" class="btn btn-default float-r"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="far fa-save"></i> Simpan</button>
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <p>Halaman setting ini untuk membuat format saat calon peserta melakukan pelunasan</p>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="row pr-lg-5 pl-lg-5">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Format Pesan Tagihan</label>
                                <textarea type="text" name="tagihan_bayar" class="form-control" rows="12"><?= $setting['tagihan_bayar'] ?></textarea>
                            </div>
                            <p><i>Gunakan Variabel : {name},{var1},{var2}...</i><a href="javascript:;" data-toggle="modal" data-target="#keteranganModal">Lihat Keterangan</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Format Sukses Bayar</label>
                                <textarea type="text" name="sukses_bayar" class="form-control" rows="12"><?= $setting['sukses_bayar'] ?></textarea>
                            </div>
                            <p><i>Gunakan Variabel : {name},{var1},{var2}...</i><a href="javascript:;" data-toggle="modal" data-target="#keteranganModal">Lihat Keterangan</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Format Pesan Tagihan Email</label>
                                <textarea id="description" type="text" name="tagihan_bayar_email" class="form-control" rows="12"><?= $setting['tagihan_bayar_email'] ?></textarea>
                            </div>
                            <p><i>Gunakan Variabel : {name},{var1},{var2}...</i><a href="javascript:;" data-toggle="modal" data-target="#keteranganModal">Lihat Keterangan</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Format Sukses Bayar Email</label>
                                <textarea id="description" type="text" name="sukses_bayar_email" class="form-control" rows="12"><?= $setting['sukses_bayar_email'] ?></textarea>
                            </div>
                            <p><i>Gunakan Variabel : {name},{var1},{var2}...</i><a href="javascript:;" data-toggle="modal" data-target="#keteranganModal">Lihat Keterangan</a></p>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </section>
</form>
<!-- keterangan modal -->
<div class="modal fade" id="keteranganModal">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-info"></i> Keterangan Variabel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    <li>{name} = Nama Penerima</li>
                    <li>{var1} = Judul Event</li>
                    <li>{var2} = Nomor Invoice</li>
                    <li>{var3} = Waktu Pelaksanaan</li>
                    <li>{var4} = Jumlah Tiket</li>
                    <li>{var5} = Rekening Bank</li>
                    <li>{var6} = QR Code</li>
                </ul>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>