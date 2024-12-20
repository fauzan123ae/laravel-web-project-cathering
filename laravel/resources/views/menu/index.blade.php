@extends('layouts.master')

@section('content')

<!-- Menu Section -->
<div class="container mt-5">
    <!-- Judul Menu -->
    <div class="heading_container heading_center text-center mb-4">
        <h2 class="menu-title">Our Menu</h2>
    </div>

    <!-- Filter Tab -->
    <div class="filter-container text-center mb-4">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link {{ request('type') == '' ? 'active' : '' }}" href="{{ route('menu.index') }}" style="color: black;">All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('type') == 'Makanan' ? 'active' : '' }}" href="{{ route('menu.index', ['type' => 'Makanan']) }}" style="color: black;">Makanan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request('type') == 'Snack' ? 'active' : '' }}" href="{{ route('menu.index', ['type' => 'Snack']) }}" style="color: black;">Snack</a>
            </li>
        </ul>
    </div>

    <!-- Menu Grid Section -->
    <div class="row">
        @forelse($menus as $menu)
        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card shadow-sm h-100">
                @if ($menu->image)
                    <div class="image-container" style="cursor: pointer;" onclick="showImageModal('{{ asset('storage/' . $menu->image) }}')">
                        <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top" alt="{{ $menu->name }}" style="object-fit: cover; height: 200px;">
                    </div>
                @else
                    <div class="d-flex justify-content-center align-items-center bg-light" style="height: 200px;">
                        <span class="text-muted">No Image</span>
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-truncate" style="min-height: 50px;">{{ $menu->name }}</h5>
                    <p class="card-text text-muted text-truncate" style="height: 60px;">{{ $menu->description }}</p>
                    <p class="card-text text-muted"><strong>Price:</strong> Rp{{ number_format($menu->price, 0, ',', '.') }}</p>

                    <!-- Form untuk menambahkan menu ke keranjang -->
                    <form action="{{ route('cart.add', $menu->id) }}" method="POST" class="d-inline mt-auto">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-plus" aria-hidden="true"></i> Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <p>No menu available at the moment. Please try again later.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal untuk Menampilkan Foto Full -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Menu Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="modalImage" src="" class="img-fluid" alt="Menu Image">
      </div>
    </div>
  </div>
</div>

<script>
  // Fungsi untuk menampilkan modal dengan gambar
  function showImageModal(imageUrl) {
    $('#modalImage').attr('src', imageUrl); // Ubah sumber gambar modal dengan URL gambar yang diklik
    $('#imageModal').modal('show'); // Tampilkan modal
  }
</script>

@endsection
