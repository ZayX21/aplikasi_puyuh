<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    use HasFactory;

    protected $table = 'kategori_produks';

    protected $fillable = [
        'kategori_id',
        'produk_id',
    ];

    protected $hidden = [];

    public $timestamps = true;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
