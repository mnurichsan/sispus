<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Alert;

class PasienController extends Controller
{
    public function index()
    {
        $data =  Pasien::all();

        return view('pasien.index',compact('data'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nik' => 'required',
            'nama_kk' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_hp' => 'required'
        ]);

        $cekNik = Pasien::where('nik',$request->nik)->first();
        if($cekNik)
        {
            Alert::warning('Gagal','Nik Sudah Terdaftar');
            return redirect()->back();
        }

        $data = [
            'no_rekammedis' =>  IdGenerator::generate(['table' => 'pasiens','field'=>'no_rekammedis', 'length' => 10,'prefix' => 0]),
            'nik' => $request->nik,
            'nama_kk' => $request->nama_kk,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ];

        Pasien::create($data);
        Alert::success('Sukses','Data Berhasil Di Tambah');
        return redirect()->back();
    }

    public function show(Request $request)
    {
        //
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $data = Pasien::findOrFail($id);

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'nik' => 'required',
            'nama_kk' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_hp' => 'required'
        ]);

        $id = $request->id;

        $data = [
            'nik' => $request->nik,
            'nama_kk' => $request->nama_kk,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat
        ];

        Pasien::findOrFail($id)->update($data);
        Alert::success('Sukses','Data Berhasil Di Update');
        return redirect()->back();

    }

    public function delete(Request $request)
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


