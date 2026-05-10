<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<div style="max-width:600px;margin:40px auto;padding:0 20px">
    <div class="card">
        <div class="card-header">
            <span class="card-title">Form Booking</span>
            <span class="badge badge-dipinjam"><?= ucfirst($produk->kategori) ?></span>
        </div>
        <div class="card-body">
            <!-- Produk Summary -->
            <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:10px;padding:16px;margin-bottom:20px;display:flex;gap:14px;align-items:center">
                <div style="width:60px;height:60px;border-radius:10px;background:linear-gradient(135deg,#EFF6FF,#DBEAFE);display:flex;align-items:center;justify-content:center;color:#2563EB;font-size:26px;flex-shrink:0">
                    <i class="fas fa-<?= $produk->kategori === 'drone' ? 'helicopter' : 'camera' ?>"></i>
                </div>
                <div>
                    <div style="font-size:15px;font-weight:700"><?= htmlspecialchars($produk->nama) ?></div>
                    <div style="font-size:16px;font-weight:800;color:#2563EB;margin-top:4px"><?= rupiah($produk->harga_per_hari) ?>/hari</div>
                    <div style="font-size:11px;color:#64748B">Stok tersedia: <?= isset($stok_tersedia) ? (int)$stok_tersedia : (int)$produk->stok ?> unit</div>
                </div>
            </div>

            <?php if (isset($error)): ?><div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= $error ?></div><?php endif; ?>

            <?= form_open_multipart('booking/form/'.$produk->id) ?>
            <div class="grid grid-2">
                <div class="form-group">
                    <label class="form-label">Tanggal Mulai <span style="color:red">*</span></label>
                    <input type="date" name="tanggal_mulai" id="mulai" class="form-control"
                           min="<?= date('Y-m-d', strtotime('+1 day')) ?>"
                           value="<?= set_value('tanggal_mulai') ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Selesai <span style="color:red">*</span></label>
                    <input type="date" name="tanggal_selesai" id="selesai" class="form-control"
                           min="<?= date('Y-m-d', strtotime('+2 day')) ?>"
                           value="<?= set_value('tanggal_selesai') ?>" required>
                </div>
            </div>
            
            <div class="grid grid-2">
                <div class="form-group">
                    <label class="form-label">Jumlah Unit <span style="color:red">*</span></label>
                    <input type="number" name="qty" id="qty" class="form-control" min="1" max="<?= isset($stok_tersedia) ? (int)$stok_tersedia : (int)$produk->stok ?>" value="1" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Nomor Telepon (WhatsApp) <span style="color:red">*</span></label>
                    <input type="tel" name="phone" class="form-control" placeholder="Contoh: 081234567890" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Alamat Lengkap <span style="color:red">*</span></label>
                <textarea name="alamat" class="form-control" rows="2" placeholder="Masukkan alamat lengkap pengiriman/jemput..." required></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Upload KTP/Identitas <span style="color:red">*</span></label>
                <input type="file" name="ktp" class="form-control" accept="image/*" required>
                <div style="font-size:10px;color:#94A3B8;margin-top:4px">Format: JPG, PNG • Maks 2MB</div>
            </div>

            <!-- Kalkulasi Total (Live) -->
            <div id="total-box" style="background:linear-gradient(135deg,#EFF6FF,#DBEAFE);border-radius:10px;padding:16px;margin-bottom:20px;display:none">
                <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:8px">
                    <span style="color:#64748B">Harga per hari</span>
                    <span><?= rupiah($produk->harga_per_hari) ?></span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:8px">
                    <span style="color:#64748B">Durasi</span>
                    <span><strong id="durasi-text">0</strong> hari</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:8px">
                    <span style="color:#64748B">Jumlah unit</span>
                    <span id="qty-text">1</span>
                </div>
                <hr style="border-color:#BFDBFE;margin:10px 0">
                <div style="display:flex;justify-content:space-between;font-size:17px;font-weight:800;color:#1D4ED8">
                    <span>Total</span>
                    <span id="total-text">Rp 0</span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg">
                <i class="fas fa-calendar-check"></i> Buat Booking
            </button>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
const harga = <?= $produk->harga_per_hari ?>;

function hitungTotal() {
    const mulai   = new Date(document.getElementById('mulai').value);
    const selesai = new Date(document.getElementById('selesai').value);
    const qty     = parseInt(document.getElementById('qty').value) || 1;

    if (mulai && selesai && selesai > mulai) {
        const durasi = Math.round((selesai - mulai) / (1000 * 60 * 60 * 24));
        const total  = harga * qty * durasi;
        document.getElementById('durasi-text').textContent = durasi;
        document.getElementById('qty-text').textContent    = qty;
        document.getElementById('total-text').textContent  = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('total-box').style.display = 'block';
    }
}

document.getElementById('mulai').addEventListener('change', function() {
    const min = new Date(this.value);
    min.setDate(min.getDate() + 1);
    document.getElementById('selesai').min = min.toISOString().split('T')[0];
    hitungTotal();
});
document.getElementById('selesai').addEventListener('change', hitungTotal);
document.getElementById('qty').addEventListener('input', hitungTotal);
</script>
<?php $this->load->view('templates/footer'); ?>
