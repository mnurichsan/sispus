<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Validator;
use Alert;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('pegawai.index', compact('pegawais'));
    }

    public function list()
    {
        $pegawais = Pegawai::all();
        return response()->json($pegawais);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'          => ['required'],
            'nip'           => ['required', 'unique:pegawais,nip'],
            'tgl_lahir'     => ['required'], 
            'jenkel'        => ['required'],
            'alamat'        => ['required'],
        ]);

        $validated = $validator->validated();

        Pegawai::create($validated);
        Alert::success('Sukses','Data Berhasil Di Tambah');
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        $pegawai = Pegawai::findOrFail($request->id);

        return response()->json($pegawai);
    }

    public function update(Request $request)
    {
        $pegawai = Pegawai::findOrFail($request->id);
        
        $validator = Validator::make($request->all(), [
            'nama'          => ['required'],
            'nip'           => ['required', 'unique:pegawais,nip,' . $pegawai->id],
            'tgl_lahir'     => ['required'], 
            'jenkel'        => ['required'],
            'alamat'        => ['required'],
        ]);

        
        $validated = $validator->validated();

        $pegawai->update($validated);
        Alert::success('Sukses','Data Berhasil Di Tambah');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $pegawai = Pegawai::findOrFail($request->id)->delete();

        if($pegawai){
            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        }else{
            return response()->json(['message' => 'Data Gagal Di Hapus']);
        }
    }
}
