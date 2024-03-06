<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class technology_workshop_request extends Model
{
    use HasFactory;

    protected $table="technology_workshop_request";


    public function technology_workshop_request_invitees()
    {
        return $this->hasMany(technology_workshop_request_invitees::class, 'technology_workshop_request_id', 'id' );
    }

    public function user(){
        return $this->hasOne(User::class,'id','users_id');
    }
}
