<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Master\Pengguna;
use App\Models\Master\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    //
    public function index()
    {
        session()->put('pengguna', url()->full());
        $data['pengguna'] = Pengguna::leftJoin('ref_role', 'ref_pengguna.role', '=', 'ref_role.id')
            ->where('ref_pengguna.role', '!=', 1)
            ->select('ref_pengguna.*', 'ref_role.nama as role_nama')
            ->get();
        // dd($data['pengguna']);
        return view('backend.master.pengguna.index', $data);
    }

    public function tambah()
    {
        $data['role'] = Role::where('id', '!=', 1)->get();
        return view('backend.master.pengguna.add', $data);
    }

    public function action(Request $request)
    {
        if ($request->fungsi == 'tambah') {
            $pengguna = new Pengguna();
            $pengguna->username = $request->username;
            $pengguna->role = $request->role;
            $pengguna->password = Hash::make($request->password);
            $pengguna->created_by = session()->get('username');
            $pengguna->save();

            return redirect(session('pengguna'))->with('success', 'Data Berhasil Ditambah');
        } else if ($request->fungsi == 'edit') {
            $pengguna = Pengguna::find(decrypt($request->id));
            $pengguna->username = $request->username;
            $pengguna->role = $request->role;
            $pengguna->password = Hash::make($request->password);
            $pengguna->created_by = session()->get('username');
            $pengguna->save();
            return redirect(session('pengguna'))->with('success', 'Data Berhasil Diubah');
        }
    }

    public function edit($id)
    {
        $id = decrypt($id);

        $data['pengguna'] = Pengguna::where('ref_pengguna.id', '=', $id)->first();
        $data['role'] = Role::where('id', '!=', 1)->get();
        // dd($data);
        return view('backend.master.pengguna.edit', $data);
    }


    public function hapus($id)
    {
        $pengguna = Pengguna::find(decrypt($id));
        $pengguna->delete();
        return redirect(session('pengguna'))->with('success', 'Data berhasil dihapus');
    }

    public function status($id, $stat)
    {
        $pengguna = Pengguna::find(decrypt($id));
        $pengguna->status = $stat;
        $pengguna->updated_by = session()->get('username');
        $pengguna->save();
        return redirect(session('pengguna'))->with('success', 'Status Berubah');
    }
}
