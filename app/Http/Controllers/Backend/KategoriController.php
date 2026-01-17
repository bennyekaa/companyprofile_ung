<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Master\Kategori;
use Exception;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //
    public function index()
    {
        session()->put('kategori', url()->full());
        $data['kategori'] = Kategori::all();
        return view('backend.master.kategori.index', $data);
    }

    public function tambah()
    {
        return view('backend.master.kategori.add');
    }

    public function edit($id)
    {
        try {
            $kategori = Kategori::find(decrypt($id));
            return view('backend.master.kategori.edit', compact('kategori'));
        } catch (Exception $e) {
            return redirect(session('kategori'))->with('error', $e->getMessage());
        }
    }

    public function action(Request $request)
    {
        if ($request->fungsi == 'tambah') {
            $kategori = new Kategori();
            $kategori->nama = $request->nama;
            $kategori->keterangan = $request->keterangan;
            $kategori->created_by = session()->get('username');
            $kategori->save();

            return redirect(session('kategori'))->with('success', 'Data Berhasil Ditambah');
        } else if ($request->fungsi == 'edit') {
            $kategori = Kategori::find(decrypt($request->id));
            $kategori->nama = $request->nama;
            $kategori->keterangan = $request->keterangan;
            $kategori->created_by = session()->get('username');
            $kategori->save();
            return redirect(session('kategori'))->with('success', 'Data Berhasil Diubah');
        }
    }

    public function status($id, $stat)
    {
        try {
            $kategori = Kategori::find(decrypt($id));
            $kategori->status = $stat;
            $kategori->updated_by = session()->get('username');
            $kategori->save();
            return redirect(session('kategori'))->with('success', 'Status Berubah');
        } catch (Exception $e) {
            return redirect(session('kategori'))->with('error', $e->getMessage());
        }
    }

    public function hapus($id)
    {
        try {
            $kategori = Kategori::find(decrypt($id));
            $kategori->delete();
            return redirect(session('kategori'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(session('kategori'))->with('error', $e->getMessage());
        }
    }
}
