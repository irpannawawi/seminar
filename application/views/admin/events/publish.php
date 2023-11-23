<div class="content-header pr-lg-5">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?php echo $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="float-right">
                    <a href="javascript:history.back()" class="btn btn-default float-r"><i class="fas fa-long-arrow-alt-left"></i> Kembali</a>
                    <a class="btn btn-info" href="<?= site_url('admin/events/create') ?>"><i class="far fa-calendar-plus"></i> Buat Event</a>
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
                        <h3 class="card-title"><?php echo 'Data ' . $title ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="table-data" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Event</th>
                                    <th>Tanggal Event</th>
                                    <th>Kuota</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($events as $key) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $key['title'] ?></td>
                                        <td class="text-center"><?= $key['date_start'] ?></td>
                                        <td class="text-center"><?= $key['kuota'] ?></td>
                                        <td class="text-center">
                                            <span class="badge badge-pill status-badge" data-status="<?= $key['status'] ?>">Event <?= $key['status'] ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= site_url('admin/events/edit/') . $key['id_events'] ?>" class="btn btn-secondary btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            <a href="<?= base_url('admin/events/deleteEvents/' . $key['id_events']); ?>" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i> Delete</a>
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