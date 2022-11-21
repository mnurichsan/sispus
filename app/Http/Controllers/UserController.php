<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', [0,2,4,5])->get();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name'          => ['required', 'unique:users,name'],
            'password'      => ['required'],
            'role'          => ['required']
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $user = User::create([
                'name'      => $request->name,
                'password'  => Hash::make($request->password),
                'role'      => $request->role,
            ]);

            if(!empty($request->pegawai)){
                $user->pegawai()->attach($request->pegawai);
            }
    
            Alert::success('Sukses','Data Berhasil Di Tambah');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Gagal','Terjadi Kesalahan');
            return $th;
        } finally{
            DB::commit();
        }
    }

    public function edit(Request $request)
    {
        $user = User::with('pegawai')->findOrFail($request->id);

        return response()->json($user);
    }

    // public function update(Request $request)
    // {
    //     $user = User::findOrFail($request->id);

    //     $validator = Validator::make($request->all(), [
    //         'name'          => ['required', 'unique:users,name'],
    //         'password'      => ['required'],
    //         'role'          => ['required'],
    //         'pegawai'       => ['required']
    //     ]);

    //     if($validator->fails()){
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     DB::beginTransaction();
    //     try {

    //         $user->update([
    //             'name'      => $request->name,
    //             'password'  => empty($request->password) ? Hash::make($request->password) : $user->password,
    //             'role'      => $request->role,
    //         ]);

    //         $user->pegawai()->sync($request->pegawai);
    
    //         Alert::success('Sukses','Data Berhasil Di Tambah');
    //         return redirect()->back();
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         Alert::error('Gagal','Terjadi Kesalahan');
    //         return $th;
    //     } finally{
    //         DB::commit();
    //     }
    // }

    public function destroy(Request $request)
    {
        $user = User::with('pegawai')->findOrFail($request->id);

        DB::beginTransaction();
        try {
            if($user->pegawai->count() > 0){
                $user->pegawai()->detach();
            }

            $user->delete();
            return response()->json(['message' => 'Data Berhasil Di Hapus']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            
            return response()->json(['message' => 'Data Gagal Di Hapus']);
        } finally{
            DB::commit();
        }
    }
}
