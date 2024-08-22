<!-- Buat dulu folder menu di views, baru buat file index.php didalem folder menunya -->

<!-- Ambil isi awalnya dari index.php nya admin -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <!-- Ambil Bootstrap nya di bootstrap 4, hoverable tabel -->
    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div'); ?>

            <?= $this->session->flashdata('message'); ?>

            <!-- Buat tombol add menu -->
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?> <!-- Supaya penomorannya increament/bertambah terus tidak angka 1 doang -->
                    <?php foreach ($role as $r) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $r['role']; ?></td>
                            <td>
                                <!-- Ambil dari bootstrap badge tombolnya -->
                                <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="badge badge-warning">access</a>
                                <a href="" class="badge badge-success">edit</a>
                                <a href="<?= base_url(); ?>menu/delete/<?= $r['id']; ?>" class="badge badge-danger" onclick="return confirm('Anda yakin menghapus menu ini?')">delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?> <!-- Increament penomorannya -->
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->



<!-- Modal (ambil dari bootstrap 4) -->
<!-- Id nya samakan dengan yang button di atas -->
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/role'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
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