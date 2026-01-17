<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Master\Role;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function index()
    {
        session()->put('role', url()->full());
        $data['role'] = Role::all();
        return view('backend.master.role.index', $data);
    }

    public function tambah()
    {
        return view('backend.master.role.add');
    }

    public function edit($id)
    {
        try {
            $role = Role::find(decrypt($id));
            return view('backend.master.role.edit', compact('role'));
        } catch (Exception $e) {
            return redirect(session('role'))->with('error', $e->getMessage());
        }
    }

    public function action(Request $request)
    {
        if ($request->fungsi == 'tambah') {
            $role = new Role();
            $role->nama = $request->nama;
            $role->keterangan = $request->keterangan;
            $role->created_by = session()->get('username');
            $role->save();

            return redirect(session('role'))->with('success', 'Data Berhasil Ditambah');
        } else if ($request->fungsi == 'edit') {
            $role = Role::find(decrypt($request->id));
            $role->nama = $request->nama;
            $role->keterangan = $request->keterangan;
            $role->created_by = session()->get('username');
            $role->save();
            return redirect(session('role'))->with('success', 'Data Berhasil Diubah');
        }
    }

    public function status($id, $stat)
    {
        try {
            $role = Role::find(decrypt($id));
            $role->status = $stat;
            $role->updated_by = session()->get('username');
            $role->save();
            return redirect(session('role'))->with('success', 'Status Berubah');
        } catch (Exception $e) {
            return redirect(session('role'))->with('error', $e->getMessage());
        }
    }

    public function hapus($id)
    {
        try {
            $role = Role::find(decrypt($id));
            $role->delete();
            return redirect(session('role'))->with('success', 'Data Terhapus');
        } catch (Exception $e) {
            return redirect(session('role'))->with('error', $e->getMessage());
        }
    }
}
