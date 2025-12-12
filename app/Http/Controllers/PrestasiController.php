<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class PrestasiController extends Controller
{
    public $prestasi_validation_rules = [
        'nama_prestasi' => 'required|string|min:3|max:100',
        'id_siswa' => 'required|integer|exists:siswa,id_siswa',
        'penyelenggara' => 'required|string|min:3|max:50',
        'jenis' => 'required|string|min:3|max:15',
        'peringkat' => 'required|string|min:3|max:15',
        'peringkat_lainnya' => 'nullable|string|min:3|max:50',
        'tingkat' => 'required|string|min:3|max:15',
        'wilayah' => 'required|string|min:3|max:25',
        'tanggal' => 'required|date|before_or_equal:today',
        'dokumentasi' => 'nullable|file|mimes:jpg,png,jpeg|max:10240'
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::any(['staf-tata-usaha', 'guru']))
            $prestasi = Prestasi::with('siswa')->filter(request()->all())->paginate(20)->withQueryString();
        else if (Gate::allows('siswa')) {
            $prestasi = Prestasi::with('siswa')->where('id_siswa', Auth::user()->siswa->id_siswa)->filter(request()->all())->paginate(20)->withQueryString();
        } else {
            abort(404);
        }

        $siswa = Siswa::get();

        return view('pages.akademik.prestasi.index', [
            'judul' => 'Prestasi',
            'prestasi' => $prestasi,
            'siswa' => $siswa
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

        $siswa = Siswa::latest()->get();

        return view('pages.akademik.prestasi.create', [
            'judul' => 'Prestasi',
            'siswa' => $siswa
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

        $validated_prestasi = $request->validate($this->prestasi_validation_rules);

        if ($request->hasFile('dokumentasi')) {
            $validated_prestasi['dokumentasi'] = $request->file('dokumentasi')->store('dokumentasi_prestasi', 'public');
        }

        Prestasi::create($validated_prestasi);

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestasi $prestasi)
    {
        $siswa = Siswa::latest()->get();

        return view('pages.akademik.prestasi.show', [
            'judul' => 'Prestasi',
            'prestasi' => $prestasi,
            'siswa' => $siswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        return view('pages.akademik.prestasi.edit', [
            'judul' => 'Prestasi',
            'prestasi' => $prestasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestasi $prestasi)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $prestasi_validation_rultes_update = $this->prestasi_validation_rules;
        $prestasi_validation_rultes_update['image_delete'] = 'required|integer';

        $validated_prestasi = $request->validate($prestasi_validation_rultes_update);

        if ($validated_prestasi['image_delete'] == 1) {
            if (!empty($prestasi->dokumentasi)) {
                Storage::disk('public')->delete($prestasi->dokumentasi);
            }
            $validated_prestasi['dokumentasi'] = null;
        } elseif ($request->hasFile('dokumentasi')) {
            if (!empty($prestasi->dokumentasi)) {
                Storage::disk('public')->delete($prestasi->dokumentasi);
            }
            $validated_prestasi['dokumentasi'] = $request->file('dokumentasi')->store('dokumentasi_prestasi', 'public');
        } else {
            $validated_prestasi['dokumentasi'] = $prestasi->dokumentasi;
        }

        if (empty($validated_prestasi['peringkat_lainnya'])) {
            $validated_prestasi['peringkat_lainnya'] = null;
        }

        $prestasi->update($validated_prestasi);

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }
        
        $prestasi->delete();

        if (!empty($prestasi->dokumentasi)) {
            Storage::delete($prestasi->dokumentasi);
        }

        return redirect()->route('prestasi.index')->with('success', 'Prestasi berhasil dihapus.');
    }
}
