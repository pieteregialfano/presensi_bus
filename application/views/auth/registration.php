<!-- Ambil dari file registrasinya sb admin dan bagian header dan footer hapus saja karena tadi sudah punya di auth -->
<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto"> <!-- Buat bikin ukurannya card ada ditengah dan tidak terlalu besar -->
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" autocomplete="off" id="name" name="name" placeholder="Enter Your Name" value="<?= set_value('name'); ?>">
                                <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?> <!-- membuat form error untuk memberikan notifikasi di dalam form registrationnya --><!-- sebelum membuat form error ini pastikan menambahkan method="post" dan action di form class nya(ada di line 13) -->
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" autocomplete="off" id="address" name="address" placeholder="Enter Your Address" value="<?= set_value('address'); ?>">
                                <?= form_error('address', '<small class="text-danger pl-3">', '</small>'); ?> <!-- membuat form error untuk memberikan notifikasi di dalam form registrationnya --><!-- sebelum membuat form error ini pastikan menambahkan method="post" dan action di form class nya(ada di line 13) -->
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" autocomplete="off" id="phone_number" name="phone_number" placeholder="Enter Your Phone Number" value="<?= set_value('phone_number'); ?>">
                                <?= form_error('phone_number', '<small class="text-danger pl-3">', '</small>'); ?> <!-- membuat form error untuk memberikan notifikasi di dalam form registrationnya --><!-- sebelum membuat form error ini pastikan menambahkan method="post" dan action di form class nya(ada di line 13) -->
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" autocomplete="off" id="email" name="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                                <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?> <!-- membuat form error untuk memberikan notifikasi di dalam form registrationnya --><!-- sebelum membuat form error ini pastikan menambahkan method="post" dan action di form class nya(ada di line 13) -->
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?> <!-- membuat form error untuk memberikan notifikasi di dalam form registrationnya --><!-- sebelum membuat form error ini pastikan menambahkan method="post" dan action di form class nya(ada di line 13) -->
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>