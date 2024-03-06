<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class schedule_visit extends Model
{
    use HasFactory;
    protected $table="schedule_visit_request";
    public function user(){
        return $this->hasOne(User::class,'id','users_id');
    }

}
