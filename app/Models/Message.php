<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = "dates_messages";
    protected $fillable = ["appointment_id", "sender_id", "text"];

    public function sender(){
        return $this->belongsTo(User::class, 'snder_id');
    }
}
