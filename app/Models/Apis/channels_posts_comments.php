<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class channels_posts_comments extends Model
{
    use HasFactory;

    protected $table="channels_posts_comments";
    public function user(){
        return $this->hasOne(User::class, 'id', 'users_id' )->select('id','first_name','last_name','profile_photo');     
     }
}
