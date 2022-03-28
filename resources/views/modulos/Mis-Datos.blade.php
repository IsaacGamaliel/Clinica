@extends('plantilla')

@section('content')
    
<div class="content-wrapper">
    <section class="content-header">
        <h1>Mis Datos Personales</h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                
                <form method="POST">

                    @csrf
                    @method('put')
                    <div class="row">

                        <div class="col-md-6 col-xs-12">
                            <h2>Nombre y apellido</h2>
                            <input type="text" class="input-lg" name="name" value="{{auth()->user()->name}}">

                            <h2>Email</h2>
                            <input type="text" class="input-lg" name="email" value="{{auth()->user()->email}}">
                            @error('email')
                                <p class="alert alert-danger">El email ya existe</p>
                            @enderror

                            <h2>Nueva contraseña</h2>
                            <input type="text" class="input-lg" name="passwordN">
                        </div>

                        <div class="col-md-6 col-xs-12">
                            <h2>Documento</h2>
                            <input type="text" class="input-lg" name="documento" value="{{auth()->user()->documento}}">

                            <h2>telefono</h2>
                            <input type="text" class="input-lg" name="telefono" value="{{auth()->user()->telefono}}">
                            <br><br><br>
                            <button type="submit" class="btn btn-success">Guardar</button>
                            
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>
@endsection