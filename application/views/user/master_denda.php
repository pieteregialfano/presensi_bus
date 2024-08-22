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
                    <a href="" class="d-sm-inline-block btn btn-primary shadow-sm float-left" style="font-size: 13px;" data-toggle="modal" data-target="#addDendaBusModal"><i class="fas fa-fw fa-square-plus text-white-50 mr-1"></i>Add Denda Bus</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0" style="font-size: 13px;">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Reason</th>
                                    <th scope="col">Denda</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($denda as $d) : ?>
                                    <tr>
                                        <th><?= ++$start; ?></th>
                                        <td><?= $d['reason']; ?></td>
                                        <td><?= $d['denda']; ?></td>
                                        <td class="d-flex">
                                            <a href="<?= base_url(); ?>user/delete_denda/<?= $d['id']; ?>" class="btn btn-danger" onclick="return confirm('Anda yakin menghapus menu ini?')"><i class="fas fa-trash"></i></a>
                                            <!-- Button to open the Edit Denda Bus Modal for each item -->

                                            <button type="button" class="btn btn-warning edit-denda-btn" data-denda-id="<?= $d['id']; ?>" data-toggle="modal" data-target="#editDendaBusModal<?= $d['id']; ?>"><i class="fas fa-file-edit"></i></button>

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
<div class="modal fade" id="addDendaBusModal" tabindex="-1" role="dialog" aria-labelledby="addDendaBusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDendaBusModalLabel">Add Denda Bus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('user/master_denda'); ?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="reason" class="col-sm-4 col-form-label">Reason</label>
                        <div class="col-sm-8">
                            <input required type="text" class="form-control" id="reason" name="reason">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="denda" class="col-sm-4 col-form-label">Jumlah Denda</label>
                        <div class="col-sm-8">
                            <input required type="text" class="form-control" id="denda" name="denda">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $start = 0;
foreach ($denda as $d) : $start++; ?>
    <!-- Edit Denda -->
    <div class="modal fade" id="editDendaBusModal<?= $d['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editDendaBusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDendaBusModalLabel<?= $d['id']; ?>">Edit Denda Bus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('user/edit_denda/' . $d['id']); ?>" method="post" enctype="multipart/form-data" role="form">
                    <input type="hidden" name="id" value="<?= $d['id']; ?>">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" id="reason" name="reason" placeholder="Reason" value="<?= $d['reason']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" id="denda" name="denda" placeholder="Jumlah denda" value="<?= $d['denda']; ?>">
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