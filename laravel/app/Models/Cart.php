<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'menu_id',
        'quantity',
    ];

    // Relasi dengan model Menu (setiap Cart berhubungan dengan satu Menu)
    public function menu()
    {
        return $this->belongsTo(Menu::class); // Menghubungkan Cart dengan Menu
    }
}
