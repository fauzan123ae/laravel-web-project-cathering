<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class MenuController extends Controller
{
    /**
     * Menampilkan daftar semua menu.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $type = $request->input('type');

        // Query dasar untuk mengambil menu
        $query = Menu::query();

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
        }

        if ($type) {
            $query->where('type', $type);
        }
        
        // Menambahkan filter berdasarkan kategori (type)
        if ($request->has('type') && in_array($request->type, ['Makanan', 'Snack'])) {
            $query->where('type', $request->type);
        }

        $menus = $query->get();

        return view('menu.index', compact('menus'));
    }

    /**
     * Menampilkan halaman formulir untuk membuat menu baru.
     */
    public function crud()
    {
        $menus = Menu::all();
        return view('menu.crud', compact('menus'));
    }

    public function cart()
    {
        return view('menu.cart');
    }
    
    /**
     * Menyimpan menu baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'required|in:Makanan,Snack',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price'       => 'required|numeric|min:0',
        ]);

        // Menyimpan gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Menyimpan data menu baru ke database
        Menu::create([
            'name'        => $request->name,
            'description' => $request->description,
            'type'        => $request->type,
            'image'       => $imagePath,
            'price'       => $request->price,
        ]);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Menampilkan halaman formulir untuk mengedit menu yang sudah ada.
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.edit', compact('menu'));
    }

    /**
     * Memperbarui data menu yang sudah ada di database.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'type'        => 'required|in:Makanan,Snack',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price'       => 'required|numeric|min:0',
        ]);

        $menu = Menu::findOrFail($id);

        // Gunakan image lama jika tidak mengupload gambar baru
        $imagePath = $menu->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('image', 'public');
        }

        // Update data menu
        $menu->update([
            'type'        => $request->type,
            'name'        => $request->name,
            'description' => $request->description,
            'image'       => $imagePath,
            'price'       => $request->price,
        ]);

        return redirect()->route('menu.crud')->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Menghapus menu dari database.
     */
    public function destroy($id)
{
    $menu = Menu::findOrFail($id);

    // Soft delete
    $menu->delete();

    return redirect()->route('menu.crud')->with('success', 'Menu berhasil dihapus!');
}
public function trashed()
{
    $menus = Menu::onlyTrashed()->get();
    return view('menu.trashed', compact('menus'));
}

public function restore($id)
{
    $menu = Menu::onlyTrashed()->findOrFail($id);
    $menu->restore();

    return redirect()->route('menu.crud')->with('success', 'Menu berhasil dipulihkan!');
}

public function forceDelete($id)
{
    $menu = Menu::onlyTrashed()->findOrFail($id);

    // Hapus file gambar jika ada
    if ($menu->image && file_exists(storage_path('app/public/' . $menu->image))) {
        unlink(storage_path('app/public/' . $menu->image));
    }

    $menu->forceDelete();

    return redirect()->route('menu.crud')->with('success', 'Menu berhasil dihapus secara permanen!');
}



    /**
     * Mengatur user dengan ID 1 sebagai admin.
     */
    public function makeAdmin()
    {
        $user = User::find(1);

        // Cek apakah role admin sudah ada, jika belum buat
        $role = Role::firstOrCreate(['name' => 'admin']);

        // Assign role admin ke user
        $user->assignRole($role);

        return "User dengan ID 1 telah menjadi admin.";
    }
}
    