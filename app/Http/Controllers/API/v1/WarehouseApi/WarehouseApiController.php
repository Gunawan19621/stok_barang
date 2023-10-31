<?php

namespace App\Http\Controllers\API\v1\WarehouseApi;

use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class WarehouseApiController extends Controller
{
    public function index()
    {
        $warehouse = \App\Models\m_warehouse::all();

        return ResponseFormatter::success([
            'status' => true,
            'message' => 'Data warehouse berhasil diambil',
            'warehouse' => $warehouse
        ]);
    }
}
