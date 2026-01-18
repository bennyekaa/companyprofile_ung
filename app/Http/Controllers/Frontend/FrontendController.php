<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Master\Konten;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index() {
        $data['hero'] = Konten::where('id_kategori', 24)
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        $data['informasi'] = Konten::where('id_kategori', 2)
            ->where('status', 1)
            ->orderBy('created_at', 'asc')
            ->take(6)
            ->get();
        $data['agenda'] = Konten::where('id_kategori', 25)
            ->where('status', 1)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('frontend.page.beranda.index', $data);
    }

    public function tentang() {
        return view('frontend.page.profil.tentang');
    }

    public function visimisi() {
        return view('frontend.page.profil.visimisi');
    }

    public function pejabat() {
        return view('frontend.page.formasi.pejabat');
    }

    public function dosen() {
        return view('frontend.page.formasi.dosen');
    }

    public function pegawai() {
        return view('frontend.page.formasi.pegawai');
    }

    public function galeri() {
        return view('frontend.page.galeri.galeri');
    }
}
