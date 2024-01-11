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
<section class="content">
    <div class="container-fluid pr-lg-5 pl-lg-5">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card card-default">
                    <form action="<?= site_url('admin/integrasimanagement/mailer') ?>" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Mail Host</label>
                                        <input type="text" name="mail_host" id="mail_host" class="form-control" value="<?= $mailer['mail_host'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Mail Address</label>
                                        <input type="text" class="form-control" name="mail_address" value="<?= $mailer['mail_address'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Mail Password</label>
                                        <input type="text" class="form-control" name="mail_password" value="<?= $mailer['mail_password'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Mail Name</label>
                                        <input type="text" class="form-control" name="mail_name" value="<?= $mailer['mail_name'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Mail PORT</label>
                                        <input type="text" class="form-control" name="mail_port" value="<?= $mailer['mail_port'] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Mail Reply</label>
                                        <input type="text" class="form-control" name="mail_reply" value="<?= $mailer['mail_reply'] ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" value="simpan" name="action" class="btn btn-success"><i class="far fa-save"></i> Simpan</button>
                            <a data-toggle="modal" data-target="#addModal" class="btn btn-dark"><i class="far fa-paper-plane"></i> Test Kirim Email</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- add modal -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="email-testing" action="<?= site_url('admin/integrasimanagement/testing') ?>" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Testing Kirim Pesan Email</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email Anda</label>
                        <input type="email" name="email_penerima" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Subject</label>
                        <input type="text" name="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Pesan</label>
                        <textarea name="pesan" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submitBtn" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const form = $("#email-testing");
        const submitBtn = $("#submitBtn");

        form.submit(function(event) {
            e.preventDefault(); // Prevent the default form submission

            // Tampilkan loading spinner
            submitBtn.html('<span class="loading"></span>');

            // Kirim data menggunakan Ajax
            $.ajax({
                type: form.attr("method"),
                url: form.attr("action"),
                data: form.serialize(),
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message)
                        $("#addModal").modal("hide");
                    } else {
                        toastr.error(response.message)
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    toastr.error('Terjadi kesalahan saat mengirim pesan email.')
                },
                complete: function() {
                    // Sembunyikan loading spinner dan kembalikan teks tombol
                    submitBtn.html("Kirim");
                }
            });
        });
    });
</script>