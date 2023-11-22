<?php echo form_open_multipart('admin/events/create'); ?>
<div class="content-header pr-lg-5 pl-lg-5">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="javascript:history.back()" class="btn btn-default float-r"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                    <button type="submit" class="btn btn-info" name="action" value="save_draft"><i class="fas fa-save"></i> Draf</button>
                    <button type="submit" class="btn btn-success" name="action" value="submit"><i class="far fa-paper-plane"></i> Submit Event</button>
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
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Gambar Event</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                            <fieldset class="upload_dropZone text-center mb-3 p-4">
                                <!-- <legend class="visually-hidden">Gambar Event</legend> -->
                                <svg class="upload_svg" width="60" height="60" aria-hidden="true">
                                    <use href="#icon-imageUpload"></use>
                                </svg>
                                <p class="small my-2">*Max 2MB | JPEG | JPG | PNG<br>Tarik gambar untuk upload <br><i>atau</i></p>
                                <input name="image_events" id="image_events" data-post-url="https://someplace.com/image/uploads/backgrounds/" class="position-absolute invisible" type="file" multiple accept="image/jpeg, image/png, image/svg+xml" />
                                <label class="btn btn-upload mb-3" for="image_events">Pilih file gambar</label>
                                <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0"></div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Event</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                            <label>Judul Event</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?= set_value('title') ?>">
                        </div>
                        <div class="form-group">
                            <label>Kategori Event</label>
                            <select class="select2" multiple="multiple" name="id_category[]" id="id_category" data-placeholder="Select a State" style="width: 100%;">
                                <?php foreach ($category as $key) : ?>
                                    <option value="<?= $key['id_category'] ?>" <?= set_select('id_category[]', $key['id_category'], (isset($id_category) && in_array($key['id_category'], $id_category))); ?>><?= $key['name_category'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <p><i>Tambah kategori <a href="<?= site_url('admin/events/category') ?>">disini</a></i></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Detail Event</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Description Event</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Syarat & Ketentuan Event</label>
                            <textarea class="form-control" name="snk" id="snk"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Jadwal Event</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <div class="input-group date" id="date1" data-target-input="nearest">
                                            <input type="text" name="date_start" class="form-control datetimepicker-input" data-target="#date1" id="date_start" placeholder="Pilih tanggal">
                                            <div class="input-group-append" data-target="#date1" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tanggal Berakhir</label>
                                        <div class="input-group date" id="date2" data-target-input="nearest">
                                            <input type="text" name="date_finish" class="form-control datetimepicker-input" data-target="#date2" id="date_finish" placeholder="Pilih tanggal">
                                            <div class="input-group-append" data-target="#date2" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Jam Mulai</label>
                                        <div class="input-group date" id="timeevent1" data-target-input="nearest">
                                            <input type="text" name="date_start" id="date_start" class="form-control datetimepicker-input" data-target="#timeevent1" placeholder="Pilih jam mulai">
                                            <div class="input-group-append" data-target="#timeevent1" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Jam Selesai</label>
                                        <div class="input-group date" id="timeevent2" data-target-input="nearest">
                                            <input type="text" name="time_finish" id="time_finish" class="form-control datetimepicker-input" data-target="#timeevent2" placeholder="Pilih jam selesai">
                                            <div class="input-group-append" data-target="#timeevent2" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="far fa-clock"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg col-md col-sm-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Info Tiket</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label>Harga</label>
                                    <input type="text" placeholder="*Kosongkan jika free" name="price" class="form-control" id="price" value="<?= set_value('price') ?>">
                                </div>
                                <div class="col-6">
                                    <label>Kuota</label>
                                    <input type="text" placeholder="0" name="kuota" class="form-control" id="kuota" value="<?= set_value('kuota') ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_event" id="type_event" onchange="toggleInput('offlineInput')" value="offline">
                            <label class="form-check-label">Offline</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="type_event" id="type_event" onchange="toggleInput('onlineInput')" value="online">
                            <label class="form-check-label">Online</label>
                        </div>
                        <div class="hidden" id="offlineInput">
                            <div class="form-group">
                                <label>Nama Tempat </label>
                                <input type="text" class="form-control" id="location" name="location" value="<?= set_value('location') ?>">
                            </div>
                            <div class="form-group">
                                <label>URL Lokasi</label>
                                <input type="text" class="form-control" id="url_location" name="url_location" value="<?= set_value('url_location') ?>">
                            </div>
                        </div>
                        <div class="hidden" id="onlineInput">
                            <div class="form-group">
                                <label>Label </label>
                                <input type="text" class="form-control" id="label" name="label" placeholder="Zoom / GMeet / Youtube / Lainnya" value="<?= set_value('label') ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="javascript:history.back()" class="btn btn-default"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
            <button type="submit" class="btn btn-info" name="action" value="save_draft"><i class="fas fa-save"></i> Draf</button>
            <button type="submit" class="btn btn-success" name="action" value="submit"><i class="far fa-paper-plane"></i> Submit Event</button>
        </div>
    </div>
</section>
</form>