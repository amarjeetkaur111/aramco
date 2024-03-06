<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class channels extends Model
{
    use HasFactory;

    protected $table="channels";


    public function channels_posts(){

        return $this->hasMany(channels_posts::class, 'channels_id', 'id' );

     }

     public function channels_posts_limit(){

        return $this->hasMany(channels_posts::class, 'channels_id', 'id' )->orderBy('created_at','Desc')->limit(1);

     }
}
