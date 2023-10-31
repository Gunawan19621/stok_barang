<?php

namespace App\Http\Controllers\API\v1\AssetStatusApi;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AssetStatusApiController extends Controller
{
    public function index()
    {
        $m_asset = \App\Models\Peti::with(['warehouse', 'tipe_peti', 'customer'])->get();

        return ResponseFormatter::success([
            'message' => 'Data asset berhasil diambil',
            'asset' => $m_asset
        ]);
    }
}
