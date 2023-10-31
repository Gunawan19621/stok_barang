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
        'exit_pic', // di controler
        'exit_warehouse', //sudah
        'enter_at', // //sudah
        'enter_pic', // //sudah
        'enter_warehouse', // //sudah
        'kondisi_peti', // //sudah
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
