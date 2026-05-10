<?php $this->load->view('templates/header'); ?>
<div class="layout-wrapper">
    <?php $this->load->view('templates/sidebar'); ?>
    <div class="main-content">
        <div class="topbar">
            <div class="d-flex align-center gap-2">
                <a href="<?= site_url('admin/pembayaran') ?>" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i></a>
                <span class="topbar-title">Verifikasi Pembayaran #<?= $payment->id ?></span>
            </div>
        </div>
        <div class="page-content">
            <div class="grid grid-2" style="align-items:start">
                <!-- Bukti Bayar -->
                <div class="card">
                    <div class="card-header"><span class="card-title">Bukti Pembayaran</span></div>
                    <div class="card-body" style="text-align:center">
                        <?php if ($payment->bukti_bayar): ?>
                        <img src="<?= base_url('assets/uploads/bukti/'.$payment->bukti_bayar) ?>" alt="Bukti Bayar"
                             style="max-width:100%;border-radius:10px;border:2px solid #E2E8F0;cursor:pointer"
                             onclick="window.open(this.src,'_blank')">
                        <p style="font-size:12px;color:#64748B;margin-top:8px"><i class="fas fa-expand"></i> Klik untuk lihat ukuran penuh</p>
                        <?php else: ?>
                        <div style="padding:40px;color:#94A3B8"><i class="fas fa-image" style="font-size:48px;display:block;margin-bottom:12px"></i>Belum ada bukti</div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Detail & Verifikasi -->
                <div style="display:flex;flex-direction:column;gap:16px">
                    <div class="card">
                        <div class="card-header"><span class="card-title">Detail Transaksi</span></div>
                        <div class="card-body">
                            <table style="width:100%;font-size:13px;border-collapse:collapse">
                                <tr><td style="padding:8px 0;color:#64748B;width:140px">Member</td><td><strong><?= htmlspecialchars($payment->nama_user) ?></strong></td></tr>
                                <tr><td style="padding:8px 0;color:#64748B">Email</td><td><?= htmlspecialchars($payment->email) ?></td></tr>
                                <tr><td style="padding:8px 0;color:#64748B">Total Bayar</td><td><strong style="font-size:16px;color:#2563EB"><?= rupiah($payment->total_harga) ?></strong></td></tr>
                                <tr><td style="padding:8px 0;color:#64748B">Metode</td><td><?= ucfirst($payment->metode) ?></td></tr>
                                <tr><td style="padding:8px 0;color:#64748B">Tanggal Sewa</td><td><?= tgl_indo($payment->tanggal_mulai) ?> – <?= tgl_indo($payment->tanggal_selesai) ?></td></tr>
                                <tr><td style="padding:8px 0;color:#64748B">Status</td><td><span class="badge badge-<?= $payment->status ?>"><?= ucfirst($payment->status) ?></span></td></tr>
                            </table>
                        </div>
                    </div>

                    <?php if ($payment->status === 'pending'): ?>
                    <div class="card">
                        <div class="card-header"><span class="card-title">Keputusan Verifikasi</span></div>
                        <div class="card-body">
                            <?= form_open('admin/pembayaran/verifikasi/'.$payment->id) ?>
                            <div class="form-group">
                                <label class="form-label">Catatan Admin (opsional)</label>
                                <textarea name="catatan" class="form-control" rows="3" placeholder="Contoh: Nominal transfer sesuai..."></textarea>
                            </div>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-success btn-verifikasi" style="flex:1" data-status="verified">
                                        <i class="fas fa-check-circle"></i> Verifikasi
                                    </button>
                                    <button type="button" class="btn btn-danger btn-verifikasi" style="flex:1" data-status="rejected">
                                        <i class="fas fa-times-circle"></i> Tolak
                                    </button>
                                </div>
                                <?= form_close() ?>
                            </div>
                        </div>
                        <?php elseif ($payment->catatan_admin): ?>
                        <div class="card">
                            <div class="card-body">
                                <p style="font-size:12px;color:#64748B;font-weight:600;margin-bottom:6px">Catatan Admin:</p>
                                <p style="font-size:13px"><?= htmlspecialchars($payment->catatan_admin) ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    document.querySelectorAll('.btn-verifikasi').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const status = this.getAttribute('data-status');
            const title = status === 'verified' ? 'Verifikasi Pembayaran?' : 'Tolak Pembayaran?';
            const text = status === 'verified' ? 'Apakah Anda yakin pembayaran ini sudah sesuai?' : 'Apakah Anda yakin ingin menolak pembayaran ini?';
            const confirmBtnText = status === 'verified' ? 'Ya, Verifikasi' : 'Ya, Tolak';
            const confirmBtnClass = status === 'verified' ? 'btn-success' : 'btn-danger';
            const iconType = status === 'verified' ? 'question' : 'warning';
            const iconColor = status === 'verified' ? '#2563EB' : '#DC2626';

            Swal.fire({
                title: title,
                text: text,
                icon: iconType,
                iconColor: iconColor,
                showCancelButton: true,
                confirmButtonText: confirmBtnText,
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'swal2-premium-popup',
                    confirmButton: 'btn ' + confirmBtnClass,
                    cancelButton: 'btn btn-outline'
                },
                buttonsStyling: false,
                backdrop: `rgba(15, 23, 42, 0.5) blur(4px)`
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = this.closest('form');
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'status';
                    input.value = status;
                    form.appendChild(input);
                    form.submit();
                }
            });
        });
    });
    </script>
</div>
<?php $this->load->view('templates/footer'); ?>
