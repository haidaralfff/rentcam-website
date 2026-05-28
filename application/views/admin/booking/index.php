<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar"><span class="topbar-title"><i class="fas fa-calendar-alt" style="color:var(--primary);margin-right:8px;"></i>Manajemen Booking</span></div>
        <div class="page-content">
            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header"><span class="card-title">Daftar Booking (<?= count($bookings) ?>)</span></div>
                <div class="table-wrap">
                    <table class="table">
                        <thead>
                            <tr><th>#</th><th>Member</th><th>Mulai</th><th>Selesai</th><th>Total</th><th>Status</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            <?php if (empty($bookings)): ?>
                            <tr><td colspan="7" class="text-center text-muted" style="padding:36px">Belum ada booking</td></tr>
                            <?php else: ?>
                            <?php foreach ($bookings as $i => $b): ?>
                            <tr>
                                <td><?= $i+1 ?></td>
                                <td><strong><?= htmlspecialchars($b->nama_user) ?></strong></td>
                                <td style="font-size:12px"><?= tgl_indo($b->tanggal_mulai) ?></td>
                                <td style="font-size:12px"><?= tgl_indo($b->tanggal_selesai) ?></td>
                                <td class="fw-semibold"><?= rupiah($b->total_harga) ?></td>
                                <td><span class="badge badge-<?= $b->status ?>"><?= ucfirst($b->status) ?></span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?= site_url('admin/booking/detail/'.$b->id) ?>" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i> Detail</a>
                                        <a href="<?= site_url('admin/booking/hapus/'.$b->id) ?>" class="btn btn-danger btn-sm btn-delete-booking" data-id="<?= $b->id ?>"><i class="fas fa-trash"></i> Hapus</a>
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
document.querySelectorAll('.btn-delete-booking').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');
        const id = this.getAttribute('data-id');
        
        Swal.fire({
            title: 'Hapus Booking?',
            text: `Apakah Anda yakin ingin menghapus booking #${id} beserta seluruh riwayat terkait (pembayaran, ulasan, dll)?`,
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
