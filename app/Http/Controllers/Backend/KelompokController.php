<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Master\Kelompok;
use Exception;
use Illuminate\Http\Request;

class KelompokController extends Controller
{
    //
    public function index()
    {
        session()->put('kelompok', url()->full());
        $data['kelompok'] = Kelompok::all();
        return view('backend.master.kelompok.index', $data);
    }

    public function tambah()
    {
        return view('backend.master.kelompok.add');
    }

    public function edit($id)
    {
        try {
            $kelompok = Kelompok::find(decrypt($id));
            return view('backend.master.kelompok.edit', compact('kelompok'));
        } catch (Exception $e) {
            return redirect(session('kelompok'))->with('error', $e->getMessage());
        }
    }

    public function action(Request $request)
    {
        if ($request->fungsi == 'tambah') {
            $kelompok = new Kelompok();
            $kelompok->nama = $request->nama;
            $kelompok->keterangan = $request->keterangan;
            $kelompok->created_by = session()->get('username');
            $kelompok->save();

            return redirect(session('kelompok'))->with('success', 'Data Berhasil Ditambah');
        } else if ($request->fungsi == 'edit') {
            $kelompok = Kelompok::find(decrypt($request->id));
            $kelompok->nama = $request->nama;
            $kelompok->keterangan = $request->keterangan;
            $kelompok->created_by = session()->get('username');
            $kelompok->save();
            return redirect(session('kelompok'))->with('success', 'Data Berhasil Diubah');
        }
    }

    public function status($id, $stat)
    {
        try {
            $kelompok = Kelompok::find(decrypt($id));
            $kelompok->status = $stat;
            $kelompok->updated_by = session()->get('username');
            $kelompok->save();
            return redirect(session('kelompok'))->with('success', 'Status Berubah');
        } catch (Exception $e) {
            return redirect(session('kelompok'))->with('error', $e->getMessage());
        }
    }

    public function hapus($id)
    {
        try {
            $kelompok = Kelompok::find(decrypt($id));
            $kelompok->delete();
            return redirect(session('kelompok'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(session('kelompok'))->with('error', $e->getMessage());
        }
    }
}
