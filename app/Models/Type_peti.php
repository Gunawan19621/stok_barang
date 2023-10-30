<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type_peti extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'type_petis';

    protected $fillable = [
        'type',
        'size_peti',
        'description',
        'created_by',
        'updated_by',
    ];
}
