<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProduk extends Model
{
    use HasFactory;

    protected $table = 'foto_produks';

    protected $fillable = [
        'produk_id',
        'foto',
    ];

    protected $hidden = [];

    public $timestamps = true;

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
