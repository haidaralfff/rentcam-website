<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<div style="max-width:640px;margin:40px auto;padding:0 20px">
    <div class="card">
        <div class="card-header">
            <span class="card-title">Upload Bukti Pembayaran</span>
            <span class="badge badge-pending">Menunggu Verifikasi</span>
        </div>
        <div class="card-body">
            <!-- Booking Summary -->
            <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:10px;padding:16px;margin-bottom:20px">
                <p style="font-size:11px;font-weight:700;color:#64748B;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:10px">Ringkasan Booking #<?= $booking->id ?></p>
                <table style="width:100%;font-size:13px;border-collapse:collapse">
                    <tr><td style="padding:5px 0;color:#64748B;width:130px">Periode Sewa</td><td><?= tgl_indo($booking->tanggal_mulai) ?> – <?= tgl_indo($booking->tanggal_selesai) ?></td></tr>
                    <tr><td style="padding:5px 0;color:#64748B">Durasi</td><td><?= hitung_durasi($booking->tanggal_mulai, $booking->tanggal_selesai) ?> hari</td></tr>
                    <?php foreach ($detail as $d): ?>
                    <tr><td style="padding:5px 0;color:#64748B">Produk</td><td><?= htmlspecialchars($d->nama_produk) ?> (<?= $d->qty ?>x)</td></tr>
                    <?php endforeach; ?>
                    <?php if (!empty($booking->deadline_bayar)): ?>
                    <tr><td style="padding:5px 0;color:#64748B">Batas Pembayaran</td><td><strong><?= date('d/m/Y H:i', strtotime($booking->deadline_bayar)) ?></strong></td></tr>
                    <?php endif; ?>
                    <tr>
                        <td style="padding:10px 0 5px;color:#64748B;font-weight:700">Total Bayar</td>
                        <td style="font-size:18px;font-weight:800;color:#2563EB;padding-top:10px"><?= rupiah($booking->total_harga) ?></td>
                    </tr>
                </table>
            </div>

            <!-- Rekening Tujuan -->
            <div style="background:linear-gradient(135deg,#1D4ED8,#2563EB);border-radius:10px;padding:18px;margin-bottom:20px;color:#fff">
                <p style="font-size:11px;font-weight:700;opacity:0.8;margin-bottom:10px;text-transform:uppercase;letter-spacing:0.5px">Transfer ke Rekening</p>
                <div style="display:flex;flex-direction:column;gap:8px">
                    <?php foreach($this->config->item('bank_accounts') as $bank): ?>
                    <div style="display:flex;justify-content:space-between;font-size:14px">
                        <span style="opacity:0.8"><?= $bank['bank'] ?></span>
                        <strong><?= $bank['number'] ?> (a/n <?= $bank['holder'] ?>)</strong>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php if (isset($error)): ?><div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <?= $error ?></div><?php endif; ?>

            <?= form_open_multipart('pembayaran/upload/'.$booking->id) ?>
            <div class="form-group">
                <label class="form-label">Metode Pembayaran</label>
                <select name="metode" id="metode_bayar" class="form-control form-select">
                    <?php foreach($this->config->item('bank_accounts') as $bank): ?>
                    <option value="<?= $bank['bank'] ?>">Transfer <?= $bank['bank'] ?></option>
                    <?php endforeach; ?>
                    <option value="cash">Cash (Tunai)</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label" id="label_bukti">Foto Bukti Transfer <span style="color:red">*</span></label>
                <div class="upload-area" onclick="document.getElementById('bukti_bayar').click()">
                    <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                    <div class="upload-text" id="text_bukti">Klik atau drag foto bukti transfer</div>
                    <div style="font-size:11px;color:#94A3B8;margin-top:4px">JPG, PNG, GIF • Maks 2MB</div>
                    <div id="file-name" style="font-size:12px;color:#2563EB;margin-top:8px;font-weight:600"></div>
                </div>
                <input type="file" id="bukti_bayar" name="bukti_bayar" accept="image/*" style="display:none" onchange="
                    document.getElementById('file-name').textContent = this.files[0]?.name || '';
                    const reader = new FileReader();
                    reader.onload = e => {
                        document.getElementById('preview').src = e.target.result;
                        document.getElementById('preview-box').style.display = 'block';
                    };
                    if(this.files[0]) reader.readAsDataURL(this.files[0]);
                " required>
                <div id="preview-box" style="display:none;margin-top:12px">
                    <img id="preview" style="max-width:100%;border-radius:8px;border:2px solid #E2E8F0">
                </div>
            </div>
            
            <script>
            const metodeSelect = document.getElementById('metode_bayar');
            const buktiInput = document.getElementById('bukti_bayar');
            const labelBukti = document.getElementById('label_bukti');
            const textBukti = document.getElementById('text_bukti');

            metodeSelect.addEventListener('change', function() {
                if (this.value === 'cash') {
                    buktiInput.required = false;
                    labelBukti.innerHTML = 'Foto Bukti Pembayaran (Opsional)';
                    textBukti.textContent = 'Klik untuk upload bukti (jika ada)';
                } else {
                    buktiInput.required = true;
                    labelBukti.innerHTML = 'Foto Bukti Transfer <span style="color:red">*</span>';
                    textBukti.textContent = 'Klik atau drag foto bukti transfer';
                }
            });
            </script>
            <button type="submit" class="btn btn-primary btn-block btn-lg">
                <i class="fas fa-paper-plane"></i> Kirim Bukti Pembayaran
            </button>
            <?= form_close() ?>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>
