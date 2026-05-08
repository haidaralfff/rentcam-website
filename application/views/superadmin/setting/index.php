<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar"><span class="topbar-title"><i class="fas fa-cog" style="color:var(--primary);margin-right:8px;"></i>Pengaturan Sistem</span></div>
        <div class="page-content">
            <div class="card" style="max-width:600px">
                <div class="card-header"><span class="card-title">Informasi Sistem</span></div>
                <div class="card-body">
                    <table style="width:100%;font-size:13px;border-collapse:collapse">
                        <tr><td style="padding:10px 0;color:#64748B;width:180px">Nama Sistem</td><td><strong>RENTCAM</strong></td></tr>
                        <tr><td style="padding:10px 0;color:#64748B">Versi</td><td>1.0.0</td></tr>
                        <tr><td style="padding:10px 0;color:#64748B">Framework</td><td>CodeIgniter 3</td></tr>
                        <tr><td style="padding:10px 0;color:#64748B">Database</td><td>MySQL / MariaDB</td></tr>
                        <tr><td style="padding:10px 0;color:#64748B">PHP Version</td><td><?= phpversion() ?></td></tr>
                        <tr><td style="padding:10px 0;color:#64748B">Base URL</td><td><?= base_url() ?></td></tr>
                        <tr><td style="padding:10px 0;color:#64748B">Environment</td><td><span class="badge badge-<?= ENVIRONMENT === 'production' ? 'verified' : 'dipinjam' ?>"><?= ENVIRONMENT ?></span></td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
