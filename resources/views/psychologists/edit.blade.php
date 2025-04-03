@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-align: center">Editar psicólogo</h1>
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
            <div class="col-12 mt-3">
                <div class="alert alert-success" style="text-align: center">
                    <h3>{{session('success')}}</h3>
                </div>
            </div>
            @endif
            <form action="{{route('psychologist.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                      <div class="mb-3 col-md-4">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{$user->name}}" >
                      </div>
                      <div class="mb-3 col-md-4">
                        <label for="lastname" class="form-label">Apellidos</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" value="{{$user->lastname}}" >
                      </div>
                      <div class="mb-3 col-md-4">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{$user->phone}}" >
                      </div>
                      <div class="mb-3 col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{$user->email}}" >
                      </div>
                      <div class="mb-3 col-md-4">
                        <label for="skills" class="form-label">Características (separadas por comas)</label><br>
                        <input type="text" name="skills" class="form-control" value="{{$user->skills}}" id="skills">
                      </div>
                      <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña (dejar en blanco para mantener)</label>
                            <input type="password"  autocomplete="new-password" autocorrect="off" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" autocomplete="off" autocorrect="off" class="form-control" id="password_confirmation"
                                name="password_confirmation">
                        </div>
                    </div>
                 
                    <div class="mb-3 col-12 col-md-4">
                        <label for="avatar" class="form-label">Avatar</label><br>
                        <img style="width: 60%" src="{{ asset('storage/'.$user->avatar) }}">
                      
                        <input type="file" accept="image/*" name="avatar" class="form-control" id="avatar"></input>
                    </div>
                      
                    <div class="mb-3 col-md-12">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                     
                </div>
            
            </form>
        </div>
    </div>
   
</div>


@endsection