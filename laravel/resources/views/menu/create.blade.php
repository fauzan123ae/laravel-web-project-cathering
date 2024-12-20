@extends('layout.app')

@section('content')
<div class="container">
    <h1>Tambah Menu</h1>
    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="type" class="form-label">Kategori</label>
            <select name="type" id="type" class="form-control" required>
                <option value="Makanan">Makanan</option>
                <option value="Snack">Snack</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Menu</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div>
            <label for="price">Harga</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $menu->price ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
