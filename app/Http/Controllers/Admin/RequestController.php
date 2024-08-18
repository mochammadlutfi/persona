<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Models\Pengajuan;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserTraining;
use App\Models\Trainer;


use App\Mail\TerimaPengajuan;
use App\Mail\TolakPengajuan;
use App\Mail\TrainerPengajuan;
use Illuminate\Support\Facades\Mail;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Pengajuan::with(['program', 'user'])->orderBy('id', 'DESC')->get();

        return view('admin.request.index', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $data = Pengajuan::where('id', $id)
        ->first();

        $trainer = Trainer::select('id as value' , 'nama as label')->latest()->get();
        return view('admin.request.show',[
            'data' => $data,
            'trainer' => $trainer,
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Anggota::where('id', $id)->first();
        $ekskul = Ekskul::orderBy('nama', 'ASC')->get();
        return view('anggota.edit',[
            'data' => $data,
            'ekskul' => $ekskul
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
            'nis' => 'required|numeric|unique:anggota,nis',
            'nama' => 'required|string',
            'jk' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
        ];

        $pesan = [
            'nis.required' => 'NIS Wajib Diisi!',
            'nis.numeric' => 'NIS Hanya Boleh Angka!',
            'nis.unique' => 'NIS Sudah Terdaftar!',
            'nama.required' => 'Nama Lengkap Wajib Diisi!',
            'jk.required' => 'Bidang Wajib Diisi!',
            'kelas.required' => 'Kelas Wajib Diisi!',
            'alamat.required' => 'Alamat Wajib Diisi!',
        ];


        $validator = Validator::make($request->all(), $rules, $pesan);
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }else{
            DB::beginTransaction();
            try{

                $data = Anggota::where('id', $id)->first();
                $data->nis = $request->nis;
                $data->nama = $request->nama;
                $data->jk = $request->jk;
                $data->kelas = $request->kelas;
                $data->hp = $request->hp;
                $data->email = $request->email;
                $data->alamat = $request->alamat;
                $data->status = 'aktif';
                $data->ekskul_id = $request->ekskul_id;
                $data->save();

            }catch(\QueryException $e){
                DB::rollback();
                return response()->json([
                    'fail' => true,
                    'errors' => $e,
                    'pesan' => 'Error Menyimpan Data Anggota',
                ]);
            }

            DB::commit();
            if($request->level_id > 2){
                return back()->withErrors($validator->errors());
            }

            return redirect()->route('anggota.index');
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

            $data = Anggota::where('id', $id)->first();
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

    public function cek(Request $request)
    {
        dd($request->all());
    }

    
    
    public function status($id, Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try{
            $data = Pengajuan::where('id', $id)->first();
            $data->status = $request->status;
            $data->save();

            if($request->status == 'Disetujui'){
                Mail::to($data->user->email)->send(new TerimaPengajuan($data));
            }else{
                Mail::to($data->user->email)->send(new TolakPengajuan($data));
            }
        }catch(\QueryException $e){
            DB::rollback();
            dd($e);
        }

        DB::commit();
        return redirect()->back();
    }

    
    
    public function trainer($id, Request $request)
    {
        DB::beginTransaction();
        try{
            $data = Pengajuan::where('id', $id)->first();
            $data->trainer_id = $request->trainer_id;
            $data->save();

            Mail::to($data->user->email)->send(new TrainerPengajuan($data));

        }catch(\QueryException $e){
            DB::rollback();
            dd($e);
        }

        DB::commit();
        return redirect()->back();
    }

    public function bayar($id, Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try{
            $data = Payment::where('id', $id)->first();
            $data->status = $request->status;
            $data->save();
        }catch(\QueryException $e){
            DB::rollback();
            dd($e);
        }

        DB::commit();
        return redirect()->back();
    }
}
