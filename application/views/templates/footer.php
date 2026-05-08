    <footer class="footer">
        <p>© <?= date('Y') ?> <strong style="color:#fff">RENTCAM</strong> — Platform Rental Kamera & Drone</p>
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
