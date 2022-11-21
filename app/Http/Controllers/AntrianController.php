<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Antrian;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class AntrianController extends Controller
{
    public function index()
    {
        Antrian::whereDate('created_at', '!=', Carbon::now())->delete();
        
        return view('antrian.index', ['jmlhAntrian', count(Antrian::whereDate('created_at', Carbon::now())->get())]);
    }

    public function list()
    {
        $antrians = Antrian::whereDate('created_at', Carbon::now())->get();
        return DataTables::of($antrians)
                ->editColumn('status', function($antrians){
                    return $antrians->status ? '<button class="btn btn-secondary  btn-sm rounded-circle"><i class="fa fa-microphone"></i></button>' : '<button class="btn btn-primary btn-sm rounded-circle"><i class="fa fa-microphone"></i></button>';
                })
                ->escapeColumns([])
                ->make(true);
    }

    public function store(Request $request)
    {
        $antrians = Antrian::whereDate('created_at', Carbon::now())->get();
        $data = Antrian::create([
            'no_antrian' => count($antrians) + 1,
        ]);

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $antrian = Antrian::findOrFail($request->id);
        $data = $antrian->update([
            'status' => 1,
        ]);

        return response()->json($data);
    }

    public function jumlahAntrian()
    {
        $jmlhAntrian = count(Antrian::whereDate('created_at', Carbon::now())->get());
        return response()->json($jmlhAntrian);
    }

    public function antrianSekarang()
    {
        $antrian = Antrian::whereDate('created_at', Carbon::now())->where('status', 1)->orderBy('updated_at', 'DESC')->first();
        $antrianSekarang = $antrian->no_antrian ?? 0;
        return response()->json($antrianSekarang);
    }

    public function antrianSelanjutnya()
    {
        $antrian = Antrian::whereDate('created_at', Carbon::now())->where('status', 0)->orderBy('no_antrian', 'ASC')->first();
        $antrianSelanjutnya = $antrian->no_antrian ?? 0;
        return response()->json($antrianSelanjutnya);
    }

    public function sisaAntrian()
    {
        $sisaAntrian = count(Antrian::whereDate('created_at', Carbon::now())->where('status', 0)->get());
        return response()->json($sisaAntrian);
    }

    public function cetak(Request $request)
    {
        $antrian = Antrian::whereDate('created_at', Carbon::now())->where('status', 1)->orderBy('updated_at', 'DESC')->first();
        $antrianSekarang = $antrian->no_antrian ?? 0;

        $pdf = Pdf::loadView('antrian.cetak', compact('antrianSekarang'));
        return $pdf->stream();
        // return view('antrian.cetak', compact('antrianSekarang'));
        // return $pdf->download('invoice.pdf'); 
    }
}
