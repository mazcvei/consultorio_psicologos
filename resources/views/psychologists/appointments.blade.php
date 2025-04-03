@extends('layouts.app')
@section('post-head')
<style>
  
    h2 {
        text-align: center;
        color: #333;
    }

    .day-container {
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    label {
        font-weight: bold;
        display: block;
        cursor: pointer;
    }

    input[type="checkbox"] {
        margin-right: 10px;
    }

    .hours {
        display: none;
        margin-top: 10px;
    }

    select {
        width: 100%;
        padding: 5px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .submit-btn {
        width: 100%;
        padding: 10px;
        background: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 20px;
    }

    .submit-btn:hover {
        background: #45a049;
    }
</style>
@endsection
@section('content')
<div class="container">
    

    <h1 style="text-align: center">Configurar disponibilidad</h1>
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

            <form id="availabilityForm" action="{{route('appointment.store.configuration')}}" method="post">
                @csrf
                @foreach($days as $day)
                    <div class="day-container" >
                        <label><input type="checkbox" name="days[]" @if($data_availability && property_exists($data_availability,$day->day)) checked  @endif value="{{$day->day}}" onchange="toggleHours('{{Str::lower($day->day)}}')"> {{$day->day}}</label>
                        <div class="hours" id="{{Str::lower($day->day)}}-hours"  @if($data_availability &&  property_exists($data_availability,$day->day)) style="display: block"  @endif>
                            <label>Horario disponible:  @if($data_availability && property_exists($data_availability,$day->day)) {{ $data_availability->{$day->day} }} @endif</label>
                            <select name="horas[{{$day->day}}]">
                                @foreach($hour_ranges as $hour)
                                    <option value="{{$hour->value}}">{{$hour->value}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endforeach
                <label>Precio por hora:
                    <input type="number" step="0.01" min="1" name="price" value="{{$price}}" >€
                </label>

    
                <button type="submit" class="submit-btn">Guardar Disponibilidad</button>
            </form>
          
        </div>
    </div>
   
</div>

<script>
    function toggleHours(day) {
        console.log(day)
        console.log(`input[value="${day.charAt(0).toUpperCase() + day.slice(1)}"]`)
        let checkbox = document.querySelector(`input[value="${day.charAt(0).toUpperCase() + day.slice(1)}"]`);
        let hoursDiv = document.getElementById(day + '-hours');
        hoursDiv.style.display = checkbox.checked ? 'block' : 'none';
    }
</script>
@endsection