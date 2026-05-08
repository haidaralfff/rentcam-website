<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="d-flex align-center gap-2">
                <button id="sidebar-toggle" style="background:none;border:none;cursor:pointer;font-size:18px;color:#64748B;display:none" class="sidebar-toggle-btn">
                    <i class="fas fa-bars"></i>
                </button>
                <span class="topbar-title"><?= isset($title) ? htmlspecialchars($title) : 'Dashboard' ?></span>
            </div>
            <div class="topbar-actions">
                <a href="<?= site_url('admin/pembayaran') ?>" class="topbar-badge" title="Verifikasi Pembayaran">
                    <i class="fas fa-bell"></i>
                    <?php if (!empty($summary['pending_bayar'])): ?>
                    <span style="position:absolute;top:2px;right:2px;width:8px;height:8px;background:#EF4444;border-radius:50%;border:2px solid #fff"></span>
                    <?php endif; ?>
                </a>
                <a href="<?= site_url('admin/booking') ?>" class="topbar-badge" title="Manajemen Booking">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div class="page-content">
            <!-- Flash Messages -->
            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">Dashboard Admin</h1>
                <p class="page-subtitle">Selamat datang, <?= htmlspecialchars($this->session->userdata('nama')) ?>!</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-4 mb-4">
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="fas fa-calendar-check"></i></div>
                    <div class="stat-info">
                        <div class="stat-value"><?= $summary['total_booking'] ?></div>
                        <div class="stat-label">Total Booking</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-users"></i></div>
                    <div class="stat-info">
                        <div class="stat-value"><?= $summary['total_user'] ?></div>
                        <div class="stat-label">Total Member</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon orange"><i class="fas fa-box-open"></i></div>
                    <div class="stat-info">
                        <div class="stat-value"><?= $summary['total_produk'] ?></div>
                        <div class="stat-label">Produk Aktif</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-money-bill-wave"></i></div>
                    <div class="stat-info">
                        <div class="stat-value" style="font-size:17px"><?= rupiah($summary['total_pendapatan']) ?></div>
                        <div class="stat-label">Total Pendapatan</div>
                    </div>
                </div>
            </div>

            <!-- Alert Pending -->
            <?php if ($summary['pending_bayar'] > 0): ?>
            <div class="alert alert-warning mb-4">
                <i class="fas fa-exclamation-triangle"></i>
                Ada <strong><?= $summary['pending_bayar'] ?></strong> pembayaran menunggu verifikasi.
                <a href="<?= site_url('admin/pembayaran') ?>" style="font-weight:700;margin-left:8px">Verifikasi Sekarang →</a>
            </div>
            <?php endif; ?>

            <!-- Charts -->
            <div class="grid grid-3 mb-4">
                <div class="card">
                    <div class="card-header"><span class="card-title">Booking 14 Hari Terakhir</span></div>
                    <div class="card-body" style="height: 180px;"><canvas id="bookingChart"></canvas></div>
                </div>
                <div class="card">
                    <div class="card-header"><span class="card-title">Pembayaran per Status</span></div>
                    <div class="card-body" style="height: 180px;"><canvas id="paymentChart"></canvas></div>
                </div>
                <div class="card">
                    <div class="card-header"><span class="card-title">Stok Rendah</span></div>
                    <div class="card-body" style="height: 180px;"><canvas id="stockChart"></canvas></div>
                </div>
            </div>

            <!-- Recent Bookings & Top Products -->
            <div class="grid grid-2">
                <!-- Recent Bookings -->
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Booking Terbaru</span>
                        <a href="<?= site_url('admin/booking') ?>" class="btn btn-outline btn-sm">Lihat Semua</a>
                    </div>
                    <div class="table-wrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Member</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($recent_bookings)): ?>
                                <tr><td colspan="4" class="text-center text-muted" style="padding:24px">Belum ada booking</td></tr>
                                <?php else: ?>
                                <?php foreach ($recent_bookings as $b): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($b->nama_user) ?></strong></td>
                                    <td style="font-size:12px"><?= tgl_indo($b->tanggal_mulai) ?></td>
                                    <td><?= rupiah($b->total_harga) ?></td>
                                    <td><span class="badge badge-<?= $b->status ?>"><?= ucfirst($b->status) ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Top Products -->
                <div class="card">
                    <div class="card-header">
                        <span class="card-title">Produk Terlaris</span>
                    </div>
                    <div class="card-body" style="padding:0">
                        <?php if (empty($produk_terlaris)): ?>
                        <p class="text-center text-muted" style="padding:24px">Belum ada data</p>
                        <?php else: ?>
                        <?php foreach ($produk_terlaris as $i => $p): ?>
                        <div style="display:flex;align-items:center;gap:14px;padding:14px 20px;border-bottom:1px solid #E2E8F0">
                            <div style="width:28px;height:28px;border-radius:50%;background:<?= ['#EFF6FF','#F0FDF4','#FFF7ED','#FEF2F2','#E0E7FF'][$i%5] ?>;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;color:#374151">
                                <?= $i+1 ?>
                            </div>
                            <div style="flex:1">
                                <div style="font-size:13px;font-weight:600"><?= htmlspecialchars($p->nama) ?></div>
                                <div style="font-size:11px;color:#64748B"><?= ucfirst($p->kategori) ?></div>
                            </div>
                            <div style="font-size:13px;font-weight:700;color:#2563EB"><?= $p->total_sewa ?>x</div>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const bookingRaw = <?= json_encode($booking_harian) ?>;
const paymentRaw = <?= json_encode($pembayaran_status) ?>;
const stockRaw   = <?= json_encode($stok_rendah) ?>;

const bookingMap = new Map(bookingRaw.map(i => [i.tanggal, parseInt(i.total)]));
const bookingLabels = [];
const bookingData = [];
for (let i = 13; i >= 0; i--) {
    const d = new Date();
    d.setDate(d.getDate() - i);
    const key = d.toISOString().slice(0, 10);
    bookingLabels.push(d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' }));
    bookingData.push(bookingMap.get(key) || 0);
}

const paymentLabels = ['pending', 'verified', 'rejected'];
const paymentMap = new Map(paymentRaw.map(i => [i.status, parseInt(i.total)]));
const paymentData = paymentLabels.map(s => paymentMap.get(s) || 0);

const stockLabels = stockRaw.map(i => i.nama);
const stockData = stockRaw.map(i => parseInt(i.stok));

new Chart(document.getElementById('bookingChart'), {
    type: 'line',
    data: {
        labels: bookingLabels,
        datasets: [{
            data: bookingData,
            borderColor: '#2563EB',
            backgroundColor: 'rgba(37,99,235,0.15)',
            fill: true,
            tension: 0.35,
            pointRadius: 2,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#F1F5F9' } },
            x: { grid: { display: false }, ticks: { font: { size: 10 } } }
        }
    }
});

new Chart(document.getElementById('paymentChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Verified', 'Rejected'],
        datasets: [{
            data: paymentData,
            backgroundColor: ['#FDE047', '#22C55E', '#EF4444'],
            borderWidth: 0,
        }]
    },
    options: { 
        responsive: true, 
        maintainAspectRatio: false,
        plugins: { 
            legend: { 
                position: 'bottom',
                labels: { boxWidth: 10, font: { size: 10 } }
            } 
        },
        layout: { padding: { top: 5, bottom: 5 } }
    }
});

new Chart(document.getElementById('stockChart'), {
    type: 'bar',
    data: {
        labels: stockLabels,
        datasets: [{
            data: stockData,
            backgroundColor: 'rgba(249,115,22,0.2)',
            borderColor: '#F97316',
            borderWidth: 2,
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: '#F1F5F9' } },
            x: { grid: { display: false }, ticks: { font: { size: 10 } } }
        }
    }
});
</script>
<?php $this->load->view('templates/footer'); ?>
