<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    
    protected $table = 'request';
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'id', 'nama',
    ];


    protected $appends = [
        'status_pembayaran',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function trainer(){
        return $this->belongsTo(Trainer::class, 'trainer_id');
    }
    
    public function program(){
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function pembayaran(){
        return $this->hasMany(Payment::class, 'request_id');
    }

    public function getStatusPembayaranAttribute(){

        if($this->pembayaran->count()){
            if($this->pembayaran->sum('jumlah') == $this->total){
                return 'Lunas';
            }else{
                return 'Sebagian';
            }

        }else{
            return 'Belum Bayar';
        }
    }
}
