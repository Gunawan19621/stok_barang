<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asset_status extends Model
{
    use HasFactory;
    protected $table = 'asset_statuses';

    protected $fillable = [
        'asset_id',
        'exit_at',
        'exit_pic',
        'exit_warehouse',
        'enter_at',
        'enter_pic',
        'enter_warehouse',
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
}
