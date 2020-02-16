<div class="content">
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->

        <div class="row">

            <div class="col-lg-8">
                <?= $this->session->flashdata('flash');
                ?>
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-key"></i>
                            Change Password
                        </h3>
                    </div>
                    <div class="card-body">



                        <?=
                            form_open('user/changePassword');
                        ?>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Old Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="oldpassword" name="oldpassword">
                                <small class="text-danger mb-0"> <?= form_error('oldpassword'); ?> </small>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">New password </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password1" name="password1">
                                <small class="text-danger mb-0"> <?= form_error('password1'); ?> </small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Repeat password </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password2" name="password2">
                                <small class="text-danger mb-0"> <?= form_error('password2'); ?> </small>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <hr>
                        </div>
                        <div class="form-group row ">
                            <div class="col-sm-12 ">
                                <button type="submit" class="btn btn-primary float-right"> Change </button>
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