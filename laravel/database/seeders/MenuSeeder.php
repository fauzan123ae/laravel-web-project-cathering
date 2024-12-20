<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel menus.
     *
     * @return void
     */
    public function run()
    {
        // Contoh data menu awal
        $menus = [
            [
                'type' => 'Makanan',
                'name' => 'Nasi Goreng',
                'description' => 'Nasi goreng dengan telur dan ayam.',
                'image' => 'images/f1.png', // Atur ke jalur file gambar jika ada
            ],
            [
                'type' => 'Snack',
                'name' => 'Keripik Kentang',
                'description' => 'Keripik kentang renyah dengan rasa barbeque.',
                'image' =>'images/f2.png', // Atur ke jalur file gambar jika ada
            ],
            [
                'type' => 'Makanan',
                'name' => 'Sate Ayam',
                'description' => 'Sate ayam dengan bumbu kacang.',
                'image' => 'images/f3.png', // Atur ke jalur file gambar jika ada
            ],
            [
                'type' => 'Snack',
                'name' => 'Donat',
                'description' => 'Donat dengan taburan gula halus.',
                'image' => 'images/f4.png', // Atur ke jalur file gambar jika ada
            ],
        ];

        // Masukkan data ke dalam tabel menus
        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}