<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class idea_request extends Model
{
    use HasFactory;
    protected $table="idea_request";

    public function implementation_level(){
        return $this->hasMany(current_implementation_level::class, 'id', 'current_implementation_level');
    }

    public function technology(){
        return $this->hasMany(technology_list::class, 'id', 'technology');
    }

    public function user(){
        return $this->hasOne(User::class,'id','users_id');
    }
}
