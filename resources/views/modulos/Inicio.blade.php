@extends('plantilla')

@section('content')
    
<div class="content-wrapper">
    <section class="content-header">
        <h1>Inicio</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <div class="col-md-6 bg-primary">
                    <h1>Bienvenido</h1>
                    <hr>
                    <h2>Dias:</h2>
                    <h3>{{$inicio->dias}}</h3>
                    <hr>
                    <h2>Horarios:</h2>
                    <h3>Desde: {{$inicio->horaInicio}}</h3>
                    <h3>Hasta: {{$inicio->horaFin}}</h3>
                    <hr>
                    <h2>Dirección:</h2>
                    <h3>{{$inicio->direccion}}</h3>
                    <hr>
                    <h2>Contactanos:</h2>
                    <h3>Telefono: {{$inicio->telefono}}<br>
                        Correo: {{$inicio->email}}</h3>
                </div>
                <div class="col-md-6">
                    <h2>Logo:</h2>
                    <img src="http://localhost/DesarrolloWebProfesional/ProyectoClinica/public/storage/{{$inicio->logo}}" class="img-responsive" >
                </div>

                <div class="col-md-6">
                    <h2>Carussel de imagenes:</h2>
                    <img src="http://localhost/DesarrolloWebProfesional/ProyectoClinica/public/storage/{{$inicio->logo}}" class="img-responsive" >
                </div>
            </div>
            @if (auth()->user()->rol == "Administrador")
                
            
            <div class="box-footer">
                <a href="{{url('Inicio-Editar')}}">
                    <button class="btn btn-success btn-lglg">Editar</button>
                </a>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection