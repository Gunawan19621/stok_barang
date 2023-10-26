<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barang_masuks';

    protected $fillable = [
        'asset_id',
        'jumlah',
        'tanggal_masuk',
        'asal_barang',
        'pengiriman_barang',
        'penerima_barang',
        'enter_warehouse',
        'keterangan',
    ];
}
