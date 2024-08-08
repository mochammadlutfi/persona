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


    public function program(){
        return $this->belongsTo(Program::class, 'program_id');
    }

}
