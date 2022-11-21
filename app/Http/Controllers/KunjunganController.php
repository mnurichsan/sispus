<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kunjungan;
use Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class KunjunganController extends Controller
{
    public function index()
    {
        $kunjungans = Kunjungan::with('poli', 'pasien', 'dokter')->get();
        return view('pendaftaran.kunjungan.index', compact('kunjungans'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_masuk'     => ['required'],
            'jam_masuk'         => ['required'],
            'pasien_id'         => ['required'],
            'poli_id'           => ['required'],
            'dokter_id'         => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back();
        }

        Kunjungan::create($validator->validated());
        Alert::success('Sukses','Data Berhasil Di Tambah');
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        $kunjungan = Kunjungan::findOrFail($request->id);

        return response()->json($kunjungan);
    }

    public function update(Request $request)
    {
        $kunjungan = Kunjungan::findOrFail($request->id);
        
        $validator = Validator::make($request->all(), [
            'tanggal_masuk'     => ['required'],
            'jam_masuk'         => ['required'],
            'pasien_id'         => ['required'],
            'poli_id'           => ['required'],
            'dokter_id'         => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back();
        }

        $kunjungan->update($validator->validated());
        Alert::success('Sukses','Data Berhasil Di Tambah');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {   
        $kunjungan = Kunjungan::findOrFail($request->id)->delete();

        if($kunjungan){
            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        }else{
            return response()->json(['message' => 'Data Gagal Di Hapus']);
        }
    }

    public function cetak(Request $request)
    {
        $kunjungan = Kunjungan::with('poli', 'pasien', 'dokter')->findOrFail($request->id);

        $pdf = Pdf::loadView('pendaftaran.kunjungan.cetak', compact('kunjungan'));
        return $pdf->stream();
        // return view('pendaftaran.kunjungan.cetak', compact('kunjungan'));
        // return $pdf->download('invoice.pdf'); 
    }
}
