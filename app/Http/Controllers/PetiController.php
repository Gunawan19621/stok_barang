<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidasiCreatePeti;
use App\Http\Requests\ValidasiUpdatePeti;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Peti;
use App\Models\Customer;
use App\Models\Type_peti;
use Mockery\Matcher\Type;
use App\Models\m_warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PetiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'peti' => Peti::all(),
            'active' => 'menu-peti',
        ];
        return view('dashboard.Master_Data.Manajemen_Peti.Peti.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'typepeti' => Type_peti::all(),
            'customer' => Customer::all(),
            'warehouse' => m_warehouse::all(),
            'active' => 'menu-peti',
        ];
        return view('dashboard.Master_Data.Manajemen_Peti.Peti.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ValidasiCreatePeti $request)
    {
        try {
            $currenttype = Auth::user();

            for ($i = 0; $i < $request->jumlah; $i++) {
                $validatedData = $request->except('_token');

                // Ambil nomor urutan otomatis untuk packing_no
                $latestPackingNo = Peti::max('packing_no');
                $nextPackingNo = $latestPackingNo + 1;
                $validatedData['packing_no'] = $nextPackingNo;

                $code_customer = Customer::where('id', $validatedData['customer_id'])->first()->code_customer;
                $type = Type_peti::where('id', $validatedData['tipe_peti_id'])->first()->type;
                $size_peti = Type_peti::where('id', $validatedData['tipe_peti_id'])->first()->size_peti;
                $lot_no = Customer::where('id', $validatedData['customer_id'])->first()->lot_no;
                $packing_no = $validatedData['packing_no'];

                // Generate nilai 'fix_lot' sesuai format yang diinginkan
                $fixLot = $code_customer . $type . $size_peti . $lot_no . $packing_no;
                $validatedData['fix_lot'] = $fixLot;

                $validatedData['created_by'] = $currenttype->fullname; // Menggunakan nama pengguna sebagai created_by
                $validatedData['updated_by'] = $currenttype->fullname; // Menggunakan nama pengguna sebagai updated_by

                // Buat entri peti baru
                Peti::create($validatedData);
            }

            return redirect()->route('dashboard.peti.index')->with('success', 'Data peti berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data peti Gagal Ditambah.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = [
            'peti' => Peti::findOrFail($id),
            'typepeti' => Type_peti::all(),
            'customer' => Customer::all(),
            'warehouse' => m_warehouse::all(),
            'active' => 'menu-peti',
        ];

        $petiqr = Peti::find($id);

        $qrcode = base64_encode(QrCode::format('svg')->size(150)->errorCorrection('H')->generate(
            'Nama Customer : ' .
                $petiqr->customer->name .
                "\n" .
                'Code Customer : ' .
                $petiqr->customer->code_customer .
                "\n" .
                'ID Peti : ' .
                $petiqr->tipe_peti->id .
                "\n" .
                'Type Peti : ' .
                $petiqr->tipe_peti->type .
                "\n" .
                'ID Warehouse : ' .
                $petiqr->warehouse->id .
                "\n" .
                'Warehouse : ' .
                $petiqr->warehouse->name .
                "\n" .
                'Ukuran Peti : ' .
                $petiqr->tipe_peti->size_peti .
                "\n" .
                'Lot Number : ' .
                $petiqr->customer->lot_no .
                "\n" .
                'Paking Number : ' .
                $petiqr->packing_no .
                "\n" .
                'Status Peti : ' .
                $petiqr->status_disposal
        ));
        return view('dashboard.Master_Data.Manajemen_Peti.Peti.show', compact('qrcode'), $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [
            'peti' => Peti::findOrFail($id),
            'typepeti' => Type_peti::all(),
            'customer' => Customer::all(),
            'warehouse' => m_warehouse::all(),
            'active' => 'menu-peti',
        ];
        return view('dashboard.Master_Data.Manajemen_Peti.Peti.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ValidasiUpdatePeti $request, $id)
    {
        try {
            $currentuser = Auth::user();
            $typepeti = Peti::findOrFail($id);

            if (!$typepeti) {
                return redirect()->back()->with('error', 'Data peti tidak ditemukan.');
            }

            $validatedData = $request->except('_token', '_method');

            $code_customer = Customer::where('id', $validatedData['customer_id'])->first()->code_customer;
            $type = Type_peti::where('id', $validatedData['tipe_peti_id'])->first()->type;
            $size_peti = Type_peti::where('id', $validatedData['tipe_peti_id'])->first()->size_peti;
            $lot_no = Customer::where('id', $validatedData['customer_id'])->first()->lot_no;
            $packing_no = $typepeti->packing_no; // Mengambil packing_no dari entitas yang sudah ada

            // Generate nilai 'fix_lot' sesuai format yang diinginkan
            $fixLot = $code_customer . $type . $size_peti . $lot_no . $packing_no;
            $validatedData['fix_lot'] = $fixLot;

            // Tambahkan perubahan yang diperlukan ke entitas Peti
            $typepeti->update($validatedData);

            // Menambahkan nama pengguna yang melakukan pembaruan
            $typepeti->update(['updated_by' => $currentuser->fullname]);

            return redirect()->route('dashboard.peti.index')->with('success', 'Data peti berhasil diperbaharui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data peti gagal diperbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $typepeti = Peti::findOrFail($id);
            $typepeti->delete();
            return redirect()->back()->with('success', 'Data peti berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data peti gagal dihapus');
        }
    }

    public function cetakPdf($id)
    {
        try {
            $peti = Peti::find($id);

            // Generate QR Code
            $qrcode = base64_encode(QrCode::format('svg')->size(150)->errorCorrection('H')->generate(
                'Nama Customer : ' .
                    $peti->customer->name .
                    "\n" .
                    'Code Customer : ' .
                    $peti->customer->code_customer .
                    "\n" .
                    'ID Peti : ' .
                    $peti->tipe_peti->id .
                    "\n" .
                    'Type Peti : ' .
                    $peti->tipe_peti->type .
                    "\n" .
                    'ID Warehouse : ' .
                    $peti->warehouse->id .
                    "\n" .
                    'Warehouse : ' .
                    $peti->warehouse->name .
                    "\n" .
                    'Ukuran Peti : ' .
                    $peti->tipe_peti->size_peti .
                    "\n" .
                    'Lot Number : ' .
                    $peti->customer->lot_no .
                    "\n" .
                    'Paking Number : ' .
                    $peti->packing_no .
                    "\n" .
                    'Fix Lot : ' .
                    $peti->fix_lot .

                    'Status Peti : ' .
                    $peti->status_disposal
            ));

            // Inisialisasi Dompdf
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $options->set('defaultFont', 'Arial');
            $dompdf = new Dompdf($options);

            // Load HTML dari view
            $html = view('dashboard.Master_Data.Manajemen_Peti.Peti.label_pdf', compact('peti', 'qrcode'))->render();
            $dompdf->loadHtml($html);

            // Render PDF (portrait A4)
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $output = $dompdf->output();

            // Download file PDF dengan nama yang sesuai
            return response()->stream(
                function () use ($output) {
                    echo $output;
                },
                200,
                [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="label_Peti.pdf"',
                ]
            );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mencetak PDF.');
        }
    }
}
