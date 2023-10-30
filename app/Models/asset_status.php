<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asset_status extends Model
{
    use HasFactory;
    protected $table = 'asset_statuses';

    protected $fillable = [
        'peti_id', //sudah
        'exit_at', //sudah
        'est_pengembalian', //sudah
        'exit_pic', //sudah
        'exit_warehouse', //sudah
        'enter_at',
        'enter_pic',
        'enter_warehouse',
        'kondisi_peti',
        'created_by',
        'updated_by',
    ];

    public function asset()
    {
        return $this->belongsTo(m_asset::class, 'asset_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(m_warehouse::class, 'exit_warehouse');
    }

    public function peti()
    {
        return $this->belongsTo(Peti::class, 'peti_id');
    }

    public function tipe_peti()
    {
        return $this->belongsTo(Type_peti::class, 'type');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
