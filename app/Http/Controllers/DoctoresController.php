<?php

namespace App\Http\Controllers;

use App\Models\Doctores;
use Illuminate\Http\Request;
use App\Models\Consultorios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DoctoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->rol !="Administrador" && auth()->user()->rol !="Secretaria") {
            return redirect('Inicio');
        }

        $consultorios=Consultorios::all();
        $doctores= Doctores::All();
        return view('modulos.Doctores',compact('consultorios','doctores'));
    }

    
    public function store(Request $request)
    {
        $datos = request()->validate([
            'sexo'=>['required'],
            'name'=>['required'],
            'id_consultorio'=>['required'],
            'password'=>['required', 'string','min:3'],
            'email'=> ['required', 'string','email','unique:users']
        ]);

        Doctores::create([
            'name'=>$datos['name'],
            'id_consultorio'=>$datos['id_consultorio'],
            'email'=>$datos['email'],
            'sexo'=>$datos['sexo'],
            'documento'=>'',
            'telefono'=>'',
            'rol'=>'Doctor',
            'password'=>Hash::make($datos['password'])

        ]);

        return redirect('Doctores')->with('registrado','Si');
    }

    public function destroy($id)
    {
        DB::table('users')->whereId($id)->delete();
        return redirect('Doctores');
    }
}
