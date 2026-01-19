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
        if (Gate::any(['staf-tata-usaha', 'guru']))
            $kehadiran = Kehadiran::with(['siswa', 'siswa.kelas', 'semester'])->filter(request()->all())
                ->join('siswa', 'siswa.id_siswa', '=', 'kehadiran.id_siswa')
                ->orderBy('siswa.nomor_urut')->select('kehadiran.*')
                ->paginate(20)
                ->withQueryString();
        else if (Gate::allows('siswa')) {
            $kehadiran = Kehadiran::with(['siswa', 'siswa.kelas', 'semester'])->where('id_siswa', Auth::user()->siswa->id_siswa)->filter(request()->except(['kelas_filter', 'siswa_filter']))->paginate(20)->withQueryString();
        } else {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $siswa = Siswa::get();
        $semester = Semester::filter(['order_by' => 'desc'])->get();
        $route_kehadiran_filter = route('kehadiran.recapitulation');

        return view('pages.akademik.kehadiran.index', [
            'judul' => 'Kehadiran',
            'route_kehadiran_filter' => $route_kehadiran_filter,
            'kehadiran' => $kehadiran,
            'kelas' => $kelas,
            'siswa' => $siswa,
            'semester' => $semester
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

        return redirect()->route('kehadiran.index')->with('success', 'Kehadiran berhasil ditambahkan / disinkronkan.');
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
        if (Gate::any(['staf-tata-usaha', 'guru']))
            $kehadiran = Kehadiran::with(['siswa', 'siswa.kelas', 'semester'])->filter(request()->except(['status_filter', 'keterangan_filter', 'tanggal_filter']))
                ->join('siswa', 'siswa.id_siswa', '=', 'kehadiran.id_siswa')
                ->orderBy('siswa.nomor_urut')->select('kehadiran.*')
                ->paginate(20)
                ->withQueryString();
        else if (Gate::allows('siswa')) {
            $kehadiran = Kehadiran::with(['siswa', 'siswa.kelas', 'semester'])->siswaRecap(Auth::user()->siswa->id_siswa)->filter(request()->except(['kelas_filter', 'siswa_filter', 'status_filter', 'keterangan_filter', 'tanggal_filter']))->paginate(20)->withQueryString();
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
        $kehadiran_update_validation_rules['tanggal_new'] = 'required|date|after_or_equal:today';

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
            ->route('kehadiran.index')
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

        $kehadiran_update_validation_rules = [
            'id_kehadiran'   => 'required|array',
            'id_kehadiran.*' => 'required|exists:kehadiran,id_kehadiran',
            'status'   => 'required|array',
            'status.*' => 'required|in:Hadir,Sakit,Izin,Alfa',
            'keterangan'   => 'nullable|array',
            'keterangan.*' => 'nullable|string|max:255',
        ];

        $validated_kehadiran = $request->validate($kehadiran_update_validation_rules);

        foreach ($validated_kehadiran['id_kehadiran'] as $id_kehadiran) {

            if (!isset($validated_kehadiran['status'][$id_kehadiran])) {
                continue;
            }

            $new_status = $validated_kehadiran['status'][$id_kehadiran];

            $new_keterangan = null;

            if ($new_status === 'Izin') {
                $new_keterangan = $validated_kehadiran['keterangan'][$id_kehadiran] ?? null;

                if (empty($new_keterangan)) {
                    return back()->withErrors(["keterangan.$id_kehadiran" => 'Keterangan Izin wajib diisi.'])->withInput();
                }
            }

            $current_kehadiran = Kehadiran::query()->select('status', 'keterangan')
                ->where('id_kehadiran', $id_kehadiran)
                ->first();

            if (!$current_kehadiran) {
                continue;
            }

            $kehadiran_data_update = [];

            if ($current_kehadiran->status !== $new_status) {
                $kehadiran_data_update['status'] = $new_status;
            }

            if ($current_kehadiran->keterangan !== $new_keterangan) {
                $kehadiran_data_update['keterangan'] = $new_keterangan;
            }

            if (empty($kehadiran_data_update)) {
                continue;
            }

            Kehadiran::where('id_kehadiran', $id_kehadiran)
                ->update($kehadiran_data_update);
        }

        return back()->with('success', 'Kehadiran berhasil disimpan.');
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
