<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class about_the_lab_content extends Model
{
    use HasFactory;

    protected $table="about_the_lab_content";

    public function about_the_lab_list_points(){



        return $this->hasMany(about_the_lab_list_points::class, 'about_the_lab_content_id', 'id' );

     }
}
