<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('admin/index'); ?>">
        <div class="sidebar-brand-icon">
            <i class="fas fa-fw fa-bus"></i>
        </div>
        <div class="sidebar-brand-text">PRESENSI BUS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Disini kita joinkan master_user_menu dengan master_user_access_menu, codenya liat di https://www.dofactory.com/sql/join -->
    <!-- Query Menu -->

    <?php
    // Buat role_id nya buat dipanggil di query menu nya
    $role_id = $this->session->userdata('role_id');
    // Isi querynya liat di https://www.dofactory.com/sql/join, tinggal disesuaikan dengan nama tabel yang ada di database kita
    $queryMenu = "SELECT `master_user_menu`.`id`, `menu`
                FROM `master_user_menu` JOIN `master_user_access_menu` 
                ON `master_user_menu`.`id` = `master_user_access_menu`.`menu_id`
                WHERE `master_user_access_menu`.`role_id` = $role_id
                ORDER BY `master_user_access_menu`.`menu_id` ASC    
                ";
    $menu = $this->db->query($queryMenu)->result_array(); //Menampilkan isi tabelnya
    ?>

    <!-- LOOPING Menu -->
    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>

        <!-- Siapkan sub menu sesuai menu -->
        <?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT *
                        FROM `master_user_sub_menu` JOIN `master_user_menu`
                        ON `master_user_sub_menu`.`menu_id` = `master_user_menu`.`id`
                        WHERE `master_user_sub_menu`.`menu_id` = $menuId
                        AND `master_user_sub_menu`.`is_active` = 1
                        ";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <!-- Menampilkan submenu yang ada di sidebar -->
        <?php foreach ($subMenu as $sm) : ?>
            <?php if ($title == $sm['title']) : ?>
                <!-- if dibuat agar ketika kita ada di dalam menu yg kita pilih, maka warnanya akan nyala sedangkan yang tidak dipilih mati -->
                <li class="nav-item active">
                <?php else : ?>
                <li class="nav-item">
                <?php endif; ?>
                <!-- Sampai sini -->
                <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                    <i class="<?= $sm['icon']; ?>"></i>
                    <span><?= $sm['title']; ?></span></a>
                </li>
            <?php endforeach; ?>

            <!-- Divider -->
            <hr class="sidebar-divider mt-3">

        <?php endforeach; ?>


        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

</ul>
<!-- End of Sidebar -->