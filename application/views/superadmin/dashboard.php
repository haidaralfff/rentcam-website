<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <?php
        $cu  = current_user();
        $jam = (int) date('H');
        if ($jam >= 5  && $jam < 12) $salam = 'Selamat Pagi';
        elseif ($jam >= 12 && $jam < 15) $salam = 'Selamat Siang';
        elseif ($jam >= 15 && $jam < 19) $salam = 'Selamat Sore';
        else $salam = 'Selamat Malam';
        ?>

        <div class="topbar">
            <span class="topbar-title"><i class="fas fa-th-large" style="color:var(--primary);margin-right:8px;"></i>Dashboard</span>
        </div>

        <div class="page-content">

            <!-- ── Greeting Banner ── -->
            <div class="greeting-banner page-header" style="margin-bottom:24px;">
                <div class="greeting-deco greeting-deco-1"></div>
                <div class="greeting-deco greeting-deco-2"></div>

                <div class="greeting-inner">
                    <div class="greeting-avatar">
                        <?= strtoupper(substr($cu['nama'], 0, 1)) ?>
                    </div>
                    <div class="greeting-text">
                        <p class="greeting-sub">
                            <i class="fas fa-sun"></i>
                            <?= $salam ?>, selamat datang kembali!
                        </p>
                        <h1 class="greeting-name"><?= htmlspecialchars($cu['nama']) ?></h1>
                        <div class="greeting-meta">
                            <span><i class="fas fa-shield-alt"></i> Super Admin</span>
                            <span><i class="fas fa-calendar-alt"></i> <?= date('l, d F Y') ?></span>
                            <span><i class="fas fa-clock"></i> <?= date('H:i') ?> WIB</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── Stats ── -->
            <div class="grid grid-4 mb-4">
                <div class="stat-card">
                    <div class="stat-icon blue"><i class="fas fa-money-bill-wave"></i></div>
                    <div class="stat-info">
                        <div class="stat-value" style="font-size:16px"><?= rupiah($summary['total_pendapatan']) ?></div>
                        <div class="stat-label">Total Pendapatan</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green"><i class="fas fa-calendar-check"></i></div>
                    <div class="stat-info">
                        <div class="stat-value"><?= $summary['total_booking'] ?></div>
                        <div class="stat-label">Total Booking</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon orange"><i class="fas fa-users"></i></div>
                    <div class="stat-info">
                        <div class="stat-value"><?= $summary['total_user'] ?></div>
                        <div class="stat-label">Total Member</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon red"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="stat-info">
                        <div class="stat-value"><?= $summary['pending_bayar'] ?></div>
                        <div class="stat-label">Pembayaran Pending</div>
                    </div>
                </div>
            </div>

            <!-- ── Charts ── -->
            <div class="chart-dashboard-grid">
                <div class="card">
                    <div class="card-header"><span class="card-title">Pendapatan Bulanan (<?= date('Y') ?>)</span></div>
                    <div class="card-body" style="height:160px;">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><span class="card-title">Transaksi per Status</span></div>
                    <div class="card-body" style="height:160px;">
                        <canvas id="bookingStatusChart"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><span class="card-title">Produk Terlaris</span></div>
                    <div class="card-body" style="height:160px;">
                        <canvas id="topProdukChart"></canvas>
                    </div>
                </div>
            </div>

        </div><!-- /.page-content -->
    </div><!-- /.main-content -->
</div><!-- /.layout-wrapper -->



<script>
const bulanLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
const bookingStatusRaw = <?= json_encode($booking_status) ?>;
const produkRaw        = <?= json_encode($produk_terlaris) ?>;
const rawData          = <?= json_encode($pendapatan_bulanan) ?>;

const chartData = new Array(12).fill(0);
rawData.forEach(item => { chartData[item.bulan - 1] = parseInt(item.total); });

const statusLabels = ['pending','confirmed','dipinjam','kembali','batal'];
const statusMap    = new Map(bookingStatusRaw.map(i => [i.status, parseInt(i.total)]));
const statusData   = statusLabels.map(s => statusMap.get(s) || 0);

const produkLabels = produkRaw.map(i => i.nama);
const produkData   = produkRaw.map(i => parseInt(i.total_sewa));

// Revenue Chart
new Chart(document.getElementById('revenueChart'), {
    type: 'bar',
    data: {
        labels: bulanLabels,
        datasets: [{
            label: 'Pendapatan (Rp)',
            data: chartData,
            backgroundColor: 'rgba(37,99,235,0.15)',
            borderColor: '#2563EB',
            borderWidth: 2,
            borderRadius: 8,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { ticks: { callback: v => 'Rp ' + (v/1000000).toFixed(0) + 'jt', font: { size: 10 } }, grid: { color: '#F1F5F9' } },
            x: { grid: { display: false }, ticks: { font: { size: 10 } } }
        }
    }
});

// Status Doughnut
new Chart(document.getElementById('bookingStatusChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pending','Confirmed','Dipinjam','Kembali','Batal'],
        datasets: [{
            data: statusData,
            backgroundColor: ['#FDE047','#22C55E','#3B82F6','#8B5CF6','#EF4444'],
            borderWidth: 0,
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } } },
        layout: { padding: { top: 8, bottom: 8 } }
    }
});

// Top Products
new Chart(document.getElementById('topProdukChart'), {
    type: 'bar',
    data: {
        labels: produkLabels,
        datasets: [{
            data: produkData,
            backgroundColor: 'rgba(37,99,235,0.2)',
            borderColor: '#2563EB',
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
