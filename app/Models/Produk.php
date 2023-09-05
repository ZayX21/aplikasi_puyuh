<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
    ];

    protected $hidden = [];

    public $timestamps = true;

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }

    public function fotoProduk()
    {
        return $this->hasMany(FotoProduk::class);
    }

    public function keranjang()
    {
        return $this->hasOne(FotoProduk::class);
    }

    public function kategori()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_produks');
    }

    public function kategoriProduk()
    {
        return $this->hasMany(KategoriProduk::class);
    }

    public function jumlahTerjual()
    {
        return $this->hasMany(DetailPesanan::class, 'produk_id')->sum('jumlah_dipesanan');
    }
}
