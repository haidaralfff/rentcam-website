<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<div style="background: #F8FAFC; min-height: 100vh; padding: 24px 0;">
    <div style="max-width:1000px; margin:0 auto; padding:0 20px">
        <!-- Breadcrumb -->
        <nav style="margin-bottom: 24px;" data-aos="fade-right">
            <a href="<?= site_url('produk') ?>" style="display:inline-flex; align-items:center; gap:8px; font-size:13px; font-weight:600; color:#64748B; text-decoration:none; transition:color 0.3s;" onmouseover="this.style.color='#2563EB'" onmouseout="this.style.color='#64748B'">
                <i class="fas fa-chevron-left" style="font-size: 9px;"></i> Kembali ke Katalog
            </a>
        </nav>

        <!-- Product Grid -->
        <div class="product-detail-grid">
            <!-- Left: Product Image -->
            <div data-aos="fade-up">
                <div class="card" style="border-radius:20px; overflow:hidden; border:none; box-shadow: 0 12px 30px rgba(0,0,0,0.08);">
                    <?php if ($produk->foto): ?>
                        <img src="<?= base_url('assets/uploads/produk/'.$produk->foto) ?>" alt="<?= htmlspecialchars($produk->nama) ?>" style="width:100%; aspect-ratio:1/1; object-fit:cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <?php else: ?>
                        <div style="aspect-ratio:1/1; background:linear-gradient(135deg,#EFF6FF,#DBEAFE); display:flex; align-items:center; justify-content:center; font-size:80px; color:#93C5FD">
                            <i class="fas fa-<?= $produk->kategori === 'drone' ? 'helicopter' : 'camera' ?>"></i>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Product Info -->
            <div data-aos="fade-left">
                <div style="display:inline-block; padding:4px 12px; border-radius:100px; background:rgba(37, 99, 235, 0.1); color:#2563EB; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px;">
                    <i class="fas fa-tag"></i> <?= $produk->kategori ?>
                </div>
                
                <h1 style="font-family:'Poppins', sans-serif; font-size:26px; font-weight:800; color:#0F172A; margin-bottom:16px; line-height:1.2;"><?= htmlspecialchars($produk->nama) ?></h1>

                <div style="display:flex; align-items:baseline; gap:6px; margin-bottom:24px;">
                    <span style="font-size:28px; font-weight:800; color:#2563EB; font-family:'Poppins', sans-serif;"><?= rupiah($produk->harga_per_hari) ?></span>
                    <span style="font-size:14px; color:#64748B;">/ hari</span>
                </div>

                <!-- Specifications Card -->
                <div style="background:#fff; border-radius:16px; padding:20px; border:1px solid #E2E8F0; margin-bottom:24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03);">
                    <h4 style="font-family:'Poppins', sans-serif; font-size:12px; font-weight:800; color:#0F172A; text-transform:uppercase; letter-spacing:1px; margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <i class="fas fa-list-ul" style="color:#2563EB"></i> Spesifikasi Utama
                    </h4>
                    <div style="display:grid; gap:8px;">
                        <?php 
                        $specs = explode("\n", $produk->spesifikasi);
                        foreach($specs as $spec): 
                            if(trim($spec) == "") continue;
                        ?>
                        <div style="display:flex; align-items:start; gap:8px; font-size:13px; color:#475569; line-height:1.5;">
                            <i class="fas fa-check-circle" style="color:#22C55E; margin-top:2px; font-size:13px;"></i>
                            <span><?= htmlspecialchars(ltrim(trim($spec), '-')) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Availability & Action -->
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:20px; padding-left:4px;">
                    <div style="width:8px; height:8px; border-radius:50%; background:<?= $produk->stok > 0 ? '#22C55E' : '#EF4444' ?>; box-shadow: 0 0 0 4px <?= $produk->stok > 0 ? 'rgba(34, 197, 94, 0.1)' : 'rgba(239, 68, 68, 0.1)' ?>"></div>
                    <span style="font-size:13px; font-weight:600; color:<?= $produk->stok > 0 ? '#22C55E' : '#EF4444' ?>">
                        <?= $produk->stok > 0 ? 'Tersedia (' . $produk->stok . ' unit)' : 'Stok Habis' ?>
                    </span>
                </div>

                <?php if ($produk->stok > 0): ?>
                    <?php if (is_logged_in()): ?>
                        <a href="<?= site_url('booking/form/'.$produk->id) ?>" class="btn btn-primary btn-block" style="padding:14px; font-size:15px; border-radius:12px;">
                            <i class="fas fa-calendar-plus"></i> Sewa Sekarang
                        </a>
                    <?php else: ?>
                        <a href="<?= site_url('login') ?>" class="btn btn-primary btn-block" style="padding:14px; font-size:15px; border-radius:12px;">
                            <i class="fas fa-sign-in-alt"></i> Sewa sekarang
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <button class="btn btn-block" style="background:#E2E8F0; color:#94A3B8; cursor:not-allowed; padding:14px; border-radius:12px;" disabled>
                        <i class="fas fa-ban"></i> Stok Tidak Tersedia
                    </button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Reviews Section -->
        <div style="margin-top: 48px;" data-aos="fade-up">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
                <h3 style="font-family:'Poppins', sans-serif; font-size:20px; font-weight:800; color:#0F172A;">Ulasan Pelanggan</h3>
                <div style="display:flex; align-items:center; gap:8px;">
                    <div style="color:#F59E0B; font-size:18px;">
                        <?php for($i=1; $i<=5; $i++): ?>
                            <i class="<?= $i <= round($rating) ? 'fas' : 'far' ?> fa-star"></i>
                        <?php endfor; ?>
                    </div>
                    <span style="font-weight:800; color:#0F172A; font-size:18px;"><?= $rating ?></span>
                    <span style="color:#64748B; font-size:14px;">(<?= count($reviews) ?> Ulasan)</span>
                </div>
            </div>

            <?php if (empty($reviews)): ?>
                <div style="background:#fff; border-radius:16px; padding:40px; text-align:center; border:1px solid #E2E8F0;">
                    <div style="font-size:48px; color:#E2E8F0; margin-bottom:16px;"><i class="far fa-comment-dots"></i></div>
                    <p style="color:#64748B; font-size:14px;">Belum ada ulasan untuk produk ini.</p>
                </div>
            <?php else: ?>
                <div style="display:grid; gap:16px;">
                    <?php foreach ($reviews as $rev): ?>
                        <div style="background:#fff; border-radius:16px; padding:20px; border:1px solid #E2E8F0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                            <div style="display:flex; justify-content:space-between; align-items:start; margin-bottom:12px;">
                                <div style="display:flex; gap:12px; align-items:center;">
                                    <div style="width:40px; height:40px; border-radius:50%; background:#F1F5F9; display:flex; align-items:center; justify-content:center; color:#64748B; font-weight:700; font-size:14px;">
                                        <?= strtoupper(substr($rev->nama_user, 0, 1)) ?>
                                    </div>
                                    <div>
                                        <div style="font-size:14px; font-weight:700; color:#0F172A;"><?= htmlspecialchars($rev->nama_user) ?></div>
                                        <div style="color:#F59E0B; font-size:11px;">
                                            <?php for($i=1; $i<=5; $i++): ?>
                                                <i class="<?= $i <= $rev->rating ? 'fas' : 'far' ?> fa-star"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                                <div style="font-size:11px; color:#94A3B8;"><?= tgl_indo($rev->created_at) ?></div>
                            </div>
                            <p style="font-size:13px; color:#475569; line-height:1.6; margin:0;"><?= nl2br(htmlspecialchars($rev->komentar)) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.product-detail-grid {
    display: grid;
    grid-template-columns: 4.5fr 7.5fr;
    gap: 40px;
    align-items: start;
}

@media (max-width: 768px) {
    .product-detail-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
}
</style>

<?php $this->load->view('templates/footer'); ?>
