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
                    <a href="" class="d-sm-inline-block btn btn-primary shadow-sm float-left" style="font-size: 13px;" data-toggle="modal" data-target="#addPoBusModal"><i class="fas fa-fw fa-square-plus text-white-50 mr-1"></i>Add PO. Bus</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Perusahaan Oto Bus</th>
                                    <th scope="col">No Route Bus</th>
                                    <th scope="col">Route Bus</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($po_bus as $vendor) : ?>
                                    <tr>
                                        <th><?= ++$start; ?></th>
                                        <td><?= $vendor['per_oto_bus']; ?></td>
                                        <td><?= $vendor['no_bus']; ?></td>
                                        <td><?= $vendor['route']; ?></td>
                                        <td class="d-flex">
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#detailPoBusModal<?= $vendor['id']; ?>"><i class="fas fa-eye"></i></button>

                                            <a href="<?= base_url(); ?>user/delete_po_bus/<?= $vendor['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin menghapus menu ini?')"><i class="fas fa-trash"></i></a>
                                            <!-- Button to open the Edit Denda Bus Modal for each item -->

                                            <button type="button" class="btn btn-warning edit-denda-btn" data-denda-id="<?= $vendor['id']; ?>" data-toggle="modal" data-target="#editPoBusModal<?= $vendor['id']; ?>"><i class="fas fa-file-edit"></i></button>

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
<div class="modal fade" id="addPoBusModal" tabindex="-1" role="dialog" aria-labelledby="addPoBusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPoBusModalLabel">Add PO. Bus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/master_bus'); ?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="per_oto_bus" class="col-sm-3 col-form-label">Nama PO. Bus<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="per_oto_bus" name="per_oto_bus">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_bus_vendor" class="col-sm-3 col-form-label">No. Route Bus<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="no_bus_vendor" name="no_bus_vendor">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="valid_from" class="col-sm-3 col-form-label" for="valid_from">Valid From<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input required type="text" class="form-control" id="valid_from" name="valid_from" placeholder="yyyy/mm/dd" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="valid_to" class="col-sm-3 col-form-label">Valid To<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input required type="text" class="form-control" id="valid_to" name="valid_to" placeholder="yyyy/mm/dd" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-fw fa-calendar input-prefix"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deletion" class="col-sm-3 col-form-label">Deletion Indicator</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="deletion" name="deletion">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pc" class="col-sm-3 col-form-label">PC Bus<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="pc" name="pc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="type_bus" class="col-sm-3 col-form-label">Type Bus<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="type_bus" name="type_bus">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="route" class="col-sm-3 col-form-label">Route Bus<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="route" name="route">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jum_rit_b" class="col-sm-3 col-form-label">Jumlah Rit/Bln<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="jum_rit_b" name="jum_rit_b">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jum_hk" class="col-sm-3 col-form-label">Jumlah Hari Kerja<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="jum_hk" name="jum_hk">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hrg_sewa" class="col-sm-3 col-form-label">Harga Sewa<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="hrg_sewa" name="hrg_sewa">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_polisi" class="col-sm-3 col-form-label">Nomor Polisi</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="no_polisi" name="no_polisi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kap_bus" class="col-sm-3 col-form-label">Kapasitas Bus<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="kap_bus" name="kap_bus">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jum_pnp" class="col-sm-3 col-form-label">Jumlah Penumpang<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="jum_pnp" name="jum_pnp">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jum_pnp_egm" class="col-sm-3 col-form-label">Jumlah Penumpang EGM<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="jum_pnp_egm" name="jum_pnp_egm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jum_pnp_mgc" class="col-sm-3 col-form-label">Jumlah Penumpang MGC<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="jum_pnp_mgc" name="jum_pnp_mgc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jum_pnp_mkr" class="col-sm-3 col-form-label">Jumlah Penumpang MKR<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="jum_pnp_mkr" name="jum_pnp_mkr">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jum_pnp_mgf" class="col-sm-3 col-form-label">Jumlah Penumpang MGF<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input required type="text" class="form-control" id="jum_pnp_mgf" name="jum_pnp_mgf">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ppn" class="col-sm-3 col-form-label">PPN 11%</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="ppn" name="ppn">
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


<?php $start = 0;
foreach ($po_bus as $vendor) : $start++; ?>
    <!-- Edit Denda -->
    <div class="modal fade" id="editPoBusModal<?= $vendor['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editPoBusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPoBusModalLabel<?= $vendor['id']; ?>">Edit Denda Bus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/edit_po_bus/' . $vendor['id']); ?>" method="post" enctype="multipart/form-data" role="form">
                    <input type="hidden" name="id" value="<?= $vendor['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="per_oto_bus" class="col-sm-3 col-form-label">PO. Bus</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="per_oto_bus" name="per_oto_bus" value="<?= $vendor['per_oto_bus']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_bus" class="col-sm-3 col-form-label">No. Route Bus</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="no_bus" name="no_bus" value="<?= $vendor['no_bus']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="valid_from" class="col-sm-3 col-form-label">Valid From</label>
                            <div class="col-sm-9">
                                <input required type="text" class="valid_from_edit form-control" id="valid_from" name="valid_from" value="<?= $vendor['valid_from']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="valid_to" class="col-sm-3 col-form-label">Valid To</label>
                            <div class="col-sm-9">
                                <input required type="text" class="valid_to_edit form-control" id="valid_to" name="valid_to" value="<?= $vendor['valid_to']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deletion" class="col-sm-3 col-form-label">Deletion Indicator</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="deletion" name="deletion" value="<?= $vendor['deletion']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pc" class="col-sm-3 col-form-label">PC Bus</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="pc" name="pc" value="<?= $vendor['pc']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type_bus" class="col-sm-3 col-form-label">Type Bus</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="type_bus" name="type_bus" value="<?= $vendor['type_bus']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="route" class="col-sm-3 col-form-label">Route Bus</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="route" name="route" value="<?= $vendor['route']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_rit_b" class="col-sm-3 col-form-label">Jumlah Rit/Bln</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="jum_rit_b" name="jum_rit_b" value="<?= $vendor['jum_rit_b']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_hk" class="col-sm-3 col-form-label">Jumlah Hari Kerja</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="jum_hk" name="jum_hk" value="<?= $vendor['jum_hk']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hrg_sewa" class="col-sm-3 col-form-label">Harga Sewa</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="hrg_sewa" name="hrg_sewa" value="<?= $vendor['hrg_sewa']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_polisi" class="col-sm-3 col-form-label">Nomor Polisi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_polisi" name="no_polisi" value="<?= $vendor['no_polisi']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kap_bus" class="col-sm-3 col-form-label">Kapasitas Bus</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="kap_bus" name="kap_bus" value="<?= $vendor['kap_bus']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_pnp" class="col-sm-3 col-form-label">Jumlah Penumpang</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="jum_pnp" name="jum_pnp" value="<?= $vendor['jum_pnp']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_pnp_egm" class="col-sm-3 col-form-label">Jumlah Penumpang EGM</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="jum_pnp_egm" name="jum_pnp_egm" value="<?= $vendor['jum_pnp_egm']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_pnp_mgc" class="col-sm-3 col-form-label">Jumlah Penumpang MGC</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="jum_pnp_mgc" name="jum_pnp_mgc" value="<?= $vendor['jum_pnp_mgc']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_pnp_mkr" class="col-sm-3 col-form-label">Jumlah Penumpang MKR</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="jum_pnp_mkr" name="jum_pnp_mkr" value="<?= $vendor['jum_pnp_mkr']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_pnp_mgf" class="col-sm-3 col-form-label">Jumlah Penumpang MGF</label>
                            <div class="col-sm-9">
                                <input required type="text" class="form-control" id="jum_pnp_mgf" name="jum_pnp_mgf" value="<?= $vendor['jum_pnp_mgf']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ppn" class="col-sm-3 col-form-label">PPN 11%</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ppn" name="ppn" value="<?= $vendor['ppn']; ?>">
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
<?php
foreach ($po_bus as $vendor) : $start++; ?>
    <div class="modal fade" id="detailPoBusModal<?= $vendor['id']; ?>" role="dialog" aria-labelledby="detailPoBusModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailPoBusModalLabel<?= $vendor['id']; ?>">Detail PO. Bus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Form edit data presensi -->
                <form action="<?= base_url('user/detail_po_bus/' . $vendor['id']); ?>" method="post" enctype="multipart/form-data" role="form">
                    <div class="modal-body">

                        <input type="hidden" name="id" value="<?= $vendor['id']; ?>">
                        <!-- Tambahkan formulir pengeditan di sini -->
                        <div class="form-group row">
                            <label for="per_oto_bus" class="col-sm-3 col-form-label">PO. Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="per_oto_bus" name="per_oto_bus" value="<?= $vendor['per_oto_bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_bus" class="col-sm-3 col-form-label">No. Route Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_bus" name="no_bus" value="<?= $vendor['no_bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="valid_from" class="col-sm-3 col-form-label">Valid From</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="valid_from" name="valid_from" value="<?= $vendor['valid_from']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="valid_to" class="col-sm-3 col-form-label">Valid To</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="valid_to" name="valid_to" value="<?= $vendor['valid_to']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deletion" class="col-sm-3 col-form-label">Deletion Indicator</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="deletion" name="deletion" value="<?= $vendor['deletion']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pc" class="col-sm-3 col-form-label">PC Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="pc" name="pc" value="<?= $vendor['pc']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type_bus" class="col-sm-3 col-form-label">Type Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="type_bus" name="type_bus" value="<?= $vendor['type_bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="route" class="col-sm-3 col-form-label">Route Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="route" name="route" value="<?= $vendor['route']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_rit_b" class="col-sm-3 col-form-label">Jumlah Rit/Bln</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="jum_rit_b" name="jum_rit_b" value="<?= $vendor['jum_rit_b']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_hk" class="col-sm-3 col-form-label">Jumlah Hari Kerja</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="jum_hk" name="jum_hk" value="<?= $vendor['jum_hk']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hrg_sewa" class="col-sm-3 col-form-label">Harga Sewa</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="hrg_sewa" name="hrg_sewa" value="<?= $vendor['hrg_sewa']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_polisi" class="col-sm-3 col-form-label">Nomor Polisi</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_polisi" name="no_polisi" value="<?= $vendor['no_polisi']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kap_bus" class="col-sm-3 col-form-label">Kapasitas Bus</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kap_bus" name="kap_bus" value="<?= $vendor['kap_bus']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_pnp" class="col-sm-3 col-form-label">Jumlah Penumpang</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="jum_pnp" name="jum_pnp" value="<?= $vendor['jum_pnp']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_pnp_egm" class="col-sm-3 col-form-label">Jumlah Penumpang EGM</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="jum_pnp_egm" n ame="jum_pnp_egm" value="<?= $vendor['jum_pnp_egm']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_pnp_mgc" class="col-sm-3 col-form-label">Jumlah Penumpang MGC</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="jum_pnp_mgc" name="jum_pnp_mgc" value="<?= $vendor['jum_pnp_mgc']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_pnp_mkr" class="col-sm-3 col-form-label">Jumlah Penumpang MKR</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="jum_pnp_mkr" name="jum_pnp_mkr" value="<?= $vendor['jum_pnp_mkr']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jum_pnp_mgf" class="col-sm-3 col-form-label">Jumlah Penumpang MGF</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="jum_pnp_mgf" name="jum_pnp_mgf" value="<?= $vendor['jum_pnp_mgf']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ppn" class="col-sm-3 col-form-label">PPN 11%</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ppn" name="ppn" value="<?= $vendor['ppn']; ?>" readonly>
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