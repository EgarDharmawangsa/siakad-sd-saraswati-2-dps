<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::any(['staf-tata-usaha', 'guru']))
            $kehadiran = Kehadiran::with(['siswa', 'siswa.kelas', 'semester'])->filter(request()->all())->paginate(20)->withQueryString();
        else if (Gate::allows('siswa')) {
            $kehadiran = Kehadiran::with(['siswa', 'siswa.kelas', 'semester'])->where('id_siswa', Auth::user()->siswa->id_siswa)->filter(request()->all())->paginate(20)->withQueryString();
        } else {
            abort(404);
        }

        $kelas = Kelas::orderedNamaKelas()->get();
        $kelas_default_filter = Kelas::orderedNamaKelas()->first();
        $siswa = Siswa::get();
        $semester = Semester::latest()->get();
        $active_semester = Semester::activeSemester()->first();

        if (!$active_semester) {
            $active_semester = Semester::latest()->first();
        }

        return view('pages.akademik.kehadiran.index', [
            'judul' => 'Kehadiran',
            'kehadiran' => $kehadiran,
            'kelas' => $kelas,
            'kelas_default_filter' => $kelas_default_filter,
            'siswa' => $siswa,
            'semester' => $semester,
            'active_semester' => $active_semester
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

        $kelas = kelas::orderedNamaKelas()->get();
        $semester = Semester::latest()->get();

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
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }

        $kehadian_validation_rules = [
            'id_kelas' => 'required|exists:kelas,id_kelas',
            'id_semester' => 'required|exists:semester,id_semester',
            'tanggal' => 'required|date|equal_or_after:today'
        ];
        $siswa = Siswa::get();

        if ($siswa->isEmpty()) {
            return back()->with('error', 'Siswa tidak tersedia.');
        }

        $validated_kehadiran = $request->validate($kehadian_validation_rules);

        Siswa::where('id_kelas', $validated_kehadiran['id_kelas'])->get()->each(function ($siswa) use ($validated_kehadiran) {
            Kehadiran::firstOrCreate(
                [
                    'id_siswa' => $siswa->id_siswa,
                    'id_kelas' => $validated_kehadiran['id_kelas'],
                    'id_semester' => $validated_kehadiran['id_semester']
                ],
                [
                    'status' => 'Alfa',
                    'keterangan' => null,
                    'tanggal' => $validated_kehadiran['tanggal']
                ]
            );
        });

        return redirect()->route('kehadiran.index')->with('success', 'Kehadiran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kehadiran $kehadiran)
    {
        return view('pages.akademik.kehadiran.show', [
            'judul' => 'Kehadiran',
            'kehadiran' => $kehadiran
        ]);
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
    public function update(Request $request, Kehadiran $kehadiran)
    {
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }

        $kehadiran_update_validation_rules = [
            'id_kehadiran' => 'required|array',
            'id_kehadiran.*' => 'required|exists:kehadiran,id_kehadiran',
            'status' => 'required|array',
            'status.*' => 'required|in:Hadir,Sakit,Izin,Alfa',
            'keterangan' => 'nullable|array',
            'keterangan.*' => 'nullable|string|max:255'
        ];

        $validated_kehadiran = $request->validate($kehadiran_update_validation_rules);

        foreach ($validated_kehadiran['id_kehadiran'] as $_id_kehadiran) {
            if (!\array_key_exists($_id_kehadiran, $validated_kehadiran['status'])) {
                continue;
            }

            $new_status = $validated_kehadiran['status'][$_id_kehadiran];
            $new_keterangan = null;

            if ($new_status === 'Izin') {
                $new_keterangan = $validated_kehadiran['keterangan'][$_id_kehadiran] ?? null;
            }

            Kehadiran::where('id_kehadiran', $_id_kehadiran)
                ->where(function ($query) use ($new_status, $new_keterangan) {
                    $query->where('status', '!=', $new_status)
                        ->orWhere('keterangan', '!=', $new_keterangan);
                })
                ->update([
                    'status' => $new_status,
                    'keterangan' => $new_keterangan
                ]);
        }

        return back()->with('success', 'Kehadiran berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Kehadiran $kehadiran)
    // {
    //     //
    // }
}
