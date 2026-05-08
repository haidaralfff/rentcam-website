<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar">
            <span class="topbar-title"><i class="fas fa-user-shield" style="color:var(--primary);margin-right:8px;"></i>Manajemen Admin</span>
            <a href="<?= site_url('superadmin/admin/tambah') ?>" class="btn btn-primary btn-sm" style="padding:8px 16px; border-radius:10px; font-weight:600;">
                <i class="fas fa-plus-circle"></i> Tambah Admin
            </a>
        </div>
        <div class="page-content">
            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header"><span class="card-title">Daftar Admin (<?= count($admins) ?>)</span></div>
                <div class="table-wrap">
                    <table class="table">
                        <thead><tr><th>#</th><th>Nama</th><th>Email</th><th>Status</th><th>Bergabung</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <?php foreach ($admins as $i => $a): ?>
                            <tr>
                                <td><?= $i+1 ?></td>
                                <td>
                                    <div class="d-flex align-center gap-2">
                                        <div class="sidebar-avatar" style="width:32px;height:32px;font-size:12px;flex-shrink:0;background:#16A34A"><?= strtoupper(substr($a->nama,0,1)) ?></div>
                                        <strong><?= htmlspecialchars($a->nama) ?></strong>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($a->email) ?></td>
                                <td><span class="badge badge-<?= $a->status ? 'verified' : 'rejected' ?>"><?= $a->status ? 'Aktif' : 'Nonaktif' ?></span></td>
                                <td style="font-size:12px"><?= tgl_indo(date('Y-m-d',strtotime($a->created_at))) ?></td>
                                <td>
                                    <a href="<?= site_url('superadmin/admin/hapus/'.$a->id) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus admin ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
