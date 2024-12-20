<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            if (!Schema::hasColumn('menus', 'type')) {
                $table->string('type')->after('id'); // Tambahkan kolom 'type'
            }
        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            if (Schema::hasColumn('menus', 'type')) {
                $table->dropColumn('type'); // Hapus kolom 'type' jika migrasi di-rollback
            }
        });
    }
};
