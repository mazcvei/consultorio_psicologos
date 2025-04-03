<?php

namespace App\Http\Controllers;

use App\Helpers\UsersHelper;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Session;
class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('services.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (UsersHelper::isAdmin(Auth::id())) {
            $request->validate([
                'title' => 'required|string|max:250|min:5',
                'description' => 'required|string|min:10',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096', // Máximo 4MB
            ], [
                'title.required' => 'El título es obligatorio.',
                'title.string' => 'El título debe ser un texto válido.',
                'title.max' => 'El título no puede tener más de 250 caracteres.',
                'title.min' => 'El título no puede tener menos de 5 caracteres.',

                'description.required' => 'La descripción es obligatoria.',
                'description.string' => 'La descripción debe ser un texto válido.',
                'description.min' => 'La descripción no puede tener menos de 10 caracteres.',

                'image.required' => 'Debe subir una imagen.',
                'image.image' => 'El archivo debe ser una imagen.',
                'image.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
                'image.max' => 'La imagen no puede superar los 4MB.',
            ]);

            $path = null;
            if ($request->file('image')) {
                $path = $request->file('image')->store('images', 'public');
            }

            Service::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $path
            ]);

            $services = Service::all();
            return redirect()->route('services', compact('services'))
                ->with('success', 'Servicio creado correctamente.');
        }else{
            $services = Service::all();
            return redirect()->route('services', compact('services'))
            ->with('warning', 'Acción no permitida.');
        }

       

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        if (UsersHelper::isAdmin(Auth::id())) {
            return view('services.edit', compact('service'));
        }else{
            $services = Service::all();
            return redirect()->route('services', compact('services'))
            ->with('warning', 'Acción no permitida.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        if (UsersHelper::isAdmin(Auth::id())) {
            $request->validate([
                'title' => 'required|string|max:250|min:5',
                'description' => 'required|string|min:10',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096', // Máximo 4MB
            ], [
                'title.required' => 'El título es obligatorio.',
                'title.string' => 'El título debe ser un texto válido.',
                'title.max' => 'El título no puede tener más de 250 caracteres.',
                'title.min' => 'El título no puede tener menos de 5 caracteres.',

                'description.required' => 'La descripción es obligatoria.',
                'description.string' => 'La descripción debe ser un texto válido.',
                'description.min' => 'La descripción no puede tener menos de 10 caracteres.',

                'image.image' => 'El archivo debe ser una imagen.',
                'image.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg o gif.',
                'image.max' => 'La imagen no puede superar los 4MB.',
            ]);


            if ($request->file('image')) {
                $path = $request->file('image')->store('images', 'public');
                $service->image = $path;
            }
            $service->title = $request->title;
            $service->description = $request->description;
            $service->save();
            return redirect()->back()->with('success', 'Servicio actualizado correctamente.');
        }else{
            $services = Service::all();
            return redirect()->route('services', compact('services'))
            ->with('warning', 'Acción no permitida.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if(UsersHelper::isAdmin(Auth::id())){
            $service->delete();
            $services = Service::all();
            return redirect()->route('services', compact('services'))
            ->with('success', 'Servicio eliminado correctamente.');
        }else{
            $services = Service::all();
            return redirect()->route('services', compact('services'))
            ->with('warning', 'Acción no permitida.');
        }
      
    }
}
