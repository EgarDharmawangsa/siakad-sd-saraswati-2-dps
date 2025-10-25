<?php

namespace App\Http\Controllers;


use App\Models\Pengumuman;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::query()->orderBy('tanggal', 'desc')->paginate(20)->withQueryString();

        return view('pages.beranda', [
            'judul' => 'Beranda',
            'pengumuman' => $pengumuman
        ]);
    }
}
