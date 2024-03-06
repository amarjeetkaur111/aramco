<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class about_the_lab_templates extends Model
{
    use HasFactory;

    protected $table="about_the_lab_templates";


    public function about_the_lab_content(){



        return $this->hasMany(about_the_lab_content::class, 'about_the_lab_templates_id', 'id' );

     }

}

