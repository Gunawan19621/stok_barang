<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asset_status extends Model
{
    use HasFactory;
    protected $table = 'asset_statuses', $guarded = ['id'];

    public function asset()
    {
        return $this->belongsTo(m_asset::class, 'asset_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(m_warehouse::class, 'exit_warehouse');
    }
}
