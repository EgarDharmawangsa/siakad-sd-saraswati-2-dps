<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class PengumumanController extends Controller
{
    public $pengumuman_validation_rules = [
        'judul' => 'required|string|min:5|max:50',
        'isi' => 'required|string',
        'tanggal' => 'required|date|after_or_equal:today',
        'gambar' => 'nullable|file|mimes:jpg,png,jpeg|max:10240'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }

        $pengumuman = Pengumuman::filter(request()->all())->paginate(20)->withQueryString();

        return view('pages.akademik.pengumuman.index', [
            'judul' => 'Pengumuman',
            'pengumuman' => $pengumuman
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        return view('pages.akademik.pengumuman.create', [
            'judul' => 'Pengumuman'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $validated_pengumuman = $request->validate($this->pengumuman_validation_rules);

        if ($request->hasFile('gambar')) {
            $validated_pengumuman['gambar'] = $request->file('gambar')->store('gambar_pengumuman');
        }

        Pengumuman::create($validated_pengumuman);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        return view('pages.akademik.pengumuman.show', [
            'judul' => 'Pengumuman',
            'pengumuman' => $pengumuman
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumuman $pengumuman)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        return view('pages.akademik.pengumuman.edit', [
            'judul' => 'Pengumuman',
            'pengumuman' => $pengumuman
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $pengumuman_update_validation_rules = $this->pengumuman_validation_rules;
        $pengumuman_update_validation_rules['tanggal'] = "required|date|after_or_equal:{$pengumuman->getFormatedTanggal()}";
        $pengumuman_update_validation_rules['image_delete'] = 'required|integer';
        
        $validated_pengumuman = $request->validate($pengumuman_update_validation_rules);

        if ($validated_pengumuman['image_delete'] == 1) {
            if (!empty($pengumuman->gambar)) {
                Storage::delete($pengumuman->gambar);
            }
            $validated_pengumuman['gambar'] = null;
        } elseif ($request->hasFile('gambar')) {
            if (!empty($pengumuman->gambar)) {
                Storage::delete($pengumuman->gambar);
            }
            $validated_pengumuman['gambar'] = $request->file('gambar')->store('gambar_pengumuman');
        } else {
            $validated_pengumuman['gambar'] = $pengumuman->gambar;
        }

        $pengumuman->update($validated_pengumuman);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }
        
        $pengumuman->delete();

        if (!empty($pengumuman->gambar)) {
            Storage::delete($pengumuman->gambar);
        }

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
