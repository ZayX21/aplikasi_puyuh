<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama',
    ];

    protected $hidden = [];

    public $timestamps = true;

    public function kategoriProduk()
    {
        return $this->hasMany(KategoriProduk::class);
    }

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'kategori_produks');
    }
}
