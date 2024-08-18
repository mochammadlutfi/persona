<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use App\Models\Training;
use App\Models\UserTraining;

use Carbon\Carbon;
use PDF;
class LaporanController extends Controller
{

    public function index()
    {
        return view('admin.laporan');
    }

    
    public function pdf(Request $request)
    {
        $tgl = explode(" - ",$request->tgl);
        $data = UserTraining::with('user')
        ->whereBetween('tgl', $tgl)
        ->latest()->get();
        $config = [
            'format' => 'A4-L'
        ];

        $pdf = PDF::loadView('reports.full', [
            'data' => $data,
            'tgl' =>$tgl
        ], [ ], $config);

        return $pdf->stream('Laporan Pesanan.pdf');

    }
}
