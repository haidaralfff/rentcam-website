<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar">
            <span class="topbar-title"><i class="fas fa-boxes" style="color:var(--primary);margin-right:8px;"></i>Manajemen Produk</span>
            <a href="<?= site_url('admin/produk/tambah') ?>" class="btn btn-primary btn-sm" style="padding:8px 16px; border-radius:10px; font-weight:600;">
                <i class="fas fa-plus-circle"></i> Tambah Produk
            </a>
        </div>
        <div class="page-content">
            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <span class="card-title">Daftar Produk (<?= count($produk) ?>)</span>
                </div>
                <div class="table-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga/Hari</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($produk)): ?>
                            <tr><td colspan="8" class="text-center text-muted" style="padding:36px">Belum ada produk. <a href="<?= site_url('admin/produk/tambah') ?>">Tambah sekarang</a></td></tr>
                            <?php else: ?>
                            <?php foreach ($produk as $i => $p): ?>
                            <tr>
                                <td><?= $i+1 ?></td>
                                <td>
                                    <?php if ($p->foto): ?>
                                    <img src="<?= base_url('assets/uploads/produk/'.$p->foto) ?>" alt="" style="width:44px;height:44px;object-fit:cover;border-radius:8px">
                                    <?php else: ?>
                                    <div style="width:44px;height:44px;background:#EFF6FF;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#2563EB;font-size:18px">
                                        <i class="fas fa-<?= $p->kategori === 'drone' ? 'helicopter' : 'camera' ?>"></i>
                                    </div>
                                    <?php endif; ?>
                                </td>
                                <td><strong><?= htmlspecialchars($p->nama) ?></strong></td>
                                <td><span class="badge badge-<?= $p->status === 'tersedia' ? 'confirmed' : 'batal' ?>"><?= ucfirst($p->kategori) ?></span></td>
                                <td class="fw-semibold"><?= rupiah($p->harga_per_hari) ?></td>
                                <td>
                                    <span style="font-weight:700;color:<?= $p->stok > 0 ? '#22C55E' : '#EF4444' ?>"><?= $p->stok ?></span>
                                </td>
                                <td><span class="badge badge-<?= $p->status ?>"><?= $p->status === 'tersedia' ? 'Tersedia' : 'Tidak Tersedia' ?></span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?= site_url('admin/produk/edit/'.$p->id) ?>" class="btn btn-outline btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="<?= site_url('admin/produk/hapus/'.$p->id) ?>" class="btn btn-danger btn-sm btn-delete-produk" data-nama="<?= htmlspecialchars($p->nama) ?>"><i class="fas fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.querySelectorAll('.btn-delete-produk').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');
        const nama = this.getAttribute('data-nama');
        
        Swal.fire({
            title: 'Hapus Produk?',
            text: `Apakah Anda yakin ingin menghapus produk "${nama}"?`,
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
</script>
<?php $this->load->view('templates/footer'); ?>
