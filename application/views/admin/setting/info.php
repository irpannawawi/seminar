<?php echo form_open_multipart('admin/webmanagement/info'); ?>
<div class="content-header pr-lg-5 pl-lg-5">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="javascript:history.back()" class="btn btn-default float-r"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save info</button>
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
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo 'Form ' . $title ?></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Judul Website</label>
                                    <input type="text" class="form-control" name="title_web" id="title_web" value="<?= get_management('title_web') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Sub Judul Website</label>
                                    <input type="text" class="form-control" name="sub_title" id="sub_title" value="<?= get_management('sub_title') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi Website</label>
                                    <textarea class="form-control" name="description_web" id="description_web"><?= get_management('description_web') ?></textarea>
                                </div>
                                <div class="form-group row">
                                    <label>Logo Web</label>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-1">
                                                <img src="<?= base_url('assets/backend/dist/img/') . get_management('logo_web'); ?>" class="img-thumbnail">
                                            </div>
                                            <div class="col-sm-11">
                                                <div class="custom-file">
                                                    <input type="file" class="form-control" id="logo_web" name="logo_web">
                                                    <label class="custom-file-label" for="logo_web">Pilih file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" class="form-control" name="instagram" value="<?= get_management('instagram') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" class="form-control" name="facebook" value="<?= get_management('facebook') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Meta Google</label>
                                    <textarea class="form-control" name="meta_google" id="description"><?= get_management('meta_google') ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="javascript:history.back()" class="btn btn-default float-r"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save info</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</form>