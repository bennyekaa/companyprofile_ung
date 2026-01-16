<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index() {
        return view('frontend.page.beranda.index');
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
