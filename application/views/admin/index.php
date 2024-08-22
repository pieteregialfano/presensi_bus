<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div> -->

    <!-- Content Row -->
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
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->