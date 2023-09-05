<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans';

    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'tanggal',
        'alamat_pengiriman',
        'total_harga',
        'status',
    ];

    protected $hidden = [];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }    
}
