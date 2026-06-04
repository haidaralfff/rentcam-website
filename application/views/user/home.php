<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<!-- Hero Section -->
<section class="hero" style="position: relative; background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.6)), url('<?= base_url('assets/picture/hero-bg.jpg') ?>');">
    <div class="hero-content" data-aos="fade-up" data-aos-duration="1000" style="position: relative; z-index: 10;">
        <div class="hero-badge"><i class="fas fa-camera"></i> Platform Rental Terpercaya</div>
        <h1>Abadikan Momen<br><span>Kualitas Sinematik</span><br>Profesional</h1>
        <p>Platform sewa kamera & drone profesional terlengkap. Bebaskan kreativitas Anda dan ciptakan karya luar biasa dengan peralatan terbaik di tangan.</p>

        <div class="hero-actions">
            <a href="<?= site_url('produk') ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-th-list" style="margin-right:8px;"></i> Lihat Katalog
            </a>
        </div>
    </div>
    
    <!-- Smooth Wave Divider -->
    <div style="position: absolute; bottom: -1px; left: 0; width: 100%; overflow: visible; line-height: 0; z-index: 1;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200" preserveAspectRatio="none" style="display: block; width: 100%; height: 120px; filter: drop-shadow(0 -10px 15px rgba(0, 0, 0, 0.5));">
            <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,165.3C1248,149,1344,107,1392,85.3L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</section>

<!-- Hero to Features Connector (Fixed Style) -->
<div style="display:flex; flex-direction:column; align-items:center; margin-top:-30px; margin-bottom:20px; position:relative; z-index:100;" data-aos="fade-down" data-aos-duration="1200">
    <div style="width:2px; height:80px; background:linear-gradient(to bottom, rgba(37, 99, 235, 0.2), #2563EB); border-radius:1px;"></div>
    <div style="width:10px; height:10px; background:#2563EB; border-radius:50%; box-shadow: 0 0 20px #2563EB, 0 0 40px rgba(37, 99, 235, 0.4); margin-top:-5px;"></div>
</div>

<!-- Features Section -->
<section style="padding:60px 20px 80px; background: #fff; position:relative; overflow:hidden;">
    <!-- Dekorasi Latar Belakang -->
    <div style="position:absolute; top:0; left:0; width:100%; height:100%; background: radial-gradient(circle at 50% 50%, rgba(37, 99, 235, 0.02) 0%, transparent 70%); pointer-events:none;"></div>
    
    <div class="section-header" data-aos="fade-down" style="margin-bottom:60px">
        <h2 class="section-title" style="font-family:'Poppins', sans-serif; font-size:32px; font-weight:800; letter-spacing:-1px;">Mengapa Harus <span style="background: linear-gradient(135deg, #60A5FA, #2563EB); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">RENTCAM</span>?</h2>
        <p class="section-subtitle">Solusi rental terbaik dengan standar pelayanan kelas dunia</p>
    </div>

    <div class="grid grid-3" style="max-width:1100px; margin:0 auto; gap:30px; position:relative; z-index:2;">
        <!-- Card 1 -->
        <div class="card" data-aos="fade-up" data-aos-delay="100" style="padding:45px 30px; border-radius:24px; border:1px solid rgba(226, 232, 240, 0.8); background:#fff; box-shadow: 0 10px 40px rgba(0,0,0,0.03); transition:all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); text-align:center; cursor:default;" onmouseover="this.style.transform='translateY(-15px)'; this.style.boxShadow='0 25px 50px rgba(37, 99, 235, 0.1)'; this.style.borderColor='rgba(37, 99, 235, 0.2)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 40px rgba(0,0,0,0.03)'; this.style.borderColor='rgba(226, 232, 240, 0.8)';">
            <div style="width:70px; height:70px; border-radius:20px; background:linear-gradient(135deg, #EFF6FF, #DBEAFE); color:#2563EB; font-size:28px; display:flex; align-items:center; justify-content:center; margin:0 auto 24px; position:relative; overflow:hidden;">
                <div style="position:absolute; width:100%; height:100%; background:radial-gradient(circle at center, rgba(37, 99, 235, 0.2), transparent); top:0; left:0;"></div>
                <i class="fas fa-calendar-check" style="position:relative; z-index:2"></i>
            </div>
            <h3 style="font-family:'Poppins', sans-serif; font-size:20px; font-weight:800; margin-bottom:12px; color:#0F172A">Booking Online</h3>
            <p style="font-size:14px; color:#64748B; line-height:1.7">Pesan unit favorit Anda kapan saja dan di mana saja dengan sistem inventori real-time kami.</p>
        </div>

        <!-- Card 2 -->
        <div class="card" data-aos="fade-up" data-aos-delay="200" style="padding:45px 30px; border-radius:24px; border:1px solid rgba(226, 232, 240, 0.8); background:#fff; box-shadow: 0 10px 40px rgba(0,0,0,0.03); transition:all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); text-align:center; cursor:default;" onmouseover="this.style.transform='translateY(-15px)'; this.style.boxShadow='0 25px 50px rgba(34, 197, 94, 0.1)'; this.style.borderColor='rgba(34, 197, 94, 0.2)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 40px rgba(0,0,0,0.03)'; this.style.borderColor='rgba(226, 232, 240, 0.8)';">
            <div style="width:70px; height:70px; border-radius:20px; background:linear-gradient(135deg, #F0FDF4, #DCFCE7); color:#22C55E; font-size:28px; display:flex; align-items:center; justify-content:center; margin:0 auto 24px; position:relative; overflow:hidden;">
                <div style="position:absolute; width:100%; height:100%; background:radial-gradient(circle at center, rgba(34, 197, 94, 0.2), transparent); top:0; left:0;"></div>
                <i class="fas fa-shield-alt" style="position:relative; z-index:2"></i>
            </div>
            <h3 style="font-family:'Poppins', sans-serif; font-size:20px; font-weight:800; margin-bottom:12px; color:#0F172A">Terverifikasi</h3>
            <p style="font-size:14px; color:#64748B; line-height:1.7">Setiap pembayaran dan data penyewa divalidasi langsung untuk menjamin keamanan setiap transaksi.</p>
        </div>

        <!-- Card 3 -->
        <div class="card" data-aos="fade-up" data-aos-delay="300" style="padding:45px 30px; border-radius:24px; border:1px solid rgba(226, 232, 240, 0.8); background:#fff; box-shadow: 0 10px 40px rgba(0,0,0,0.03); transition:all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); text-align:center; cursor:default;" onmouseover="this.style.transform='translateY(-15px)'; this.style.boxShadow='0 25px 50px rgba(249, 115, 22, 0.1)'; this.style.borderColor='rgba(249, 115, 22, 0.2)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 40px rgba(0,0,0,0.03)'; this.style.borderColor='rgba(226, 232, 240, 0.8)';">
            <div style="width:70px; height:70px; border-radius:20px; background:linear-gradient(135deg, #FFF7ED, #FFEDD5); color:#F97316; font-size:28px; display:flex; align-items:center; justify-content:center; margin:0 auto 24px; position:relative; overflow:hidden;">
                <div style="position:absolute; width:100%; height:100%; background:radial-gradient(circle at center, rgba(249, 115, 22, 0.2), transparent); top:0; left:0;"></div>
                <i class="fas fa-star" style="position:relative; z-index:2"></i>
            </div>
            <h3 style="font-family:'Poppins', sans-serif; font-size:20px; font-weight:800; margin-bottom:12px; color:#0F172A">Review Komunitas</h3>
            <p style="font-size:14px; color:#64748B; line-height:1.7">Berikan rating dan bagikan pengalaman Anda untuk membangun ekosistem rental yang terpercaya.</p>
        </div>
    </div>
    
    <!-- Connector to How It Works -->
    <div style="display:flex; flex-direction:column; align-items:center; margin-top:60px; margin-bottom:-40px; position:relative; z-index:10;" data-aos="zoom-in" data-aos-duration="800">
        <div style="width:2px; height:60px; background:linear-gradient(to bottom, #E2E8F0, #2563EB); border-radius:1px;"></div>
        <div style="width:12px; height:12px; background:#2563EB; border-radius:50%; box-shadow: 0 0 15px rgba(37, 99, 235, 0.4); margin-top:-5px;"></div>
    </div>
</section>

<!-- How It Works Section -->
<section class="section" style="background:#F8FAFC; position:relative; overflow:hidden; padding-top:100px;">
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
                <span style="position:absolute; width:28px; height:28px; background:#fff; color:var(--primary); border-radius:50%; font-size:14px; font-weight:800; display:flex; align-items:center; justify-content:center; border:3px solid var(--primary); top: -10px; right: -10px; font-family:'Poppins', sans-serif;">1</span>
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
    
    <!-- Connector Visual -->
    <div style="display:flex; flex-direction:column; align-items:center; margin-top:40px; margin-bottom:-20px; position:relative; z-index:10;" data-aos="fade-down" data-aos-duration="1000">
        <div style="width:2px; height:60px; background:linear-gradient(to bottom, #E2E8F0, #2563EB); border-radius:1px;"></div>
        <div style="width:12px; height:12px; background:#2563EB; border-radius:50%; box-shadow: 0 0 15px rgba(37, 99, 235, 0.4); margin-top:-5px;"></div>
    </div>
</section>

<!-- Catalog Section -->
<section id="katalog" class="section" style="background:#F8FAFC; padding:80px 20px 100px;">
    <div class="section-header" data-aos="fade-down" style="text-align:center; margin-bottom:60px;">
        <div style="width:50px; height:50px; background:rgba(37, 99, 235, 0.05); color:#2563EB; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 16px; font-size:22px; box-shadow: inset 0 0 10px rgba(37, 99, 235, 0.1);">
            <i class="fas fa-box-open"></i>
        </div>
        <h2 style="font-family:'Poppins', sans-serif; font-size:36px; font-weight:800; color:#0F172A; margin-bottom:12px; letter-spacing:-1px;">Katalog <span style="background: linear-gradient(135deg, #60A5FA, #2563EB); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Produk</span></h2>
        <p style="font-size:16px; color:#64748B; max-width:600px; margin:0 auto; line-height:1.6;">Temukan koleksi kamera & drone profesional terbaik yang siap mendukung setiap karya kreatif Anda.</p>
        <div style="width:60px; height:4px; background:linear-gradient(90deg, #2563EB, #60A5FA); margin:20px auto 0; border-radius:2px;"></div>
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

    <!-- Connector Visual Down -->
    <div style="display:flex; flex-direction:column; align-items:center; margin-top:60px; margin-bottom:-40px; position:relative; z-index:10;" data-aos="zoom-in" data-aos-delay="200">
        <div style="width:12px; height:12px; background:rgba(37, 99, 235, 0.2); border-radius:50%; margin-bottom:-5px;"></div>
        <div style="width:2px; height:60px; background:linear-gradient(to bottom, #2563EB, #E2E8F0); border-radius:1px;"></div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="section" style="background:#fff; padding:100px 20px 60px;">
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

    <!-- Connector Visual to CTA -->
    <div style="display:flex; flex-direction:column; align-items:center; margin-top:60px; margin-bottom:-20px; position:relative; z-index:10;" data-aos="fade-down" data-aos-duration="1000">
        <div style="width:2px; height:60px; background:linear-gradient(to bottom, #E2E8F0, rgba(255,255,255,0.5)); border-radius:1px;"></div>
        <div style="width:12px; height:12px; border:2px solid rgba(255,255,255,0.5); border-radius:50%; margin-top:-5px;"></div>
    </div>
</section>

<!-- Final CTA Section (Social Spotlight) -->
<section style="position: relative; padding: 160px 20px 100px; background:linear-gradient(rgba(15, 23, 42, 0.9), rgba(15, 23, 42, 0.9)), url('<?= base_url('assets/picture/hero-bg.jpg') ?>'); background-size:cover; background-position:center; text-align:center;">
    
    <!-- Smooth Top Wave Divider -->
    <div style="position: absolute; top: -1px; left: 0; width: 100%; overflow: visible; line-height: 0; z-index: 1;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200" preserveAspectRatio="none" style="display: block; width: 100%; height: 120px; filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.5));">
            <path fill="#ffffff" fill-opacity="1" d="M0,128L48,138.7C96,149,192,171,288,160C384,149,480,107,576,96C672,85,768,107,864,128C960,149,1056,171,1152,160C1248,149,1344,107,1392,85.3L1440,64L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
        </svg>
    </div>

    <div style="max-width:800px; margin:0 auto; position: relative; z-index: 10;" data-aos="zoom-in">
        <h2 style="font-family:'Poppins', sans-serif; font-size:36px; font-weight:800; color:#fff; margin-bottom:16px; letter-spacing:-1px;">Wujudkan Karya Imajinasi Anda Sekarang</h2>
        <p style="color:#CBD5E1; font-size:16px; margin-bottom:40px; line-height:1.6;">Lihat hasil karya komunitas kami dan temukan inspirasi di media sosial RENTCAM.</p>
        
        <div style="display:flex; justify-content:center; gap:24px;">
            <!-- Instagram -->
            <a href="#" style="width:60px; height:60px; border-radius:50%; background:linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); color:#fff; display:flex; align-items:center; justify-content:center; font-size:28px; transition:transform 0.3s ease; box-shadow: 0 10px 20px rgba(0,0,0,0.2);" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
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
            <!-- Whatsapp -->
            <a href="#" style="width:60px; height:60px; border-radius:50%; background:#25D366; color:#fff; border: 1px solid rgba(255, 255, 255, 0.2); display:flex; align-items:center; justify-content:center; font-size:28px; transition:transform 0.3s ease; box-shadow: 0 10px 20px rgba(37, 211, 102, 0.2);" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                <i class="fab fa-whatsapp"></i> 
            </a>
        </div>
        <p style="color:#94A3B8; font-size:13px; margin-top:24px; font-weight:500;">@rentcam_official</p>
    </div>
</section>

<?php $this->load->view('templates/footer'); ?>
