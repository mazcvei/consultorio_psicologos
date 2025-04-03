@extends('layouts.app')
@section('post-head')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales-all.global.js'></script>


<style>
    #calendar th {
        background-color: rgb(148 220 229);
        color: black;
    }

    #calendar td {
        cursor: pointer;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    label {
        font-weight: bold;
        margin-right: 10px;
    }

    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .no-results {
        text-align: center;
        padding: 10px;
        font-size: 16px;
        color: #777;
    }
</style>

@endsection

@section('content')
@php
$days_value = ["Lunes"=> 1,"Martes"=>2,"Miércoles"=>3,"Jueves"=>4,"Viernes"=>5];
if(isset($user->availability)){
    $days_availability = get_object_vars(json_decode($user->availability));
}else{
    $days_availability = [];
}
$days_allow = [];
$hours_allow = [];
foreach($days_availability as $index=>$day){
    array_push($days_allow,$days_value[$index]);
    $hours_allow[$days_value[$index]] = $days_availability[$index];
}
@endphp
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
        <div class="col-md-12">
            <h2>Solicitar reserva</h2>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <img style="width: 100%" src="{{ asset('storage/'.$user->avatar) }}" alt="avatar">
                </div>

                <div class="col-md-8 content-article">
                    <h5 class="subtitle">{{$user->name.' '.$user->lastname}}</h5>
                    @if(isset($user->skills))
                    @php
                    $skills = explode(",",$user->skills);
                    @endphp
                    <ul>
                        @foreach($skills as $sk)
                        <li>{{$sk}}</li>
                        @endforeach
                    </ul>
                    @endif

                    <p>Precio de la consulta: <span style="font-weight: bold">{{number_format($user->price,2)}}€</span></p>
                </div>
                <div class="col-md-8 mb-5" style="background-color: #f6f6f6; margin:auto;margin-top:2rem">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBook" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliga una hora</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('bookings.store')}}" method="post" id="form-book">
                        @csrf
                        <input type="hidden" name="psychologist_id" value="{{$user->id}}">
                        <input type="hidden" name="customer_id" value="{{Auth::id()}}">
                        <input type="hidden" name="date" id="input_date">
                        <select class="form-select" name="hour_range" id="select_hour_input" style="text-align: center"></select>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Reservar</button>
                        </div>
                    </form>
                  
                </div>
               
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectHourInput = document.getElementById('select_hour_input');
            const inputDate = document.getElementById('input_date');
            let days_allow = @json($days_allow);
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            buttonText: {
                today:    'Hoy',
                month:    'Mes',
                week:     'Semana',
                day:      'Día',
                list:     'Lista'
            },
            validRange: {
                start: new Date()
            },
            dateClick: function(info) {
                var day = info.date.getDay();
                if (!days_allow.includes(day)) {
                    return;
                }
                var modal = new bootstrap.Modal(document.getElementById('modalBook'));
                let hours_allow = @json($hours_allow);
                let hour_range = hours_allow[day];
                let hours_array = hours_allow[day].split(' - ');
                selectHourInput.innerHTML = '';
                inputDate.value = info.dateStr
                for (let i = 0; i < hours_array.length - 1; i++) {
                    let startHour = parseInt(hours_array[i].split(':')[0]);
                    let endHour = parseInt(hours_array[i + 1].split(':')[0]); 

                    for (let hour = startHour; hour < endHour; hour++) {
                        let option = document.createElement('option');
                        option.value = `${hour}:00-${hour + 1}:00`;
                        option.textContent = `${hour}:00 - ${hour + 1}:00`;
                        selectHourInput.appendChild(option);
                    }
                }
                modal.show();
            },
            businessHours: [
                { daysOfWeek: days_allow, startTime: '00:00', endTime: '23:59' }
            ],
          });
          calendar.render();
        });
    
    </script>
    @endsection