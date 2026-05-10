<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<div style="max-width:900px; margin:20px auto 60px; padding:0 16px">
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px">
        <div>
            <h1 style="font-size:24px; font-weight:800; margin-bottom: 4px;">Riwayat Booking</h1>
            <p style="font-size:14px; color:#64748B">Semua transaksi sewa Anda</p>
        </div>
        <a href="<?= site_url('produk') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Sewa Baru</a>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success"><i class="fas fa-check-circle"></i> <?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <?php if (empty($bookings)): ?>
    <div style="text-align:center; padding:100px 20px; background: #fff; border-radius: 24px; border: 1px solid rgba(15, 23, 42, 0.05); box-shadow: var(--shadow); margin-top: 20px;" data-aos="zoom-in">
        <div style="width:100px; height:100px; border-radius:50%; background:rgba(37, 99, 235, 0.08); display:flex; align-items:center; justify-content:center; margin:0 auto 28px; color:#2563EB; font-size:42px; box-shadow: 0 10px 20px rgba(37, 99, 235, 0.1);">
            <i class="fas fa-calendar-alt"></i>
        </div>
        <h3 style="font-size:24px; font-weight:800; color:#0F172A; margin-bottom:12px; letter-spacing:-0.5px">Belum Ada Transaksi</h3>
        <p style="color:#64748B; max-width:440px; margin:0 auto 36px; line-height:1.7; font-size:15px">Sepertinya Anda belum melakukan penyewaan alat. Temukan kamera atau drone impian Anda di katalog dan mulai abadikan momen spesial Anda!</p>
        <a href="<?= site_url('produk') ?>" class="btn btn-primary btn-lg">
            <i class="fas fa-camera"></i> Mulai Sewa Sekarang
        </a>
    </div>
    <?php else: ?>

    <div style="display:flex; flex-direction:column; gap:16px">
        <?php foreach ($bookings as $b): ?>
        <div class="card" style="padding:0" data-aos="fade-up">
            <div style="padding:20px; display:flex; align-items:center; gap:16px; flex-wrap:wrap">
                <div style="width:48px; height:48px; border-radius:12px; background:#EFF6FF; display:flex; align-items:center; justify-content:center; color:#2563EB; font-size:22px; flex-shrink:0">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div style="flex:1; min-width:200px">
                    <div style="font-size:14px; font-weight:700; margin-bottom: 2px;">Booking #<?= $b->id ?> — <span style="color:#2563EB"><?= $b->nama_produk ?></span></div>
                    <div style="font-size:12px; color:#64748B"><?= tgl_indo($b->tanggal_mulai) ?> — <?= tgl_indo($b->tanggal_selesai) ?></div>
                </div>
                <div style="text-align:right; min-width: 100px;">
                    <div style="font-size:18px; font-weight:800; color:#2563EB"><?= rupiah($b->total_harga) ?></div>
                    <div style="font-size:11px; color:#64748B">Total Harga</div>
                </div>
                <div style="display:flex; align-items:center; gap:8px; width:100%; padding-top:12px; border-top:1px solid #F1F5F9; margin-top:4px">
                    <span class="badge badge-<?= $b->status ?>"><?= ucfirst($b->status) ?></span>
                    <?php if ($b->status_bayar): ?>
                        <span class="badge badge-<?= $b->status_bayar ?>">Bayar: <?= ucfirst($b->status_bayar) ?></span>
                    <?php endif; ?>
                    
                    <div style="margin-left:auto; display:flex; gap:8px">
                        <?php if ($b->status === 'kembali'): ?>
                            <?php if (!empty($b->review_id)): ?>
                            <a href="<?= site_url('produk/detail/'.$b->produk_id) ?>" class="btn btn-outline btn-sm">
                                <i class="fas fa-check-circle"></i> Sudah Diulas
                            </a>
                            <?php else: ?>
                            <a href="<?= site_url('review/form/'.$b->id) ?>" class="btn btn-primary btn-sm">
                                <i class="fas fa-star"></i> Review
                            </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($b->status === 'pending' && (!$b->status_bayar || $b->status_bayar === 'rejected')): ?>
                        <a href="<?= site_url('pembayaran/upload/'.$b->id) ?>" class="btn btn-accent btn-sm">
                            <i class="fas fa-upload"></i> Bayar
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($b->status === 'pending' && !empty($b->deadline_bayar)): ?>
                <div style="width:100%; font-size:11px; color:#EF4444; margin-top: -8px;">
                    <i class="fas fa-clock"></i> Batas bayar: <?= date('d/m/Y H:i', strtotime($b->deadline_bayar)) ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer'); ?>
