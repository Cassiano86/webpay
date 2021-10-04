<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class url extends Model{
    use HasFactory;

    protected $table = "url";

    protected $fillable =   [
                                'users_id',
                                'url',
                                'status',
                                'verificado'
                            ];

    public function User(){
        return $this->belongsTo(User::class ,'users_id', 'id');
    }
}
