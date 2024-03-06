<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class channels_posts extends Model
{
    use HasFactory;

    protected $table="channels_posts";



 public function channels_posts_comments(){



    return $this->hasMany(channels_posts_comments::class, 'channels_posts_id', 'id' );

 }



 public function channels_posts_likes(){



    return $this->hasMany(channels_posts_likes::class, 'channels_posts_id', 'id' );

 }

 public function user(){



   return $this->hasOne(User::class, 'id', 'users_id' );

}


}
