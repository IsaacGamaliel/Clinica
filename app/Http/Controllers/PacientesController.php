<?php

namespace App\Http\Controllers;

use App\Models\Pacientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PacientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->rol != 'Administrador' && auth()->user()->rol != 'Secretaria' && auth()->user()->rol != 'Doctor'){
            return redirect('Inicio');  
        }
        $pacientes=DB::select('select * from users where rol = "Paciente" ');
        
        return view('modulos.Pacientes')->with('pacientes',$pacientes);
    }

    
    public function create()
    {
        if(auth()->user()->rol != 'Administrador' && auth()->user()->rol != 'Secretaria' && auth()->user()->rol != 'Doctor'){
            return redirect('Inicio');  
        }

        return view('modulos.Crear-Paciente');
    }

    public function store(Request $request)
    {
        $datos = request()->validate([
            'documento'=>['required'],
            'name'=>['required'],
            'sexo'=>['required'],
            'telefono'=>['required', 'digits:10'],
            'password'=>['required', 'string','min:3'],
            'email'=> ['required', 'string','email','unique:users']
        ]);

        Pacientes::create([
            'name'=>$datos['name'],
            'id_consultorio'=>0,
            'email'=>$datos['email'],
            'sexo'=>$datos['sexo'],
            'documento'=>$datos['documento'],
            'telefono'=>$datos['telefono'],
            'rol'=>'Paciente',
            'password'=>Hash::make($datos['password'])

        ]);

        return redirect('Pacientes')->with('Agregado','Si');
    }
    
    
    public function edit(Pacientes $id)
    {
    
       $pacientes= Pacientes::find($id->id);
       return view('modulos.Editar-Paciente')->with('paciente',$pacientes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pacientes  $pacientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pacientes $pacientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pacientes  $pacientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pacientes $pacientes)
    {
        //
    }
}
