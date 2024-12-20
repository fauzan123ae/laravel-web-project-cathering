<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'refreshCartCount'];

    public function mount()
    {
        $this->cartCount = $this->getCartCount();
    }

    public function getCartCount()
    {
        return Cart::where('user_id', Auth::id())->sum('quantity');
    }

    public function refreshCartCount()
    {
        $this->cartCount = $this->getCartCount();
    }

    public function render()
    {
        return view('livewire.cart-count');
    }
}
