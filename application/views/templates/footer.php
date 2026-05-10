    <footer class="footer">
        <div style="max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; text-align: left; padding: 20px 0 40px;">
            <!-- Brand & About -->
            <div>
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 16px;">
                    <div style="width: 32px; height: 32px; background: #2563EB; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px;">
                        <i class="fas fa-camera"></i>
                    </div>
                    <strong style="color:#fff; font-size: 20px; letter-spacing: -0.5px;">RENTCAM</strong>
                </div>
                <p style="color: #94A3B8; font-size: 14px; line-height: 1.6;">Solusi penyewaan kamera dan drone profesional terlengkap. Temukan alat terbaik untuk setiap momen kreatif Anda.</p>
            </div>

            <!-- Address -->
            <div>
                <strong style="color:#fff; font-size: 16px; display: block; margin-bottom: 16px; font-family: 'Poppins', sans-serif;">Alamat Kantor</strong>
                <p style="color: #94A3B8; font-size: 14px; line-height: 1.7;">
                    <i class="fas fa-map-marker-alt" style="color: #2563EB; margin-right: 10px;"></i>
                    Jl. Mawar No. 7, Desa Banjar Jaya, <br>
                    Kecamatan Manohara, Kab. Kebumen <br>
                    Jawa Tengah, Indonesia
                </p>
                <!-- Google Maps Embed with Premium Styling -->
                <div class="footer-map-container" style="margin-top: 16px; border-radius: 12px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); box-shadow: 0 10px 20px rgba(0,0,0,0.2); transition: all 0.4s ease; filter: grayscale(0.8) opacity(0.7);" onmouseover="this.style.filter='grayscale(0) opacity(1)'; this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(37, 99, 235, 0.2)'" onmouseout="this.style.filter='grayscale(0.8) opacity(0.7)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.2)'">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.2818742296415!2d109.6548!3d-7.6747!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zN8KwNDAnMjguOCJTIDEwOcKwMzknMTcuMyJF!5e0!3m2!1sen!2sid!4v1715347200000!5m2!1sen!2sid" 
                        width="100%" height="130" style="border:0; display: block;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

            <!-- Customer Service -->
            <div>
                <strong style="color:#fff; font-size: 16px; display: block; margin-bottom: 16px; font-family: 'Poppins', sans-serif;">Customer Service</strong>
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <a href="https://wa.me/<?= str_replace(['-', ' '], '', $this->config->item('contact_phone')) ?>" target="_blank" style="color: #94A3B8; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                        <i class="fab fa-whatsapp" style="color: #22C55E; font-size: 18px;"></i>
                        <?= $this->config->item('contact_phone') ?>
                    </a>
                    <a href="mailto:<?= $this->config->item('contact_email') ?>" style="color: #94A3B8; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-envelope" style="color: #F97316; font-size: 16px;"></i>
                        <?= $this->config->item('contact_email') ?>
                    </a>
                </div>
            </div>
        </div>

        <div style="border-top: 1px solid rgba(255,255,255,0.05); padding-top: 20px; text-align: center;">
            <p style="color: #64748B; font-size: 12px;">© <?= date('Y') ?> <strong style="color:#94A3B8">RENTCAM</strong> — All Rights Reserved.</p>
        </div>
    </footer>

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 100,
        easing: 'ease-in-out'
    });

    // Sidebar toggle for mobile
    const toggleBtn = document.getElementById('sidebar-toggle');
    const sidebar   = document.querySelector('.sidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => sidebar.classList.toggle('open'));
    }

    // Navbar toggle for mobile
    const navToggle = document.getElementById('navbar-toggle');
    const navCollapse = document.getElementById('navbar-collapse');
    if (navToggle && navCollapse) {
        navToggle.addEventListener('click', () => navCollapse.classList.toggle('show'));
    }

    // Auto-dismiss alerts
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-8px)';
            alert.style.transition = 'all 0.4s ease';
            setTimeout(() => alert.remove(), 400);
        }, 4000);
    });

    // Logout confirmation
    document.querySelectorAll('.logout-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            
            Swal.fire({
                title: 'Konfirmasi Logout',
                text: "Apakah Anda yakin ingin keluar dari akun RENTCAM?",
                icon: 'warning',
                iconColor: '#DC2626',
                showCancelButton: true,
                confirmButtonText: 'Ya, Keluar',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'swal2-premium-popup',
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false,
                backdrop: `rgba(15, 23, 42, 0.5) blur(4px)`
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    });

    // Password Toggle Logic
    document.querySelectorAll('.password-toggle').forEach(toggle => {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            
            if (input.type === 'password') {
                input.type = 'text';
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    });
    </script>
</body>
</html>
