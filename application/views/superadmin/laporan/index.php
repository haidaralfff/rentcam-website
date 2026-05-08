<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar"><span class="topbar-title"><i class="fas fa-file-alt" style="color:var(--primary);margin-right:8px;"></i>Laporan Keuangan</span></div>
        <div class="page-content">
            <div class="card mb-4">
                <div class="card-header">
                    <span class="card-title">Pendapatan Tahun <?= $tahun ?></span>
                    <?= form_open('superadmin/laporan', 'method="get"') ?>
                    <div class="d-flex gap-2">
                        <select name="tahun" class="form-control form-select" style="width:120px">
                            <?php for ($y = date('Y'); $y >= date('Y')-3; $y--): ?>
                            <option value="<?= $y ?>" <?= $tahun == $y ? 'selected' : '' ?>><?= $y ?></option>
                            <?php endfor; ?>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i></button>
                    </div>
                    <?= form_close() ?>
                </div>
                <div class="card-body">
                    <div class="d-flex align-center gap-3 mb-4">
                        <div class="stat-card" style="flex:1">
                            <div class="stat-icon green"><i class="fas fa-money-bill-wave"></i></div>
                            <div class="stat-info">
                                <div class="stat-value" style="font-size:18px"><?= rupiah($total_pendapatan) ?></div>
                                <div class="stat-label">Total Pendapatan Keseluruhan</div>
                            </div>
                        </div>
                    </div>
                    <canvas id="lapChart" height="120"></canvas>
                </div>
            </div>

            <div class="card">
                <div class="card-header"><span class="card-title">Produk Terlaris</span></div>
                <div class="table-wrap">
                    <table class="table">
                        <thead><tr><th>Rank</th><th>Produk</th><th>Kategori</th><th>Total Disewa</th></tr></thead>
                        <tbody>
                            <?php foreach ($produk_terlaris as $i => $p): ?>
                            <tr>
                                <td><strong style="color:#2563EB">#<?= $i+1 ?></strong></td>
                                <td><?= htmlspecialchars($p->nama) ?></td>
                                <td><?= ucfirst($p->kategori) ?></td>
                                <td><strong><?= $p->total_sewa ?>x</strong></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header"><span class="card-title">Riwayat Semua Transaksi</span></div>
                <div class="table-wrap">
                    <table class="table">
                        <thead><tr><th>ID</th><th>User</th><th>Periode</th><th>Total</th><th>Status</th><th>Aksi</th></tr></thead>
                        <tbody>
                            <?php foreach ($all_bookings as $b): ?>
                            <tr>
                                <td>#<?= $b->id ?></td>
                                <td><strong><?= htmlspecialchars($b->nama_user) ?></strong></td>
                                <td style="font-size:12px"><?= tgl_indo($b->tanggal_mulai) ?> - <?= tgl_indo($b->tanggal_selesai) ?></td>
                                <td><strong><?= rupiah($b->total_harga) ?></strong></td>
                                <td><span class="badge badge-<?= $b->status ?>"><?= ucfirst($b->status) ?></span></td>
                                <td><a href="<?= site_url('superadmin/laporan/detail/'.$b->id) ?>" class="btn btn-outline btn-sm">Detail</a></td>
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
const bulanLabels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
const rawData = <?= json_encode($pendapatan_bulanan) ?>;
const chartData = new Array(12).fill(0);
rawData.forEach(item => { chartData[item.bulan - 1] = parseInt(item.total); });

new Chart(document.getElementById('lapChart'), {
    type: 'line',
    data: {
        labels: bulanLabels,
        datasets: [{
            label: 'Pendapatan',
            data: chartData,
            borderColor: '#2563EB',
            backgroundColor: 'rgba(37,99,235,0.08)',
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#2563EB',
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { ticks: { callback: v => 'Rp ' + (v/1000).toFixed(0) + 'rb', font: { size: 11 } }, grid: { color: '#F1F5F9' } },
            x: { grid: { display: false }, ticks: { font: { size: 11 } } }
        }
    }
});
</script>
<?php $this->load->view('templates/footer'); ?>
