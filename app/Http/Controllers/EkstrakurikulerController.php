<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EkstrakurikulerController extends Controller
{
    public $validation_rules = [
        'nama_ekstrakurikuler' => 'required|string|min:3|max:25',
        'nama_pembina' => 'required|string|min:3|max:255',
        'alamat_pembina' => 'required|string|min:10|max:255',
        'no_telepon' => 'required|string|min:10|max:15',
        'hari' => 'required|integer|in:1,2,3,4,5,6,7',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i'
    ];

    public $custom_message_validation = [
        'hari.in' => 'Hari harus berupa angka antara 1 sampai 7.',
    ];
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.master.ekstrakurikuler.index', [
            'judul' => 'Ekstrakurikuler',
            'ekstrakurikuler' => Ekstrakurikuler::paginate(20)->withQueryString()
        ]);        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master.ekstrakurikuler.create', [
            'judul' => 'Tambah Ekstrakurikuler'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_ekstrakurikuler = $request->validate($this->validation_rules, $this->custom_message_validation);

        Ekstrakurikuler::create($validated_ekstrakurikuler);

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('pages.master.ekstrakurikuler.show', [
            'judul' => 'Detail Ekstrakurikuler',
            'ekstrakurikuler' => $ekstrakurikuler
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('pages.master.ekstrakurikuler.edit', [
            'judul' => 'Edit Ekstrakurikuler',
            'ekstrakurikuler' => $ekstrakurikuler
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        $update_validation_rules = $this->validation_rules;

        $update_validation_rules['nama_mata_pelajaran'][] = Rule::unique('ekstrakurikuler', 'nama_ekstrakurikuler')->ignore($ekstrakurikuler->id_ekstrakurikuler);

        $validated_ekstrakurikuler = $request->validate($update_validation_rules);

        $ekstrakurikuler->update($validated_ekstrakurikuler, $this->custom_message_validation);

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        $ekstrakurikuler->delete();

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
