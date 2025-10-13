<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $pengumuman = Pengumuman::query()->orderBy('tanggal', 'desc')->paginate(20)->withQueryString();

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
        return view('pages.akademik.pengumuman.create', [
            'judul' => 'Pengumuman'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_pengumuman = $request->validate($this->pengumuman_validation_rules);

        if ($request->hasFile('gambar')) {
            $validated_pengumuman['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
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
        $validated_pengumuman = $request->validate($this->pengumuman_validation_rules);

        if ($request->gambar_delete == 1) {
            if (!empty($request->old_gambar)) {
                Storage::disk('public')->delete($request->old_gambar);
            }
            $validated_pengumuman['gambar'] = null;
        } elseif ($request->hasFile('gambar')) {
            if (!empty($request->old_gambar)) {
                Storage::disk('public')->delete($request->old_gambar);
            }
            $validated_pengumuman['gambar'] = $request->file('gambar')->store('pengumuman', 'public');
        } else {
            $validated_pengumuman['gambar'] = $request->old_gambar;
        }

        $pengumuman->update($validated_pengumuman);

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        if (!empty($pengumuman->gambar)) {
            Storage::delete($pengumuman->gambar);
        }

        return redirect()->route('pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
