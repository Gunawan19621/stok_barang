<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $table = 'barang_keluars', $guarded = ['id'];

    public function asset()
    {
        return $this->belongsTo(m_asset::class, 'asset_id');
    }
}
