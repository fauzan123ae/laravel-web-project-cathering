@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="text-center">Checkout</h2>

    <div class="card">
        <div class="card-header">
            <h4>Ringkasan Pesanan</h4>
        </div>
        <div class="card-body">
            @php $total = 0; @endphp
            @foreach($cartItems as $cartItem)
                <div class="d-flex justify-content-between">
                    <span>{{ $cartItem->menu->name }} (x{{ $cartItem->quantity }})</span>
                    <span>Rp{{ number_format($cartItem->menu->price * $cartItem->quantity, 0, ',', '.') }}</span>
                </div>
                @php $total += $cartItem->menu->price * $cartItem->quantity; @endphp
            @endforeach
            <hr>
            <div class="d-flex justify-content-between">
                <strong>Total</strong>
                <strong>Rp{{ number_format($total, 0, ',', '.') }}</strong>
            </div>
        </div>
    </div>

    <!-- Form untuk Nama Pembeli dan Alamat -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Data Pembeli</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <!-- Input Nama Pembeli -->
                <div class="form-group">
                    <label for="buyer_name">Nama Pembeli</label>
                    <input type="text" id="buyer_name" name="buyer_name" class="form-control" placeholder="Masukkan nama Anda" required>
                </div>

                <!-- Input Alamat Pembeli -->
                <div class="form-group mt-3">
                    <label for="address">Alamat</label>
                    <textarea id="address" name="address" class="form-control" rows="3" placeholder="Masukkan alamat lengkap Anda" required></textarea>
                </div>

                <div class="text-right mt-4">
                    <!-- Tombol Proses Pembayaran -->
                    <button type="submit" class="btn btn-primary">
                        Proses Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
