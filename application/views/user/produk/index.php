<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<div class="container-responsive" style="padding: 20px 20px 60px; max-width: 1100px; margin: 0 auto">
    <!-- Header -->
    <div class="katalog-header" style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:16px">
        <div style="flex: 1; min-width: 250px;">
            <h1 style="font-size:24px; font-weight:800; margin-bottom: 4px;">Katalog Produk</h1>
            <p style="color:#64748B; font-size:14px">Temukan kamera & drone yang tepat untuk Anda</p>
        </div>
        <!-- Filter -->
        <div class="katalog-filter" style="width: 100%; max-width: 450px;">
            <?= form_open('produk', 'method="get"') ?>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <select name="kategori" class="form-control" style="flex: 1; min-width: 140px; height: 42px;" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <option value="kamera"    <?= $this->input->get('kategori') === 'kamera'    ? 'selected' : '' ?>>Kamera</option>
                    <option value="drone"     <?= $this->input->get('kategori') === 'drone'     ? 'selected' : '' ?>>Drone</option>
                    <option value="aksesoris" <?= $this->input->get('kategori') === 'aksesoris' ? 'selected' : '' ?>>Aksesoris</option>
                </select>
                <div style="display: flex; flex: 2; min-width: 200px; gap: 4px;">
                    <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="<?= htmlspecialchars($this->input->get('search') ?? '') ?>" style="flex: 1; height: 42px;">
                    <button type="submit" class="btn btn-primary" style="padding: 0 16px; height: 42px;"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>

    <?php if (empty($produk)): ?>
    <div style="text-align:center; padding:100px 20px; background: #fff; border-radius: 24px; border: 1px solid rgba(15, 23, 42, 0.05); box-shadow: var(--shadow); margin-top: 40px;" data-aos="zoom-in">
        <div style="width:100px; height:100px; border-radius:50%; background:rgba(37, 99, 235, 0.08); display:flex; align-items:center; justify-content:center; margin:0 auto 28px; color:#2563EB; font-size:42px; box-shadow: 0 10px 20px rgba(37, 99, 235, 0.1);">
            <i class="fas fa-search-plus"></i>
        </div>
        <h3 style="font-size:24px; font-weight:800; color:#0F172A; margin-bottom:12px; letter-spacing:-0.5px">Produk Tidak Ditemukan</h3>
        <p style="color:#64748B; max-width:440px; margin:0 auto 36px; line-height:1.7; font-size:15px">Kami tidak dapat menemukan produk yang sesuai dengan kriteria Anda. Coba gunakan kata kunci yang lebih umum atau tekan tombol di bawah untuk menyegarkan katalog.</p>
        <a href="<?= site_url('produk') ?>" class="btn btn-primary btn-lg">
            <i class="fas fa-sync-alt"></i> Reset Filter & Lihat Semua
        </a>
    </div>
    <?php else: ?>
    <div class="grid grid-3">
        <?php foreach ($produk as $p): ?>
        <div class="produk-card" data-aos="fade-up">
            <div class="produk-card-img">
                <?php if ($p->foto): ?>
                <img src="<?= base_url('assets/uploads/produk/'.$p->foto) ?>" alt="<?= htmlspecialchars($p->nama) ?>">
                <?php else: ?>
                <i class="fas fa-<?= $p->kategori === 'drone' ? 'helicopter' : ($p->kategori === 'aksesoris' ? 'camera-retro' : 'camera') ?>"></i>
                <?php endif; ?>
            </div>
            <div class="produk-card-body">
                <div class="produk-card-kategori"><i class="fas fa-tag"></i> <?= ucfirst($p->kategori) ?></div>
                <h3 class="produk-card-title"><?= htmlspecialchars($p->nama) ?></h3>
                <p style="font-size:13px; color:#64748B; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; margin-bottom:16px; line-height:1.5;"><?= htmlspecialchars($p->spesifikasi) ?></p>
                <div class="d-flex align-center justify-between" style="margin-top:auto">
                    <div>
                        <div class="produk-card-price"><?= rupiah($p->harga_per_hari) ?><span>/hari</span></div>
                        <div style="font-size:11px; margin-top:2px">
                            <span style="color:<?= $p->stok > 0 ? '#22C55E' : '#EF4444' ?>; font-weight:600"><?= $p->stok > 0 ? '● Tersedia' : '● Habis' ?></span>
                            <span style="color:#94A3B8"> (<?= $p->stok ?> unit)</span>
                        </div>
                    </div>
                    <a href="<?= site_url('produk/detail/'.$p->id) ?>" class="btn btn-primary btn-sm">Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<?php $this->load->view('templates/footer'); ?>
