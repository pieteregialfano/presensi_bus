<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Ambil Bootstrap nya di bootstrap 4, hoverable tabel -->
    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <!-- Buat tombol presensi -->
                    <a href="" class="d-sm-inline-block btn btn-primary shadow-sm float-left" style="font-size: 13px;" data-toggle="modal" data-target="#presensiModal"><i class="fas fa-fw fa-square-plus text-white-50 mr-1"></i>Add Presensi Bus</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0" style="font-size: 13px;">
                            <thead>
                                <tr>
                                    <!-- <th scope="col">No.</th> -->
                                    <th scope="col">NOMOR</th>
                                    <th scope="col">NO_BUS</th>
                                    <th scope="col">DATE_IN</th>
                                    <th scope="col">TIME_IN</th>
                                    <th scope="col">DATE_OUT</th>
                                    <th scope="col">TIME_OUT</th>
                                    <th scope="col">DATE_C</th>
                                    <th scope="col">CREATE_BY</th>
                                    <th scope="col">JUM_PNP</th>
                                    <th scope="col">SHIFT</th>
                                    <th scope="col">DENDA</th>
                                    <th scope="col">JUM_RIT</th>
                                    <th scope="col">No. Polisi</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($presensi as $pr) : ?>
                                    <tr>
                                        <!-- <th><?= ++$start; ?></th> -->
                                        <td><?= $pr['no_transaksi']; ?></td>
                                        <td><?= $pr['no_bus']; ?></td>
                                        <!-- <td><?= $pr['per_oto_bus']; ?></td> -->
                                        <!-- <td><?= $pr['type_bus']; ?></td> -->
                                        <!-- <td><?= $pr['route']; ?></td> -->
                                        <td><?= $pr['tgl_masuk']; ?></td>
                                        <td><?= $pr['jam_masuk']; ?></td>
                                        <td><?= $pr['tgl_keluar']; ?></td>
                                        <td><?= $pr['jam_keluar']; ?></td>
                                        <td><?= $pr['tgl_presensi']; ?></td>
                                        <td><?= $pr['create_by']; ?></td>
                                        <td><?= $pr['jml_pnp']; ?></td>
                                        <td><?= $pr['shift']; ?></td>
                                        <td><?= $pr['jml_denda']; ?></td>
                                        <td><?= $pr['jum_rit']; ?></td>
                                        <td><?= $pr['no_polisi']; ?></td>
                                        <td class="d-flex">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#detailPresensiModal<?= $pr['no_transaksi']; ?>"><i class="fas fa-eye"></i></button>

                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editPresensiModal<?= $pr['no_transaksi']; ?>" data-modal-no_transaksi="2"><i class="fas fa-file-edit"></i></button>

                                            <!-- <a href="<?= base_url(); ?>user/delete/<?= $pr['no_transaksi']; ?>" class="btn btn-danger delete-link" data-no_transaksi="<?= $pr['no_transaksi']; ?>"><i class="fas fa-trash"></i></a> -->

                                            <a href="<?= base_url(); ?>user/delete/<?= $pr['no_transaksi']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin menghapus menu ini?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?= $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->



<!-- Modal (ambil dari bootstrap 4) -->
<!-- Id nya samakan dengan yang button di atas -->
<div class="modal fade" id="presensiModal" role="dialog" aria-labelledby="presensiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="presensiModalLabel"><i class="fas fa-fw fa-square-plus"></i> Add Presensi Bus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/presensi'); ?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="no_bus" class="col-sm-3 col-form-label">Nama No. Bus<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select required class="js-example-basic-single form-control" id="no_bus" name="no_bus" aria-haspopup="true" style="width: 100%;">
                                <option value="">=== Pilih No. Bus ===</option>
                                <?php foreach ($no_bus_list as $bus) : ?>
                                    <option value="<?= $bus['no_bus']; ?>"><?= $bus['no_bus']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="per_oto_bus" class="col-sm-3 col-form-label">Per. Oto Bus<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="per_oto_bus" name="per_oto_bus" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type_bus" class="col-sm-3 col-form-label">Type Bus<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="type_bus" name="type_bus" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="route" class="col-sm-3 col-form-label">Route<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="route" name="route" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_polisi" class="col-sm-3 col-form-label">Nomor Polisi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="no_polisi" name="no_polisi" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shift" class="col-sm-3 col-form-label">Shift<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select required class="js-example-basic-single form-control" id="shift" name="shift" aria-haspopup="true" style="width: 100%;">
                                <option value="Pilih Shift">=== Pilih Shift ===</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="DS">Day Shift</option>
                                <option value="NS">Non Shift</option>
                            </select>
                        </div>
                    </div>
                    <!-- Yang tanggal pakai datepicker -->
                    <div class="form-group row">
                        <label for="tgl_presensi" class="col-sm-3 col-form-label">Tanggal Presensi<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input required type="text" class="form-control" id="tgl_presensi" name="tgl_presensi" placeholder="yyyy/mm/dd" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Yang tanggal pakai datepicker -->
                    <div class="form-group row">
                        <label for="tgl_masuk" class="col-sm-3 col-form-label">Tanggal Masuk<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input required type="text" class="form-control" id="tgl_masuk" name="tgl_masuk" placeholder="yyyy/mm/dd" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jam_masuk" class="col-sm-3 col-form-label">Jam Masuk<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input required type="text" class="form-control" id="jam_masuk" name="jam_masuk">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-fw fa-clock input-prefix"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Yang tanggal pakai datepicker -->
                    <div class="form-group row">
                        <label for="tgl_keluar" class="col-sm-3 col-form-label">Tanggal Keluar<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input required type="text" class="form-control" id="tgl_keluar" name="tgl_keluar" placeholder="yyyy/mm/dd" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jam_keluar" class="col-sm-3 col-form-label">Jam Keluar<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input required type="text" class="form-control" id="jam_keluar" name="jam_keluar">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-fw fa-clock input-prefix"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jml_pnp" class="col-sm-3 col-form-label">Jumlah Penumpang<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="jml_pnp" name="jml_pnp" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ket_denda" class="col-sm-3 col-form-label">Keterangan Denda</label>
                        <div class="col-sm-9">
                            <select class="js-example-basic-single form-control" id="ket_denda" name="ket_denda" aria-haspopup="true" style="width: 100%;" data-placeholder="Pilih Keterangan Denda">
                                <option value="">=== Pilih Keterangan Denda ===</option>
                                <?php foreach ($denda_reasons as $reason) : ?>
                                    <option value="<?= $reason['reason']; ?>"><?= $reason['reason']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jml_denda" class="col-sm-3 col-form-label">Jumlah Denda</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jml_denda" name="jml_denda" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ket" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="ket" name="ket" autocomplete="off" placeholder="Keterangan Pelanggaran PO. Bus">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-xmark"></i> Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="addPresensiButton">
                        <i class="fas fa-square-plus"></i> Add
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDIT -->
<?php $start = 0;
foreach ($presensi as $pr) : $start++; ?>
    <!-- Modal Edit -->
    <!-- Modal untuk Edit Presensi Bus -->
    <div class="modal fade" id="editPresensiModal<?= $pr['no_transaksi']; ?>" role="dialog" aria-labelledby="editPresensiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPresensiModalLabel<?= $pr['no_transaksi']; ?>">Edit Presensi Bus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Form edit data presensi -->
                <form action="<?= base_url('user/edit_presensi/' . $pr['no_transaksi']); ?>" method="post" enctype="multipart/form-data" role="form">
                    <div class="modal-body">

                        <input type="hidden" name="no_transaksi" value="<?= $pr['no_transaksi']; ?>">
                        <!-- Tambahkan formulir pengeditan di sini -->
                        <div class="form-group row">
                            <label for="no_bus" class="col-sm-3 col-form-label">No. Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_bus" name="no_bus" value="<?= $pr['no_bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="per_oto_bus" class="col-sm-3 col-form-label">Per. Oto Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="per_oto_bus" name="per_oto_bus" value="<?= $pr['per_oto_bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type_bus" class="col-sm-3 col-form-label">Type Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="type_bus" name="type_bus" value="<?= $pr['type_bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="route" class="col-sm-3 col-form-label">Route</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="route" name="route" value="<?= $pr['route']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_polisi" class="col-sm-3 col-form-label">Nomor Polisi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_polisi" name="no_polisi" value="<?= $pr['no_polisi']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shift" class="col-sm-3 col-form-label">Shift</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="shift" name="shift">
                                    <option value="Pilih Shift">-- Pilih Shift --</option>
                                    <option value="1" <?php if ($pr['shift'] == "1") echo "selected"; ?>>1</option>
                                    <option value="2" <?php if ($pr['shift'] == "2") echo "selected"; ?>>2</option>
                                    <option value="3" <?php if ($pr['shift'] == "3") echo "selected"; ?>>3</option>
                                    <option value="DS" <?php if ($pr['shift'] == "DS") echo "selected"; ?>>Day Shift</option>
                                    <option value="NS" <?php if ($pr['shift'] == "NS") echo "selected"; ?>>Non Shift</option>
                                </select>
                            </div>
                        </div>
                        <!-- Yang tanggal pakai datepicker -->
                        <div class="form-group row">
                            <label for="tgl_presensi" class="col-sm-3 col-form-label">Tanggal Presensi</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="tgl_presensi_edit form-control" id="tgl_presensi" name="tgl_presensi" value="<?= $pr['tgl_presensi']; ?>" placeholder="yyyy/mm/dd">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Yang tanggal pakai datepicker -->
                        <div class="form-group row">
                            <label for="tgl_masuk" class="col-sm-3 col-form-label">Tanggal Masuk</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="tgl_masuk_edit form-control" id="tgl_masuk" name="tgl_masuk" value="<?= $pr['tgl_masuk']; ?>" placeholder="yyyy/mm/dd">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jam_masuk" class="col-sm-3 col-form-label">Jam Masuk</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="jam_masuk_edit form-control" id="jam_masuk" name="jam_masuk" value="<?= $pr['jam_masuk']; ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-fw fa-clock input-prefix"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Yang tanggal pakai datepicker -->
                        <div class="form-group row">
                            <label for="tgl_keluar" class="col-sm-3 col-form-label">Tanggal Keluar</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="tgl_keluar_edit form-control" id="tgl_keluar" name="tgl_keluar" value="<?= $pr['tgl_keluar']; ?>" placeholder="yyyy/mm/dd">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jam_keluar_edit" class="col-sm-3 col-form-label">Jam Keluar</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="jam_keluar_edit form-control" id="jam_keluar" name="jam_keluar" value="<?= $pr['jam_keluar']; ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-fw fa-clock input-prefix"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jml_pnp" class="col-sm-3 col-form-label">Jumlah Penumpang</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="jml_pnp" name="jml_pnp" value="<?= $pr['jml_pnp']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ket_denda_edit" class="col-sm-3 col-form-label">Keterangan Denda</label>
                            <div class="col-sm-9">
                                <select class="ket_denda_edit form-control" name="ket_denda" aria-haspopup="true" style="width: 100%" data-placeholder="Pilih Keterangan Denda">
                                    <?php foreach ($denda_reasons as $reason) : ?>
                                        <option value="<?= $reason['reason']; ?>" <?php if ($pr['ket_denda'] == $reason['reason']) echo 'selected'; ?>><?= $reason['reason']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jml_denda" class="col-sm-3 col-form-label">Jumlah Denda</label>
                            <div class="col-sm-9">
                                <input type="text" class="jml_denda form-control" id="jml_denda" name="jml_denda" value="<?= $pr['jml_denda']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ket" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ket" name="ket" value="<?= $pr['ket']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-xmark"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-floppy-disk"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- DETAIL -->
<?php foreach ($presensi as $pr) : $start++; ?>
    <div class="modal fade" id="detailPresensiModal<?= $pr['no_transaksi']; ?>" role="dialog" aria-labelledby="detailPresensiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailPresensiModalLabel<?= $pr['no_transaksi']; ?>">Detail Presensi Bus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Form edit data presensi -->
                <form action="<?= base_url('user/detail_presensi/' . $pr['no_transaksi']); ?>" method="post" enctype="multipart/form-data" role="form">
                    <div class="modal-body">

                        <input type="hidden" name="id" value="<?= $pr['no_transaksi']; ?>">
                        <!-- Tambahkan formulir pengeditan di sini -->
                        <div class="form-group row">
                            <label for="no_bus" class="col-sm-3 col-form-label">No. Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_bus" name="no_bus" value="<?= $pr['no_bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="per_oto_bus" class="col-sm-3 col-form-label">Per. Oto Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="per_oto_bus" name="per_oto_bus" value="<?= $pr['per_oto_bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type_bus" class="col-sm-3 col-form-label">Type Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="type_bus" name="type_bus" value="<?= $pr['type_bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="route" class="col-sm-3 col-form-label">Route</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="route" name="route" value="<?= $pr['route']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_polisi" class="col-sm-3 col-form-label">Nomor Polisi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_polisi" name="no_polisi" value="<?= $pr['no_polisi']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="shift" class="col-sm-3 col-form-label">Shift</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="shift" name="shift" disabled>
                                    <option value="Pilih Shift">-- Pilih Shift --</option>
                                    <option value="1" <?php if ($pr['shift'] == "1") echo "selected"; ?>>1</option>
                                    <option value="2" <?php if ($pr['shift'] == "2") echo "selected"; ?>>2</option>
                                    <option value="3" <?php if ($pr['shift'] == "3") echo "selected"; ?>>3</option>
                                    <option value="DS" <?php if ($pr['shift'] == "DS") echo "selected"; ?>>Day Shift</option>
                                    <option value="NS" <?php if ($pr['shift'] == "NS") echo "selected"; ?>>Non Shift</option>
                                </select>
                            </div>
                        </div>

                        <!-- Yang tanggal pakai datepicker -->
                        <div class="form-group row">
                            <label for="tgl_presensi" class="col-sm-3 col-form-label">Tanggal Presensi</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tgl_presensi" name="tgl_presensi" value="<?= $pr['tgl_presensi']; ?>" placeholder="yyyy/mm/dd" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Yang tanggal pakai datepicker -->
                        <div class="form-group row">
                            <label for="tgl_masuk" class="col-sm-3 col-form-label">Tanggal Masuk</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tgl_masuk" name="tgl_masuk" value="<?= $pr['tgl_masuk']; ?>" placeholder="yyyy/mm/dd" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jam_masuk" class="col-sm-3 col-form-label">Jam Masuk</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="jam_masuk" name="jam_masuk" value="<?= $pr['jam_masuk']; ?>" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-fw fa-clock input-prefix"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Yang tanggal pakai datepicker -->
                        <div class="form-group row">
                            <label for="tgl_keluar" class="col-sm-3 col-form-label">Tanggal Keluar</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tgl_keluar" name="tgl_keluar" value="<?= $pr['tgl_keluar']; ?>" placeholder="yyyy/mm/dd" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jam_keluar" class="col-sm-3 col-form-label">Jam Keluar</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="jam_keluar" name="jam_keluar" value="<?= $pr['jam_keluar']; ?>" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-fw fa-clock input-prefix"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jml_pnp" class="col-sm-3 col-form-label">Jumlah Penumpang</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="jml_pnp" name="jml_pnp" value="<?= $pr['jml_pnp']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ket_denda" class="col-sm-3 col-form-label">Keterangan Denda</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ket_denda" name="ket_denda" value="<?= htmlspecialchars($pr['ket_denda']); ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jml_denda" class="col-sm-3 col-form-label">Jumlah Denda</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="jml_denda" name="jml_denda" value="<?= $pr['jml_denda']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ket" class="col-sm-3 col-form-label">Keterangan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ket" name="ket" value="<?= $pr['ket']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-xmark"></i> Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>