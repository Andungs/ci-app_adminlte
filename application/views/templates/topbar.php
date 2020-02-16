<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>

    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link " data-toggle="dropdown" href="#">
                <i class="fas fa-cogs"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <a href="<?= base_url('user/index') ?>" class="dropdown-item">
                    <i class="fas fa-fw fa-user "></i> My Profile
                </a>
                <a href="<?= base_url('auth/logout') ?>" class="dropdown-item ">
                    <i class="fas fa-fw fa-sign-out-alt"></i> logout
                </a>

            </div>
        </li>

    </ul>
</nav>
<!-- /.navbar -->