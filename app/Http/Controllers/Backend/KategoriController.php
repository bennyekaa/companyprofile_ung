<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Master\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //
    public function index(){
        $data['kategori'] = Kategori::all();
        return view('backend.page.master.kategori.index', $data);
    }
}
