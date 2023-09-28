<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_asset extends Model
{
    use HasFactory;
    protected $table = 'm_assets', $guarded = ['id'];

    public function warehouse()
    {
        return $this->belongsTo(m_warehouse::class, 'warehouse_id');
    }
}
