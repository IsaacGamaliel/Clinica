@extends('plantilla')

@section('content')
    
<div class="content-wrapper">
    <section class="content-header">
        <h1>Editar el Paciente: {{$paciente->name}}</h1>
    </section>

    <section class="content">
        <div class="box">    

            <div class="box-header">

                <a href="{{ url('Pacientes') }}">
                
                    <button class="btn btn-primary"> Volver a pacientes</button>
                </a>

            </div>

            <div class="box-body">

                <form method="post" action="{{ url('actualizar-paciente/'.$paciente->id) }}">

                    @csrf
                    @method('put')

                    <h4>Nombre y Apellido:</h4>
                    <input type="text" class="form-control" name="name" value="{{$paciente->name}}">

                    <h4>Documento:</h4>
                    <input type="text" class="form-control" name="documento" value="{{$paciente->documento}}">

                    <h4>Email:</h4>
                    <input type="text" class="form-control" name="email" value="{{$paciente->email}}">

                    
                    <input type="hidden" class="form-control" name="sexo" value="{{$paciente->sexo}}">
                    
                   

                    <h4>Nueva contraseña:</h4>
                    <input type="text" class="form-control" name="passwordN" value="">

                    
                    <input type="hidden" class="form-control" name="password" value="{{$paciente->password}}">

                    <h4>Telefono:</h4>
                    <input type="tel" class="form-control" name="telefono" value="{{$paciente->telefono}}">

                    <br>
                    <button class="btn btn-success" type="submit">Actualizar</button>
                </form>

            </div>

        </div>
    </section>
</div>
@endsection