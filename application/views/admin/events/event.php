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
                                foreach ($event_peserta as $event_id => $event_data) : ?>
                                    <?php $event = $event_data['event']; ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $event['title'] ?></td>
                                        <?php
                                        if (empty($event['date_finish']) || empty($event['date_start'])) :
                                        ?>
                                            <td class="text-center">
                                                <span class="badge badge-pill badge-info">Belum berlangsung</span>
                                            </td>
                                            <?php else :
                                            $dateFinishTimestamp = strtotime($event['date_finish']);
                                            $dateStartTimestamp = strtotime($event['date_start']);

                                            if ($dateStartTimestamp > time()) :
                                            ?>
                                                <td class="text-center"><span class="badge badge-pill badge-info">Belum berlangsung</span></td>
                                            <?php elseif ($dateFinishTimestamp <= time()) :
                                            ?>
                                                <td class="text-center">
                                                    <span class="badge badge-pill badge-secondary">Sudah Berlangsung</span>
                                                </td>
                                            <?php else : ?>
                                                <td class="text-center"><span class="badge badge-pill badge-warning">Sedang Berlangsung</span></td>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <td class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#infoModal<?= $event['id_events'] ?>" class="btn btn-info">
                                                <i class="fas fa-users"></i> Cek Peserta
                                            </a>
                                            <a href="javascript:;" data-toggle="modal" data-target="#sendModal<?= $event['id_events'] ?>" class="btn btn-success"><i class="fab fa-whatsapp"></i> Kirim WhatsApp</a>
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
<?php foreach ($event_peserta as $event_id => $event_data) : ?>
    <?php $event = $event_data['event']; ?>
    <!-- add modal -->
    <div class="modal fade" id="sendModal<?= $event['id_events'] ?>">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('admin/events') ?>" method="post">
                    <input type="hidden" name="id_events" value="<?= $event['id_events'] ?>">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="fab fa-whatsapp"></i> Kirim Pesan WhatsApp</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea name="pesan" id="pesan" cols="30" rows="18" class="form-control"></textarea>
                        </div>
                        <p><i>Gunakan Variabel : {name} untuk memanggila nama peserta</i></p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="action" value="submit" class="btn btn-success">Kirim <i class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- info modal -->
    <div class="modal fade" id="infoModal<?= $event['id_events'] ?>">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Peserta Event : <b><?= $event['title'] ?></b> | <a href="<?= site_url('admin/absensi') ?>">Cek Kehadiran <i class="fas fa-external-link-alt"></i></a></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="card">
                            <div class="card-body">
                                <table id="table-peserta" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Peserta</th>
                                            <th>No WhatsApp</th>
                                            <th>Email</th>
                                            <th>Tanggal Daftar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($event_data['peserta'])) : ?>
                                            <?php $no = 1; ?>
                                            <?php foreach ($event_data['peserta'] as $peserta) : ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $peserta['name']; ?></td>
                                                    <td><a target="_blank" href="<?= 'https://wa.me/62' . $peserta['nowa'] ?>"><?= $peserta['nowa'] ?></a></td>
                                                    <td><?= $peserta['email']; ?></td>
                                                    <td><?= date('d M Y', strtotime($peserta['date_participate'])) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="5" class="text-center">Belum ada peserta untuk event ini.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach ?>