<?php

namespace App\Http\Controllers;

use App\Models\NilaiEkstrakurikuler;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Ekstrakurikuler;
use App\Models\PesertaEkstrakurikuler;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class NilaiEkstrakurikulerController extends Controller
{
    public $ekstrakurikuler_validation_rules = [
        'id_ekstrakurikuler' => 'required|exists:ekstrakurikuler,id_ekstrakurikuler',
        'id_semester' => 'required|exists:semester,id_semester'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::any(['staf-tata-usaha', 'guru']))
            $nilai_ekstrakurikuler = NilaiEkstrakurikuler::with(['pesertaEkstrakurikuler.siswa', 'pesertaEkstrakurikuler.ekstrakurikuler', 'semester'])->filter(request()->all())
                                                        ->join('peserta_ekstrakurikuler', 'peserta_ekstrakurikuler.id_peserta_ekstrakurikuler', '=', 'nilai_ekstrakurikuler.id_peserta_ekstrakurikuler')
                                                        ->join('siswa', 'siswa.id_siswa', '=', 'peserta_ekstrakurikuler.id_siswa')
                                                        ->orderBy('siswa.nomor_urut')
                                                        ->select('nilai_ekstrakurikuler.*')
                                                        ->paginate(20)
                                                        ->withQueryString();
        else if (Gate::allows('siswa')) {
            $nilai_ekstrakurikuler = NilaiEkstrakurikuler::with(['pesertaEkstrakurikuler.siswa', 'pesertaEkstrakurikuler.ekstrakurikuler', 'semester'])->whereHas('pesertaEkstrakurikuler', fn ($query) => $query->where('id_siswa', Auth::user()->siswa->id_siswa))->filter(request()->except(['kelas_filter', 'siswa_filter']))->paginate(20)->withQueryString();
        } else {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $siswa = Siswa::get();
        $ekstrakurikuler = Ekstrakurikuler::latest()->get();
        $semester = Semester::filter(['order_by' => 'desc'])->get();

        return view('pages.akademik.nilai_ekstrakurikuler.index', [
            'judul' => 'Nilai Ekstrakurikuler',
            'nilai_ekstrakurikuler' => $nilai_ekstrakurikuler,
            'kelas' => $kelas,
            'siswa' => $siswa,
            'ekstrakurikuler' => $ekstrakurikuler,
            'semester' => $semester
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

        $ekstrakurikuler = Ekstrakurikuler::latest()->get();
        $semester = Semester::filter(['order_by' => 'desc'])->get();

        return view('pages.akademik.nilai_ekstrakurikuler.create', [
            'judul' => 'Nilai Ekstrakurikuler',
            'ekstrakurikuler' => $ekstrakurikuler,
            'semester' => $semester
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

        $siswa = Siswa::get();

        if ($siswa->isEmpty()) {
            return back()->with('error', 'Siswa tidak tersedia.');
        }

        $validated_ekstrakurikuler = $request->validate($this->ekstrakurikuler_validation_rules);

        $peserta_in_ekstrakurikuler = PesertaEkstrakurikuler::where('id_ekstrakurikuler', $validated_ekstrakurikuler['id_ekstrakurikuler'])->get();

        if ($peserta_in_ekstrakurikuler->isEmpty()) {
            return back()->withErrors(['id_ekstrakurikuler' => 'Ekstrakurikuler belum memiliki anggota.'])->withInput();
        }

        $peserta_ekstrakurikuler = PesertaEkstrakurikuler::where('id_ekstrakurikuler', $validated_ekstrakurikuler['id_ekstrakurikuler'])->get();

        if (empty($peserta_ekstrakurikuler)) {
            return back()->withErrors([
                'id_ekstrakurikuler' => 'Ekstrakurikuler belum memiliki peserta.'
            ])->withInput();
        }

        PesertaEkstrakurikuler::where('id_ekstrakurikuler', $validated_ekstrakurikuler['id_ekstrakurikuler'])->get()->each(function ($_peserta_ekstrakurikuler) use ($validated_ekstrakurikuler) {
            NilaiEkstrakurikuler::firstOrCreate(
                [
                    'id_peserta_ekstrakurikuler' => $_peserta_ekstrakurikuler->id_peserta_ekstrakurikuler,
                    'id_semester' => $validated_ekstrakurikuler['id_semester']
                ],
                [
                    'nilai' => 0
                ]
            );
        });

        return redirect()->route('nilai-ekstrakurikuler.index')->with('success', 'Nilai Ekstrakurikuler berhasil ditambahkan / disinkronkan.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(NilaiEkstrakurikuler $nilaiEkstrakurikuler)
    // {
    //     return view('pages.akademik.nilai_ekstrakurikuler.show', [
    //         'judul' => 'Nilai Ekstrakurikuler',
    //         'nilai_ekstrakurikuler' => $nilaiEkstrakurikuler
    //     ]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(NilaiEkstrakurikuler $nilaiEkstrakurikuler)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, NilaiEkstrakurikuler $nilaiEkstrakurikuler)
    // {
    // }

    public function massUpdate(Request $request)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        if (!$request->has('id_nilai_ekstrakurikuler')) {
            return back()->with('error', 'Tidak ada perubahan pada Nilai Ekstrakurikuler.');
        }

        $nilai_ekstrakurikuler_update_validation_rules = [
            'id_nilai_ekstrakurikuler' => 'required|array',
            'id_nilai_ekstrakurikuler.*' => 'required|exists:nilai_ekstrakurikuler,id_nilai_ekstrakurikuler',
            'nilai' => 'required|array',
            'nilai.*' => 'nullable|numeric|min:0|max:100'
        ];

        $validated_nilai_ekstrakurikuler = $request->validate($nilai_ekstrakurikuler_update_validation_rules);

        foreach ($validated_nilai_ekstrakurikuler['id_nilai_ekstrakurikuler'] as $_id_nilai_ekstrakurikuler) {
            if (!isset($validated_nilai_ekstrakurikuler['nilai'][$_id_nilai_ekstrakurikuler])) {
                continue;
            }

            NilaiEkstrakurikuler::where('id_nilai_ekstrakurikuler', $_id_nilai_ekstrakurikuler)->where('nilai', '!=', $validated_nilai_ekstrakurikuler['nilai'][$_id_nilai_ekstrakurikuler])
                ->update([
                    'nilai' => $validated_nilai_ekstrakurikuler['nilai'][$_id_nilai_ekstrakurikuler]
                ]);
        }

        return back()->with('success', 'Nilai Ekstrakurikuler berhasil disimpan.');
    }

    public function delete()
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $ekstrakurikuler = Ekstrakurikuler::latest()->get();
        $semester = Semester::latest()->get();

        return view('pages.akademik.nilai_ekstrakurikuler.delete', [
            'judul' => 'Nilai Ekstrakurikuler',
            'ekstrakurikuler' => $ekstrakurikuler,
            'semester' => $semester
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $validated_ekstrakurikuler = $request->validate($this->ekstrakurikuler_validation_rules);

        /** @var \Illuminate\Database\Eloquent\Builder $nilai_ekstrakurikuler_data */
        $nilai_ekstrakurikuler_data = NilaiEkstrakurikuler::whereHas('pesertaEkstrakurikuler', fn ($query) => $query->where('id_ekstrakurikuler', $validated_ekstrakurikuler['id_ekstrakurikuler']))
            ->where('id_semester', $validated_ekstrakurikuler['id_semester']);

        if (!$nilai_ekstrakurikuler_data->exists()) {
            return back()->with('error', 'Nilai Ekstrakurikuler tidak ditemukan untuk dihapus.');
        }

        $nilai_ekstrakurikuler_data->delete();
        
        return redirect()->route('nilai-ekstrakurikuler.index')->with('success', 'Nilai Ekstrakurikuler berhasil dihapus.');
    }
}
