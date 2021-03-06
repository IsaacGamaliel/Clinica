@extends('plantilla')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Crear Paciente</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">

                <form method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <h4>Nombre y Apellidos:</h4>
                        <input type="text" name="name" class="form-control" required>
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
                        <h4>Telefono:</h4>
                        <input type="tel" name="telefono" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <h4>Email:</h4>
                        <input type="text" class="form-control" name="email" value="{{old('email')}}" required>
                        @error('email')
                        <div class="alert alert-danger">Email ya existe</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <h4>Historial Medico</h4>
                        <input type="file" class="form-control" id="documento" name="documento" value="{{old('documento')}}">
                        @error('documento')
                        <div class="alert alert-danger">Solo se admite archivos pdf</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <h4>Contrase??a:</h4>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    
                    <br>

                    <button type="submit" class="btn btn-primary">Agregar Paciente</button>
                </form>

            </div>
        </div>
    </section>
</div>
@endsection