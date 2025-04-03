<?php

namespace App\Http\Controllers;

use App\Helpers\UsersHelper;
use App\Models\Appointment;
use App\Models\HourRange;
use App\Models\User;
use App\Models\WeekDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{

    public function configure_appointments()
    {
        if(UsersHelper::isPsychologist(Auth::id())){
            $days = WeekDay::all();
            $hour_ranges = HourRange::all();
            $data_availability = json_decode(Auth::user()->availability);
            $price = Auth::user()->price;
           
            return view('psychologists.appointments',compact(['days','hour_ranges','data_availability','price']));
        }else{
            return redirect()->route('home')
            ->with('warning', 'Acción no permitida.');
        }
    }

    public function show_bookings(){
        if(Auth::user()->rol->rol=="Cliente"){
            $bookings = Appointment::where('customer_id', Auth::id())->get();
        }else if(Auth::user()->rol->rol=="Psicologo"){
            $bookings = Appointment::where('psychologist_id', Auth::id())->get();
        }else{
            $bookings = Appointment::all();
        }

        $psychologists = User::where('rol_id', 2)->get();
        return view('psychologists.bookings',compact('bookings','psychologists'));
    }
  

    public function store_configuration(Request $request)
    {
        if(UsersHelper::isPsychologist(Auth::id())){
           // dd($request->all());
            $data_availability = [];
            $hours = $request->horas;
            if(isset($request->days)){
                foreach($request->days as $day){
                    $data_availability[$day] = $hours[$day];      
                }
            }else{
                $data_availability = null;
            }
            
            $user = User::find(Auth::id());
            $user->availability = json_encode($data_availability);
            $user->price = $request->price;
            $user->save();

            return redirect()->route('appointment.configure')
            ->with('success', 'Configuración actualizada correctamente.');
         
        }else{
            return redirect()->route('home')
            ->with('warning', 'Acción no permitida.');
        }
       
    }

    public function request_booking_form(User $user){
        return view('psychologists.book',compact('user'));
    }

    public function store_booking(Request $request){
   
        $appointment_exist = Appointment::where('psychologist_id', $request->psychologist_id)
            ->where('date', $request->date)
            ->where('hour', $request->hour_range)->first();
        if($appointment_exist){
            return redirect()->route('bookings.request',$request->psychologist_id)
            ->with('warning', 'Ya hay una reserva para esa hora y fecha.');
        }
        Appointment::create([
            'customer_id'=>$request->customer_id,
            'psychologist_id'=>$request->psychologist_id,
            'date'=>$request->date,
            'hour'=>$request->hour_range,
        ]);
        return redirect()->route('bookings.request',$request->psychologist_id)
        ->with('success', 'Reserva realizada correctamente.');
   
    }

}
