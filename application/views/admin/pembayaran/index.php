<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar">
            <span class="topbar-title"><i class="fas fa-credit-card" style="color:var(--primary);margin-right:8px;"></i>Verifikasi Pembayaran</span>
        </div>
        <div class="page-content">
            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <span class="card-title">Daftar Pembayaran</span>
                    <div class="d-flex gap-2">
                        <span class="badge badge-pending">Pending: <?= count(array_filter((array)$payments, fn($p) => $p->status === 'pending')) ?></span>
                    </div>
                </div>
                <div class="table-wrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Member</th>
                                <th>Total Harga</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($payments)): ?>
                            <tr><td colspan="7" class="text-center text-muted" style="padding:36px">Belum ada data pembayaran</td></tr>
                            <?php else: ?>
                            <?php foreach ($payments as $i => $p): ?>
                            <tr>
                                <td><?= $i+1 ?></td>
                                <td>
                                    <strong><?= htmlspecialchars($p->nama_user) ?></strong>
                                    <div style="font-size:11px;color:#64748B">Booking #<?= $p->booking_id ?></div>
                                </td>
                                <td class="fw-semibold"><?= rupiah($p->total_harga) ?></td>
                                <td><?= ucfirst($p->metode) ?></td>
                                <td><span class="badge badge-<?= $p->status ?>"><?= ucfirst($p->status) ?></span></td>
                                <td style="font-size:12px"><?= tgl_indo(date('Y-m-d', strtotime($p->created_at))) ?></td>
                                <td>
                                    <a href="<?= site_url('admin/pembayaran/detail/'.$p->id) ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-eye"></i> Review
                                    </a>
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
<?php $this->load->view('templates/footer'); ?>
