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
            'documento'=>['required','mimes:pdf'],
            'name'=>['required'],
            'sexo'=>['required'],
            'telefono'=>['required', 'digits:10'],
            'password'=>['required', 'string','min:3'],
            'email'=> ['required', 'string','email','unique:users']
        ]);

        if ($request->hasFile('documento')) {
            $archivo=$request->file('documento');
            $archivo->move(public_path().'/Archivos/',$archivo->getClientOriginalName());
            $nombre=$archivo->getClientOriginalName();

            Pacientes::create([
                'name'=>$datos['name'],
                'id_consultorio'=>0,
                'email'=>$datos['email'],
                'sexo'=>$datos['sexo'],
                'documento'=>$nombre,
                'telefono'=>$datos['telefono'],
                'rol'=>'Paciente',
                'password'=>Hash::make($datos['password'])
    
            ]);
        
        }

        

        return redirect('Pacientes')->with('Agregado','Si');
    }
    
    
    public function edit(Pacientes $id)
    {
        if(auth()->user()->rol != 'Administrador' && auth()->user()->rol != 'Secretaria' && auth()->user()->rol != 'Doctor'){
            return redirect('Inicio');  
        }
    
       $paciente= Pacientes::find($id->id);
       return view('modulos.Editar-Paciente')->with('paciente',$paciente);
    }

    
    public function update(Request $request, Pacientes $paciente)
    {
        
        //dd($paciente['id']);
        if ($paciente["email"] != request('email') && request('passwordN') !=""){
           
            $datos =request()->validate([
            
            'documento'=>['required'],
            'name'=>['required'],
            'sexo'=>['required'],
            'telefono'=>['required', 'digits:10'],
            'passwordN'=>['required', 'string','min:3'],
            'email'=> ['required', 'string','email','unique:users']
            
            ]);

            DB::table('users')->where('id',$paciente["id"])->update(['name' => $datos["name"], 'email'
            =>$datos ["email"],'documento'=>$datos["documento"],'telefono'=>$datos["telefono"],'sexo'=>$datos["sexo"],'password'=>Hash::make($datos["passwordN"])]);

        }else if($paciente["email"] != request('email') && request('passwordN') ==""){
            
            $datos =request()->validate([
            
                'documento'=>['required'],
                'name'=>['required'],
                'sexo'=>['required'],
                'telefono'=>['required', 'digits:10'],
                'password'=>['required', 'string','min:3'],
                'email'=> ['required', 'string','email','unique:users']
                
                ]);
    
                DB::table('users')->where('id',$paciente["id"])->update(['name' => $datos["name"], 'email'
                =>$datos ["email"],'documento'=>$datos["documento"],'telefono'=>$datos["telefono"],'sexo'=>$datos["sexo"],'password'=>Hash::make($datos["password"])]);
    

        }else if($paciente["email"] == request('email') && request('passwordN') !=""){
            
            $datos =request()->validate([
            
                'documento'=>['required'],
                'name'=>['required'],
                'sexo'=>['required'],
                'telefono'=>['required', 'digits:10'],
                'passwordN'=>['required', 'string','min:3'],
                'email'=> ['required', 'string','email',]
                
                ]);
    
                DB::table('users')->where('id',$paciente["id"])->update(['name' => $datos["name"], 'email'
                =>$datos ["email"],'documento'=>$datos["documento"],'telefono'=>$datos["telefono"],'sexo'=>$datos["sexo"],'password'=>Hash::make($datos["passwordN"])]);
    

        }else{
            $datos =request()->validate([
            
                'documento'=>['required'],
                'name'=>['required'],
                'sexo'=>['required'],
                'telefono'=>['required', 'digits:10'],
                'password'=>['required', 'string','min:3'],
                'email'=> ['required', 'string','email',]
                
                ]);
    
                DB::table('users')->where('id',$paciente["id"])->update(['name' => $datos["name"], 'email'
                =>$datos ["email"],'documento'=>$datos["documento"],'telefono'=>$datos["telefono"],'sexo'=>$datos["sexo"],'password'=>Hash::make($datos["password"])]);
    
        }

        return redirect ('Pacientes')->with('actualizadoP','Si');

    }

    
    public function destroy($id)
    {
        Pacientes::destroy($id);

        return redirect ('Pacientes');
    }
}
