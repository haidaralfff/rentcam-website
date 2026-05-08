<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar">
            <span class="topbar-title">Dashboard Super Admin</span>
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1 class="page-title">Laporan & Overview</h1>
                <p class="page-subtitle">Pantau performa sistem RENTCAM secara keseluruhan</p>
            </div>

            <!-- Stats -->
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

            <!-- Charts -->
            <div class="grid grid-2">
                <div class="card">
                    <div class="card-header"><span class="card-title">Pendapatan Bulanan (<?= date('Y') ?>)</span></div>
                    <div class="card-body" style="height: 220px;">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><span class="card-title">Transaksi per Status</span></div>
                    <div class="card-body" style="height: 220px;">
                        <canvas id="bookingStatusChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="grid grid-2" style="margin-top:24px">
                <div class="card">
                    <div class="card-header"><span class="card-title">Produk Terlaris</span></div>
                    <div class="card-body" style="height: 220px;">
                        <canvas id="topProdukChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const ctx = document.getElementById('revenueChart');
const bulanLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];

const bookingStatusRaw = <?= json_encode($booking_status) ?>;
const produkRaw = <?= json_encode($produk_terlaris) ?>;

// Prepare data from PHP
const rawData = <?= json_encode($pendapatan_bulanan) ?>;
const chartData = new Array(12).fill(0);
rawData.forEach(item => { chartData[item.bulan - 1] = parseInt(item.total); });

const statusLabels = ['pending', 'confirmed', 'dipinjam', 'kembali', 'batal'];
const statusMap = new Map(bookingStatusRaw.map(i => [i.status, parseInt(i.total)]));
const statusData = statusLabels.map(s => statusMap.get(s) || 0);

const produkLabels = produkRaw.map(i => i.nama);
const produkData = produkRaw.map(i => parseInt(i.total_sewa));

new Chart(ctx, {
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
            y: {
                ticks: {
                    callback: v => 'Rp ' + (v/1000000).toFixed(0) + 'jt',
                    font: { size: 11 }
                },
                grid: { color: '#F1F5F9' }
            },
            x: { grid: { display: false }, ticks: { font: { size: 11 } } }
        }
    }
});

new Chart(document.getElementById('bookingStatusChart'), {
    type: 'doughnut',
    data: {
        labels: ['Pending', 'Confirmed', 'Dipinjam', 'Kembali', 'Batal'],
        datasets: [{
            data: statusData,
            backgroundColor: ['#FDE047', '#22C55E', '#3B82F6', '#8B5CF6', '#EF4444'],
            borderWidth: 0,
        }]
    },
    options: { 
        responsive: true, 
        maintainAspectRatio: false,
        plugins: { 
            legend: { 
                position: 'bottom',
                labels: { boxWidth: 12, font: { size: 11 } }
            } 
        },
        layout: { padding: { top: 10, bottom: 10 } }
    }
});

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
