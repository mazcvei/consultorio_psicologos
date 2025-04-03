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
        @if (session('warning'))
        <div class="col-12 mt-3">
            <div class="alert alert-warning" style="text-align: center">
                <h3>{{session('warning')}}</h3>
            </div>
        </div>
        @endif
        <div class="col-12">
            <h1 style="text-align: center">Nuestros Servicios</h1> 
            @if(\App\Helpers\UsersHelper::isAdmin(Auth::id()))
                <a href="{{route('service.create')}}" class="btn btn-primary">Nuevo servicio</a> 
            @endif

            <section class="mt-4">
                @foreach($services as $service)
                <article>
                    <div class="content-article">
                        <h3 class="subtitle">{{$service->title}}</h3>
                        <p>
                            {{$service->description}}
                        </p>
                    </div>
                    <div class="img-article">
                        <img src="{{ asset('storage/'.$service->image) }}" alt="Imagen servicio1 ">
                    </div>
                </article>
                @if(\App\Helpers\UsersHelper::isAdmin(Auth::id()))
                    <a href="{{route('service.edit',$service->id)}}" class="btn btn-primary">Editar</a>
                     <a class="btn btn-danger" href="{{route('service.destroy',$service->id)}}">Eliminar</a>
                @endif
                <hr>
                @endforeach
            </section>
        </div>
    </div>
</div>


@endsection