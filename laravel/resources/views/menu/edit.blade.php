@extends('layouts.master')
@section('content')
<div class="container mt-5">
    <h2>Edit Menu</h2>
    <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $menu->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Category</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ $menu->type }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($menu->image)
                <p>Current Image:</p>
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}" width="100">
            @endif
        </div>
        <div>
            <label for="price">Harga</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $menu->price ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Menu</button>
        <a href="{{ route('menu.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
