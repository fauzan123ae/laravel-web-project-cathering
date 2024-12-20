@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Trashed Menus</h2>
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
                            <td>${{ number_format($menu->price, 2) }}</td>
                            <td>
                                <form action="{{ route('menu.restore', $menu->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                </form>

                                <form action="{{ route('menu.forceDelete', $menu->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to permanently delete this menu?')">Delete Permanently</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No trashed menus available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
