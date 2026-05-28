<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar"><span class="topbar-title"><i class="fas fa-users" style="color:var(--primary);margin-right:8px;"></i>Manajemen User</span></div>
        <div class="page-content">
            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header"><span class="card-title">Daftar User (<?= count($users) ?>)</span></div>
                <div class="table-wrap">
                    <table class="table">
                        <thead>
                            <tr><th>#</th><th>Nama</th><th>Email</th><th>Role</th><th>Status</th><th>Bergabung</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $i => $u): ?>
                            <?php
                                $role = normalize_role($u->role);
                                $role_label = $role === 'superadmin' ? 'Super Admin' : ucfirst($role);
                            ?>
                            <tr>
                                <td><?= $i+1 ?></td>
                                <td>
                                    <div class="d-flex align-center gap-2">
                                        <div class="sidebar-avatar" style="width:32px;height:32px;font-size:12px;flex-shrink:0"><?= strtoupper(substr($u->nama,0,1)) ?></div>
                                        <strong><?= htmlspecialchars($u->nama) ?></strong>
                                    </div>
                                </td>
                                <td style="font-size:13px"><?= htmlspecialchars($u->email) ?></td>
                                <td><span class="badge badge-<?= $role === 'user' ? 'dipinjam' : ($role === 'admin' ? 'confirmed' : 'kembali') ?>"><?= $role_label ?></span></td>
                                <td>
                                    <?php if ($u->status): ?>
                                    <span class="badge badge-verified">Aktif</span>
                                    <?php else: ?>
                                    <span class="badge badge-rejected">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td style="font-size:12px"><?= tgl_indo(date('Y-m-d', strtotime($u->created_at))) ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?= site_url('superadmin/user/edit/'.$u->id) ?>" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="<?= site_url('superadmin/user/toggle_status/'.$u->id) ?>" class="btn btn-sm <?= $u->status ? 'btn-danger' : 'btn-success' ?> btn-toggle-status" data-nama="<?= htmlspecialchars($u->nama) ?>" data-status="<?= $u->status ? 'Nonaktifkan' : 'Aktifkan' ?>">
                                            <i class="fas fa-<?= $u->status ? 'ban' : 'check' ?>"></i>
                                        </a>
                                        <a href="<?= site_url('superadmin/user/hapus/'.$u->id) ?>" class="btn btn-danger btn-sm btn-delete-user" data-nama="<?= htmlspecialchars($u->nama) ?>">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
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

<script>
document.querySelectorAll('.btn-delete-user').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');
        const nama = this.getAttribute('data-nama');
        
        Swal.fire({
            title: 'Hapus User?',
            text: `Apakah Anda yakin ingin menghapus user "${nama}" secara permanen?`,
            icon: 'warning',
            iconColor: '#EF4444',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'swal2-premium-popup',
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-outline'
            },
            buttonsStyling: false,
            backdrop: `rgba(15, 23, 42, 0.5) blur(4px)`
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });
});

document.querySelectorAll('.btn-toggle-status').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');
        const nama = this.getAttribute('data-nama');
        const status = this.getAttribute('data-status');
        
        Swal.fire({
            title: 'Ubah Status User?',
            text: `Apakah Anda yakin ingin ${status.toLowerCase()} user "${nama}"?`,
            icon: 'question',
            iconColor: '#3B82F6',
            showCancelButton: true,
            confirmButtonText: `Ya, ${status}`,
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'swal2-premium-popup',
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-outline'
            },
            buttonsStyling: false,
            backdrop: `rgba(15, 23, 42, 0.5) blur(4px)`
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });
});
</script>

<?php $this->load->view('templates/footer'); ?>
