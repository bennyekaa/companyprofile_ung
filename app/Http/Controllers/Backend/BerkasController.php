<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    //
    public function index()
    {
        return view('backend.master.kategori.index');
    }
}
