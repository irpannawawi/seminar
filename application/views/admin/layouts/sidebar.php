<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="<?= base_url('assets/backend/dist/img/') . get_setting('logo_web') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/backend') ?>/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $users['name'] ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= site_url('admin') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Events
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('admin/events/create') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buat Event</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('admin/events') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Event</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('admin/events/publish') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Event Publish</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('admin/events/draft') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Event Draf</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('admin/events/category') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Kategori</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>
                            Penjualan
                            <i class="fas fa-angle-left right"></i>
                            <span class="badge badge-warning right">6</span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/usermanagement'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Akun Pengguna</p>
                                <span class="badge badge-warning right">6</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/partnership'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>Partnership</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Akun Management
                            <i class="fas fa-angle-left right"></i>
                            <!-- <span class="badge badge-warning right">6</span> -->
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/usermanagement'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Akun Pengguna</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/usermanagement/role'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role Pengguna</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Web Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/webmanagement/info'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Info Website</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/webmanagement/wagw'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Integrasi WhatsApp</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/webmanagement/#'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Integrasi Email</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/webmanagement/pesan'); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pesan Setting</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/rekening'); ?>" class="nav-link">
                        <i class="nav-icon fas fa-money-check"></i>
                        <p>Rekening Management</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('auth/logout'); ?>" class="nav-link delete-btn">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
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