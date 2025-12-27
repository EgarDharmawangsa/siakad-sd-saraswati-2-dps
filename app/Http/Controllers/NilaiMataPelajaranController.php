<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Semester;
use App\Models\NilaiMataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class NilaiMataPelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::any(['staf-tata-usaha', 'guru']))
            $nilai_mata_pelajaran = NilaiMataPelajaran::with(['siswa', 'siswa.kelas', 'mataPelajaran', 'semester'])->filter(request()->all())->paginate(20)->withQueryString();
        else if (Gate::allows('siswa')) {
            $nilai_mata_pelajaran = NilaiMataPelajaran::with(['siswa', 'siswa.kelas', 'mataPelajaran', 'semester'])->where('id_siswa', Auth::user()->siswa->id_siswa)->filter(request()->all())->paginate(20)->withQueryString();
        } else {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $kelas_default_filter = $kelas->first();
        $siswa = Siswa::get();
        $mata_pelajaran = MataPelajaran::latest()->get();
        $mata_pelajaran_default_filter = $mata_pelajaran->first();
        $semester = Semester::latest()->get();
        $semester_default_filter = Semester::activeSemester()->first();

        if (!$semester_default_filter) {
            $semester_default_filter = $semester->first();
        }

        return view('pages.akademik.nilai_mata_pelajaran.index', [
            'judul' => 'Nilai Mata Pelajaran',
            'nilai_mata_pelajaran' => $nilai_mata_pelajaran,
            'kelas' => $kelas,
            'kelas_default_filter' => $kelas_default_filter,
            'siswa' => $siswa,
            'mata_pelajaran' => $mata_pelajaran,
            'mata_pelajaran_default_filter' => $mata_pelajaran_default_filter,
            'semester' => $semester,
            'semester_default_filter' => $semester_default_filter
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $semester = Semester::latest()->get();
        $mata_pelajaran = MataPelajaran::latest()->get();

        return view('pages.akademik.nilai_mata_pelajaran.create', [
            'judul' => 'Nilai Mata Pelajaran',
            'kelas' => $kelas,
            'semester' => $semester,
            'mata_pelajaran' => $mata_pelajaran
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }

        $nilai_mata_pelajaran_validation_rules = [
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'id_semester' => 'required|exists:semester,id_semester',
            'id_mata_pelajaran' => 'required|exists:nilai_mata_pelajaran,id_mata_pelajaran',
            'nilai' => 'required|integer|min:0|max:20'
        ];
        $siswa = Siswa::get();

        if ($siswa->isEmpty()) {
            return back()->with('error', 'Siswa tidak tersedia.');
        }

        $validated_nilai_mata_pelajaran = $request->validate($nilai_mata_pelajaran_validation_rules);

        $jumlah_portofolio = (int) $validated_nilai_mata_pelajaran['jumlah_portofolio'];

        Siswa::where('id_kelas', $validated_nilai_mata_pelajaran['id_kelas'])->get()->each(function ($_siswa) use ($validated_nilai_mata_pelajaran, $jumlah_portofolio) {
            $nilai_mata_pelajaran = NilaiMataPelajaran::firstOrCreate(
                [
                    'id_siswa' => $_siswa->id_siswa,
                    'id_kelas' => $validated_nilai_mata_pelajaran['id_kelas'],
                    'id_semester' => $validated_nilai_mata_pelajaran['id_semester'],
                    'id_mata_pelajaran' => $validated_nilai_mata_pelajaran['id_mata_pelajaran']
                ],
                [
                    'jumlah_portofolio' => $validated_nilai_mata_pelajaran['jumlah_portofolio'],
                    'nilai_portofolio' => [],
                    'nilai_ub' => 0,
                    'nilai_uts' => 0,
                    'nilai_uas' => 0
                ]
            );

            $nilai_portofolio = $nilai_mata_pelajaran->nilai_portofolio ?? [];

            $nilai_mata_pelajaran->update([
                'nilai_portofolio' => $this->syncPortofolio($nilai_portofolio, $jumlah_portofolio)
            ]);
        });

        return redirect()->route('nilai-mata-pelajaran.index')->with('success', 'Nilai Mata Pelajaran berhasil ditambahkan / disinkronkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(NilaiMataPelajaran $nilaiMataPelajaran)
    {
        return view('pages.akademik.nilai_mata_pelajaran.show', [
            'judul' => 'Nilai Mata Pelajaran',
            'nilai_mata_pelajaran' => $nilaiMataPelajaran
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NilaiMataPelajaran $nilaiMataPelajaran)
    {
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }

        return view('pages.akademik.nilai_mata_pelajaran.edit', [
            'judul' => 'Nilai Mata Pelajaran',
            'nilai_mata_pelajaran' => $nilaiMataPelajaran
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NilaiMataPelajaran $nilaiMataPelajaran)
    {
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }

        if (request()->routeIs('nilai-mata-pelajaran.mass-update')) {
            $nilai_mata_pelajaran_validation_rules = [
                'id_nilai_mata_pelajaran' => 'required|array',
                'id_nilai_mata_pelajaran.*' => 'required|exists:nilai_mata_pelajaran,id_nilai_mata_pelajaran',
                'nilai_ub' => 'required|array',
                'nilai_ub.*' => 'required|integer|min:0|max:100',
                'nilai_uts' => 'required|array',
                'nilai_uts.*' => 'required|integer|min:0|max:100',
                'nilai_uas' => 'required|array',
                'nilai_uas.*' => 'required|integer|min:0|max:100'
            ];

            $validated_nilai_mata_pelajaran = $request->validate($nilai_mata_pelajaran_validation_rules);

            foreach ($validated_nilai_mata_pelajaran['id_nilai_mata_pelajaran'] as $_id_nilai_mata_pelajaran) {
                $nilai_mata_pelajaran_data_update = [];

                if (\array_key_exists($_id_nilai_mata_pelajaran, $validated_nilai_mata_pelajaran['nilai_ub'] ?? [])) {
                    $nilai_mata_pelajaran_data_update['nilai_ub'] = $validated_nilai_mata_pelajaran['nilai_ub'][$_id_nilai_mata_pelajaran];
                }

                if (\array_key_exists($_id_nilai_mata_pelajaran, $validated_nilai_mata_pelajaran['nilai_uts'] ?? [])) {
                    $nilai_mata_pelajaran_data_update['nilai_uts'] = $validated_nilai_mata_pelajaran['nilai_uts'][$_id_nilai_mata_pelajaran];
                }

                if (\array_key_exists($_id_nilai_mata_pelajaran, $validated_nilai_mata_pelajaran['nilai_uas'] ?? [])) {
                    $nilai_mata_pelajaran_data_update['nilai_uas'] = $validated_nilai_mata_pelajaran['nilai_uas'][$_id_nilai_mata_pelajaran];
                }

                if (!empty($nilai_mata_pelajaran_data_update)) {
                    NilaiMataPelajaran::where('id_nilai_mata_pelajaran', $_id_nilai_mata_pelajaran)
                        ->update($nilai_mata_pelajaran_data_update);
                }
            }

            return back()->with('success', 'Nilai Mata Pelajaran berhasil disimpan.');
        } else {
            $nilai_mata_pelajaran_validation_rules = [
                'nilai_portofolio' => 'required|array',
                'nilai_portofolio.*' => 'required|min:1|max:20',
                'nilai_portofolio.*.judul' => 'required|string|min:3|max:50',
                'nilai_portofolio.*.nilai' => 'required|integer|min:0|max:100',
                'nilai_ub' => 'required|integer|min:0|max:100',
                'nilai_uts' => 'required|integer|min:0|max:100',
                'nilai_uas' => 'required|integer|min:0|max:100'
            ];

            $validated_nilai_mata_pelajaran = $request->validate($nilai_mata_pelajaran_validation_rules);

            $nilaiMataPelajaran->update($validated_nilai_mata_pelajaran);

            return redirect()->route('nilai-mata-pelajaran.index')->with('success', 'Nilai Mata Pelajaran berhasil disimpan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(NilaiMataPelajaran $nilaiMataPelajaran)
    // {
    //     //
    // }

    private function syncPortofolio(array $nilai_portofolio, int $jumlah_portofolio): array
    {
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }

        $current_count = \count($nilai_portofolio);

        if ($current_count > $jumlah_portofolio) {
            $nilai_portofolio = \array_slice($nilai_portofolio, 0, $jumlah_portofolio);
        }

        if ($current_count < $jumlah_portofolio) {
            for ($i = $current_count; $i < $jumlah_portofolio; $i++) {
                $nilai_portofolio[] = [
                    'judul' => 'Judul Portofolio ' . ($i + 1),
                    'nilai' => 0
                ];
            }
        }

        return $nilai_portofolio;
    }
}
