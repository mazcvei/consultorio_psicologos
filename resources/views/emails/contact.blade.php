<!DOCTYPE html>
<html>
<body>
    <h1>Nueva solicitud de contacto.</h1>
    <p>Nombre: {{$name}}</p>
    <p>Email:  {{$email}}</p>
    <p>Servicios solicitados: </p>
    @if(isset($services))
        <ul>
            @foreach($services as $key=>$set)
                <li>{{ucfirst($key)}}</li>
            @endforeach
        </ul>
    @endif
    <p>Mensaje: </p>
    <p>{{$message_text}}</p>
   
</body>
</html>