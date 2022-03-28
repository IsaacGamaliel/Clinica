@extends('plantilla')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Gestor de Doctores</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#CrearDoctor">
                    Crear Doctor</button>
            </div>

            <div class="box-body">
                <table class="table table-bordered table-hover table-striped dt-responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre y Apellido</th>
                            <th>Consultorios</th>
                            <th>Email</th>
                            <th>Curriculum</th>
                            <th>Telefono</th>

                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($doctores as $doctor)
                        @if ($doctor->rol =="Doctor")
                        <tr>
                            <td>{{$doctor->id}}</td>
                            <td>{{$doctor->name}}</td>
                            <td>{{$doctor->CON->consultorio}}</td>
                            <td>{{$doctor->email}}</td>

                            @if($doctor->documento !="")

                                <td><a href="Archivos/{{$doctor->documento}}" target="_blank">
                                    CV: {{$doctor->name}} </a></td>

                                
                            @else
                                <td>Aun no registrado</td>
                            @endif

                            @if ($doctor->telefono != "")
                                <td>{{$doctor->telefono}}</td>
                            @else
                                <td>No Disponible</td>
                            @endif

                            <td>
                                <button class="btn btn-danger EliminarDoctor" Did="{{$doctor->id}}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<div id="CrearDoctor" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <h4>Nombre y Apellido:</h4>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <h4>Sexo:</h4>
                            <select class="form-control" name="sexo" required="">
                                <option value="">Seleccionar...</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Masculino">Masculino</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <h4>Consultorio:</h4>
                            <select class="form-control" name="id_consultorio" required>
                                <option value="">Seleccionar...</option>
                                @foreach ($consultorios as $consultorio)
                                <option value="{{$consultorio->id}}">{{$consultorio->consultorio}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <h4>Email:</h4>
                            <input type="text" class="form-control" name="email" value="{{old('email')}}">
                            @error('email')
                            <div class="alert alert-danger">Email ya existe</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h4>Telefono:</h4>
                            <input type="tel"  class="form-control" name="telefono">
                        </div>

                        <div class="form-group">
                            <h4>Curriculum</h4>
                            <input type="file" class="form-control" id="pdf" name="pdf" value="{{old('pdf')}}">
                            @error('pdf')
                            <div class="alert alert-danger">solo se admite archivos pdf</div>
                            @enderror
                        </div>
                        

                        <div class="form-group">
                            <h4>Contraseña:</h4>
                            <input type="text" class="form-control" name="password" required>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Crear</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
      
        
</div>
@endsection