<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanans';

    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'harga_produk',
        'jumlah_dipesanan',
        'total_harga',
    ];

    protected $hidden = [];

    public $timestamps = true;

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
