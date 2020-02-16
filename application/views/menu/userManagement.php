<section class="content">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <?php if (validation_errors()) :  ?>
                    <div class="alert alert-danger alert-dismissible fade show col-md-4" role="alert">
                        <?= validation_errors() ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?= $this->session->flashdata('flash'); ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-fw fa-table"></i>
                            <?= $title ?></h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover border-bottom-primary">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role_id</th>
                                    <th scope="col">is_Active</th>
                                    <th scope="col">date_created</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($dataUser as $u) : ?>
                                    <tr>
                                        <th scope="row"><?= $i ?></th>
                                        <td><?= $u['name'] ?></td>
                                        <td><?= $u['email'] ?></td>
                                        <td><?= $u['role_id'] ?></td>
                                        <td>
                                            <?php if ($u['is_active'] == 1) : ?>
                                                <small class="badge badge-success">
                                                    Active
                                                </small>
                                            <?php else : ?>
                                                <small class="badge badge-danger">
                                                    Not Active
                                                </small>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('D-FY', $u['date_created'])  ?></td>
                                        <td>
                                            <a href="<?= base_url('Menu/deleteUser') ?>" class="btn btn-block btn-outline-danger btn-sm">
                                                <i class="fas fa-fw fa-trash"></i>
                                                delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>