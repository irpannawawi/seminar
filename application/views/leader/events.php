<div class="content-header ">
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
<section class="content ">
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
                                foreach ($events as $event) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $event['title'] ?> <a target="_blank" href="<?= site_url('event/' . $event['id_events'] . '/' . $event['slug']) ?>"><i class="fas fa-external-link-alt"></i></a>
                                        </td>
                                        <?php
                                        if (!empty($event['date_finish']) && !empty($event['date_start']) && !empty($event['time_finish'])) {
                                            $dateTimeFinish = $event['date_finish'] . ' ' . $event['time_finish'];
                                            $dateTimeFinishTimestamp = strtotime($dateTimeFinish);
                                            $dateStartTimestamp = strtotime($event['date_start']);

                                            if ($dateStartTimestamp > time()) {
                                                $badgeClass = 'badge-info';
                                                $badgeText = 'Belum berlangsung';
                                            } elseif ($dateTimeFinishTimestamp <= time()) {
                                                $badgeClass = 'badge-secondary';
                                                $badgeText = 'Sudah Berlangsung';
                                            } else {
                                                $badgeClass = 'badge-warning';
                                                $badgeText = 'Sedang Berlangsung';
                                            }
                                        ?>
                                            <td class="text-center"><span class="badge badge-pill <?= $badgeClass ?>"><?= $badgeText ?></span></td>
                                        <?php } ?>
                                        <td class="text-center">
                                            <a href="javascript:;" data-toggle="modal" data-target="#tiketModal<?= $event['id_events']  ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-ticket-alt"></i></i> Beli Tiket
                                            </a>
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

<?php foreach ($events as $event) : ?>
    <!-- add modal -->
    <div class="modal fade" id="tiketModal<?= $event['id_events'] ?>">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url('leader/events') ?>" method="post">
                    <input type="hidden" name="price" value="<?= $event['price'] ?>">
                    <input type="hidden" name="id_events" value="<?= $event['id_events'] ?>">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= $event['title'] . ' [Sisa ' . $event['sisa_kuota'] . ' Tiket]'  ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Jumlah Tiket</label>
                            <input type="text" name="jml_tiket" id="jml_tiket" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Bank Transfer</label>
                            <select name="bank_transfer" id="bank_transfer" class="form-control">
                                <option disabled selected>Pilih Bank Transfer</option>
                                <?php foreach ($rekening as $key) : ?>
                                    <option value="<?= $key['name_bank'] ?>"><?= $key['name_bank'] ?></option>
                                <?php endforeach ?>
                            </select>
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
<?php endforeach ?>