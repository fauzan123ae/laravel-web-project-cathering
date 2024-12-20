<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart($menuId)
    {
        $menu = Menu::findOrFail($menuId);
        $user = Auth::user();

        // Cek jika menu sudah ada di keranjang
        $cartItem = Cart::where('user_id', $user->id)
                        ->where('menu_id', $menuId)
                        ->first();

        if ($cartItem) {
            // Jika sudah ada, update quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Jika belum ada, buat item baru
            Cart::create([
                'user_id' => $user->id,
                'menu_id' => $menuId,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('menu.index');
    }

    public function index()
    {
        $user = Auth::user();
        $cartItems = Cart::with('menu')->where('user_id', $user->id)->get();
        return view('cart.index', compact('cartItems'));
    }

    public function updateQuantity(Request $request, $cartId)
    {
        $cartItem = Cart::findOrFail($cartId);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart.index');
    }

    public function removeFromCart($cartId)
    {
        Cart::destroy($cartId);
        return redirect()->route('cart.index');
    }

    public function checkout()
{
    $user = Auth::user();
    $cartItems = Cart::with('menu')->where('user_id', $user->id)->get();

    return view('checkout.index', compact('cartItems'));
}

public function processCheckout(Request $request)
{
    $request->validate([
        'buyer_name' => 'required|string|max:255',
        'address' => 'required|string',
    ]);

    $user = Auth::user();
    $cartItems = Cart::with('menu')->where('user_id', $user->id)->get();

    // Format pesan untuk WhatsApp
    $message = "Halo, saya ingin memesan:\n";
    foreach ($cartItems as $item) {
        $message .= "- {$item->menu->name} x {$item->quantity}\n";
    }
    $message .= "\nNama: {$request->buyer_name}\nAlamat: {$request->address}";
    $message .= "\nTerima kasih!";

    // Encode pesan untuk URL
    $whatsappMessage = urlencode($message);
    $whatsappNumber = '6281937307515'; // Ganti dengan nomor WA Anda

    // Kosongkan keranjang setelah checkout
    Cart::where('user_id', $user->id)->delete();

    // Redirect ke WhatsApp
    return redirect()->away("https://wa.me/{$whatsappNumber}?text={$whatsappMessage}");
}





}
