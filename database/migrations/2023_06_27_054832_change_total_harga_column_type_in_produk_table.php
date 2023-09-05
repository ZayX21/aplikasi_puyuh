<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('harga');
        });
        Schema::table('produks', function (Blueprint $table) {
            $table->decimal('harga', 10, 2)->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            // Hapus kolom total_harga yang baru
            $table->dropColumn('harga');
        });

        Schema::table('produks', function (Blueprint $table) {
            // Tambahkan kembali kolom total_harga dengan tipe data double
            $table->double('harga')->after('deskripsi');
        });
    }
};
