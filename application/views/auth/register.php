<?php $this->load->view('templates/header'); ?>
<div class="auth-wrapper">
    <div class="auth-card" style="max-width:460px">
        <div class="auth-logo">
            <div class="navbar-brand-icon" style="width:44px;height:44px;border-radius:12px;font-size:22px"><i class="fas fa-camera"></i></div>
            <span style="font-size:22px;font-weight:800">RENTCAM</span>
        </div>
        <h1 class="auth-title">Buat Akun Baru</h1>
        <p class="auth-subtitle">Bergabung dengan RENTCAM dan mulai sewa hari ini</p>

        <?php if (isset($error)): ?>
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= $error ?></div>
        <?php endif; ?>

        <?= form_open('register') ?>
        <div class="form-group">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" value="<?= set_value('nama') ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="email@example.com" value="<?= set_value('email') ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label">Password</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="reg-password" class="form-control" placeholder="Minimal 6 karakter" required>
                <i class="fas fa-eye password-toggle" data-target="reg-password"></i>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Konfirmasi Password</label>
            <div class="password-wrapper">
                <input type="password" name="confirm" id="reg-confirm" class="form-control" placeholder="Ulangi password" required>
                <i class="fas fa-eye password-toggle" data-target="reg-confirm"></i>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-top:4px">
            <i class="fas fa-user-plus"></i> Daftar Sekarang
        </button>
        <?= form_close() ?>

        <p style="text-align:center;margin-top:20px;font-size:13px;color:#64748B">
            Sudah punya akun? <a href="<?= site_url('login') ?>" style="font-weight:600">Masuk di sini</a>
        </p>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
