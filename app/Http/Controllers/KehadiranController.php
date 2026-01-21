<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class KehadiranController extends Controller
{
    public $kehadiran_validation_rules = [
        'id_kelas' => 'required|exists:kelas,id_kelas',
        'id_semester' => 'required|exists:semester,id_semester',
        'tanggal' => 'required|date|after_or_equal:today'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semester_default_filter = Semester::filter(['order_by' => 'desc'])->first()->id_semester ?? null;

        if (Gate::any(['staf-tata-usaha', 'guru']))
            $kehadiran = Kehadiran::with(['siswa', 'siswa.kelas', 'semester'])
                ->filter([
                    ...request()->all(),
                    'semester_filter' => request('semester_filter', $semester_default_filter),
                ])
                ->join('siswa', 'siswa.id_siswa', '=', 'kehadiran.id_siswa')
                ->orderBy('siswa.nomor_urut')->select('kehadiran.*')
                ->paginate(20)
                ->withQueryString();
        else if (Gate::allows('siswa')) {
            $kehadiran = Kehadiran::with(['siswa', 'siswa.kelas', 'semester'])
                ->where('id_siswa', Auth::user()->siswa->id_siswa)
                ->filter([
                    ...request()->except(['kelas_filter', 'siswa_filter']),
                    'semester_filter' => request('semester_filter', $semester_default_filter),
                ])
                ->paginate(20)->withQueryString();
        } else {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $siswa = Siswa::get();
        $semester = Semester::filter(['order_by' => 'desc'])->get();
        $route_kehadiran_filter = route('kehadiran.index');

        return view('pages.akademik.kehadiran.index', [
            'judul' => 'Kehadiran',
            'route_kehadiran_filter' => $route_kehadiran_filter,
            'kehadiran' => $kehadiran,
            'kelas' => $kelas,
            'siswa' => $siswa,
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

        $kelas = kelas::orderedNamaKelas()->get();
        $semester = Semester::filter(['order_by' => 'desc'])->get();

        return view('pages.akademik.kehadiran.create', [
            'judul' => 'Kehadiran',
            'kelas' => $kelas,
            'semester' => $semester
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

        $validated_kehadiran = $request->validate($this->kehadiran_validation_rules);

        $siswa_in_kelas = Siswa::where('id_kelas', $validated_kehadiran['id_kelas'])->get();

        if ($siswa_in_kelas->isEmpty()) {
            return back()->withErrors(['id_kelas' => 'Kelas belum memiliki anggota.'])->withInput();
        }

        Siswa::where('id_kelas', $validated_kehadiran['id_kelas'])->get()->each(function ($_siswa) use ($validated_kehadiran) {
            $kehadiran_data = Kehadiran::firstOrNew(
                [
                    'id_siswa' => $_siswa->id_siswa,
                    'id_semester' => $validated_kehadiran['id_semester'],
                    'tanggal' => $validated_kehadiran['tanggal']
                ]
            );

            if (!$kehadiran_data->exists) {
                $kehadiran_data->status = 'Alfa';
                $kehadiran_data->keterangan = null;
            }

            $kehadiran_data->save();
        });

        return redirect()->route('kehadiran.index', [
            'kelas_filter' => $validated_kehadiran['id_kelas'],
            'semester_filter' => $validated_kehadiran['id_semester'],
            'tanggal_filter' => $validated_kehadiran['tanggal']
        ])->with('success', 'Kehadiran berhasil ditambahkan / disinkronkan.');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Kehadiran $kehadiran)
    // {
    //     return view('pages.akademik.kehadiran.show', [
    //         'judul' => 'Kehadiran',
    //         'kehadiran' => $kehadiran
    //     ]);
    // }

    public function recapitulation()
    {
        if (Gate::any(['staf-tata-usaha', 'guru'])) {
            $kehadiran = Kehadiran::with(['siswa', 'siswa.kelas', 'semester'])
                ->siswaRecap([
                    'kelas_filter' => request('kelas_filter'),
                    'siswa_filter' => request('siswa_filter'),
                    'semester_filter' => request('semester_filter'),
                    'order_by' => request('order_by')
                ])
                ->join('siswa', 'siswa.id_siswa', '=', 'kehadiran.id_siswa')
                // ->join('semester', 'semester.id_semester', '=', 'kehadiran.id_semester')
                // ->orderBy('semester.tanggal_mulai', $orderBy)
                ->orderBy('siswa.nomor_urut')
                ->paginate(20)
                ->withQueryString();
        } elseif (Gate::allows('siswa')) {
            $kehadiran = Kehadiran::with(['siswa', 'siswa.kelas', 'semester'])
                ->siswaRecap([
                    'id_siswa_filter' => Auth::user()->siswa->id_siswa,
                    'semester_filter' => request('semester_filter'),
                    'order_by' => request('order_by')
                ])
                // ->join('semester', 'semester.id_semester', '=', 'kehadiran.id_semester')
                // ->orderBy('semester.tanggal_mulai', $orderBy)
                ->paginate(20)
                ->withQueryString();
        } else {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $siswa = Siswa::get();
        $semester = Semester::filter(['order_by' => 'desc'])->get();
        $route_kehadiran_filter = route('kehadiran.recapitulation');

        return view('pages.akademik.kehadiran.recapitulation', [
            'judul' => 'Kehadiran',
            'route_kehadiran_filter' => $route_kehadiran_filter,
            'kehadiran' => $kehadiran,
            'kelas' => $kelas,
            'siswa' => $siswa,
            'semester' => $semester
        ]);
    }

    public function editForm()
    {
        if (!Gate::allows('guru')) {
            abort(404);
        }

        $kelas = kelas::orderedNamaKelas()->get();
        $semester = Semester::filter(['order_by' => 'desc'])->get();

        return view('pages.akademik.kehadiran.edit_form', [
            'judul' => 'Kehadiran',
            'kelas' => $kelas,
            'semester' => $semester
        ]);
    }

    public function updateForm(Request $request)
    {
        if (!Gate::allows('guru')) {
            abort(404);
        }

        $kehadiran_update_validation_rules = $this->kehadiran_validation_rules;

        $kehadiran_update_validation_rules['id_semester_new'] = 'required|exists:semester,id_semester';
        $kehadiran_update_validation_rules['tanggal_new'] = 'required|date';

        $validated_kehadiran = $request->validate($kehadiran_update_validation_rules);

        $kehadiran = Kehadiran::whereHas(
            'siswa',
            function ($query) use ($validated_kehadiran) {
                $query->where('id_kelas', $validated_kehadiran['id_kelas']);
            }
        )
            ->where('id_semester', $validated_kehadiran['id_semester'])
            ->where('tanggal', $validated_kehadiran['tanggal'])
            ->get();

        $kehadiran_new = Kehadiran::whereHas(
            'siswa',
            function ($query) use ($validated_kehadiran) {
                $query->where('id_kelas', $validated_kehadiran['id_kelas']);
            }
        )
            ->where('id_semester', $validated_kehadiran['id_semester_new'])
            ->where('tanggal', $validated_kehadiran['tanggal_new'])
            ->get();

        if ($kehadiran->isEmpty()) {
            return back()->with('error', 'kehadiran yang ingin diperbarui tidak ditemukan.')->withInput();
        }

        if ($kehadiran_new->isNotEmpty()) {
            return back()->with('error', 'Kehadiran dengan data baru sudah tersedia sebelumnya.')->withInput();
        }

        Kehadiran::query()->whereIn(
            'id_kehadiran',
            $kehadiran->pluck('id_kehadiran')
        )->update([
            'id_semester'       => $validated_kehadiran['id_semester_new'],
            'tanggal' => $validated_kehadiran['tanggal_new'],
        ]);

        return redirect()
            ->route('kehadiran.index', [
                'id_kelas' => $validated_kehadiran['id_kelas'],
                'id_semester' => $validated_kehadiran['id_semester_new'],
                'tanggal' => $validated_kehadiran['tanggal_new']
            ])
            ->with('success', 'kehadiran berhasil diperbarui.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Kehadiran $kehadiran)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function massUpdate(Request $request)
    {
        if (!Gate::allows('guru')) {
            abort(404);
        }

        if (!$request->has('id_kehadiran')) {
            return back()->with('error', 'Tidak ada perubahan pada Kehadiran.');
        }

        $validated = $request->validate([
            'id_kehadiran'   => 'required|array',
            'id_kehadiran.*' => 'required|exists:kehadiran,id_kehadiran',
            'status'         => 'required|array',
            'status.*'       => 'required|in:Hadir,Sakit,Izin,Alfa',
            'keterangan'     => 'nullable|array',
            'keterangan.*'   => 'nullable|string|max:255',
        ]);

        $errors = [];
        $updatedCount = 0;

        foreach ($validated['id_kehadiran'] as $id) {

            $newStatus = $validated['status'][$id] ?? null;
            $newKeterangan = $newStatus === 'Izin'
                ? ($validated['keterangan'][$id] ?? null)
                : null;

            if ($newStatus === 'Izin' && empty($newKeterangan)) {
                $errors["keterangan.$id"] = 'Keterangan Izin wajib diisi.';
                continue;
            }

            $current = Kehadiran::select('status', 'keterangan')
                ->where('id_kehadiran', $id)
                ->first();

            if (!$current) continue;

            $update = [];
            if ($current->status !== $newStatus) $update['status'] = $newStatus;
            if ($current->keterangan !== $newKeterangan) $update['keterangan'] = $newKeterangan;

            if (!empty($update)) {
                Kehadiran::where('id_kehadiran', $id)->update($update);
                $updatedCount++;
            }
        }

        $errorCount = \count($errors);

        $response = back()->withInput();

        if ($updatedCount > 0) {
            $response->with('success', "$updatedCount baris berhasil disimpan.");
        }

        if ($errorCount > 0) {
            $response->with('error', "$errorCount baris terjadi kesalahan.")->withErrors($errors)->withInput();
        }

        return $response;
    }

    public function delete()
    {
        if (!Gate::allows('guru')) {
            abort(404);
        }

        $kelas = kelas::orderedNamaKelas()->get();
        $semester = Semester::filter(['order_by' => 'desc'])->get();

        return view('pages.akademik.kehadiran.delete', [
            'judul' => 'Kehadiran',
            'kelas' => $kelas,
            'semester' => $semester
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

        $kehadiran_update_validation_rules = $this->kehadiran_validation_rules;
        $kehadiran_update_validation_rules['tanggal'] = 'required|date';

        $validated_kehadiran = $request->validate($kehadiran_update_validation_rules);

        /** @var \Illuminate\Database\Eloquent\Builder $kehadiran_data */
        $kehadiran_data = Kehadiran::whereHas('siswa', fn($query) => $query->where('id_kelas', $validated_kehadiran['id_kelas']))
            ->where('id_semester', $validated_kehadiran['id_semester'])
            ->where('tanggal', $validated_kehadiran['tanggal']);

        if (!$kehadiran_data->exists()) {
            return back()->with('error', 'Kehadiran tidak ditemukan untuk dihapus.')->withInput();
        }

        $kehadiran_data->delete();

        return redirect()->route('kehadiran.index')->with('success', 'Kehadiran berhasil dihapus.');
    }
}
