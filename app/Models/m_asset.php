<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class m_asset extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'm_assets';

    protected $fillable = [
        'seri',
        'name',
        'description',
        'warehouse_id',
        'date',
        'qr_count',
        'created_by',
        'updated_by',
    ];

    public function warehouse()
    {
        return $this->belongsTo(m_warehouse::class, 'warehouse_id');
    }
}
