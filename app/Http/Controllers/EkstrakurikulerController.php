<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use App\Models\PesertaEkstrakurikuler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class EkstrakurikulerController extends Controller
{
    public $ekstrakurikuler_validation_rules = [
        'nama_ekstrakurikuler' => 'required|string|min:3|max:25|unique:ekstrakurikuler,nama_ekstrakurikuler',
        'nama_pembina' => 'required|string|min:3|max:255',
        'alamat_pembina' => 'required|string|min:10|max:255',
        'no_telepon' => 'required|string|min:10|max:15',
        'hari' => 'required|string|min:3|max:10',
        'jam_mulai' => 'required|date_format:H:i',
        'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
    ];
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::any(['staf-tata-usaha', 'guru'])) {
            $ekstrakurikuler = Ekstrakurikuler::filter(request()->all())->paginate(20)->withQueryString();
        } else if (Gate::allows('siswa')) {
            $ekstrakurikuler = Ekstrakurikuler::with('pesertaEkstrakurikuler.ekstrakurikuler')->whereHas('pesertaEkstrakurikuler', fn ($query) => $query->where('id_siswa', Auth::user()->siswa->id_siswa))->paginate(20)->withQueryString();
        } else {
            abort(404);
        }

        return view('pages.master.ekstrakurikuler.index', [
            'judul' => 'Ekstrakurikuler',
            'ekstrakurikuler' => $ekstrakurikuler
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

        return view('pages.master.ekstrakurikuler.create', [
            'judul' => 'Ekstrakurikuler'
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

        $validated_ekstrakurikuler = $request->validate($this->ekstrakurikuler_validation_rules);

        Ekstrakurikuler::create($validated_ekstrakurikuler);

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ekstrakurikuler $ekstrakurikuler)
    {
        return view('pages.master.ekstrakurikuler.show', [
            'judul' => 'Ekstrakurikuler',
            'ekstrakurikuler' => $ekstrakurikuler
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ekstrakurikuler $ekstrakurikuler)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        return view('pages.master.ekstrakurikuler.edit', [
            'judul' => 'Ekstrakurikuler',
            'ekstrakurikuler' => $ekstrakurikuler
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ekstrakurikuler $ekstrakurikuler)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $ekstrakurikuler_update_validation_rules = $this->ekstrakurikuler_validation_rules;

        $ekstrakurikuler_update_validation_rules['nama_ekstrakurikuler'] = "required|string|min:3|max:25|unique:ekstrakurikuler,nama_ekstrakurikuler,{$ekstrakurikuler->id_ekstrakurikuler},id_ekstrakurikuler";

        $validated_ekstrakurikuler = $request->validate($ekstrakurikuler_update_validation_rules);

        $ekstrakurikuler->update($validated_ekstrakurikuler);

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ekstrakurikuler $ekstrakurikuler)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }
        
        $ekstrakurikuler->delete();

        return redirect()->route('ekstrakurikuler.index')->with('success', 'Ekstrakurikuler berhasil dihapus.');
    }
}
