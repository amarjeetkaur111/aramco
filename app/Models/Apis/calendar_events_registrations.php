<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class calendar_events_registrations extends Model
{
    use HasFactory;

    protected $table="calendar_events_registrations";
    public function users(){
        return $this->hasMany(User::class, 'id', 'users_id' );

     }

     public function calendarEvent()
     {
         return $this->hasOne(calendar_events::class, 'id', 'calendar_events_id');
     }

    public function user(){
        return $this->hasOne(User::class,'id','users_id');
    }

}
