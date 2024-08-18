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
use App\Models\Payment;

use PDF;
class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('landing.request.index');
    }

    public function create(Request $request)
    {
        $program = Program::select('id as value', 'nama as label')->get()->toArray();

        return view('landing.request.create', compact('program'));
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
                
                $data = new Pengajuan();
                $data->user_id = auth()->guard('web')->user()->id;
                $data->instansi = $request->instansi;
                $data->tgl = $request->tgl;
                $data->program_id = $request->program;
                $data->jenis = $request->jenis;
                $data->lokasi = $request->lokasi;
                $data->peserta = $request->peserta;
                $data->harga = $request->harga;
                $data->status = 'Pending';
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


        $bank = Collect([
            [
                'img' => '/images/bca.png',
                'nama' => 'Bank BCA',
                'rek' => '0267141517',
                'an' => 'Scoria Novrisa Dewi'
            ],
            [
                'img' => '/images/bni.png',
                'nama' => 'Bank BNI',
                'rek' => ' 0267141527',
                'an' => 'Scoria Novrisa Dewi'
            ],
            [
                'img' => '/images/mandiri.png',
                'nama' => 'Bank Mandiri',
                'rek' => '1320024213929',
                'an' => 'CV Transformasi Akselerasi Prima'
            ],
        ]);
        return view('landing.request.show',[
            'data' => $data,
            'bank' => $bank
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

    
    public function bayar(Request $request, $id)
    {
        // dd($request->all());
        $rules = [
            'nama' => 'required',
            'tgl' => 'required',
            'jumlah' => 'required',
            'bank' => 'required',
            'bukti' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Pengirim Wajib Diisi!',
            'bank.required' => 'Bank Tujuan Wajib Diisi!',
            'tgl.required' => 'Tanggal Bayar Wajib Diisi!',
            'jumlah.required' => 'Jumlah Wajib Diisi!',
            'bukti.required' => 'Bukti Pembayaran Wajib Diisi!',
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()){
            return response()->json([
                'fail' => true,
                'errors' => $validator->errors()
            ]);
        }else{
            DB::beginTransaction();
            try{

                $data = new Payment();
                $data->request_id = $id;
                $data->pengirim = $request->nama;
                $data->bank = $request->bank;
                $data->tgl = Carbon::parse($request->tgl);
                $data->jumlah = $request->jumlah;
                $data->status = 'Pending';

                if($request->bukti){
                    $fileName = time() . '.' . $request->bukti->extension();
                    Storage::disk('public')->putFileAs('uploads/pembayaran', $request->bukti, $fileName);
                    $data->bukti = '/uploads/pembayaran/'.$fileName;
                }
                $data->save();

            }catch(\QueryException $e){
                DB::rollback();
                return response()->json([
                    'fail' => true,
                    'errors' => $e
                ]);
            }

            DB::commit();
            return response()->json([
                'fail' => false,
            ]);
        } 
    }

    
    public function kwitansi($id, Request $request)
    {
        $user = auth()->guard('web')->user();

        $data = Payment::where('id', $id)->first();

        $config = [
            'format' => 'A5-L',
            'margin-top' => 0
        ];
        $pdf = PDF::loadView('reports.kwitansi_request', [
            'data' => $data,
        ], [ ], $config);

        return $pdf->stream('Kwitansi Program Inhouse.pdf');
    }
}
