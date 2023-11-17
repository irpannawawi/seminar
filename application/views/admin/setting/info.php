<?php echo form_open_multipart('admin/setting/info'); ?>
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
                        <div class="form-group">
                            <label>Judul Website</label>
                            <input type="text" class="form-control" name="title_web" id="title_web" value="<?= $setting['title_web'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Sub Judul Website</label>
                            <input type="text" class="form-control" name="sub_title" id="sub_title" value="<?= $setting['sub_title'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Website</label>
                            <textarea class="form-control" name="description_web" id="description_web"><?= $setting['description_web'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta Google</label>
                            <textarea class="form-control" name="meta_google" id="description"><?= $setting['meta_google'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Logo Website</label>
                            <input type="file" class="form-control" name="logo_web" id="logo_web">
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