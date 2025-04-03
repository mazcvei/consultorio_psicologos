@extends('layouts.app')
@section('post-head')
<style>
  
    .chat-container {
        width: 100%;
        background: white;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
        text-align: center;
        color: #333;
    }
    .chat-box {
        height: 300px;
        overflow-y: auto;
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        background: #f9f9f9;
    }
    .message {
        padding: 8px;
        margin: 5px 0;
        border-radius: 5px;   
        width: fit-content;
    }
    .user {
        background: #007bff;
        color: white;
        margin-left: auto
    }
    .other {
        background: #e0e0e0;
        align-self: flex-start;
    }
    .input-container {
        display: flex;
    }
    input[type="text"] {
        flex: 1;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button {
        padding: 8px 15px;
        border: none;
        background: #007bff;
        color: white;
        border-radius: 5px;
        margin-left: 5px;
        cursor: pointer;
    }
</style>
@endsection
@section('content')
<div class="container">
    <h1 style="text-align: center">Mensajes</h1>
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
           
            <div class="col-md-8 m-auto">
                @if(Auth::user()->rol->rol=="Cliente")
                    <p>Estás hablando con el psicólogo <strong>{{$appointment->psychologist->name.' '.$appointment->psychologist->name}}</strong></p>
                @elseif(Auth::user()->rol->rol=="Psicologo")
                    <p>Estás hablando con el cliente <strong>{{$appointment->customer->name.' '.$appointment->customer->name}}</strong></p>
                @endif
                <div class="chat-container">
                    <div class="chat-box" id="chatBox">
                        @foreach($messages as $message)
                            <div class="message @if($message->sender_id==Auth::id()) user  @else other  @endif ">{{$message->text}}</div>
                        @endforeach
                       
                    </div>
                    <form method="post" class="input-containe" action="{{route('messages.send')}}">
                        @csrf
                    <div class="input-container">
                            <input type="hidden" name="appointment_id" value="{{$appointment->id}}">
                            <input type="text" name="text" id="messageInput" placeholder="Escribe un mensaje...">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
                </div>
            </div>

        </div>
    </div>
   
</div>


@endsection