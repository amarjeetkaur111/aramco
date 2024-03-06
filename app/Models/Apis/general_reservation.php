<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class general_reservation extends Model
{
    use HasFactory;

    protected $table="general_reservation";
    public function user(){
        return $this->hasOne(User::class,'id','users_id');
    }
}
