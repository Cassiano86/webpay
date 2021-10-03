<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\robotVerfication;
use App\Models\User;
use App\Models\robotVerification;

class url extends Model{
    use HasFactory;

    protected $table = "url";

    protected $fillable =   [
                                'users_id',
                                'url',
                                'quantidade_acesso',
                                'status',
                                'verificado'
                            ];

    public function url(){
        return $this->belongsToMany(User::class ,'users_id', 'id');
    }

    public function robotVerification(){
        return $this->hasMany(robotVerification::class , 'url_id', 'id');
    }
}
