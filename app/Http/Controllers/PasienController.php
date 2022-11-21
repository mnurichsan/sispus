<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\KepalaKeluarga;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Alert;
use Illuminate\Support\Facades\Validator;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens =  Pasien::with('kepalaKeluarga')->orderBy('kepala_keluarga_id', 'desc')->get();
        $noKartuKeluarga  =  KepalaKeluarga::pluck('no_kk', 'id');

        return view('pendaftaran.pasien.index', compact('pasiens', 'noKartuKeluarga'));
    }

    public function list()
    {
        $pasiens = Pasien::all();
        return response()->json($pasiens);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik'                   => 'required',
            'nama_pasien'           => 'required',
            'tempat_lahir'          => 'required',
            'tanggal_lahir'         => 'required',
            'alamat'                => 'required',
            'jenis_kelamin'         => 'required',
            'agama'                 => 'max:10',
            'no_hp'                 => 'required',
            'pekerjaan'             => 'max:255',
            'no_kk'                 => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $cekNik = Pasien::where('nik',$request->nik)->first();
        if($cekNik)
        {
            Alert::warning('Gagal','Nik Sudah Terdaftar');
            return redirect()->back();
        }

        $data = [
            'no_rekammedis'         =>  IdGenerator::generate(['table' => 'pasiens','field'=>'no_rekammedis', 'length' => 10,'prefix' => 0]),
            'nik'                   => $request->nik,
            'nama_pasien'           => $request->nama_pasien,
            'tempat_lahir'          => $request->tempat_lahir,
            'tanggal_lahir'         => $request->tanggal_lahir,
            'alamat'                => $request->alamat,
            'jenis_kelamin'         => $request->jenis_kelamin,
            'agama'                 => $request->agama,
            'no_hp'                 => $request->no_hp,
            'pekerjaan'             => $request->pekerjaan,
            'kepala_keluarga_id'    => $request->no_kk,
        ];

        Pasien::create($data);
        Alert::success('Sukses','Data Berhasil Di Tambah');
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Pasien::with('kepalaKeluarga')->findOrFail($id);

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik'                   => 'required',
            'nama_pasien'           => 'required',
            'tempat_lahir'          => 'required',
            'tanggal_lahir'         => 'required',
            'alamat'                => 'required',
            'jenis_kelamin'         => 'required',
            'agama'                 => 'max:10',
            'no_hp'                 => 'required',
            'pekerjaan'             => 'max:255',
            'no_kk'                 => 'required'
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $id = $request->id;

        $data = [
            'nik'                   => $request->nik,
            'nama_pasien'           => $request->nama_pasien,
            'tempat_lahir'          => $request->tempat_lahir,
            'tanggal_lahir'         => $request->tanggal_lahir,
            'alamat'                => $request->alamat,
            'jenis_kelamin'         => $request->jenis_kelamin,
            'agama'                 => $request->agama,
            'no_hp'                 => $request->no_hp,
            'pekerjaan'             => $request->pekerjaan,
            'kepala_keluarga_id'    => $request->no_kk,
        ];

        Pasien::findOrFail($id)->update($data);
        Alert::success('Sukses','Data Berhasil Di Update');
        return redirect()->back();

    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        
        $data = Pasien::findOrFail($id)->delete();

        if($data){
            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        }else{
            return response()->json(['message' => 'Data Gagal Di Hapus']);
        }

        
    }
}


