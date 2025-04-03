<?php

namespace App\Http\Controllers;

use App\Helpers\UsersHelper;
use App\Models\Rol;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function psychologistsIndex()
    {
        $rolPsychologist = Rol::where('rol', 'Psicologo')->first();
        $psychologists = User::where('rol_id',$rolPsychologist->id)->get();
        return view('psychologists.index',compact( 'psychologists'));
    }

    public function usersIndex()
    {
        
            $users = User::all();
        
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create_psychologist()
    {
        return view('psychologists.add');
    }

    public function store_psychologist(Request $request){
        if (UsersHelper::isAdmin(Auth::id())) {

            $request->validate([
                'name' => 'required|string|max:250|min:5',
                'lastname' => 'required|string|max:250|min:5',
                'phone' => 'required|digits_between:9,15',
                'skills' => 'nullable|string|max:250|min:5',
                'password' => 'required|confirmed|min:6',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096', // Máximo 4MB
            ], [
                'name.required' => 'El nombre es obligatorio.',
                'name.string' => 'El nombre debe ser un texto válido.',
                'name.max' => 'El nombre no puede tener más de 250 caracteres.',
                'name.min' => 'El nombre no puede tener menos de 5 caracteres.',

                'lastname.required' => 'El apellido es obligatorio.',
                'lastname.string' => 'El apellido debe ser un texto válido.',
                'lastname.max' => 'El apellido no puede tener más de 250 caracteres.',
                'lastname.min' => 'El apellido no puede tener menos de 5 caracteres.',

                'skills.string' => 'El campo skills debe ser un texto válido.',
                'skills.max' => 'El campo skills no puede tener más de 250 caracteres.',
                'skills.min' => 'El campo skills no puede tener menos de 5 caracteres.',

                'phone.required' => 'El número de teléfono es obligatorio.',
                'phone.numeric' => 'El número de teléfono debe contener solo números.',
                'phone.digits_between' => 'El número de teléfono debe tener entre 9 y 15 dígitos.',
    
                'password.required' => 'La contraseña es obligatoria.',
                'password.min' => 'La contraseña debe tener al menos 6 carácteres.',
                'password.confirmed' => 'Las contraseñas no coinciden.',

                'avatar.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
                'avatar.max' => 'La imagen no puede superar los 4MB.',
            ]);

            $path = null;
            if ($request->file('avatar')) {
                $path = $request->file('avatar')->store('avatars', 'public');
            }

            $rolPsychologist = Rol::where('rol', 'Psicologo')->first();
            if($rolPsychologist){
                $user = User::create([
                    'name' => $request->name,
                    'lastname' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'skills' => $request->skills,
                    'rol_id' => $rolPsychologist->id,
                    'avatar' => $path ? $path : null,
                    'password' => Hash::make($request->password),
                ]);
            }else{
                $user = User::create([
                    'name' => $request->name,
                    'lastname' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'skills' => $request->skills,
                    'rol_id' => 1,
                    'avatar' => $path ? $path : null,
                    'password' => Hash::make($request->password),
                ]);
            }
           

            $pyschologists = User::all();
            return redirect()->route('psychologists.index', compact('pyschologists'))
                ->with('success', 'Psicólogo creado correctamente.');
        }else{
            $pyschologists = User::all();
            return redirect()->route('psychologists.index', compact('pyschologists'))
            ->with('warning', 'Acción no permitida.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

   
    public function edit_psychologist(User $user)
    {
        if (UsersHelper::isAdmin(Auth::id())) {

            return view('psychologists.edit',compact('user'));
        }else{
            $pyschologists = User::all();
            return redirect()->route('psychologists.index', compact('pyschologists'))
            ->with('warning', 'Acción no permitida.');
        }
    }

 
    public function update(Request $request, User $user)
    {
        if (UsersHelper::isAdmin(Auth::id())) {
            $request->validate([
                'name' => 'required|string|max:250|min:5',
                'lastname' => 'required|string|max:250|min:5',
                'skills' => 'nullable|string|max:250|min:5',
                'phone' => 'required|digits_between:9,15',
                'password' => 'nullable|confirmed|min:6',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096', // Máximo 4MB
            ], [
                'name.required' => 'El nombre es obligatorio.',
                'name.string' => 'El nombre debe ser un texto válido.',
                'name.max' => 'El nombre no puede tener más de 250 caracteres.',
                'name.min' => 'El nombre no puede tener menos de 5 caracteres.',

                'skills.string' => 'El campo skills debe ser un texto válido.',
                'skills.max' => 'El campo skills no puede tener más de 250 caracteres.',
                'skills.min' => 'El campo skills no puede tener menos de 5 caracteres.',

                'lastname.required' => 'El apellido es obligatorio.',
                'lastname.string' => 'El apellido debe ser un texto válido.',
                'lastname.max' => 'El apellido no puede tener más de 250 caracteres.',
                'lastname.min' => 'El apellido no puede tener menos de 5 caracteres.',

                'phone.required' => 'El número de teléfono es obligatorio.',
                'phone.numeric' => 'El número de teléfono debe contener solo números.',
                'phone.digits_between' => 'El número de teléfono debe tener entre 9 y 15 dígitos.',
  
                'password.min' => 'La contraseña debe tener al menos 6 carácteres.',
                'password.confirmed' => 'Las contraseñas no coinciden.',

                'avatar.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
                'avatar.max' => 'La imagen no puede superar los 4MB.',
            ]);

            $path = null;
            if ($request->file('avatar')) {
                $path = $request->file('avatar')->store('avatars', 'public');
            }

            $user->update([
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone,
                'skills' => $request->skills,
                'avatar' => $request->file('avatar') ?  $path : $user->avatar,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);
         
            return redirect()->back()->with('success', 'Psícologo actualizado correctamente.');
        }else{
            $pyschologists = User::all();
            return redirect()->route('psychologists.index', compact('pyschologists'))
            ->with('warning', 'Acción no permitida.');
        }
    }

  
    public function destroy(User $user)
    {
        if (UsersHelper::isAdmin(Auth::id())) {
            $user->delete();
            $pyschologists = User::all();
            return redirect()->route('psychologists.index', compact('pyschologists'))
            ->with('success', 'Psícologo eliminado correctamente.');
        }else{
            $pyschologists = User::all();
            return redirect()->route('psychologists.index', compact('pyschologists'))
            ->with('warning', 'Acción no permitida.');
        }
    }
}
