<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Hero Section -->
<section class="hero" style="background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.6)), url('<?= base_url('assets/picture/hero-bg.jpg') ?>');">
    <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
        <div class="hero-badge"><i class="fas fa-camera"></i> Platform Rental Terpercaya</div>
        <h1>Abadikan Momen<br><span>Kualitas Sinematik</span><br>Profesional</h1>
        <p>Platform sewa kamera & drone profesional terlengkap. Bebaskan kreativitas Anda dan ciptakan karya luar biasa dengan peralatan terbaik di tangan.</p>

        <div class="hero-actions">
            <a href="<?= site_url('produk') ?>" class="btn btn-primary btn-lg">
                Lihat Katalog
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section style="padding:80px 20px; background:#F8FAFC; border-bottom:1px solid #E2E8F0;">
    <div class="section-header" data-aos="fade-down">
        <h2 class="section-title" style="font-family:'Poppins', sans-serif;">Keunggulan <span style="background: linear-gradient(135deg, #60A5FA, #2563EB); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">RENTCAM</span></h2>
        <p class="section-subtitle">Kemudahan dan keamanan dalam setiap langkah penyewaan Anda</p>
    </div>
    <div class="grid grid-3" style="max-width:1000px; margin:0 auto; gap:20px">
        <div class="card feature-card" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-icon-box" style="background:rgba(37, 99, 235, 0.08); color:#2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h3>Booking Online</h3>
            <p>Pesan kamera atau drone favorit Anda kapan saja dan di mana saja dengan sistem real-time.</p>
        </div>
        <div class="card feature-card" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-icon-box" style="background:rgba(34, 197, 94, 0.08); color:#22C55E; box-shadow: 0 4px 12px rgba(34, 197, 94, 0.1);">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3>Terverifikasi</h3>
            <p>Setiap pembayaran dan data penyewa diverifikasi langsung untuk keamanan transaksi Anda.</p>
        </div>
        <div class="card feature-card" data-aos="fade-up" data-aos-delay="300">
            <div class="feature-icon-box" style="background:rgba(249, 115, 22, 0.08); color:#F97316; box-shadow: 0 4px 12px rgba(249, 115, 22, 0.1);">
                <i class="fas fa-star"></i>
            </div>
            <h3>Berikan Review</h3>
            <p>Bagikan pengalaman seru Anda dan berikan rating untuk membantu penyewa lainnya.</p>
        </div>
    </div>
</section>
<!-- How It Works Section -->
<section class="section" style="background:#F8FAFC; position:relative; overflow:hidden;">
    <!-- Background Decor -->
    <div style="position:absolute; top:-100px; right:-100px; width:300px; height:300px; background:rgba(37, 99, 235, 0.03); border-radius:50%;"></div>
    
    <div class="section-header" data-aos="fade-down">
        <h2 class="section-title" style="font-family:'Poppins', sans-serif;">Cara Mudah Sewa di <span style="background: linear-gradient(135deg, #60A5FA, #2563EB); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">RENTCAM</span></h2>
        <p class="section-subtitle">Proses simpel, cepat, dan transparan dalam 3 langkah mudah</p>
    </div>
    
    <div class="grid grid-3" style="max-width:1100px; margin:0 auto; gap:30px; position:relative;">
        <!-- Connecting Line (Desktop Only) -->
        <div class="desktop-only" style="position:absolute; top:40px; left:15%; right:15%; height:2px; border-top:2px dashed #E2E8F0; z-index:1;"></div>
        
        <!-- Step 1 -->
        <div class="card" style="text-align:center; padding:40px 24px; position:relative; z-index:2; border:none; background:transparent; box-shadow:none;" data-aos="fade-up" data-aos-delay="100">
            <div style="width:80px; height:80px; border-radius:24px; background:linear-gradient(135deg, #2563EB, #1E3A8A); color:#fff; font-size:30px; display:flex; align-items:center; justify-content:center; margin:0 auto 24px; box-shadow: 0 12px 24px rgba(37, 99, 235, 0.25); position:relative;">
                <i class="fas fa-search"></i>
                <span style="position:absolute; -top:12px; -right:12px; width:28px; height:28px; background:#fff; color:var(--primary); border-radius:50%; font-size:14px; font-weight:800; display:flex; align-items:center; justify-content:center; border:3px solid var(--primary); top: -10px; right: -10px; font-family:'Poppins', sans-serif;">1</span>
            </div>
            <h4 style="font-family:'Poppins', sans-serif; font-size:20px; font-weight:800; margin-bottom:14px; color:#0F172A">Pilih Alat</h4>
            <p style="font-size:14px; color:#64748B; line-height:1.6">Temukan kamera atau drone yang sesuai dengan kebutuhan project Anda di katalog kami.</p>
        </div>
        
        <!-- Step 2 -->
        <div class="card" style="text-align:center; padding:40px 24px; position:relative; z-index:2; border:none; background:transparent; box-shadow:none;" data-aos="fade-up" data-aos-delay="200">
            <div style="width:80px; height:80px; border-radius:24px; background:linear-gradient(135deg, #2563EB, #1E3A8A); color:#fff; font-size:30px; display:flex; align-items:center; justify-content:center; margin:0 auto 24px; box-shadow: 0 12px 24px rgba(37, 99, 235, 0.25); position:relative;">
                <i class="fas fa-wallet"></i>
                <span style="position:absolute; width:28px; height:28px; background:#fff; color:var(--primary); border-radius:50%; font-size:14px; font-weight:800; display:flex; align-items:center; justify-content:center; border:3px solid var(--primary); top: -10px; right: -10px; font-family:'Poppins', sans-serif;">2</span>
            </div>
            <h4 style="font-family:'Poppins', sans-serif; font-size:20px; font-weight:800; margin-bottom:14px; color:#0F172A">Bayar Online</h4>
            <p style="font-size:14px; color:#64748B; line-height:1.6">Lakukan booking dan unggah bukti transfer. Admin kami akan memverifikasi dalam waktu singkat.</p>
        </div>
        
        <!-- Step 3 -->
        <div class="card" style="text-align:center; padding:40px 24px; position:relative; z-index:2; border:none; background:transparent; box-shadow:none;" data-aos="fade-up" data-aos-delay="300">
            <div style="width:80px; height:80px; border-radius:24px; background:linear-gradient(135deg, #2563EB, #1E3A8A); color:#fff; font-size:30px; display:flex; align-items:center; justify-content:center; margin:0 auto 24px; box-shadow: 0 12px 24px rgba(37, 99, 235, 0.25); position:relative;">
                <i class="fas fa-camera-retro"></i>
                <span style="position:absolute; width:28px; height:28px; background:#fff; color:var(--primary); border-radius:50%; font-size:14px; font-weight:800; display:flex; align-items:center; justify-content:center; border:3px solid var(--primary); top: -10px; right: -10px; font-family:'Poppins', sans-serif;">3</span>
            </div>
            <h4 style="font-family:'Poppins', sans-serif; font-size:20px; font-weight:800; margin-bottom:14px; color:#0F172A">Ambil & Karya</h4>
            <p style="font-size:14px; color:#64748B; line-height:1.6">Ambil alat di workshop kami dan mulai abadikan momen luar biasa Anda dengan kualitas pro.</p>
        </div>
    </div>
</section>
</section>
<!-- Catalog Section -->
<section class="section" style="background:#F8FAFC">
    <div class="section-header" data-aos="fade-down">
        <h2 class="section-title" style="font-family:'Poppins', sans-serif;">Produk <span style="background: linear-gradient(135deg, #60A5FA, #2563EB); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Tersedia</span></h2>
        <p class="section-subtitle">Temukan kamera dan drone terbaik untuk kebutuhan Anda</p>
    </div>

    <?php if (empty($produk_unggulan)): ?>
    <div style="text-align:center; padding:60px 20px; background:#fff; border-radius:20px; border:1px solid #E2E8F0; max-width:600px; margin:0 auto;" data-aos="zoom-in">
        <div style="width:64px; height:64px; border-radius:50%; background:rgba(37, 99, 235, 0.05); color:#2563EB; font-size:28px; display:flex; align-items:center; justify-content:center; margin:0 auto 20px;">
            <i class="fas fa-box-open"></i>
        </div>
        <p style="color:#64748B; font-weight:600;">Saat ini belum ada produk unggulan yang tersedia.</p>
    </div>
    <?php else: ?>
    <div class="grid grid-3" style="max-width:1100px;margin:0 auto">
        <?php foreach ($produk_unggulan as $p): ?>
        <div class="produk-card" data-aos="zoom-in" data-aos-duration="600">
            <div class="produk-card-img">
                <?php if ($p->foto): ?>
                    <img src="<?= base_url('assets/uploads/produk/' . $p->foto) ?>" alt="<?= htmlspecialchars($p->nama) ?>">
                <?php else: ?>
                    <i class="fas fa-<?= $p->kategori === 'drone' ? 'helicopter' : 'camera' ?>"></i>
                <?php endif; ?>
            </div>
            <div class="produk-card-body">
                <div class="produk-card-kategori"><i class="fas fa-tag"></i> <?= ucfirst($p->kategori) ?></div>
                <h3 class="produk-card-title"><?= htmlspecialchars($p->nama) ?></h3>
                <p style="font-size:12px;color:#64748B;margin-bottom:8px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden"><?= htmlspecialchars($p->spesifikasi) ?></p>
                <div style="display:flex;align-items:center;justify-content:space-between;margin-top:auto;padding-top:12px">
                    <div>
                        <div class="produk-card-price"><?= rupiah($p->harga_per_hari) ?><span>/hari</span></div>
                        <div style="font-size:11px;color:#64748B;margin-top:2px">Stok: <?= $p->stok ?> unit</div>
                    </div>
                    <a href="<?= site_url('produk/detail/' . $p->id) ?>" class="btn btn-primary btn-sm">Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div style="text-align:center;margin-top:32px">
        <a href="<?= site_url('produk') ?>" class="btn btn-outline">Lihat Semua Produk <i class="fas fa-arrow-right"></i></a>
    </div>
    <?php endif; ?>
</section>

<!-- Why Choose Us Section -->
<section class="section" style="background:#fff;">
    <div class="section-header" data-aos="fade-down">
        <h2 class="section-title" style="font-family:'Poppins', sans-serif;">Mengapa Memilih <span style="background: linear-gradient(135deg, #60A5FA, #2563EB); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">RENTCAM</span>?</h2>
        <p class="section-subtitle">Kami memberikan lebih dari sekadar sewa alat</p>
    </div>
    
    <div class="grid grid-3" style="max-width:1100px; margin:0 auto; gap:20px;">
        <!-- USP 1 -->
        <div class="card feature-card" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-icon-box" style="background:rgba(37, 99, 235, 0.08); color:#2563EB; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.1);">
                <i class="fas fa-check-circle"></i>
            </div>
            <h3 style="font-family:'Poppins', sans-serif;">Alat Terawat</h3>
            <p>Setiap kamera dan drone selalu melalui tahap pembersihan dan pengecekan teknis sebelum disewakan.</p>
        </div>
        
        <!-- USP 2 -->
        <div class="card feature-card" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-icon-box" style="background:rgba(34, 197, 94, 0.08); color:#22C55E; box-shadow: 0 4px 12px rgba(34, 197, 94, 0.1);">
                <i class="fas fa-tags"></i>
            </div>
            <h3 style="font-family:'Poppins', sans-serif;">Harga Kompetitif</h3>
            <p>Nikmati harga sewa terbaik dengan paket-paket fleksibel yang menyesuaikan budget produksi Anda.</p>
        </div>
        
        <!-- USP 3 -->
        <div class="card feature-card" data-aos="fade-up" data-aos-delay="300">
            <div class="feature-icon-box" style="background:rgba(249, 115, 22, 0.08); color:#F97316; box-shadow: 0 4px 12px rgba(249, 115, 22, 0.1);">
                <i class="fas fa-headset"></i>
            </div>
            <h3 style="font-family:'Poppins', sans-serif;">Support Ahli</h3>
            <p>Tim kami siap membantu Anda memilih alat yang paling pas untuk kebutuhan karya Anda.</p>
        </div>
    </div>
</section>

<!-- Final CTA Section (Social Spotlight) -->
<section style="padding:100px 20px; background:linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), url('<?= base_url('assets/picture/hero-bg.jpg') ?>'); background-size:cover; background-position:center; text-align:center;">
    <div style="max-width:800px; margin:0 auto;" data-aos="zoom-in">
        <h2 style="font-family:'Poppins', sans-serif; font-size:36px; font-weight:800; color:#fff; margin-bottom:16px; letter-spacing:-1px;">Wujudkan Karya Imajinasi Anda Sekarang</h2>
        <p style="color:#CBD5E1; font-size:16px; margin-bottom:40px; line-height:1.6;">Lihat hasil karya komunitas kami dan temukan inspirasi di media sosial RENTCAM.</p>
        
        <div style="display:flex; justify-content:center; gap:24px;">
            <!-- Instagram -->
            <a href="#" style="width:60px; height:60px; border-radius:50%; background:linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); color:#fff; display:flex; align-items:center; justify-content:center; font-size:28px; transition:transform 0.3s ease; box-shadow: 0 10px 20px rgba(220, 39, 67, 0.2);" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fab fa-instagram"></i>
            </a>
            <!-- YouTube -->
            <a href="#" style="width:60px; height:60px; border-radius:50%; background:#FF0000; color:#fff; display:flex; align-items:center; justify-content:center; font-size:28px; transition:transform 0.3s ease; box-shadow: 0 10px 20px rgba(255, 0, 0, 0.2);" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fab fa-youtube"></i>
            </a>
            <!-- TikTok -->
            <a href="#" style="width:60px; height:60px; border-radius:50%; background:#000000; color:#fff; border: 1px solid rgba(255, 255, 255, 0.2); display:flex; align-items:center; justify-content:center; font-size:28px; transition:transform 0.3s ease; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fab fa-tiktok"></i>
            </a>
        </div>
        <p style="color:#94A3B8; font-size:13px; margin-top:24px; font-weight:500;">@rentcam_official</p>
    </div>
</section>

<?php $this->load->view('templates/footer'); ?>
