@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        @if (session('success'))
        <div class="col-12 mt-3">
            <div class="alert alert-success" style="text-align: center">
                <h3>{{session('success')}}</h3>
            </div>
        </div>
        @endif
        <div class="col-12">
            <h1 style="text-align: center">Nuestro equipo</h1>
            <h5>Nuestro equipo humano es nuestra mayor fortaleza, encontrar la persona que mejor conecte contigo y pueda
                ayudarte de manera efectiva es nuestra mayor meta. Para ello contamos con un equipo de profesionales.
            </h5>
            @if(\App\Helpers\UsersHelper::isAdmin(Auth::id()))
            <a href="{{route('psychologist.create')}}" class="btn btn-primary">Nuevo Psicólogo</a>
            @endif
            <section class="mt-4">
                @foreach($psychologists as $psychologist)
                <article>
                    <div class="content-article">
                        <h3 class="subtitle">{{$psychologist->name.' '.$psychologist->lastname}}</h3>
                        @if(isset($psychologist->skills))
                        @php 
                            $skills = explode(",",$psychologist->skills);
                        @endphp
                        <ul>
                            @foreach($skills as $sk)
                                <li>{{$sk}}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                    <div class="img-article">
                        <img src="{{ asset('storage/'.$psychologist->avatar) }}" alt="avatar">
                    </div>
                </article>

                @if(\App\Helpers\UsersHelper::isAdmin(Auth::id()))
                <a href="{{route('psychologist.edit',$psychologist->id)}}" class="btn btn-primary">Editar</a>
                <a href="{{route('psychologist.destroy',$psychologist->id)}}" class="btn btn-danger">Eliminar</a>
                @endif
                @if(\App\Helpers\UsersHelper::isClient(Auth::id()))
                <a class="btn btn-info" href="{{route('bookings.request',$psychologist->id)}}">Reservar</a>
                @endif
                <hr>
                @endforeach
            </section>
        </div>
    </div>
</div>


@endsection