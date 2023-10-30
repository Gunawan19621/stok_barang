<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peti extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'petis';

    protected $fillable = [
        'tipe_peti_id',
        'warna',
        'customer_id',
        'warehouse_id',
        'jumlah',
        'date_pembuatan',
        'status_disposal',
        'packing_no',
        'fix_lot',
        'created_by',
        'updated_by',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function warehouse()
    {
        return $this->belongsTo(m_warehouse::class, 'warehouse_id');
    }
    public function tipe_peti()
    {
        return $this->belongsTo(Type_peti::class, 'tipe_peti_id');
    }
}
