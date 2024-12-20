<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID pengguna (opsional)
            $table->unsignedBigInteger('menu_id'); // ID menu
            $table->string('name'); // Nama menu
            $table->decimal('price', 10, 2); // Harga menu
            $table->integer('quantity'); // Kuantitas
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
