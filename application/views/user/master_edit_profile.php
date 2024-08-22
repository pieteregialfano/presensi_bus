<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-12">
            <!-- Combined Card for Profile Picture and Edit Profile -->
            <div class="card">
                <div class="card-header">
                    Profile Management
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Profile Picture Section -->
                        <div class="col-lg-6">
                            <div class="text-center">
                                <img src="<?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail rounded-circle" style="max-width: 150px;">
                            </div>
                            <form action="<?= base_url('user/edit'); ?>" method="post" enctype="multipart/form-data">
                                <div class="custom-file mt-3">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Upload New Image</button>
                            </form>
                        </div>

                        <!-- Edit Profile Section -->
                        <div class="col-lg-6">
                            <?= form_open_multipart('user/edit'); ?>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                                <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?= $user['address']; ?>">
                                <?= form_error('address', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= $user['phone_number']; ?>">
                                <?= form_error('phone_number', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- End of Main Content -->