<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-3 active">
                    <li class="breadcrumb-item"><a href="<?= base_url('user'); ?>">My Profile</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/edit'); ?>">Edit Profile</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/changePassword'); ?>">Change Password</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/presensi'); ?>">Presensi Bus</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/cetak_laporan'); ?>">Cetak Laporan</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/master_denda'); ?>">Ubah dan Tambah Denda</a></li>
                </ol>
            </nav> -->

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->

                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['name']; ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('user/index'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            My Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- End of Topbar -->