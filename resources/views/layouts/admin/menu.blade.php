<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link text-white {{(Request::routeIs('admin.dashboard') ? 'active':'')}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
            </a>
        </li>
           
        <li class="nav-item">
            <a href="{{route('admin.kelola-admin.index')}}" class="nav-link text-white {{(Request::routeIs('admin.kelola-admin.index') ? 'active':'')}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>Kelola Admin</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.kelola-pelanggan.index')}}" class="nav-link text-white {{(Request::routeIs('admin.kelola-pelanggan.index') ? 'active':'')}}">
                <i class="nav-icon fas fa-users"></i>
                <p>Kelola Pengguna</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.produk.index')}}" class="nav-link text-white {{(Request::routeIs('admin.produk.index') ? 'active':'')}}">
                <i class="nav-icon fas fa-box-open"></i>
                <p>Kelola Produk</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('admin.pesanan.index')}}" class="nav-link text-white {{(Request::routeIs('admin.pesanan.index') ? 'active':'')}}">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>Kelola Pesanan</p>
            </a>
        </li>
        
                                                          
        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden>
                @csrf
            </form>
            <a href="#" class="nav-link text-white @yield('')"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>          
    </ul>
</nav>