<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public $semester_validation_rules = [
        'jenis_semester' => 'required|string|not_in:default',
        'tanggal_mulai' => 'required|date|unique:semester,tanggal_mulai|after_or_equal:today|before:tanggal_selesai',
        'tanggal_selesai' => 'required|date|unique:semester,tanggal_selesai|after:today|after:tanggal_mulai'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semester = Semester::query()->orderBy('tanggal_mulai', 'desc')->paginate(20)->withQueryString();

        return view('pages.master.semester.index', [
            'judul' => 'Semester',
            'semester' => $semester
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.master.semester.create', [
            'judul' => 'Semester'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_semester = $request->validate($this->semester_validation_rules);

        $errors = Semester::getOverlapErrors($validated_semester['tanggal_mulai'], $validated_semester['tanggal_selesai']);

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        Semester::create($validated_semester);

        return redirect()->route('semester.index')->with('success', 'Semester berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Semester $semester)
    {
        return view('pages.master.semester.show', [
            'judul' => 'Semester',
            'semester' => $semester
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semester $semester)
    {
        return view('pages.master.semester.edit', [
            'judul' => 'Semester',
            'semester' => $semester
        ]);
    }
    
    /**
     * Update the specified resource in storage.
    */
    public function update(Request $request, Semester $semester)
    {
        $semester_update_validation_rules = $this->semester_validation_rules;
    
        $semester_update_validation_rules['tanggal_mulai'] = "required|date|unique:semester,tanggal_mulai,{$semester->id_semester},id_semester|after_or_equal:today|before:tanggal_selesai";
        $semester_update_validation_rules['tanggal_selesai'] = "required|date|unique:semester,tanggal_selesai,{$semester->id_semester},id_semester|after:today|after:tanggal_mulai";

        $validated_semester = $request->validate($semester_update_validation_rules);

        $errors = Semester::getOverlapErrors($validated_semester['tanggal_mulai'], $validated_semester['tanggal_selesai'], $semester->id_semester);

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $semester->update($validated_semester);
    
        return redirect()->route('semester.index')->with('success', 'Semester berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semester $semester)
    {
        $semester->delete();

        return redirect()->route('semester.index')->with('success', 'Semester berhasil dihapus.');
    }
}
