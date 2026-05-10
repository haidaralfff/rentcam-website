<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar">
            <div class="d-flex align-center gap-2">
                <a href="<?= site_url('superadmin/laporan') ?>" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i></a>
                <span class="topbar-title">Detail Transaksi #<?= $booking->id ?></span>
            </div>
        </div>
        <div class="page-content">
            <div class="grid grid-2 gap-4">
                <div class="card">
                    <div class="card-header"><span class="card-title">Informasi Penyewa & Identitas</span></div>
                    <div class="card-body">
                        <table class="table-info">
                            <tr><td>Nama</td><td>: <strong><?= htmlspecialchars($booking->nama_user) ?></strong></td></tr>
                            <tr><td>Email</td><td>: <?= htmlspecialchars($booking->email) ?></td></tr>
                            <tr><td>Telepon</td><td>: <?= htmlspecialchars($booking->phone) ?></td></tr>
                            <tr><td>Alamat</td><td>: <?= htmlspecialchars($booking->alamat) ?></td></tr>
                            <tr><td>Tgl Booking</td><td>: <?= tgl_indo(date('Y-m-d', strtotime($booking->created_at))) ?></td></tr>
                        </table>
                        
                        <?php if ($booking->ktp): ?>
                        <div style="margin-top:16px;padding-top:16px;border-top:1px solid #F1F5F9">
                            <p style="font-size:12px;color:#64748B;font-weight:700;margin-bottom:8px">KTP / Identitas Penyewa:</p>
                            <img src="<?= base_url('assets/uploads/identitas/'.$booking->ktp) ?>" 
                                 style="max-width:100%;max-height:150px;border-radius:8px;border:1px solid #E2E8F0;cursor:pointer"
                                 onclick="window.open(this.src,'_blank')">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><span class="card-title">Status & Bukti</span></div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-3">
                            <span class="badge badge-<?= $booking->status ?>" style="width:fit-content;padding:8px 16px;font-size:14px">
                                Status: <?= strtoupper($booking->status) ?>
                            </span>
                            
                            <div style="display:flex;gap:12px">
                                <!-- Bukti Bayar -->
                                <?php if (isset($pembayaran) && $pembayaran->bukti_bayar): ?>
                                <div style="flex:1">
                                    <p style="font-size:11px;color:#64748B;font-weight:700;margin-bottom:4px">Bukti Pembayaran:</p>
                                    <img src="<?= base_url('assets/uploads/bukti/'.$pembayaran->bukti_bayar) ?>" 
                                         style="width:100%;height:100px;object-fit:cover;border-radius:6px;border:1px solid #E2E8F0;cursor:pointer"
                                         onclick="window.open(this.src,'_blank')">
                                </div>
                                <?php endif; ?>

                                <!-- Bukti Handover -->
                                <?php if ($booking->foto_penerima): ?>
                                <div style="flex:1">
                                    <p style="font-size:11px;color:#64748B;font-weight:700;margin-bottom:4px">Bukti Penerima:</p>
                                    <img src="<?= base_url('assets/uploads/penerima/'.$booking->foto_penerima) ?>" 
                                         style="width:100%;height:100px;object-fit:cover;border-radius:6px;border:1px solid #E2E8F0;cursor:pointer"
                                         onclick="window.open(this.src,'_blank')">
                                </div>
                                <?php endif; ?>
                            </div>

                            <p style="font-size:12px;color:#64748B">Periode: <?= tgl_indo($booking->tanggal_mulai) ?> s/d <?= tgl_indo($booking->tanggal_selesai) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header"><span class="card-title">Rincian Produk</span></div>
                <div class="table-wrap">
                    <table class="table">
                        <thead><tr><th>Produk</th><th>Harga Satuan</th><th>Qty</th><th>Durasi</th><th>Subtotal</th></tr></thead>
                        <tbody>
                            <?php 
                            $durasi = hitung_durasi($booking->tanggal_mulai, $booking->tanggal_selesai);
                            foreach ($detail as $item): 
                            ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($item->nama_produk) ?></strong></td>
                                <td><?= rupiah($item->harga_satuan) ?></td>
                                <td><?= $item->qty ?> unit</td>
                                <td><?= $durasi ?> hari</td>
                                <td><strong><?= rupiah($item->harga_satuan * $item->qty * $durasi) ?></strong></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" style="text-align:right"><strong>Total Pendapatan:</strong></td>
                                <td style="font-size:18px;color:#2563EB"><strong><?= rupiah($booking->total_harga) ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('templates/footer'); ?>
