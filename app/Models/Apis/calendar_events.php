<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendar_events extends Model
{


    use HasFactory;

 protected $table="calendar_events";


 public function calendar_events_registrations(){



    return $this->hasMany(calendar_events_registrations::class, 'calendar_events_id', 'id' );

 }




}
