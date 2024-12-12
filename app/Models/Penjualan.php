<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sales',
        'nilai_omset',
        'nama_customer',
        'produk',
        'province_id',
        'city_id',
        'courier',
        'berat',
        'ongkir',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    // Relasi ke tabel City
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
