<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="container">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <h1 class="display-4"><strong> Selamat Datang <?= $user['name']; ?>!</strong></h1>
                        <p class="lead">Silahkan mengisi presensi untuk meng-update pembayaran vendor bus.</p>
                        <a href="<?= base_url('user/presensi'); ?>" class="btn btn-primary shadow-sm"><i class="fas fa-fw fa-file-edit text-white-50"></i> Buat Presensi</a>
                    </div>
                    <div class="col-md-4 text-right">
                        <img src="<?= base_url('assets/img/admin.jpg'); ?>" class="img-thumbnail rounded-circle mr-4" style="max-width: 200px;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card mb-3 col-lg-6"> <!-- Adjust the col-lg value to control card width -->
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="card-img">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $user['name']; ?></h5>
                        <p class="card-text"><?= $user['email']; ?></p>
                        <p class="card-text"><?= $user['address']; ?></p>
                        <p class="card-text"><?= $user['phone_number']; ?></p>
                        <p class="card-text"><?= $user['username']; ?></p>
                        <p class="card-text"><small class="text-muted">Member Since <?= date('d F Y', $user['date_created']); ?></small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->