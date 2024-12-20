<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            if (!Schema::hasColumn('menus', 'description')) {
                $table->text('description')->nullable()->after('name'); // Menambahkan kolom 'description'
            }
        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            if (Schema::hasColumn('menus', 'description')) {
                $table->dropColumn('description'); // Menghapus kolom 'description' jika rollback
            }
        });
    }
};
