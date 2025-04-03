@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-align: center">Nuevo servicio</h1>
    <div class="row">
        @if (session('success'))
        <div class="col-12 mt-3">
            <div class="alert alert-success" style="text-align: center">
                <h3>{{session('success')}}</h3>
            </div>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="col-md-12">
            <form action="{{route('service.update',$service->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12 col-md-7 row">
                        <div class="mb-3 col-md-12">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{$service->title}}" >
                          </div>
                          @if($service->image)
                            <div class="mb-3 col-md-12">
                                <label for="description" class="form-label">Imagen</label>
                                <input type="file" accept="image/*" name="image" class="form-control" id="description" rows="3" value="{{old('image')}}"></input>
                            </div>
                          @endif
                    </div>
                    <div class="col-12 col-md-5">
                        <img style="width: 100%" src="{{ asset('storage/'.$service->image) }}">
                    </div>
                   
                      <div class="mb-3 col-md-12">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{$service->description}}</textarea>
                      </div>
                      <div class="mb-3 col-12 col-md-3">
                      <button type="submit" class="btn btn-primary">Enviar</button>
                      <a class="btn btn-danger" href="{{route('services')}}">Servicios</a>
                </div>
            
            </form>
        </div>
    </div>
   
</div>


@endsection