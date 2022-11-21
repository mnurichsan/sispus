<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Alert;
use Illuminate\Support\Facades\Validator;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = Dokter::with('user')->get();
        return view('master_data.dokter.index', compact('dokters'));
    }

    public function list()
    {
        $dokters = Dokter::where('dokter_aktif', 1)->get();
        return response()->json($dokters);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nama_dokter'         => ['required'],
                'spesialis'           => ['required'],
                'dokter_aktif'        => ['required', 'boolean'],
                'dokter_luar'         => ['required', 'boolean'],
                'username'            => ['required', 'unique:users,name'],
                'password'            => ['required']
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
    
            $user = User::create([
                'name'                => $request->username,
                'password'            => Hash::make($request->password),
                'role'                => 3
            ]);

            Dokter::create([
                'nama_dokter'         => $request->nama_dokter,
                'spesialis'           => $request->spesialis,
                'dokter_aktif'        => $request->dokter_aktif,
                'dokter_luar'         => $request->dokter_luar,
                'user_id'             => $user->id
            ]);
    
            Alert::success('Sukses','Data Berhasil Di Tambah');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Gagal','Terjadi Kesalahan');
            return redirect()->back();
        }
        
    }

    public function edit(Request $request)
    {
        $dokter = Dokter::with('user')->findOrFail($request->id);

        return response()->json($dokter);
    }

    public function update(Request $request)
    {
        try {
            $dokter = Dokter::findOrFail($request->id);
            $user = User::findOrFail($dokter->user_id);
            
            $validator = Validator::make($request->all(), [
                'nama_dokter'         => ['required'],
                'spesialis'           => ['required'],
                'dokter_aktif'        => ['required', 'boolean'],
                'dokter_luar'         => ['required', 'boolean'],
                'username'            => ['required', 'unique:users,name,' . $user->id],
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user->update([
                'name'                => $request->username,
                'password'            => empty($request->password) ? $user->password : Hash::make($request->password),
                'role'                => 3
            ]);

            $dokter->update([
                'nama_dokter'         => $request->nama_dokter,
                'spesialis'           => $request->spesialis,
                'dokter_aktif'        => $request->dokter_aktif,
                'dokter_luar'         => $request->dokter_luar,
            ]);

            Alert::success('Sukses','Data Berhasil Di Ubah');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Gagal','Terjadi Kesalahan');
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {       
        try {
            User::findOrFail($request->id)->delete();
            
            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data Gagal Di Hapus']);
        }
    }
}
