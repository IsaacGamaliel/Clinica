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
                        <br>
                        <br>
                </div>
                <div class="col-md-6" align="center">
                    <h2>Logo</h2>
                    <img src="http://localhost/DesarrolloWebProfesional/ProyectoClinica/public/storage/{{$inicio->logo}}" class="img-responsive" >
                </div>
                
                <div class="col-md-6" >
                    <link rel="stylesheet" href="{{ asset('css/estilo.css') }}" />
                    <h2 align="center">Imagenes de la clinica</h2>
                    <ul class="slider">
                        <li id="slide1"><img src="img/imagen1.png" width="430" height="270" ></li>
                        <li id="slide2"><img src="img/imagen2.png" width="430" height="270" ></li>
                        <li id="slide3"><img src="img/servicios.jpg" width="430" height="270"></li>
                        
                    </ul>
                    
                    <nav1>
                        <ul class="menu">
                            <li><a href="#slide1">Instalaciones
                            <li><a href="#slide2">Ortopedika
                            <li><a href="#slide3">Servicios
                        </ul>
                    </nav1>
                    
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