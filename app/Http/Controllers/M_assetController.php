<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\m_asset;
use Barryvdh\DomPDF\PDF;
use App\Models\m_warehouse;
use App\Exports\AssetExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class M_assetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asset = m_asset::get();
        $warehouse = m_warehouse::all();
        return view('MasterData.asset', compact('asset', 'warehouse'));
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
    // public function store(Request $request)
    // {
    //     $latestAsset = \App\Models\m_asset::latest()->first();
    //     // Mendapatkan tahun saat ini
    //     $currentYear = date("Y");
    //     // Menghitung nomor urut untuk kode barang
    //     if ($latestAsset == null) {
    //         // Kode pertama
    //         $nomorUrut = 1;
    //     } else {
    //         // Kode berikutnya
    //         $lastCode = substr($latestAsset->seri, 7);
    //         $nomorUrut = intval($lastCode) + 1;
    //     }
    //     // Menggabungkan semua komponen kode barang
    //     $seri = 'AST' . $currentYear . str_pad($nomorUrut, STR_PAD_LEFT);
    //     // Validasi input
    //     $request->validate([
    //         'name' => 'required',
    //         'description' => 'required',
    //         'warehouse_id' => 'required',
    //         'date' => 'required',
    //         'qr_count' => '',
    //     ]);
    //     try {
    //         $currentUser = Auth::user();
    //         // Menyiapkan data untuk disimpan
    //         $validatedData = $request->except('_token');
    //         $validatedData['seri'] = $seri;
    //         $validatedData['created_by'] = $currentUser->id; // Menambahkan ID pengguna sebagai created_by
    //         $validatedData['updated_by'] = $currentUser->id; // Menambahkan ID pengguna sebagai updated_by

    //         // Menyimpan data ke dalam database
    //         $newAsset = \App\Models\m_asset::create($validatedData);

    //         // Membuat QR code dan menyimpannya ke dalam basis data
    //         $dataForQR = [
    //             'seri' => $newAsset->seri,
    //             'name' => $newAsset->name,
    //             // ... tambahkan lebih banyak data sesuai kebutuhan ...
    //         ];

    //         $qrCode = QrCode::size(300)->generate(json_encode($dataForQR));

    //         // Menyimpan QR code ke dalam kolom 'qr_code' di tabel asset (perbaikan)
    //         $newAsset->update(['qr_count' => $qrCode]);

    //         return redirect()->back()->with('success', 'Data asset berhasil ditambah.');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', 'Data asset gagal ditambah.');
    //     }
    // }

    // public function store(Request $request)
    // {
    //     $latestAsset = \App\Models\m_asset::latest()->first();

    //     // Mendapatkan tahun saat ini
    //     $currentYear = date("Y");

    //     // Menghitung nomor urut untuk kode barang
    //     if ($latestAsset == null) {
    //         // Kode pertama
    //         $nomorUrut = 1;
    //     } else {
    //         // Kode berikutnya
    //         $lastCode = substr($latestAsset->seri, 7);
    //         $nomorUrut = intval($lastCode) + 1;
    //     }

    //     // Menggabungkan semua komponen kode barang
    //     $seri = 'AST' . $currentYear . str_pad($nomorUrut, STR_PAD_LEFT);

    //     // Validasi input
    //     $request->validate([
    //         'name' => 'required',
    //         'description' => 'required',
    //         'warehouse_id' => 'required',
    //         'date' => 'required',
    //         'qr_count' => '',
    //     ]);

    //     try {
    //         $currentUser = Auth::user();

    //         // Menyiapkan data untuk disimpan
    //         $validatedData = $request->except('_token');
    //         $validatedData['seri'] = $seri;
    //         $validatedData['created_by'] = $currentUser->id; // Menambahkan ID pengguna sebagai created_by
    //         $validatedData['updated_by'] = $currentUser->id; // Menambahkan ID pengguna sebagai updated_by

    //         // Menyimpan data ke dalam database
    //         $newAsset = \App\Models\m_asset::create($validatedData);

    //         // Generate QR code and save it as an image in the public directory
    //         $dataForQR = [
    //             'seri' => $newAsset->seri,
    //             'name' => $newAsset->name,
    //             // ... tambahkan lebih banyak data sesuai kebutuhan ...
    //         ];

    //         $qrCode = QrCode::format('png')->size(300)->generate(json_encode($dataForQR));

    //         // Menyimpan QR code sebagai gambar di direktori penyimpanan publik
    //         $qrCodePath = 'qr_codes/' . $seri . '.png';
    //         Storage::disk('public')->put($qrCodePath, $qrCode);

    //         // Menyimpan URL gambar QR code ke dalam kolom 'qr_count'
    //         $newAsset->update(['qr_count' => $qrCodePath]);

    //         return redirect()->back()->with('success', 'Data asset berhasil ditambah.');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', 'Data asset gagal ditambah.');
    //     }
    // }
    public function store(Request $request)
    {
        // dd($request);
        $latestAsset = \App\Models\m_asset::latest()->first();
        // Mendapatkan tahun saat ini
        $currentYear = date("Y");
        // Menghitung nomor urut untuk kode barang
        if ($latestAsset == null) {
            // Kode pertama
            $nomorUrut = 1;
        } else {
            // Kode berikutnya
            $lastCode = substr($latestAsset->seri, 7);
            $nomorUrut = intval($lastCode) + 1;
        }
        // Menggabungkan semua komponen kode barang
        $seri = 'AST' . $currentYear . str_pad($nomorUrut, STR_PAD_LEFT);
        // Validasi input
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'warehouse_id' => 'required',
            'date' => 'required',
        ]);
        try {
            $currentUser = Auth::user();
            // Menyiapkan data untuk disimpan
            $validatedData = $request->except('_token');
            $validatedData['seri'] = $seri;
            $validatedData['created_by'] = $currentUser->id; // Menambahkan ID pengguna sebagai created_by
            $validatedData['updated_by'] = $currentUser->id; // Menambahkan ID pengguna sebagai updated_by
            // dd($validatedData);
            // Menyimpan data ke dalam database
            \App\Models\m_asset::create($validatedData);
            return redirect()->back()->with('success', 'Data asset berhasil ditambah.');
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->back()->with('error', 'Data asset gagal ditambah.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd('oke');
        $asset = m_asset::find($id);
        $warehouse = m_warehouse::all();
        return view('MasterData.asset.show', compact('asset', 'warehouse'));
    }

    // Menampilkan data QR
    public function QR($id)
    {
        $asset = m_asset::find($id);
        return QrCode::generate(
            'Hello, World!',
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        // dd('oke');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd('oke');
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'warehouse_id' => 'required',
            'date' => 'required',
            'qr_count' => 'required',
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
        $html = view('MasterData.asset_pdf', compact('asset'))->render();

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
