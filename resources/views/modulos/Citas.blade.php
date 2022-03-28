@extends('plantilla')

@section('content')

<div class="content-wrapper">
    <section class="content-header">

        @if($doctor->sexo == "Femenino")
        <h2>Doctora: {{$doctor->name}}</h2>
        @else
        <h2>Doctor: {{$doctor->name}}</h2>
        @endif

        <h2>Horarios</h2>
        @if ($horarios == null)

        @if (auth()->user()->rol == "Doctor")

        <form method="POST" action="{{url('Horario')}}">

            @csrf

            <div class="row">
                <div class="col-md-2">
                    Desde <input type="time" class="form-control" name="horaInicio">
                </div>
                <div class="col-md-2">
                    Hasta <input type="time" class="form-control" name="horaFin">
                </div>
                <br>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-success">
                        Guardar
                    </button>
                </div>
            </div>
        </form>
        @endif

        @else

        @foreach ($horarios as $hora)

        @if (auth()->user()->rol == "Doctor")
        <form method="POST" action="{{url('editar-horario/'.$hora->id)}}">

            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-2">
                    Desde <input type="time" class="form-control" name="horaInicioE" value="{{$hora->horaInicio}}">
                </div>
                <div class="col-md-2">
                    Hasta <input type="time" class="form-control" name="horaFinE" value="{{$hora->horaFin}}">
                </div>
                <br>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-success">Editar</button>
                </div>
            </div>
        </form>
        @elseif(auth()->user()->rol == "Paciente")
        <h2>{{$hora->horaInicio}} - {{$hora->horaFin}} </h2>
        @endif

        @endforeach



        @endif

    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <div id="calendario">

                </div>
            </div>
        </div>
    </section>
</div>


<div class="modal fade" id="CitaModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">

                @csrf

                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <h4>Seleccionar Paciente</h4>

                            <input type="hidden" name="id_doctor" value="{{auth()->user()->id}}">

                            <select name="id_paciente" required="" id="select2" style="width: 100%">
                                <option value=""> Paciente...</option>

                                @foreach ($pacientes as $paciente)

                                @if($paciente->rol == "Paciente")
                                <option value="{{$paciente->id}}">{{$paciente->name}} - {{$paciente->documento}}
                                </option>
                                @endif

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <h4>Fecha</h4>
                            <input type="text" id="Fecha" class="form-control" readonly="">
                        </div>

                        <div class="form-group">
                            <h4>Hora</h4>
                            <input type="text" id="Hora" class="form-control" readonly="">

                            <input type="hidden" name="FyHinicio" id="FyHinicio" class="form-control" readonly="">
                            <input type="hidden" name="FyHfinal" id="FyHfinal" class="form-control" readonly="">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Pedir Cita</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>

    </div>

</div>

<div class="modal fade" id="EventoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{url('borrar-cita')}}">

                @csrf
                @method('delete')

                <div class="modal-body">
                    <div class="form-group">
                        <h2>Paciente</h2>
                        <h3 id="paciente"></h3>

                        <input type="hidden" name="idCita" id="idCita">

                        <?php
                            $exp= explode("/",$_SERVER["REQUEST_URI"]);
                            echo '<input type="hidden" name="idDoctor" value="'.$exp[5].'">';
                        ?>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Cancelar Cita</button>
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="Cita">
    <div class="modal-dialog">
        <div class="modal-content">


            <form method="POST">

                @csrf
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">

                            <?php
                            $exp= explode("/",$_SERVER["REQUEST_URI"]);
                            echo '<input type="hidden" name="id_doctor" value="'.$exp[5].'">';
                            ?>
                            
                            <input type="hidden" name="id_paciente" value="{{ auth()->user()->id }}">
                        </div>

                        <div class="form-group">
                            <h2>Fecha:</h2>
                            <input type="text" class="form-control input"  id="FechaP" readonly="">
                        </div>

                        <div class="form-group">
                            <h2>Hora:</h2>
                            <input type="text" class="form-control input"  id="HoraP" readonly="">
                        </div>

                        <div class="form-group">
                            <input type="hidden" class="form-control input"  id="FyHinicioP" name="FyHinicio" readonly="">
                            <input type="hidden" class="form-control input"  id="FyHfinalP" name="FyHfinal" readonly="">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Pedir Cita</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection