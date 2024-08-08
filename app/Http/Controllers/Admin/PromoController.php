<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Storage;
use Carbon\Carbon;


use App\Models\Promo;
use App\Models\User;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Promo::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<div class="dropdown">
                        <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle" id="dropdown-default-outline-primary" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi
                        </button>
                        <div class="dropdown-menu fs-sm" aria-labelledby="dropdown-default-outline-primary" style="">';
                        $btn .= '<a class="dropdown-item" href="'. route('admin.promo.edit', $row->id).'"><i class="si si-note me-1"></i>Ubah</a>';
                        $btn .= '<a class="dropdown-item" href="javascript:void(0)" onclick="hapus('. $row->id.')"><i class="si si-trash me-1"></i>Hapus</a>';
                    $btn .= '</div></div>';
                    return $btn; 
                })
                ->editColumn('tgl', function ($row) {
                    $tgl_mulai = Carbon::parse($row->tgl_mulai);
                    $tgl_selesai = Carbon::parse($row->tgl_selesai);
                    if($tgl_mulai->eq($tgl_selesai) || $row->tgl_selesai == null){
                        return $tgl_mulai->translatedformat('d M Y');
                    }else{
                        return $tgl_mulai->translatedformat('d M') . ' - '. $tgl_selesai->translatedformat('d M Y');
                    }
                })
                ->rawColumns(['action']) 
                ->make(true);
        }
        return view('admin.promo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promo.create');
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
            'nama' => 'required',
            'deskripsi' => 'required',
            'tgl' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Wajib Diisi!',
            'deskripsi.required' => 'Deskripsi Wajib Diisi!',
            'tgl.required' => 'Tanggal Periode Wajib Diisi!',
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()){
            return back()->withInput()->withErrors($validator->errors());
        }else{
            DB::beginTransaction();
            try{
                $tgl = explode(" - ",$request->tgl);

                $data = new Promo();
                $data->nama = $request->nama;
                $data->deskripsi = $request->deskripsi;
                $data->tgl_mulai = $tgl[0];
                $data->tgl_selesai = (count($tgl) > 1) ? $tgl[1] : null;
                
                if($request->foto){
                    $fileName = time() . '.' . $request->foto->extension();
                    Storage::disk('public')->putFileAs('uploads/promo', $request->foto, $fileName);
                    $data->foto = '/uploads/promo/'.$fileName;
                }
                
                $data->save();

            }catch(\QueryException $e){
                DB::rollback();
                dd($e);
            }

            DB::commit();
            return redirect()->route('admin.promo.index');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Promo::where('id', $id)->first();

        $data->tgl = $data->tgl_mulai .' - '. $data->tgl_selesai;

        return view('admin.promo.edit',[
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'nama' => 'required',
            'deskripsi' => 'required',
            'tgl' => 'required',
        ];

        $pesan = [
            'nama.required' => 'Nama Wajib Diisi!',
            'deskripsi.required' => 'Deskripsi Wajib Diisi!',
            'tgl.required' => 'Tanggal Periode Wajib Diisi!',
        ];

        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()){
            return back()->withInput()->withErrors($validator->errors());
        }else{
            DB::beginTransaction();
            try{
                $tgl = explode(" - ",$request->tgl);
                
                $data = Promo::where('id', $id)->first();
                $data->nama = $request->nama;
                $data->deskripsi = $request->deskripsi;
                $data->tgl_mulai = $tgl[0];
                $data->tgl_selesai = (count($tgl) > 1) ? $tgl[1] : null;
                
                if($request->foto){
                    $fileName = time() . '.' . $request->foto->extension();
                    Storage::disk('public')->putFileAs('uploads/promo', $request->foto, $fileName);
                    $data->foto = '/uploads/promo/'.$fileName;
                }
                
                $data->save();

            }catch(\QueryException $e){
                DB::rollback();
                dd($e);
            }

            DB::commit();
            return redirect()->route('admin.promo.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{

            $data = Promo::where('id', $id)->first();
            $data->delete();

        }catch(\QueryException $e){
            DB::rollback();
            return response()->json([
                'fail' => true,
                'errors' => $e,
                'pesan' => 'Gagal Hapus Data!',
            ]);
        }

        DB::commit();
        return response()->json([
            'fail' => false,
            'pesan' => 'Berhasil Hapus Data!',
        ]);
    }
    

}
