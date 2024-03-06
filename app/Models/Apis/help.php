<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class help extends Model
{

    protected $table="help";
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class,'id','users_id');
    }
}
