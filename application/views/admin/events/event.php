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
                                        <?php
                                        if (empty($key['date_finish']) || empty($key['date_start'])) :
                                        ?>
                                            <td class="text-center">
                                                <span class="badge badge-pill status-badge badge-warning">Belum berlangsung</span>
                                            </td>
                                            <?php else :
                                            $dateFinishTimestamp = strtotime($key['date_finish']);
                                            $dateStartTimestamp = strtotime($key['date_start']);

                                            if ($dateStartTimestamp > time()) :
                                            ?>
                                                <td class="text-center">Belum berlangsung</td>
                                            <?php elseif ($dateFinishTimestamp <= time()) :
                                            ?>
                                                <td class="text-center">
                                                    <span class="badge badge-pill status-badge badge-dark">Sudah berlangsung</span>
                                                </td>
                                            <?php else : ?>
                                                <td class="text-center"><span class="badge badge-pill status-badge badge-success">Berlangsung</span></td>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <td class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#sendModal<?= $key['id_events'] ?>" class=" btn btn-success"><i class="fab fa-whatsapp"></i> Kirim WhatsApp</a>
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
<div class="modal fade" id="sendModal<?= $key['id_events'] ?>">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('admin/events') ?>" method="post">
                <input type="hidden" name="id_events" value="<?= $key['id_events'] ?>">
                <div class="modal-header">
                    <h4 class="modal-title">Kirim Pesan WhatsApp</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea name="pesan" id="pesan" cols="30" rows="20" class="form-control"></textarea>
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