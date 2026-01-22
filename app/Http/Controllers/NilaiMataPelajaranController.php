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
    public $nilai_mata_pelajaran_validation_rules = [
        'id_kelas' => 'required|exists:kelas,id_kelas',
        'id_semester' => 'required|exists:semester,id_semester',
        'id_mata_pelajaran' => 'required|exists:mata_pelajaran,id_mata_pelajaran',
        'jumlah_portofolio' => 'required|integer|min:0|max:20'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semester_default_filter = Semester::filter(['order_by' => 'desc'])->first()->id_semester ?? null;

        if (Gate::any(['staf-tata-usaha', 'guru']))
            $nilai_mata_pelajaran = NilaiMataPelajaran::with(['siswa', 'siswa.kelas', 'mataPelajaran', 'semester'])
                ->filter([
                    ...request()->all(),
                    'semester_filter' => request('semester_filter', $semester_default_filter)
                ])
                ->join('siswa', 'siswa.id_siswa', '=', 'nilai_mata_pelajaran.id_siswa')
                ->orderBy('siswa.nomor_urut')->select('nilai_mata_pelajaran.*')
                ->paginate(20)
                ->withQueryString();
        else if (Gate::allows('siswa')) {
            $nilai_mata_pelajaran = NilaiMataPelajaran::with(['siswa', 'siswa.kelas', 'mataPelajaran', 'semester'])->where('id_siswa', Auth::user()->siswa->id_siswa)
                ->filter([
                    ...request()->except(['kelas_filter', 'siswa_filter']),
                    'semester_filter' => request('semester_filter', $semester_default_filter)
                ])->paginate(20)->withQueryString();
        } else {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $siswa = Siswa::orderedNomorUrutSiswa()->get();
        $mata_pelajaran = MataPelajaran::latest()->get();
        $semester = Semester::filter(['order_by' => 'desc'])->get();

        session(['nilai_mp_query' => request()->query()]);

        return view('pages.akademik.nilai_mata_pelajaran.index', [
            'judul' => 'Nilai Mata Pelajaran',
            'nilai_mata_pelajaran' => $nilai_mata_pelajaran,
            'kelas' => $kelas,
            'siswa' => $siswa,
            'mata_pelajaran' => $mata_pelajaran,
            'semester' => $semester,
            'semester_default_filter' => $semester_default_filter
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::allows('guru')) {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $semester = Semester::filter(['order_by' => 'desc'])->get();
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
        if (!Gate::allows('guru')) {
            abort(404);
        }

        $siswa = Siswa::get();

        if ($siswa->isEmpty()) {
            return back()->with('error', 'Siswa tidak tersedia.')->withInput();
        }

        $validated_nilai_mata_pelajaran = $request->validate($this->nilai_mata_pelajaran_validation_rules);

        $siswa_in_kelas = Siswa::where('id_kelas', $validated_nilai_mata_pelajaran['id_kelas'])->get();

        if ($siswa_in_kelas->isEmpty()) {
            return back()->withErrors(['id_kelas' => 'Kelas belum memiliki anggota.'])->withInput();
        }

        $jumlah_portofolio = (int) $validated_nilai_mata_pelajaran['jumlah_portofolio'];

        $nilai_mata_pelajaran_in_kelas = NilaiMataPelajaran::where(
            'id_semester',
            $validated_nilai_mata_pelajaran['id_semester']
        )
            ->where(
                'id_mata_pelajaran',
                $validated_nilai_mata_pelajaran['id_mata_pelajaran']
            )
            ->whereHas('siswa', function ($query) use ($validated_nilai_mata_pelajaran) {
                $query->where('id_kelas', $validated_nilai_mata_pelajaran['id_kelas']);
            })
            ->first();

        $nilai_portofolio_template = [];

        if ($nilai_mata_pelajaran_in_kelas && is_array($nilai_mata_pelajaran_in_kelas->nilai_portofolio)) {
            foreach ($nilai_mata_pelajaran_in_kelas->nilai_portofolio as $item) {
                $nilai_portofolio_template[] = [
                    'judul' => $item['judul'],
                    'nilai' => 0
                ];
            }
        }

        Siswa::where('id_kelas', $validated_nilai_mata_pelajaran['id_kelas'])
            ->get()
            ->each(function ($_siswa) use (
                $validated_nilai_mata_pelajaran,
                $jumlah_portofolio,
                $nilai_portofolio_template
            ) {
                $nilai_mata_pelajaran = NilaiMataPelajaran::updateOrCreate(
                    [
                        'id_siswa' => $_siswa->id_siswa,
                        'id_semester' => $validated_nilai_mata_pelajaran['id_semester'],
                        'id_mata_pelajaran' => $validated_nilai_mata_pelajaran['id_mata_pelajaran']
                    ],
                    [
                        'jumlah_portofolio' => $jumlah_portofolio,
                        'nilai_ub_1' => 0,
                        'nilai_ub_2' => 0,
                        'nilai_uts' => 0,
                        'nilai_uas' => 0
                    ]
                );

                $nilai_portofolio = empty($nilai_mata_pelajaran->nilai_portofolio) ? $nilai_portofolio_template : $nilai_mata_pelajaran->nilai_portofolio;

                $nilai_mata_pelajaran->update([
                    'jumlah_portofolio' => $jumlah_portofolio,
                    'nilai_portofolio' => $this->syncPortofolio(
                        $nilai_portofolio,
                        $jumlah_portofolio
                    )
                ]);
            });

        return redirect()
            ->route('nilai-mata-pelajaran.index', [
                'kelas_filter' => $validated_nilai_mata_pelajaran['id_kelas'],
                'semester_filter' => $validated_nilai_mata_pelajaran['id_semester'],
                'mata_pelajaran_filter' => $validated_nilai_mata_pelajaran['id_mata_pelajaran']
            ])
            ->with('success', 'Nilai Mata Pelajaran berhasil ditambahkan / disinkronkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(NilaiMataPelajaran $nilaiMataPelajaran)
    {
        if (Gate::allows('siswa') && $nilaiMataPelajaran->siswa->id_siswa !== Auth::user()->siswa->id_siswa) {
            abort(404);
        }

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
        if (!Gate::allows('guru')) {
            abort(404);
        }

        return view('pages.akademik.nilai_mata_pelajaran.edit', [
            'judul' => 'Nilai Mata Pelajaran',
            'nilai_mata_pelajaran' => $nilaiMataPelajaran
        ]);
    }

    public function editForm()
    {
        if (!Gate::allows('guru')) {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $semester = Semester::filter(['order_by' => 'desc'])->get();
        $mata_pelajaran = MataPelajaran::latest()->get();

        return view('pages.akademik.nilai_mata_pelajaran.edit_form', [
            'judul' => 'Nilai Mata Pelajaran',
            'kelas' => $kelas,
            'semester' => $semester,
            'mata_pelajaran' => $mata_pelajaran
        ]);
    }

    public function updateForm(Request $request)
    {
        if (!Gate::allows('guru')) {
            abort(404);
        }

        $nilai_mata_pelajaran_update_validation_rules = $this->nilai_mata_pelajaran_validation_rules;

        unset($nilai_mata_pelajaran_update_validation_rules['jumlah_portofolio']);

        $nilai_mata_pelajaran_update_validation_rules['id_semester_new'] = 'required|exists:semester,id_semester';
        $nilai_mata_pelajaran_update_validation_rules['id_mata_pelajaran_new'] = 'required|exists:mata_pelajaran,id_mata_pelajaran';

        $validated_nilai_mata_pelajaran = $request->validate($nilai_mata_pelajaran_update_validation_rules);

        $nilai_mata_pelajaran = NilaiMataPelajaran::whereHas(
            'siswa',
            function ($query) use ($validated_nilai_mata_pelajaran) {
                $query->where('id_kelas', $validated_nilai_mata_pelajaran['id_kelas']);
            }
        )
            ->where('id_semester', $validated_nilai_mata_pelajaran['id_semester'])
            ->where('id_mata_pelajaran', $validated_nilai_mata_pelajaran['id_mata_pelajaran'])
            ->get();

        $nilai_mata_pelajaran_new = NilaiMataPelajaran::whereHas(
            'siswa',
            function ($query) use ($validated_nilai_mata_pelajaran) {
                $query->where('id_kelas', $validated_nilai_mata_pelajaran['id_kelas']);
            }
        )
            ->where('id_semester', $validated_nilai_mata_pelajaran['id_semester_new'])
            ->where('id_mata_pelajaran', $validated_nilai_mata_pelajaran['id_mata_pelajaran_new'])
            ->get();

        if ($nilai_mata_pelajaran->isEmpty()) {
            return back()->with('error', 'Nilai Mata Pelajaran yang ingin diperbarui tidak ditemukan.')->withInput();
        }

        if ($nilai_mata_pelajaran_new->isNotEmpty()) {
            return back()->with('error', 'Nilai Mata Pelajaran dengan data baru sudah tersedia sebelumnya.')->withInput();
        }

        NilaiMataPelajaran::query()->whereIn(
            'id_nilai_mata_pelajaran',
            $nilai_mata_pelajaran->pluck('id_nilai_mata_pelajaran')
        )->update([
            'id_semester'       => $validated_nilai_mata_pelajaran['id_semester_new'],
            'id_mata_pelajaran' => $validated_nilai_mata_pelajaran['id_mata_pelajaran_new'],
        ]);

        return redirect()
            ->route('nilai-mata-pelajaran.index', [
                'id_kelas' => $validated_nilai_mata_pelajaran['id_kelas'],
                'id_semester' => $validated_nilai_mata_pelajaran['id_semester_new'],
                'id_mata_pelajaran' => $validated_nilai_mata_pelajaran['id_mata_pelajaran_new']
            ])
            ->with('success', 'Nilai Mata Pelajaran berhasil diperbarui.');
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, NilaiMataPelajaran $nilaiMataPelajaran)
    {
        if (!Gate::allows('guru')) {
            abort(404);
        }

        $nilai_mata_pelajaran_validation_rules = [
            'nilai_portofolio' => 'required|array|min:1|max:20',
            'nilai_portofolio.*.judul' => 'required|string|min:3|max:50',
            'nilai_portofolio.*.nilai' => 'required|numeric|min:0|max:100',
            'nilai_ub_1' => 'required|numeric|min:0|max:100',
            'nilai_ub_2' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|numeric|min:0|max:100'
        ];

        $validated_nilai_mata_pelajaran = $request->validate($nilai_mata_pelajaran_validation_rules);

        $nilaiMataPelajaran->update($validated_nilai_mata_pelajaran);

        $nilai_mata_pelajaran_in_kelas = NilaiMataPelajaran::where(
            'id_semester',
            $nilaiMataPelajaran->id_semester
        )
            ->where(
                'id_mata_pelajaran',
                $nilaiMataPelajaran->id_mata_pelajaran
            )
            ->whereHas('siswa', function ($query) use ($nilaiMataPelajaran) {
                $query->where('id_kelas', $nilaiMataPelajaran->siswa->id_kelas);
            })
            ->get();

        foreach ($nilai_mata_pelajaran_in_kelas as $_nilai_mata_pelajaran_in_kelas) {
            $nilai_porotofolio_json = $_nilai_mata_pelajaran_in_kelas->nilai_portofolio ?? [];

            foreach ($nilai_porotofolio_json as $index => &$item) {
                if (isset($validated_nilai_mata_pelajaran['nilai_portofolio'][$index]['judul'])) {
                    $item['judul'] = $validated_nilai_mata_pelajaran['nilai_portofolio'][$index]['judul'];
                }
            }

            $_nilai_mata_pelajaran_in_kelas->update([
                'nilai_portofolio' => $nilai_porotofolio_json
            ]);
        }

        $query_data = $request->query();

        return redirect()->route('nilai-mata-pelajaran.index', $query_data)->with('success', 'Nilai Mata Pelajaran berhasil disimpan.');
    }

    public function massUpdate(Request $request)
    {
        if (!Gate::allows('guru')) {
            abort(404);
        }

        if (!$request->has('id_nilai_mata_pelajaran')) {
            return back()->with('error', 'Tidak ada perubahan pada Nilai Mata Pelajaran.');
        }

        $nilai_mata_pelajaran_validation_rules = [
            'id_nilai_mata_pelajaran' => 'required|array',
            'id_nilai_mata_pelajaran.*' => 'required|exists:nilai_mata_pelajaran,id_nilai_mata_pelajaran',
            'nilai_ub_1' => 'required|array',
            'nilai_ub_1.*' => 'required|numeric|min:0|max:100',
            'nilai_ub_2' => 'required|array',
            'nilai_ub_2.*' => 'required|numeric|min:0|max:100',
            'nilai_uts' => 'required|array',
            'nilai_uts.*' => 'required|numeric|min:0|max:100',
            'nilai_uas' => 'required|array',
            'nilai_uas.*' => 'required|numeric|min:0|max:100'
        ];

        $validated_nilai_mata_pelajaran = $request->validate($nilai_mata_pelajaran_validation_rules);

        foreach ($validated_nilai_mata_pelajaran['id_nilai_mata_pelajaran'] as $_id_nilai_mata_pelajaran) {
            $nilai_mata_pelajaran_data_update = [];

            if (\array_key_exists($_id_nilai_mata_pelajaran, $validated_nilai_mata_pelajaran['nilai_ub_1'] ?? [])) {
                $nilai_mata_pelajaran_data_update['nilai_ub_1'] = $validated_nilai_mata_pelajaran['nilai_ub_1'][$_id_nilai_mata_pelajaran];
            }

            if (\array_key_exists($_id_nilai_mata_pelajaran, $validated_nilai_mata_pelajaran['nilai_ub_2'] ?? [])) {
                $nilai_mata_pelajaran_data_update['nilai_ub_2'] = $validated_nilai_mata_pelajaran['nilai_ub_2'][$_id_nilai_mata_pelajaran];
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
    }

    public function delete()
    {
        if (!Gate::allows('guru')) {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $semester = Semester::filter(['order_by' => 'desc'])->get();
        $mata_pelajaran = MataPelajaran::latest()->get();

        return view('pages.akademik.nilai_mata_pelajaran.delete', [
            'judul' => 'Nilai Mata Pelajaran',
            'kelas' => $kelas,
            'semester' => $semester,
            'mata_pelajaran' => $mata_pelajaran
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (!Gate::allows('guru')) {
            abort(404);
        }

        $nilai_mata_pelajaran_update_validation_rules = $this->nilai_mata_pelajaran_validation_rules;
        unset($nilai_mata_pelajaran_update_validation_rules['jumlah_portofolio']);

        $validated_nilai_mata_pelajaran = $request->validate($nilai_mata_pelajaran_update_validation_rules);

        /** @var \Illuminate\Database\Eloquent\Builder $nilai_mata_pelajaran_data */
        $nilai_mata_pelajaran_data = NilaiMataPelajaran::whereHas('siswa', fn($query) => $query->where('id_kelas', $validated_nilai_mata_pelajaran['id_kelas']))
            ->where('id_semester', $validated_nilai_mata_pelajaran['id_semester'])
            ->where('id_mata_pelajaran', $validated_nilai_mata_pelajaran['id_mata_pelajaran']);

        if (!$nilai_mata_pelajaran_data->exists()) {
            return back()->with('error', 'Nilai Mata Pelajaran tidak ditemukan untuk dihapus.')->withInput();
        }

        $nilai_mata_pelajaran_data->delete();

        return redirect()->route('nilai-mata-pelajaran.index')->with('success', 'Nilai Mata Pelajaran berhasil dihapus.');
    }

    private function syncPortofolio(array $nilai_portofolio, int $jumlah_portofolio): array
    {
        if (!Gate::allows('guru')) {
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
