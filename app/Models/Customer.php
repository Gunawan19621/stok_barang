<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'code_customer',
        'lot_no',
        'no_tlp',
        'address',
        'created_by',
        'updated_by',
    ];
}
