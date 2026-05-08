<?php $this->load->view('templates/header'); ?>
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-logo">
            <div class="navbar-brand-icon" style="width:44px;height:44px;border-radius:12px;font-size:22px"><i class="fas fa-camera"></i></div>
            <span style="font-size:22px;font-weight:800">RENTCAM</span>
        </div>
        <h1 class="auth-title">Selamat Datang Kembali</h1>
        <p class="auth-subtitle">Masuk ke akun RENTCAM Anda</p>

        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= $error ?></div>
        <?php endif; ?>

        <?= form_open('login') ?>
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" placeholder="email@example.com" value="<?= set_value('email') ?>" required>
        </div>
        <div class="form-group">
            <label class="form-label">Password</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="login-password" class="form-control" placeholder="••••••••" required>
                <i class="fas fa-eye password-toggle" data-target="login-password"></i>
            </div>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-lg" style="margin-top:4px">
            <i class="fas fa-sign-in-alt"></i> Masuk
        </button>
        <?= form_close() ?>

        <p style="text-align:center;margin-top:20px;font-size:13px;color:#64748B">
            Belum punya akun? <a href="<?= site_url('register') ?>" style="font-weight:600">Daftar sekarang</a>
        </p>

    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
