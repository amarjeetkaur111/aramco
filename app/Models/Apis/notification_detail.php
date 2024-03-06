<?php

namespace App\Models\Apis;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification_detail extends Model
{
    use HasFactory;
    protected $table="notification_detail";
    protected $appends = ['receiver_detail'];
    protected $casts = [
        'created_at' => 'datetime',
    ]; 
    public function sender(){
        return $this->belongsTo(notification::class, 'notification_id','id');
    }

    public function getReceiverDetailAttribute()
    {
        $id = $this->receiver_id;
        $rsl =  User::where('id',$id)->select('first_name','last_name','google_id','email')->first();
        return $rsl;
    }
}
