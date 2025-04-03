<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = "appointments";
    protected $fillable = ["customer_id", "psychologist_id", "date", "hour"];

    public function customer(){
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function psychologist(){
        return $this->belongsTo(User::class, 'psychologist_id');
    }

    public function messages(){
        return $this->hasMany(Message::class, 'appointment_id');
    }
}
