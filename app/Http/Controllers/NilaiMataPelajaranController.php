<?php

namespace App\Http\Controllers;

use App\Models\NilaiMataPelajaran;
use Illuminate\Http\Request;

class NilaiMataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.akademik.nilai_mata_pelajaran.index');
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
    public function show(NilaiMataPelajaran $nilaiMataPelajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NilaiMataPelajaran $nilaiMataPelajaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NilaiMataPelajaran $nilaiMataPelajaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NilaiMataPelajaran $nilaiMataPelajaran)
    {
        //
    }
}
