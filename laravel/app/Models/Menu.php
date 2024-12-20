<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'type',
        'image',
    ];
    protected $dates = ['deleted_at'];

    // Relasi dengan model Cart (satu Menu dapat ada di banyak Cart)
    public function carts()
    {
        return $this->hasMany(Cart::class); // Menghubungkan Menu dengan banyak Cart
    }

}
