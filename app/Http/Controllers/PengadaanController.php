<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengadaanController extends Controller
{
    public function index()
    {
        return view('addons.pengadaan');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // dd('oke');
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd("oke");
    }
}
