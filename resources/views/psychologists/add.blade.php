@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-align: center">Nuevo psicólogo</h1>
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
            <form action="{{route('psychologist.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                      <div class="mb-3 col-md-4">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}" >
                      </div>
                      <div class="mb-3 col-md-4">
                        <label for="lastname" class="form-label">Apellidos</label>
                        <input type="text" name="lastname" class="form-control" id="lastname" value="{{old('lastname')}}" >
                      </div>
                      <div class="mb-3 col-md-4">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" name="phone" class="form-control" id="phone" value="{{old('phone')}}" >
                      </div>
                      <div class="mb-3 col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{old('email')}}" >
                      </div>
                      <div class="mb-3 col-md-4">
                        <label for="skills" class="form-label">Características (separadas por comas)</label><br>
                        <input type="text" name="skills" class="form-control" id="skills">
                      </div>
                     
                      <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password"  autocomplete="new-password" autocorrect="off" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" autocomplete="off" autocorrect="off" class="form-control" id="password_confirmation"
                                name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="avatar" class="form-label">Avatar</label>
                        <input type="file" accept="image/*" name="avatar" class="form-control" id="avatar" value="{{old('avatar')}}"></input>
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