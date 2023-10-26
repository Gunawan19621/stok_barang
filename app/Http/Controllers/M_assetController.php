<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\m_asset;
use BaconQrCode\Writer;
use Barryvdh\DomPDF\PDF;
use App\Models\m_warehouse;
use App\Exports\AssetExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use BaconQrCode\Renderer\ImageRenderer;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;


class M_assetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'asset' => m_asset::get(),
            'warehouse' => m_warehouse::all(),
            'active' => 'menu-asset',
        ];
        return view('dashboard.Master_Data.Asset.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $latestAsset = \App\Models\m_asset::latest()->first();
        $currentYear = date("Y-m-d");
        if ($latestAsset == null) {
            $nomorUrut = 1;
        } else {
            $lastCode = substr($latestAsset->seri, 7);
            $nomorUrut = intval($lastCode) + 1;
        }
        $seri = 'AST' . $currentYear . '-' . str_pad($nomorUrut, STR_PAD_LEFT);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'warehouse_id' => 'required',
            'date' => 'required',
            'qr_count' => 'nullable'
        ]);
        // dd($request);
        try {
            $currentUser = Auth::user();
            $validatedData = $request->except('_token');
            $validatedData['seri'] = $seri;
            $validatedData['created_by'] = $currentUser->fullname;
            $validatedData['updated_by'] = $currentUser->fullname;
            \App\Models\m_asset::create($validatedData);
            return redirect()->back()->with('success', 'Data asset berhasil ditambah.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data asset gagal ditambah.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = [
            'asset' => m_asset::find($id),
            'warehouse' => m_warehouse::all(),
            'active' => 'menu-asset',
        ];
        return view('dashboard.Master_Data.Asset.show', $data);
    }

    // Menampilkan data QR
    // public function QR($id)
    // {
    //     $asset = m_asset::find($id);
    //     return QrCode::generate(
    //         'Hello, World!',
    //     );
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'warehouse_id' => 'required',
            'date' => 'required',
        ]);
        try {
            $asset = m_asset::findOrFail($id);
            $asset->update($request->all());
            return redirect()->back()->with('success', 'Data asset berhasil diperbaharui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data asset gagal diperbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd("oke");
        try {
            $asset = m_asset::findOrFail($id);
            $asset->delete();
            return redirect()->back()->with('success', 'Data asset berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data asset gagal dihapus');
        }
    }

    /**
     * Cetak PDF.
     */
    public function cetakpdf()
    {
        // dd('oke');
        $asset = m_asset::all();

        // Buat objek Dompdf
        $dompdf = new Dompdf();
        // Render tampilan ke PDF
        $html = view('dashboard.Master_Data.Asset.asset_pdf', compact('asset'))->render();

        // Muat HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Atur ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Tampilkan PDF di browser
        return $dompdf->stream('Laporan Assets');
    }

    /**
     * Cetak Exel.
     */
    public function export()
    {
        return Excel::download(new AssetExport, 'Laporan Assets.xlsx');
    }
}
