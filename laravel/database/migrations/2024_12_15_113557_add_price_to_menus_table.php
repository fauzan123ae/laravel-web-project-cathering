<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Mengecek apakah kolom 'price' sudah ada
        if (!Schema::hasColumn('menus', 'price')) {
            Schema::table('menus', function (Blueprint $table) {
                $table->decimal('price', 10, 2)->nullable();
            });
        }
    }
    
    public function down()
    {
        // Menghapus kolom 'price' jika ada
        Schema::table('menus', function (Blueprint $table) {
            if (Schema::hasColumn('menus', 'price')) {
                $table->dropColumn('price');
            }
        });
    }
    
};
