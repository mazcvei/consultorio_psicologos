@extends('layouts.app')
@section('post-head')
<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .card {
        width: 100%;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 500px;
    }
</style>


@endsection
@section('content')
<div class="container">
    <div class="d-flex justify-content-center align-items-center">
        <div class="card p-4">
            <h3 class="text-center">Mis datos</h3>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if (session('status'))
            <div class="alert alert-success">
                <p>{{session('status')}}</p>
            </div>
            @endif
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{$user->lastname}}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="number" class="form-control" id="phone" name="phone" value="{{$user->phone}}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" value="{{$user->email}}" autocomplete="new-password" autocorrect="off" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password"  autocomplete="new-password" autocorrect="off" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                            <input type="password" autocomplete="off" autocorrect="off" class="form-control" id="password_confirmation"
                                name="password_confirmation">
                        </div>
                    </div>
                  
                    <div class="col-12 col-md-12">
                        <div class="mb-3">
                            Tipo de Usuario: <h1 class="badge bg-success">{{$user->rol->rol}}</h1>
                           
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Guardar</button>
            </form>
           
        </div>
    </div>
</div>

@endsection