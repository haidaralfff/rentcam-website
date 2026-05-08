<?php if (in_array($this->uri->segment(1), ['login', 'register'])) return; ?>
<nav class="navbar">
    <a href="<?= base_url() ?>" class="navbar-brand">
        <div class="navbar-brand-icon"><i class="fas fa-camera"></i></div>
        RENTCAM
    </a>

    <button class="navbar-toggle" id="navbar-toggle">
        <i class="fas fa-bars"></i>
    </button>

    <div class="navbar-collapse" id="navbar-collapse">
        <ul class="navbar-menu">
            <li><a href="<?= base_url() ?>" class="<?= uri_string() === '' ? 'active' : '' ?>"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="<?= site_url('produk') ?>" class="<?= strpos(uri_string(), 'produk') === 0 ? 'active' : '' ?>"><i class="fas fa-box"></i> Katalog</a></li>
            <?php if (is_logged_in()): ?>
            <li><a href="<?= site_url('booking/riwayat') ?>"><i class="fas fa-clock"></i> Riwayat</a></li>
            <?php endif; ?>
        </ul>
        <div class="navbar-actions">
            <?php if (is_logged_in()):
                $cu = current_user();
            ?>
                <div class="d-flex align-center gap-2">
                    <?php 
                    $role = normalize_role($cu['role']);
                    if ($role === 'admin' || $role === 'superadmin'): 
                    ?>
                    <a href="<?= site_url($role) ?>" class="btn btn-primary btn-sm" style="background:#2563EB; border:none; padding:8px 16px;">
                        <i class="fas fa-tachometer-alt"></i> PANEL <?= strtoupper($role) ?>
                    </a>
                    <?php endif; ?>
                    
                    <div class="sidebar-avatar" style="width:34px;height:34px;font-size:13px;background:var(--primary);color:#fff"><?= strtoupper(substr($cu['nama'],0,1)) ?></div>
                    <span class="user-name" style="font-weight:600;font-size:13px;margin-right:10px;color:#fff"><?= htmlspecialchars($cu['nama']) ?></span>
                    
                    <a href="<?= site_url('logout') ?>" class="btn btn-outline-white btn-sm logout-link" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            <?php else: ?>
                <a href="<?= site_url('login') ?>"    class="btn btn-outline-white btn-sm">Login</a>
                <a href="<?= site_url('register') ?>" class="btn btn-primary btn-sm">Daftar</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
