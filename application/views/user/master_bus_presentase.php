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
                    <a href="" class="d-sm-inline-block btn btn-primary shadow-sm float-left" style="font-size: 13px;" data-toggle="modal" data-target="#addPresentaseBusModal"><i class="fas fa-fw fa-square-plus text-white-50 mr-1"></i>Add Presentase Bus</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTablePresentase" width="100%" cellspacing="0" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">NO_BUS</th>
                                    <th scope="col">TYPE_BUS</th>
                                    <th scope="col">PO_BUS</th>
                                    <th scope="col">PERIODE</th>
                                    <th scope="col">T_PNP_EGM</th>
                                    <th scope="col">T_PNP_MKR</th>
                                    <th scope="col">T_PNP_MGF</th>
                                    <th scope="col">T_PNP_MGC</th>
                                    <th scope="col">T_PNP</th>
                                    <th scope="col">PERSENTASE_EGM</th>
                                    <th scope="col">PERSENTASE_MKR</th>
                                    <th scope="col">PERSENTASE_MGF</th>
                                    <th scope="col">PERSENTASE_MGC</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($presentase_bus as $presentase) : ?>
                                    <tr>
                                        <th><?= ++$start; ?></th>
                                        <td><?= $presentase['No_Bus']; ?></td>
                                        <td><?= $presentase['Type_Bus']; ?></td>
                                        <td><?= $presentase['PO_Bus']; ?></td>
                                        <td><?= $presentase['periode']; ?></td>
                                        <td><?= $presentase['T_PNP_EGM']; ?></td>
                                        <td><?= $presentase['T_PNP_MKR']; ?></td>
                                        <td><?= $presentase['T_PNP_MGF']; ?></td>
                                        <td><?= $presentase['T_PNP_MGC']; ?></td>
                                        <td><?= $presentase['T_PNP']; ?></td>
                                        <td><?= $presentase['persentase_egm']; ?></td>
                                        <td><?= $presentase['persentase_mkr']; ?></td>
                                        <td><?= $presentase['persentase_mgf']; ?></td>
                                        <td><?= $presentase['persentase_mgc']; ?></td>
                                        <td class="d-flex">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#detailPresentaseBusModal<?= $presentase['id']; ?>"><i class="fas fa-eye"></i></button>

                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editPresentaseBusModal<?= $presentase['id']; ?>" data-modal-no_transaksi="2"><i class="fas fa-file-edit"></i></button>

                                            <a href="<?= base_url(); ?>user/deletepresentasebus/<?= $presentase['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin menghapus menu ini?')"><i class="fas fa-trash"></i></a>
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
<div class="modal fade" id="addPresentaseBusModal" tabindex="-1" role="dialog" aria-labelledby="addPresentaseBusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPresentaseBusModalLabel">Add Presentase PO. Bus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/presentasebus'); ?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="No_Bus_P" class="col-sm-3 col-form-label">No. Bus<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select required class="js-example-basic-single form-control" id="No_Bus_P" name="No_Bus_P" aria-haspopup="true" style="width: 100%;">
                                <option value="">=== Pilih No. Bus ===</option>
                                <?php foreach ($no_bus_list as $bus) : ?>
                                    <option value="<?= $bus['no_bus']; ?>"><?= $bus['no_bus']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Type_Bus" class="col-sm-3 col-form-label">Type Bus<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="Type_Bus" name="Type_Bus" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="PO_Bus" class="col-sm-3 col-form-label">Per. Oto Bus<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="PO_Bus" name="PO_Bus" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="periode_bus" class="col-sm-3 col-form-label">Periode<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input required type="text" class="form-control datepicker-from" id="periode_bus" name="periode_bus" placeholder="yyyy/mm/dd" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="t_pnp_egm" class="col-sm-3 col-form-label">Total Penumpang EGM<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="t_pnp_egm" name="t_pnp_egm" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="t_pnp_mkr" class="col-sm-3 col-form-label">Total Penumpang MKR<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="t_pnp_mkr" name="t_pnp_mkr" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="t_pnp_mgf" class="col-sm-3 col-form-label">Total Penumpang MGF<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="t_pnp_mgf" name="t_pnp_mgf" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="t_pnp_mgc" class="col-sm-3 col-form-label">Total Penumpang MGC<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="t_pnp_mgc" name="t_pnp_mgc" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="t_pnp" class="col-sm-3 col-form-label">Total Penumpang<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="t_pnp" name="t_pnp" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="persentase_egm" class="col-sm-3 col-form-label">Persentase EGM<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" step="any" id="persentase_egm" name="persentase_egm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="persentase_mkr" class="col-sm-3 col-form-label">Persentase MKR<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" step="any" id="persentase_mkr" name="persentase_mkr">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="persentase_mgf" class="col-sm-3 col-form-label">Persentase MGF<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" step="any" id="persentase_mgf" name="persentase_mgf">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="persentase_mgc" class="col-sm-3 col-form-label">Persentase MGC<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" step="any" id="persentase_mgc" name="persentase_mgc">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="total_pnp" id="total_pnp" value="">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Presentase Bus Modal -->
<?php $start = 0;
foreach ($presentase_bus as $presentase) : $start++; ?>
    <div class="modal fade" id="editPresentaseBusModal<?= $presentase['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editPresentaseBusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPresentaseBusModalLabel<?= $presentase['id']; ?>">Add PO. Bus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/edit_presentasebus/' . $presentase['id']); ?>" method="post" enctype="multipart/form-data" role="form">
                    <input type="hidden" name="id" value="<?= $presentase['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="No_Bus_P" class="col-sm-3 col-form-label">No. Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="No_Bus_P" name="No_Bus_P" value="<?= $presentase['No_Bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Type_Bus" class="col-sm-3 col-form-label">Type Bus<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Type_Bus" name="Type_Bus" value="<?= $presentase['Type_Bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="PO_Bus" class="col-sm-3 col-form-label">Per. Oto Bus<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="PO_Bus" name="PO_Bus" value="<?= $presentase['PO_Bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="periode_bus" class="col-sm-3 col-form-label">Periode<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input required type="text" class="edit_periode form-control datepicker-from" id="periode_bus" name="periode_bus" value="<?= $presentase['periode']; ?>" placeholder="yyyy/mm/dd" autocomplete="off">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="t_pnp_egm" class="col-sm-3 col-form-label">Total Penumpang EGM<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="t_pnp_egm" name="t_pnp_egm" value="<?= $presentase['T_PNP_EGM']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="t_pnp_mkr" class="col-sm-3 col-form-label">Total Penumpang MKR<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="t_pnp_mkr" name="t_pnp_mkr" value="<?= $presentase['T_PNP_MKR']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="t_pnp_mgf" class="col-sm-3 col-form-label">Total Penumpang MGF<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="t_pnp_mgf" name="t_pnp_mgf" value="<?= $presentase['T_PNP_MGF']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="t_pnp_mgc" class="col-sm-3 col-form-label">Total Penumpang MGC<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="t_pnp_mgc" name="t_pnp_mgc" value="<?= $presentase['T_PNP_MGC']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="t_pnp" class="col-sm-3 col-form-label">Total Penumpang<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="t_pnp" name="t_pnp" value="<?= $presentase['T_PNP']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="persentase_egm" class="col-sm-3 col-form-label">Persentase EGM<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" step="any" id="persentase_egm" name="persentase_egm" value="<?= $presentase['persentase_egm']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="persentase_mkr" class="col-sm-3 col-form-label">Persentase MKR<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" step="any" id="persentase_mkr" name="persentase_mkr" value="<?= $presentase['persentase_mkr']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="persentase_mgf" class="col-sm-3 col-form-label">Persentase MGF<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" step="any" id="persentase_mgf" name="persentase_mgf" value="<?= $presentase['persentase_mgf']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="persentase_mgc" class="col-sm-3 col-form-label">Persentase MGC<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" step="any" id="persentase_mgc" name="persentase_mgc" value="<?= $presentase['persentase_mgc']; ?>">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="total_pnp" id="total_pnp" value="">
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


<?php foreach ($presentase_bus as $presentase) : $start++; ?>
    <div class="modal fade" id="detailPresentaseBusModal<?= $presentase['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailPresentaseBusLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailPresentaseBusLabel<?= $presentase['id']; ?>">Add PO. Bus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/detail_presentasebus/' . $presentase['id']); ?>" method="post" enctype="multipart/form-data" role="form">
                    <input type="hidden" name="id" value="<?= $presentase['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="No_Bus_P" class="col-sm-3 col-form-label">No. Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="No_Bus_P" name="No_Bus_P" value="<?= $presentase['No_Bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Type_Bus" class="col-sm-3 col-form-label">Type Bus<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Type_Bus" name="Type_Bus" value="<?= $presentase['Type_Bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class=" form-group row">
                            <label for="PO_Bus" class="col-sm-3 col-form-label">Per. Oto Bus<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="PO_Bus" name="PO_Bus" value="<?= $presentase['PO_Bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="periode_bus" class="col-sm-3 col-form-label">Periode<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <input required type="text" class="form-control datepicker-from" id="periode_bus" name="periode_bus" value="<?= $presentase['periode']; ?>" placeholder="yyyy/mm/dd" autocomplete="off" readonly>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="t_pnp_egm" class="col-sm-3 col-form-label">Total Penumpang EGM<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="t_pnp_egm" name="t_pnp_egm" value="<?= $presentase['T_PNP_EGM']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="t_pnp_mkr" class="col-sm-3 col-form-label">Total Penumpang MKR<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="t_pnp_mkr" name="t_pnp_mkr" value="<?= $presentase['T_PNP_MKR']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="t_pnp_mgf" class="col-sm-3 col-form-label">Total Penumpang MGF<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="t_pnp_mgf" name="t_pnp_mgf" value="<?= $presentase['T_PNP_MGF']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="t_pnp_mgc" class="col-sm-3 col-form-label">Total Penumpang MGC<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="t_pnp_mgc" name="t_pnp_mgc" value="<?= $presentase['T_PNP_MGC']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="t_pnp" class="col-sm-3 col-form-label">Total Penumpang<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="t_pnp" name="t_pnp" value="<?= $presentase['T_PNP']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="persentase_egm" class="col-sm-3 col-form-label">Persentase EGM<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" step="any" id="persentase_egm" name="persentase_egm" value="<?= $presentase['persentase_egm']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="persentase_mkr" class="col-sm-3 col-form-label">Persentase MKR<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" step="any" id="persentase_mkr" name="persentase_mkr" value="<?= $presentase['persentase_mkr']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="persentase_mgf" class="col-sm-3 col-form-label">Persentase MGF<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" step="any" id="persentase_mgf" name="persentase_mgf" value="<?= $presentase['persentase_mgf']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="persentase_mgc" class="col-sm-3 col-form-label">Persentase MGC<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" step="any" id="persentase_mgc" name="persentase_mgc" value="<?= $presentase['persentase_mgc']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="total_pnp" id="total_pnp" value="">
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