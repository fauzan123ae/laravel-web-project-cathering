<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            if (!Schema::hasColumn('menus', 'image')) {
                $table->string('image')->nullable()->after('description'); // Tambahkan kolom 'image'
            }
        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            if (Schema::hasColumn('menus', 'image')) {
                $table->dropColumn('image'); // Hapus kolom jika rollback
            }
        });
    }
};
