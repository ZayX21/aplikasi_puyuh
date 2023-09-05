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
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn('total_harga');
        });
        Schema::table('pesanans', function (Blueprint $table) {
            $table->decimal('total_harga', 10, 2)->after('alamat_pengiriman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesanans', function (Blueprint $table) {
            // Hapus kolom total_harga yang baru
            $table->dropColumn('total_harga');
        });

        Schema::table('pesanans', function (Blueprint $table) {
            // Tambahkan kembali kolom total_harga dengan tipe data double
            $table->double('total_harga')->after('alamat_pengiriman');
        });
    }
};
