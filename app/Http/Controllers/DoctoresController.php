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
        try {


            //dd($request);
            $datos = request()->validate([
                'sexo'=>['required'],
                'name'=>['required'],
                'telefono'=>['required', 'digits:10'],
                'pdf'=>['required','mimes:pdf'],
                'id_consultorio'=>['required'],
                'password'=>['required', 'string','min:3'],
                'email'=> ['required', 'string','max:255','email','unique:users']
            ]);

             //dd($request['pdf']);

        

            if($request->hasFile('pdf')){
                $archivo=$request->file('pdf');
                $archivo->move(public_path().'/Archivos/',$archivo->getClientOriginalName());
                $nombre=$archivo->getClientOriginalName();

                Doctores::create([
                    'name'=>$datos['name'],
                    'id_consultorio'=>$datos['id_consultorio'],
                    'email'=>$datos['email'],
                    'sexo'=>$datos['sexo'],
                    'documento'=>$nombre,
                    'telefono'=>$datos['telefono'],
                    'rol'=>'Doctor',
                    'password'=>Hash::make($datos['password'])
                ]);
            }

            return redirect('Doctores')->with('registrado','Si');

       
        } catch (\Throwable $th) {
            throw $th;
        }
        

    }

    public function destroy($id)
    {
        DB::table('users')->whereId($id)->delete();
        return redirect('Doctores');
    }
}


