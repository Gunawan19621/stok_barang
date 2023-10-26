<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_warehouse extends Model
{
    use HasFactory;
    protected $table = 'm_warehouses';

    protected $fillable = [
        'name',
        'description',
        'address',
        'created_by',
        'updated_by',
    ];
}
