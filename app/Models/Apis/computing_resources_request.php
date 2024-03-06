<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class computing_resources_request extends Model
{
    use HasFactory;
    protected  $table="computing_resources_request";

    public function user(){
        return $this->hasOne(User::class,'id','users_id');
    }
}
