<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<div style="max-width:540px;margin:40px auto;padding:0 20px">
    <div class="card">
        <div class="card-header">
            <span class="card-title">Beri Ulasan</span>
        </div>
        <div class="card-body">
            <!-- Produk Info -->
            <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:10px;padding:14px;margin-bottom:20px;display:flex;gap:12px;align-items:center">
                <div style="width:50px;height:50px;border-radius:10px;background:#EFF6FF;display:flex;align-items:center;justify-content:center;color:#2563EB;font-size:22px">
                    <i class="fas fa-camera"></i>
                </div>
                <div>
                    <div style="font-size:15px;font-weight:700"><?= htmlspecialchars($produk->nama) ?></div>
                    <div style="font-size:12px;color:#64748B"><?= ucfirst($produk->kategori) ?></div>
                </div>
            </div>

            <?php if (isset($error)): ?><div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= $error ?></div><?php endif; ?>

            <?= form_open('review/form/'.$booking_id) ?>

            <!-- Star Rating -->
            <div class="form-group">
                <label class="form-label">Rating <span style="color:red">*</span></label>
                <div style="display:flex;gap:8px;font-size:36px;margin-top:4px" id="star-container">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                    <span class="star" data-value="<?= $i ?>" style="cursor:pointer;color:#E2E8F0;transition:color 0.15s" onmouseover="hoverStar(<?= $i ?>)" onmouseout="resetStar()" onclick="selectStar(<?= $i ?>)">★</span>
                    <?php endfor; ?>
                </div>
                <input type="hidden" name="rating" id="rating-input" value="" required>
                <div id="rating-label" style="font-size:13px;color:#64748B;margin-top:6px">Pilih rating</div>
            </div>

            <div class="form-group">
                <label class="form-label">Komentar <span style="color:red">*</span></label>
                <textarea name="komentar" class="form-control" rows="4" placeholder="Ceritakan pengalaman Anda menggunakan produk ini..." required><?= set_value('komentar') ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg" id="submit-btn">
                <i class="fas fa-paper-plane"></i> Kirim Ulasan
            </button>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
const labels = ['','Sangat Buruk','Buruk','Cukup','Bagus','Sangat Bagus'];
let selected = 0;

function hoverStar(val) {
    document.querySelectorAll('.star').forEach((s, i) => {
        s.style.color = i < val ? '#F59E0B' : '#E2E8F0';
    });
    document.getElementById('rating-label').textContent = labels[val];
}
function resetStar() {
    document.querySelectorAll('.star').forEach((s, i) => {
        s.style.color = i < selected ? '#F59E0B' : '#E2E8F0';
    });
    document.getElementById('rating-label').textContent = selected ? labels[selected] : 'Pilih rating';
}
function selectStar(val) {
    selected = val;
    document.getElementById('rating-input').value = val;
    resetStar();
}
</script>

<?php $this->load->view('templates/footer'); ?>
