<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use Alert;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('apoteker.obat.index', compact('obats'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_obat'     => ['required'],
            'keterangan'    => ['required'],
            'satuan'        => ['required'],
            'harga'         => ['required'],
        ]);

        $validated = $validator->validated();

        Obat::create($validated);
        Alert::success('Sukses','Data Berhasil Di Tambah');
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        $obat = Obat::findOrFail($request->id);

        return response()->json($obat);
    }

    public function update(Request $request)
    {
        $obat = Obat::findOrFail($request->id);
        
        $validator = Validator::make($request->all(), [
            'nama_obat'     => ['required'],
            'keterangan'    => ['required'],
            'satuan'        => ['required'],
            'harga'         => ['required'],
        ]);
        
        $validated = $validator->validated();

        $obat->update($validated);
        Alert::success('Sukses','Data Berhasil Di Tambah');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $obat = Obat::findOrFail($request->id)->delete();

        if($obat){
            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        }else{
            return response()->json(['message' => 'Data Gagal Di Hapus']);
        }
    }
}
