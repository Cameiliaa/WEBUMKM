<!-- navbar.blade.php -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-lg fixed-top" style="background: linear-gradient(135deg, #ff0000 0%, #ffffff 50%, #000000 100%);
; backdrop-filter: blur(10px);">
    <div class="container">
        <a class="navbar-brand fw-bold fs-3" href="#" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
            <span class="text-white">Jajanan</span><span class="text-dark"> Rakyat</span>
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link text-white fw-semibold px-3 py-2 rounded-pill position-relative overflow-hidden" href="{{ route('tamu.dashboard') }}" style="transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.2)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.backgroundColor='transparent'; this.style.transform='translateY(0)'">
                        <i class="fas fa-box-open me-2"></i>Produk
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link text-white fw-semibold px-3 py-2 rounded-pill position-relative overflow-hidden" href="{{ route('tamu.pesanan.create') }}" style="transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.2)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.backgroundColor='transparent'; this.style.transform='translateY(0)'">
                        <i class="fas fa-receipt me-2"></i>Pesanan
                    </a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link text-white fw-semibold px-3 py-2 rounded-pill position-relative overflow-hidden" href="{{ route('tamu.pesanan.history') }}" style="transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='rgba(255,255,255,0.2)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.backgroundColor='transparent'; this.style.transform='translateY(0)'">
                        <i class="fas fa-history me-2"></i>Riwayat
                    </a>
                </li>
                @auth
                <li class="nav-item mx-2">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="nav-link bg-danger text-white fw-bold px-4 py-2 rounded-pill shadow border-0"
                                style="transition: all 0.3s ease;"
                                onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 5px 15px rgba(220,53,69,0.4)'"
                                onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)'">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </li>
            @else
                <li class="nav-item mx-2">
                    <a class="nav-link bg-warning text-dark fw-bold px-4 py-2 rounded-pill shadow"
                       href="{{ route('login') }}"
                       style="transition: all 0.3s ease;"
                       onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 5px 15px rgba(255,193,7,0.4)'"
                       onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 2px 4px rgba(0,0,0,0.1)'">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                </li>
            @endauth
            
            </ul>
        </div>
    </div>
</nav>

<!-- Add padding to body to compensate for fixed navbar -->
<style>
    body { padding-top: 80px; }
    @media (max-width: 991px) {
        body { padding-top: 70px; }
    }
</style>