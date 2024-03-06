<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    use HasFactory;
    protected $table="notifications";
    protected $fillable =['sender_id', 'title', 'body', 'manual'];

    protected $appends = ['sender_detail'];


    public function receiver(){
        return $this->hasMany(notification_detail::class, 'notification_id', 'id');
    }

    public function getSenderDetailAttribute()
    {
        $id = $this->sender_id;
        $rsl =  User::where('id',$id)->select('first_name','last_name','google_id','email','profile_photo')->first();
        return $rsl;
    }
}
