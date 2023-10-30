<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\m_warehouse;
use App\Models\Peti;
use App\Models\Type_peti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Type;

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
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'tipe_peti_id' => 'required',
            'warna' => 'required',
            'customer_id' => 'required',
            'warehouse_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'date_pembuatan' => 'required',
            'status_disposal' => 'nullable',
            'packing_no' => 'nullable',
            'fix_lot' => 'nullable',
        ]);
        // dd($request);
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
        return view('dashboard.Master_Data.Manajemen_Peti.Peti.show', $data);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipe_peti_id' => 'required',
            'warna' => 'required',
            'customer_id' => 'required',
            'warehouse_id' => 'required',
            'status_disposal' => 'nullable',
            'date_pembuatan' => 'required',
        ]);

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
}
