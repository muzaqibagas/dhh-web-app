<div class="topbar">
    <div class="logo-left">
        <div class="logo header-logo">
            <img src="{{ asset('img/dhhputih.png') }}" alt="DHH Logo">
        </div>
        <button class="burger-btn" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
    </div>
    <div class="user-info">
        <i class="bi bi-person-circle"></i>
        @if (Auth::guard('staff')->check())
            {{ Auth::guard('staff')->user()->username }}
        @elseif(Auth::check())
            {{ Auth::user()->username }}
        @else
            Guest
        @endif

    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const burger = document.getElementById('sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        const mainContainer = document.querySelector('.main-container');

        burger.addEventListener('click', () => {
            // kalau layar kecil (HP/tablet), pakai overlay sidebar
            if (window.innerWidth <= 992) {
                sidebar.classList.toggle('active');
            } else {
                // kalau layar besar, pakai mode collapsed biasa
                mainContainer.classList.toggle('collapsed');
            }
        });

        // Saat resize, pastikan sidebar kembali normal di layar besar
        window.addEventListener('resize', () => {
            if (window.innerWidth > 992) {
                sidebar.classList.remove('active'); // hilangkan overlay
            }
        });
    });
</script>
