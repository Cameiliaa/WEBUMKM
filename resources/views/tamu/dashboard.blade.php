<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JajananRakyat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Include Navbar -->
    @include('layouts.user.navbar')

    <!-- Hero Section -->
    <section id="home" class="bg-light py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold text-dark">UMKM Jajanan Rakyat</h1>
                    <p class="lead">
                        Sajian keripik khas Nusantara yang renyah, lezat, dan dibuat langsung oleh pelaku UMKM lokal dengan menjaga kualitas, kebersihan, dan cita rasa tradisional. Dukung produk Indonesia dengan setiap gigitan!
                    </p>                    
                    <a href="#kontak" class="btn btn-success btn-lg">Pesan Sekarang</a>
                </div>
                <div class="col-lg-6">
                    <img src="assets/img/inoventa.png" class="img-fluid rounded shadow w-50" style="margin-left: 50px;" alt="Jajanan Rakyat">


                </div>
                
            </div>
        </div>
    </section>
    
    <!-- Produk Section -->
    <section id="produk" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold text-primary">Produk Kami</h2>

            @foreach ($produks->chunk(3) as $produkChunk)
                <div class="row">
                    @foreach ($produkChunk as $produk)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                                <div class="ratio ratio-4x3 overflow-hidden">
                                    <img src="{{ asset($produk->gambar) }}" class="card-img-top object-fit-cover transition" alt="{{ $produk->nama_produk }}">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fw-semibold">{{ $produk->nama_produk }}</h5>
                                    <span class="badge bg-success fs-6">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach

        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang-kami" class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <!-- Gambar -->
                <div class="col-lg-6 mb-4 mb-lg-0 text-center">
                    <img src="{{ asset('assets/img/inoventa.png') }}"
                         alt="Tentang Kami" 
                         class="img-fluid rounded-circle shadow-sm" 
                         style="width: 400px; height: 400px; object-fit: cover;">
                </div>
    
                <!-- Konten Tentang Kami -->
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Tentang Kami</h2>
                    <p>
                        UMKM Jajanan Rakyat adalah usaha mikro yang bergerak di bidang kuliner tradisional, khususnya dalam produksi dan pemasaran berbagai jenis keripik khas Indonesia. Kami menghadirkan aneka keripik seperti keripik pisang, keripik singkong, keripik apel, keripik bakso, keripik mangga, dan banyak lagi, yang semuanya diolah dengan resep warisan turun-temurun serta bahan-bahan berkualitas dari petani lokal.
                    </p>
                    <p>
                        Komitmen kami adalah menjaga cita rasa otentik dari setiap produk yang kami hasilkan. Setiap keripik diproses secara higienis dengan teknik pengolahan tradisional yang dipadukan dengan inovasi kekinian, sehingga menghasilkan camilan yang renyah, lezat, dan tentunya sehat.
                    </p>
                    <p>
                        Kami juga bertekad untuk mendukung pertumbuhan ekonomi masyarakat dengan memberdayakan tenaga kerja lokal dan menggunakan bahan baku hasil bumi Indonesia. Dukungan Anda adalah semangat kami untuk terus berkarya dan menjaga warisan kuliner bangsa.
                    </p>
    
                    <!-- Icon Kelebihan -->
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="text-center">
                                <i class="fas fa-utensils text-success fs-1"></i>
                                <h6 class="mt-2">Rasa Otentik</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center">
                                <i class="fas fa-store text-success fs-1"></i>
                                <h6 class="mt-2">Dukung UMKM</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    



    <!-- Include Footer -->
    @include('layouts.user.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>