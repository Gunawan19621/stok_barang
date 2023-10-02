<?php

namespace App\Exports;

use App\Models\m_asset;
use Maatwebsite\Excel\Concerns\FromCollection;

class AssetExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return m_asset::all();
    }
}
