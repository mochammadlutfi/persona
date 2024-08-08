<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Training extends Model
{
    use HasFactory;
    use Sluggable;
    
    protected $table = 'training';
    protected $primaryKey = 'id';

    
    protected $fillable = [
        'id', 'user_id', 'status', 'tgl'
    ];

    protected $appends = [
        // 'sisa'
    ];

    public function user(){
        return $this->hasMany(UserTraining::class, 'training_id');
    }

    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama'
            ]
        ];
    }
}
