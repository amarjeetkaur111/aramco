<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{

    protected $table="feedback";
    protected $fillable =['id', 'title', 'comment', 'users_id', 'admin_comment', 'status'];
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class,'id','users_id');
    }
}
