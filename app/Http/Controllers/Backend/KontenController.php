<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Master\Kategori;
use App\Models\Master\Konten;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KontenController extends Controller
{
    public function index()
    {
        session()->put('konten', url()->full());
        $data['konten'] = Konten::all();
        $data['kategori'] = Kategori::all();
        return view('backend.master.konten.index', $data);
    }

    public function tambah()
    {
        $data['kategori'] = Kategori::where('status', 1)->get();
        return view('backend.master.konten.add', $data);
    }

    public function edit($id)
    {
        $data['konten'] = Konten::findOrFail(decrypt($id));
        $data['kategori'] = Kategori::where('status', 1)->get();

        return view('backend.master.konten.edit', $data);
    }

    public function action(Request $request)
    {
        try {
            if ($request->fungsi == 'tambah') {
                $tambah = new Konten();
                $tambah->judul = $request->judul;
                $tambah->id_kategori = $request->kategori;
                $tambah->tanggal = $request->tanggal;
                $tambah->tanggal_posting = $request->tanggal_posting;
                $tambah->detail = $request->detail;
                $tambah->deskripsi = $request->deskripsi;
                $tambah->keterangan = $request->keterangan;
                if ($request->hasFile('berkas')) {
                    if ($request->file('berkas')->isValid()) {
                        $berkas = $request->file('berkas')->store('public/berkas');
                        $tambah->berkas = $berkas;
                    }
                }
                $tambah->created_by = session()->get('username');
                $tambah->save();

                return redirect(session('konten'))->with('success', 'Data Berhasil Ditambah');
            }
            if ($request->fungsi == 'edit') {
                $konten = Konten::findOrFail(decrypt($request->id));

                // update field biasa
                $konten->judul = $request->judul;
                $konten->id_kategori = $request->kategori;
                $konten->tanggal = $request->tanggal;
                $konten->tanggal_posting = $request->tanggal_posting;
                $konten->detail = $request->detail;
                $konten->deskripsi = $request->deskripsi;
                $konten->keterangan = $request->keterangan;
                $konten->updated_by = session()->get('username');

                // 🔥 JIKA ADA FILE BARU
                if ($request->hasFile('berkas')) {

                    // hapus file lama
                    if ($konten->berkas && Storage::exists($konten->berkas)) {
                        Storage::delete($konten->berkas);
                    }

                    // simpan file baru
                    $konten->berkas = $request->file('berkas')->store('public/berkas');
                }

                $konten->save();
                return redirect(session('konten'))->with('success', 'Data Berhasil Diupdate');
            }
        } catch (Exception $e) {
            return redirect(session('konten'))->with('error', $e->getMessage());
        }
    }

    public function status($id, $stat)
    {
        try {
            $konten = Konten::find(decrypt($id));
            $konten->status = $stat;
            $konten->updated_by = session()->get('username');
            $konten->save();
            return redirect(session('konten'))->with('success', 'Status Berubah');
        } catch (Exception $e) {
            return redirect(session('konten'))->with('error', $e->getMessage());
        }
    }

    public function hapus($id)
    {
        try {
            $konten = Konten::findOrFail(decrypt($id));

            if ($konten->berkas && Storage::exists($konten->berkas)) {
                Storage::delete($konten->berkas);
            }

            $konten->delete();
            return redirect(session('konten'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(session('konten'))->with('error', $e->getMessage());
        }
    }
}
