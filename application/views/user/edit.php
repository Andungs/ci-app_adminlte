<!-- Begin Page Content -->
<div class="content">
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">

            <div class="col-lg-8">
                <div class="card card-primary card-outline ">
                    <div class="card-header">
                        <h3 class="card-title ">
                            <i class="fas fa-edit"></i>
                            Edit Profile
                        </h3>
                    </div>
                    <div class="card-body">
                        <?= form_open_multipart('user/edit'); ?>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Email" name="email" value="<?= $user['email'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
                                <small class="text-danger mb-0"> <?= form_error('name'); ?> </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">picture</div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-thumbnail ">
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <hr>
                        </div>
                        <div class="form-group row ">
                            <div class="col-sm-12 ">
                                <button type="submit" class="btn btn-primary float-right"> Edit </button>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /.container-fluid -->
</div>