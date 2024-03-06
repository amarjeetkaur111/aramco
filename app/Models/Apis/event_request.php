<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event_request extends Model
{
    use HasFactory;
    protected $appends = ['required_resources_list'];
    protected $table="event_request";
    protected $fillable =['event_name', 'space_name', 'required_resources', 'event_start', 'event_end', 'num_of_attendees', 'coordinator_contact', 'justification', 'additional_info', 'status_of_request', 'date_of_request', 'created_at', 'updated_at'];

    public function getRequiredResourcesListAttribute()
    {
        $rs = explode(",", $this->required_resources);
        $rsl =  required_resource_list::whereIn('id',$rs)->get();
        return $rsl;
    }

    public function event_request_invitees()
    {
        return $this->hasMany(event_request_invitees::class, 'event_request_id', 'id' );
    }

    public function user(){
        return $this->hasOne(User::class,'id','users_id');
    }
}
