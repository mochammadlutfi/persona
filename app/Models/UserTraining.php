<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTraining extends Model
{
    use HasFactory;
    
    protected $table = 'user_training';
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'id', 'nama',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function training(){
        return $this->belongsTo(Training::class, 'training_id');
    }

}
