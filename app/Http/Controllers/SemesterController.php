<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SemesterController extends Controller
{
    public $semester_validation_rules = [
        'jenis' => 'required|string|min:3|max:10',
        'tanggal_mulai' => 'required|date|unique:semester,tanggal_mulai|after_or_equal:today|before:tanggal_selesai',
        'tanggal_selesai' => 'required|date|unique:semester,tanggal_selesai|after:today|after:tanggal_mulai'
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }

        $semester = Semester::filter(request()->all())->paginate(20)->withQueryString();

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
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        return view('pages.master.semester.create', [
            'judul' => 'Semester'
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

        $validated_semester = $request->validate($this->semester_validation_rules);

        $errors = Semester::getTanggalValidationErrors($validated_semester['tanggal_mulai'], $validated_semester['tanggal_selesai']);

        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        Semester::create($validated_semester);

        return redirect()->route('semester.index')->with('success', 'Semester berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Semester $semester)
    {
        if (!Gate::any(['staf-tata-usaha', 'guru'])) {
            abort(404);
        }
        
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
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

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
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $semester_update_validation_rules = $this->semester_validation_rules;
    
        $semester_update_validation_rules['tanggal_mulai'] = "required|date|unique:semester,tanggal_mulai,{$semester->id_semester},id_semester|after_or_equal:today|before:tanggal_selesai";
        $semester_update_validation_rules['tanggal_selesai'] = "required|date|unique:semester,tanggal_selesai,{$semester->id_semester},id_semester|after:today|after:tanggal_mulai";

        $validated_semester = $request->validate($semester_update_validation_rules);

        $errors = Semester::getTanggalValidationErrors($validated_semester['tanggal_mulai'], $validated_semester['tanggal_selesai'], $semester->id_semester);

        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        $semester->update($validated_semester);
    
        return redirect()->route('semester.index')->with('success', 'Semester berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semester $semester)
    {
        if (!Gate::allows('staf-tata-usaha')) {
            abort(404);
        }

        $semester->delete();

        return redirect()->route('semester.index')->with('success', 'Semester berhasil dihapus.');
    }
}
