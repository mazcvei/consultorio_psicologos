@extends('layouts.app')
@section('post-head')
<style>
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
<div class="container">

    <div class="row">
        @if (session('success'))
        <div class="col-12 mt-3">
            <div class="alert alert-success" style="text-align: center">
                <h3>{{session('success')}}</h3>
            </div>
        </div>
        @endif
        <div class="col-md-12">
            <h2>Reservas</h2>

            <label for="filterHour">Filtrar por psicologo:</label>
            <select id="filterPsychologist" onchange="filterReservations()">
                <option value="">Todos</option>
                @foreach($psychologists as $psy)
                    <option value="{{$psy->name.' '.$psy->lastname}}">{{$psy->name.' '.$psy->lastname}}</option>
                @endforeach
            </select>

            <label for="filterHour">Filtrar por hora:</label>
            <select id="filterHour" onchange="filterReservations()">
                <option value="">Todas</option>
                <option value="08:00-09:00">08:00 - 09:00</option>
                <option value="09:00-10:00">09:00 - 10:00</option>
                <option value="10:00-11:00">10:00 - 11:00</option>
                <option value="11:00-12:00">11:00 - 12:00</option>
                <option value="12:00-13:00">12:00 - 13:00</option>
                <option value="16:00-17:00">16:00 - 17:00</option>
                <option value="17:00-18:00">17:00 - 18:00</option>
                <option value="18:00-19:00">18:00 - 19:00</option>
                <option value="19:00-20:00">19:00 - 20:00</option>
            </select>

            <!-- Tabla de reservas -->
            <table>
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Psicologo</th>
                        <th>Fecha</th>
                        <th>Horario</th>
                        <th>Chat</th>
                    </tr>
                </thead>
                <tbody id="reservationsTable">
                    @foreach($bookings as $booking)
                        <tr data-hour="{{$booking->hour}}" data-psychologist="{{$booking->psychologist->name.' '.$booking->psychologist->lastname}}">
                            <td>{{$booking->customer->name}}</td>
                            <td>{{$booking->psychologist->name.' '.$booking->psychologist->lastname}}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->date)->format('d-m-Y')}}</td>
                            <td>{{$booking->hour}}</td>
                            <td>
                                <a href="{{route('messages.form',$booking->id)}}" class="btn btn-primary">Mensajes</a>
                            </td>
                        </tr>
                    @endforeach
                  
                    
                </tbody>
            </table>

            <p id="noResults" class="no-results" style="display: none;">No hay reservas para este filtro.</p>

        </div>
    </div>

    <script>
        function filterReservations() {
        let selectedPsychologist = document.getElementById("filterPsychologist").value;
        let selectedHour = document.getElementById("filterHour").value;
        let tableRows = document.querySelectorAll("#reservationsTable tr");
        let noResults = document.getElementById("noResults");
        let visible = false;

        tableRows.forEach(row => {
            let rowHour = row.getAttribute("data-hour");
            let rowPsychologist = row.getAttribute("data-psychologist");

            let matchPsychologist = selectedPsychologist === "" || rowPsychologist === selectedPsychologist;
            let matchHour = selectedHour === "" || rowHour === selectedHour;

            if (matchPsychologist && matchHour) {
                row.style.display = "";
                visible = true;
            } else {
                row.style.display = "none";
            }
        });

        noResults.style.display = visible ? "none" : "block";
    }
    </script>

    @endsection