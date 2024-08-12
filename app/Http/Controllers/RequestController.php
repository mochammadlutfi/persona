<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Storage;
use DataTables;

use App\Models\User;
use App\Models\Pengajuan;
use App\Models\Program;
class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $program = Program::select('id as value', 'nama as label')->get()->toArray();

        return view('landing.request.index', compact('program'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'instansi' => 'required',
            'program' => 'required',
            'peserta' => 'required',
            'tgl' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Wajib Diisi!',
            'hp.required' => 'No HP/WA Wajib Diisi!',
            'email.required' => 'Email Wajib Diisi!',
            'instansi.required' => 'Instansi Wajib Diisi!',
            'program.required' => 'Program Wajib Diisi!',
            'tgl.required' => 'Tanggal Main Wajib Diisi!',
            'peserta.required' => 'Peserta Wajib Diisi!',
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()){
            return back()->withInput()->withErrors($validator->errors());
        }else{
            DB::beginTransaction();
            try{
                $tgl =  Carbon::parse($request->tgl.' '.$request->waktu);
                // dd($test);
                $data = new Pengajuan();
                $data->user_id = auth()->guard('web')->user()->id;
                $data->instansi = $request->instansi;
                $data->tgl = $request->tgl;
                $data->program_id = $request->program;
                $data->jenis = $request->jenis;
                $data->lokasi = $request->lokasi;
                $data->peserta = $request->peserta;
                $data->harga = $request->harga;
                $data->save();

            }catch(\QueryException $e){
                DB::rollback();
                dd($e);
            }

            DB::commit();
            return view('landing.request.success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pengajuan::where('id', $id)->first();

        return view('landing.request.show',[
            'data' => $data
        ]);
    }

    
    public function user()
    {
        $data = Pengajuan::orderBY('id', 'DESC')->get();

        return view('landing.request.user',[
            'data' => $data
        ]);
    }
    
    private function getNumber()
    {
        $q = Request::select(DB::raw('MAX(RIGHT(nomor,5)) AS kd_max'));

        $code = 'REQ/';
        $no = 1;
        date_default_timezone_set('Asia/Jakarta');

        if($q->count() > 0){
            foreach($q->get() as $k){
                return $code . date('ym') .'/'.sprintf("%05s", abs(((int)$k->kd_max) + 1));
            }
        }else{
            return $code . date('ym') .'/'. sprintf("%05s", $no);
        }
    }
}
