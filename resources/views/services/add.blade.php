@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="text-align: center">Nuevo servicio</h1>
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
            <form action="{{route('service.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-8">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{old('title')}}" >
                      </div>
                      <div class="mb-3 col-md-4">
                        <label for="description" class="form-label">Imagen</label>
                        <input type="file" accept="image/*" name="image" class="form-control" id="description" rows="3" value="{{old('image')}}"></input>
                      </div>
                      <div class="mb-3 col-md-12">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" name="description" id="description" rows="3">{{old('description')}}</textarea>
                      </div>
                      <div class="mb-3 col-12 col-md-3">
                      <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            
            </form>
        </div>
    </div>
   
</div>


@endsection