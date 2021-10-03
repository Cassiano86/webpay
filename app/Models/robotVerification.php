<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\robotVerification;

class robotVerification extends Model{
    use HasFactory;

    protected $table = "robot_verifications";

    protected $fillable = [ 
                            'url_id',
                            'status_code'
                          ];

    public function url(){
        return $this->belongsToMany(robotVerification::class , 'url_id', 'id');
    }
}
