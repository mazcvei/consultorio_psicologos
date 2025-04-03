<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/servicios', [ServiceController::class,'index'])->name('services');
Route::get('/psicologos', [UserController::class, 'psychologistsIndex'])->name('psychologists.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/contacto-envio', [ContactController::class, 'send'])->name('contact.send');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/servicios', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/nuevo-servicio', [ServiceController::class, 'create'])->name('service.create');
    Route::get('/servicio/{service}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('/editar-servicio/{service}', [ServiceController::class, 'update'])->name('service.update');
    Route::get('/eliminar-servicio/{service}', [ServiceController::class, 'destroy'])->name('service.destroy');
  //psychologist

  Route::post('/psicologos', [UserController::class, 'store_psychologist'])->name('psychologist.store');
  Route::get('/nuevo-psicologo', [UserController::class, 'create_psychologist'])->name('psychologist.create');
  Route::get('/psicologo/{user}', [UserController::class, 'edit_psychologist'])->name('psychologist.edit');
  Route::post('/editar-psicologo/{user}', [UserController::class, 'update'])->name('psychologist.update');
  Route::get('/eliminar-psicologo/{user}', [UserController::class, 'destroy'])->name('psychologist.destroy');


  Route::get('/configurar-horarios', [AppointmentController::class, 'configure_appointments'])->name('appointment.configure');
  Route::get('/reservas', [AppointmentController::class, 'show_bookings'])->name('bookings.show');
  Route::post('/guardar-congifuracion', [AppointmentController::class, 'store_configuration'])->name('appointment.store.configuration');

  Route::get('/reservar/{user}', [AppointmentController::class, 'request_booking_form'])->name('bookings.request');
  Route::post('/guardar-reserva', [AppointmentController::class, 'store_booking'])->name('bookings.store');
  
  Route::get('/mensajes/{appointment}', [MessageController::class, 'show_messages_form'])->name('messages.form');
  Route::post('/mensajes', [MessageController::class, 'store_message'])->name('messages.send');
});

require __DIR__.'/auth.php';
