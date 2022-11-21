<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KepalaKeluarga;
use Alert;
use Illuminate\Support\Facades\Validator;

class KepalaKeluargaController extends Controller
{
    public function index()
    {
        $kepalaKeluargas = KepalaKeluarga::all();
        return view('pendaftaran.kepala_keluarga.index', compact('kepalaKeluargas'));
    }

    public function list()
    {
        $kepalaKeluarga = KepalaKeluarga::all();
        return response()->json($kepalaKeluarga);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'no_kk'             => ['required', 'unique:kepala_keluargas,no_kk'],
                'nama_kk'           => ['required'],
                'tempat_lahir'      => ['required'],
                'tanggal_lahir'     => ['required'],
                'jenis_kelamin'     => ['required', 'boolean'],
                'pekerjaan'         => ['required'],
                'alamat'            => ['required']
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            KepalaKeluarga::create($validator->validated());
    
            Alert::success('Sukses','Data Berhasil Di Tambah');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::error('Gagal','Terjadi Kesalahan');
            return redirect()->back();
        }
        
    }

    public function edit(Request $request)
    {
        $kepalaKeluarga = KepalaKeluarga::findOrFail($request->id);

        return response()->json($kepalaKeluarga);
    }

    public function update(Request $request)
    {
        try {
            $kepalaKeluarga = KepalaKeluarga::findOrFail($request->id);
            
            $validator = Validator::make($request->all(), [
                'no_kk'             => ['required', 'unique:kepala_keluargas,no_kk,' . $kepalaKeluarga->id],
                'nama_kk'           => ['required'],
                'tempat_lahir'      => ['required'],
                'tanggal_lahir'     => ['required'],
                'jenis_kelamin'     => ['required', 'boolean'],
                'pekerjaan'         => ['required'],
                'alamat'            => ['required']
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $kepalaKeluarga->update($validator->validated());

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
            KepalaKeluarga::findOrFail($request->id)->delete();
            
            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Data Gagal Di Hapus']);
        }
    }
}
