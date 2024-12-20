@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="text-center">Keranjang Belanja</h2>

    @if($cartItems->isEmpty())
        <p class="text-center">Keranjang Anda kosong.</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $cartItem)
                        <tr>
                            <td>{{ $cartItem->menu->name }}</td>
                            <td>Rp{{ number_format($cartItem->menu->price, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.update', $cartItem->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="form-control" style="width: 60px;">
                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Update</button>
                                </form>
                            </td>
                            <td>Rp{{ number_format($cartItem->menu->price * $cartItem->quantity, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Tombol Checkout -->
        <div class="text-right mt-3">
            <a href="{{ route('checkout.index') }}" class="btn btn-success">Checkout</a>
        </div>
    @endif
</div>
@endsection
