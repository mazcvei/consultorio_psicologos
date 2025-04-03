<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Resend\Laravel\Facades\Resend;
use Illuminate\Support\Facades\View;
class ContactController extends Controller
{
    public function send(Request $request){

        $html = View::make('emails.contact', $request->all())->render();
     
        Resend::emails()->send([
            'from' => 'Consultorio de Psicología <prueba@resend.dev>',
            'to' => 'lhuesa@cop.es',
            'subject' => 'Solicitud de contacto',
            'html' => $html,
        ]);
        return redirect()->route('home')->with('success', 'Mensaje enviado correctamente.');
       
    }
}
