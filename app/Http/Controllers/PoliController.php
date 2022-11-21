<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;
use Alert;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        return view('poli', compact('polis'));
    }

    public function list()
    {
        $polis = Poli::all();
        return response()->json($polis);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_poli' => 'required|unique:polis,nama_poli',
        ]);

        $validated = [
            'nama_poli' => $request->nama_poli,
        ];

        Poli::create($validated);
        Alert::success('Sukses','Data Berhasil Di Tambah');
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        $poli = Poli::findOrFail($request->id);

        return response()->json($poli);
    }

    public function update(Request $request)
    {
        $poli = Poli::findOrFail($request->id);
        $this->validate($request,[
            'nama_poli' => 'required|unique:polis,nama_poli,' . $poli->id,
        ]);

        $validated = [
            'nama_poli' => $request->nama_poli,
        ];

        $poli->update($validated);
        Alert::success('Sukses','Data Berhasil Di Tambah');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {   
        $poli = Poli::findOrFail($request->id)->delete();

        if($poli){
            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        }else{
            return response()->json(['message' => 'Data Gagal Di Hapus']);
        }
    }
}
