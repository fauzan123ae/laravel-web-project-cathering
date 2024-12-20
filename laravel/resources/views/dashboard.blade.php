<x-app-layout>
    @section('content')
    <body>

        <!-- Hero Section Start -->
        <div class="hero-header mb-5" style="background-image: url('{{ asset('images/platter-2009590.jpg') }}');">
            <div class="container">
                <div class="row align-items-center justify-content-between g-5">
                    <!-- Kolom kiri untuk teks dan tombol -->
                    <div class="col-lg-6 text-center text-lg-start">
                        <h1 class="display-3 text-white animate-slide-in" style="font-weight: bold;">Enjoy Our<br>Delicious Snacks</h1>
                        <p class="text-white animate-slide-in mb-4 pb-2">Dapur Fauzan adalah Catering yang menyediakan aneka NasiBox, Snacks, dan Hantaran</p>
                        <a href="{{ url('/menu') }}" class="btn py-2 px-4" style="background-color:rgb(255, 132, 8); border-color: #FFA500;">Menu</a>

                    </div>
                    <!-- Kolom kanan untuk logo -->
                    <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                        <img class="img-fluid" src="{{ asset('images/11zon_cropped.png') }}" alt="Logo Dapur Fauzan">
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Section End -->

        <!-- Content -->

        <!-- Footer Start -->
        <!-- Footer End -->

        <!-- Bootstrap JS and Dependencies -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    </body>
    @endsection
</x-app-layout>
