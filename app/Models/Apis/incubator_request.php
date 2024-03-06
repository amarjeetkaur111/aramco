<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class incubator_request extends Model
{
    use HasFactory;
    protected $table="incubator_request";

    public function user(){
        return $this->hasOne(User::class,'id','users_id');
    }


    public function incubator_request_invitees()
    {
        return $this->hasMany(incubator_request_invitees::class, 'incubator_request_id', 'id' );


    }
}
