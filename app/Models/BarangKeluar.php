<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'barang_keluars';

    protected $fillable = [
        'asset_id',
        'jumlah',
        'tanggal_keluar',
        'penerima_barang',
        'exit_warehouse',
        'keterangan',
    ];

    public function asset()
    {
        return $this->belongsTo(m_asset::class, 'asset_id');
    }
}
