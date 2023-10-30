<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'customer' => Customer::all(),
            'active' => 'menu-customer',
        ];
        return view('dashboard.Master_Data.Customer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'active' => 'menu-customer',
        ];
        return view('dashboard.Master_Data.Customer.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('oke');
        $request->validate([
            'name' => 'required',
            'code_customer' => 'required',
            'lot_no' => 'required',
            'nip' => '',
            'no_hp' => 'required',
            'tgl_lahir' => '',
            'jenis_kelamin' => '',
            'agama' => '',
            'address' => 'required',
        ]);

        try {
            $currentUser = Auth::user();
            $validatedData = $request->except('_token');
            $validatedData['created_by'] = $currentUser->fullname; // Menggunakan nama pengguna sebagai created_by
            $validatedData['updated_by'] = $currentUser->fullname; // Menggunakan nama pengguna sebagai updated_by
            Customer::create($validatedData);
            return redirect()->route('dashboard.customer.index')->with('success', 'Data customer berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data customer Gagal Ditambah.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = [
            'customer' => Customer::findOrFail($id),
            'active' => 'menu-customer',
        ];
        return view('dashboard.Master_Data.Customer.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = [
            'customer' => Customer::findOrFail($id),
            'active' => 'menu-customer',
        ];
        return view('dashboard.Master_Data.Customer.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'code_customer' => 'required',
            'lot_no' => 'required',
            'nip' => 'required',
            'no_hp' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'address' => 'required',
        ]);
        // dd($request);
        try {
            $customer = Customer::findOrFail($id);
            $customerData = $request->all();

            // Menambahkan nama pengguna yang melakukan pembaruan
            $customerData['updated_by'] = Auth::user()->fullname;

            $customer->update($customerData);
            return redirect()->route('dashboard.customer.index')->with('success', 'Data customer berhasil diperbaharui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data customer gagal diperbaharui');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd("oke");
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return redirect()->back()->with('success', 'Data customer berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Data customer gagal dihapus');
        }
    }
}
