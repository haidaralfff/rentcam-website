<?php
$role    = normalize_role($this->session->userdata('role'));
$nama    = $this->session->userdata('nama');
$current = uri_string();

$is_admin      = $role === 'admin';
$is_superadmin = $role === 'superadmin';
$role_label    = $role === 'superadmin' ? 'Super Admin' : ucfirst($role);
?>
<aside class="sidebar">
    <!-- Logo -->
    <div class="sidebar-logo">
        <div class="sidebar-logo-icon"><i class="fas fa-camera"></i></div>
        <div>
            <div class="sidebar-logo-text">RENTCAM</div>
            <div class="sidebar-logo-sub"><?= $role_label ?> Panel</div>
        </div>
    </div>

    <!-- Menu Admin/Superadmin -->
    <?php if ($is_admin): ?>
    <div class="sidebar-section-title">Menu Utama</div>
    <ul class="sidebar-nav">
        <li>
            <a href="<?= site_url('admin') ?>" class="<?= $current === 'admin' ? 'active' : '' ?>">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="<?= site_url('admin/produk') ?>" class="<?= strpos($current, 'admin/produk') === 0 ? 'active' : '' ?>">
                <i class="fas fa-box-open"></i> Produk
            </a>
        </li>
        <li>
            <a href="<?= site_url('admin/booking') ?>" class="<?= strpos($current, 'admin/booking') === 0 ? 'active' : '' ?>">
                <i class="fas fa-calendar-check"></i> Booking
            </a>
        </li>
        <li>
            <a href="<?= site_url('admin/pembayaran') ?>" class="<?= strpos($current, 'admin/pembayaran') === 0 ? 'active' : '' ?>">
                <i class="fas fa-money-bill-wave"></i> Pembayaran
            </a>
        </li>
    </ul>
    <?php endif; ?>

    <!-- Menu Superadmin -->
    <?php if ($is_superadmin): ?>
    <div class="sidebar-section-title">Super Admin</div>
    <ul class="sidebar-nav">
        <li>
            <a href="<?= site_url('superadmin') ?>" class="<?= $current === 'superadmin' ? 'active' : '' ?>">
                <i class="fas fa-chart-line"></i> Dashboard 
            </a>
        </li>
        <li>
            <a href="<?= site_url('superadmin/laporan') ?>" class="<?= strpos($current, 'superadmin/laporan') === 0 ? 'active' : '' ?>">
                <i class="fas fa-file-alt"></i> Laporan
            </a>
        </li>
        <li>
            <a href="<?= site_url('superadmin/admin') ?>" class="<?= strpos($current, 'superadmin/admin') === 0 ? 'active' : '' ?>">
                <i class="fas fa-user-shield"></i> Kelola Admin
            </a>
        </li>
        <li>
            <a href="<?= site_url('superadmin/user') ?>" class="<?= strpos($current, 'superadmin/user') === 0 ? 'active' : '' ?>">
                <i class="fas fa-users"></i> Manajemen User
            </a>
        </li>
        <li>
            <a href="<?= site_url('superadmin/setting') ?>" class="<?= strpos($current, 'superadmin/setting') === 0 ? 'active' : '' ?>">
                <i class="fas fa-cog"></i> Pengaturan
            </a>
        </li>
    </ul>
    <?php endif; ?>

    <!-- Quick Links -->
    <div class="sidebar-section-title">Lainnya</div>
    <ul class="sidebar-nav">
        <li><a href="<?= site_url('logout') ?>" class="logout-link"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>

    <!-- User Info -->
    <div class="sidebar-user">
        <div class="sidebar-avatar"><?= strtoupper(substr($nama, 0, 1)) ?></div>
        <div>
            <div class="sidebar-user-name"><?= htmlspecialchars($nama) ?></div>
            <div class="sidebar-user-role"><?= $role_label ?></div>
        </div>
    </div>
</aside>
