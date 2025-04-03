<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show_messages_form(Appointment $appointment)
    {
        if(Auth::user()->rol->rol=="Cliente"){
            if($appointment->customer_id != Auth::id()){
                return redirect()->route('bookings.show')
                ->with('warning', 'Acción no permitida.');
            }
        }else if(Auth::user()->rol->rol=="Psicologo"){
            if($appointment->psychologist_id != Auth::id()){
                return redirect()->route('bookings.show')
                ->with('warning', 'Acción no permitida.');
            }
           
        }
        $messages = $appointment->messages;
        return view('messages.index',compact('messages','appointment'));
    }

    public function store_message(Request $request)
    {
       
        if(Auth::user()->rol->rol=="Cliente"){
            
           
        }
        Message::create([
            'sender_id' => Auth::id(),
            'appointment_id' => $request->appointment_id,
            'text' => $request->text,
        ]);
        return redirect()->route('messages.form',$request->appointment_id)
        ->with('success', 'Mensaje enviado correctamente.');
    }

}
