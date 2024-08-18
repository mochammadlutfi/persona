<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use Carbon\Carbon;
use App\Models\Training;
use App\Models\UserTraining;
use Illuminate\Support\Facades\Validator;
use Storage;
use PDF;
class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Training::orderBy('id', 'DESC')->whereNotIn('status', ['draft'])
        ->paginate(9);

        return view('landing.training.index',[
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = auth()->guard('web')->user();
        $data = Training::where('slug', $slug)->first();
        if($user){
            $register = UserTraining::where('user_id', $user->id)
            ->where('training_id', $data->id)->first();
        }else{
            $register = null;
        }

        return view('landing.training.show', [
            'data' => $data,
            'register' => $register
        ]);
    }

    public function payment($id)
    {
        $user = auth()->guard('web')->user();
        $data = UserTraining::with('training')->where('id', $id)->first();

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
                'rek' => '0267141517',
                'an' => 'Scoria Novrisa Dewi'
            ],
            [
                'img' => '/images/mandiri.png',
                'nama' => 'Bank Mandiri',
                'rek' => '0267141517',
                'an' => 'Scoria Novrisa Dewi'
            ],
        ]);

        return view('landing.training.payment', [
            'data' => $data,
            'bank' => $bank
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        DB::beginTransaction();
        try{
            $user = auth()->guard('web')->user();
            $training = Training::where('id', $request->training_id)->first();

            $data = new UserTraining();
            $data->nomor = $this->getNumber();
            $data->user_id = $user->id;
            $data->training_id = $request->training_id;
            $data->status = 'Belum Bayar';
            $data->save();

        }catch(\QueryException $e){
            DB::rollback();
            return response()->json([
                'fail' => true,
                'pesan' => $e,
            ]);
        }

        DB::commit();
        return redirect()->route('user.training.payment', $data->id);
    }

    public function update($id, Request $request)
    {
        
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
            return back()->withInput()->withErrors($validator->errors());
        }else{
            DB::beginTransaction();
            try{
                $data = UserTraining::where('id', $id)->first();
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
                    'pesan' => $e,
                ]);
            }

            DB::commit();
            return redirect()->route('user.training');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        $data = Training::whereHas('user', function($q){
            return $q->where('user_id', );
        })->get();
        if ($request->ajax()) {
            $query = UserTraining::with('training')->where('user_id', auth()->guard('web')->user()->id)
            ->get();

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    // $btn = '<div class="dropdown">
                    //     <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" id="dropdown-default-outline-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    //         Aksi
                    //     </button>
                    //     <div class="dropdown-menu fs-sm" aria-labelledby="dropdown-default-outline-primary" style="">';
                    //     $btn .= '<a class="dropdown-item" href="'. route('admin.training.edit', $row->id).'"><i class="si si-note me-1"></i>Ubah</a>';
                    //     $btn .= '<a class="dropdown-item" href="javascript:void(0)" onclick="hapus('. $row->id.')"><i class="si si-trash me-1"></i>Hapus</a>';
                    // $btn .= '</div></div>';
                    // if($row->status == 'Belum Bayar' || $row->status == 'Pending'){
                    //     $btn = '<a href="'. route('user.training.payment', $row->id) .'" class="btn btn-sm btn-danger"><i class="fa fa-eye me-1"></i>Selesaikan Pembayaran</a>';
                    // }elseif($row->status == 'Lunas'){
                        $btn = '<a href="'. route('user.training.payment', $row->id) .'" class="btn btn-sm btn-danger"><i class="fa fa-eye me-1"></i>Detail Pembayaran</a>';

                    // }
                    
                    return $btn; 
                })
                ->editColumn('tgl_daftar', function ($row) {
                    $tgl = Carbon::parse($row->created_at);

                    return $tgl->translatedFormat('d M Y');
                })
                ->editColumn('harga', function ($row) {
                    $hrg = 'Rp ';
                    if($row->training->harga){
                        $hrg .= number_format($row->training->harga,0,',','.');
                    }else{
                        $hrg = 'Gratis';
                    }
 
                    return $hrg;
                })
                ->editColumn('training.nama', function ($row) {
                    $tgl_mulai = Carbon::parse($row->training->tgl_mulai);
                    $tgl_selesai = Carbon::parse($row->training->tgl_selesai);
                    if($tgl_mulai->isSameMonth($tgl_selesai) || $row->training->tgl_selesai == null){
                        $tgl = $tgl_mulai->translatedformat('d M Y');
                    }else{
                        $tgl = $tgl_mulai->translatedformat('d') . ' - '. $tgl_selesai->translatedformat('d M Y');
                    }
                    $ret = $row->training->nama;
                    $ret .= '<br/>';
                    $ret .= $tgl;
                    return $ret;

                })
                ->editColumn('status', function ($row) {
                    if($row->status == 'Belum Bayar'){
                        return '<span class="badge bg-danger">Belum Bayar</span>';
                    }else if($row->status == 'sebagian'){
                        return '<span class="badge bg-warning">Sebagian</span>';
                    }else if($row->status == 'Pending'){
                        return '<span class="badge bg-primary">Menunggu Konfirmasi</span>';
                    }else if($row->status == 'Diterima'){
                        return '<span class="badge bg-success">Lunas</span>';
                    }else if($row->status == 'Ditolak'){
                        return '<span class="badge bg-secondary">Batal</span>';
                    }
                })
                ->editColumn('training.status', function ($row) {
                    if($row->training->status == 'draft'){
                        return '<span class="badge bg-warning">Draft</span>';
                    }else if($row->training->status == 'buka'){
                        return '<span class="badge bg-primary">Buka</span>';
                    }else{
                        return '<span class="badge bg-danger">Tutup</span>';
                    }
                })
                ->rawColumns(['action','status', 'training.nama', 'training.status']) 
                ->make(true);
        }


        return view('landing.training.user',[
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice($id, Request $request)
    {
        $user = auth()->guard('web')->user();

        $data = UserTraining::where('id', $id)->first();

        $config = [
            'format' => 'A4-P'
        ];
        $pdf = PDF::loadView('reports.invoice', [
            'data' => $data,
        ], [ ], $config);

        return $pdf->stream('Invoice '. $data->nomor.'.pdf');
    }

    public function kwitansi($id, Request $request)
    {
        $user = auth()->guard('web')->user();

        $data = UserTraining::where('id', $id)->first();

        $config = [
            'format' => 'A5-L',
            'margin-top' => 0
        ];
        $pdf = PDF::loadView('reports.kwitansi', [
            'data' => $data,
        ], [ ], $config);

        return $pdf->stream('Kwitansi '. $data->nomor.'.pdf');
    }
    private function getNumber()
    {
        $q = UserTraining::select(DB::raw('MAX(RIGHT(nomor,5)) AS kd_max'));

        $code = 'REG';
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
