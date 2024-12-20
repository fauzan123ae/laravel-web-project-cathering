@extends('layouts.master')

@section('content') 
@if(auth()->user()->hasRole('admin'))
<!-- Konten yang hanya bisa dilihat oleh admin -->
<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-info">
          <p>Selamat Datang admin.</p>
        </div>
    </div>
  </div>
</div>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-center">Menu Management</h2>
        <div>
        <a href="{{ route('menu.trashed') }}" class="btn btn-secondary me-2">View Trashed Menus</a>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMenuModal">Add New Menu</button>
    </div>
      </div>

      <!-- Success Message -->
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <!-- Menu Table -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            <th>Category</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($menus as $menu)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $menu->name }}</td>
              <td>{{ $menu->description }}</td>
              <td>
                @if($menu->image)
                  <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="50" height="50">
                @else
                  No Image
                @endif
              </td>
              <td>{{ $menu->type }}</td>
              <td>${{ number_format($menu->price, 2) }}</td> <!-- Menampilkan harga -->
              <td>
                <!-- Tombol Edit -->
                <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>

                <!-- Tombol Hapus -->
                <form action="{{ route('menu.destroy', $menu->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this menu?')">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7">No data available</td>
            </tr>
          @endforelse
        </tbody>
      </table>

      <!-- Add Menu Modal -->
      <div class="modal fade" id="addMenuModal" tabindex="-1" aria-labelledby="addMenuModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addMenuModalLabel">Add New Menu</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label">Description</label>
                  <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="mb-3">
                  <label for="type" class="form-label">Category</label>
                  <select class="form-control" id="type" name="type" required>
                    <option value="Makanan">Makanan</option>
                    <option value="Snack">Snack</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="image" class="form-label">Image</label>
                  <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="mb-3">
                  <label for="price" class="form-label">Price</label>
                  <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Menu</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@else
  <!-- Konten untuk pengguna selain admin -->
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger">
          <p>Anda tidak memiliki akses ke halaman ini.</p>
        </div>
      </div>
    </div>
  </div>
@endif
