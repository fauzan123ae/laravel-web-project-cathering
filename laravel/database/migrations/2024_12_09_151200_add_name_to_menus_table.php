<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            if (!Schema::hasColumn('menus', 'name')) {
                $table->string('name')->after('id'); // Tambahkan kolom 'name'
            }
        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            if (Schema::hasColumn('menus', 'name')) {
                $table->dropColumn('name'); // Hapus kolom 'name' jika migrasi di-rollback
            }
        });
    }
};
