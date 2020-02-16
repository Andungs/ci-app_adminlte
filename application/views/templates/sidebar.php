<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('user') ?>" class="brand-link">
        <i class="fas fa-2x fa-code"></i>
        <span class=" ml-3 brand-text font-weight-light">My Project</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= base_url('User/index') ?>" class="d-block"><?= $user['name']  ?></a>
            </div>
        </div>

        <!-- QUERY MENU  -->
        <?php

        $role_id = $this->session->userdata('role_id');

        $queryMenu = " SELECT `user_menu`.`id`,`menu`,icon
                            FROM `user_menu` JOIN `user_access_menu` 
                            ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                            WHERE `user_access_menu`.`role_id` = $role_id
                            ORDER BY `user_access_menu`. `menu_id` ASC
                          ";
        $menu = $this->db->query($queryMenu)->result_array();

        ?>

        <!-- Sidebar Menu -->
        <nav class="mt-2">


            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->

                <!-- LOOPING MENU -->

                <?php foreach ($menu as $m) : ?>
                    <li class="nav-header "><?= $m['menu'] ?></li>
                    <?php if ($m['menu'] == $menu) : ?>
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <!-- hiddeng  -->
                                <!-- menu -->
                            <?php else : ?>
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link ">
                            <?php endif; ?>
                            <i class="nav-icon <?= $m['icon'] ?>"></i>
                            <p>
                                <?= $m['menu']  ?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            <?php
                            $menuId = $m['id'];
                            $querySubMenu = " SELECT * FROM `user_sub_menu`
                                WHERE `menu_id` = $menuId
                                AND `is_active` = 1 ";
                            $subMenu = $this->db->query($querySubMenu)->result_array();
                            ?>
                            <?php foreach ($subMenu as $sm) : ?>
                                <!-- Nav Item - Dashboard -->
                                <!-- submenu -->
                                <ul class="nav nav-treeview">
                                    <li class="nav-item ">
                                        <?php if ($title == $sm['title']) :  ?>
                                            <a href="<?= base_url($sm['url'])  ?>" class="nav-link active">
                                            <?php else : ?>
                                                <a href="<?= base_url($sm['url'])  ?>" class="nav-link">
                                                <?php endif ?>
                                                <i class="<?= $sm['icon'] ?>"></i>
                                                <p><?= $sm['title'] ?></p>
                                                </a>
                                    </li>
                                </ul>
                            <?php endforeach; ?>
                        <?php endforeach ?>

                        </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('user') ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->