<!-- Udah di cut ke file auth_header dan auth_footer, ini sisanya dibiarkan saja -->

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">

                                <div class=" text-center">
                                    <img class="align-content" src="<?= base_url('assets/img/'); ?>bus.png" alt="">
                                    <h1 class="h4 text-gray-900 mb-4">Presensi Bus</h1>
                                </div>

                                <?= $this->session->flashdata('message'); ?> <!-- set_flashdata yang ada di controller Auth dipanggil di page login ini untuk menampilkan pesan notifikasinya -->

                                <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" autocomplete="off" id="email" name="email" placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?> <!-- membuat form error untuk memberikan notifikasi di dalam form registrationnya --><!-- sebelum membuat form error ini pastikan menambahkan method="post" dan action di form class nya(ada di line 24) -->
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?> <!-- membuat form error untuk memberikan notifikasi di dalam form registrationnya --><!-- sebelum membuat form error ini pastikan menambahkan method="post" dan action di form class nya(ada di line 24) -->
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>

                                </form>
                                <hr>
                                <!-- <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div> -->
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('auth/registration'); ?>">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>