<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->rol != 'Administrador' && auth()->user()->rol != 'Secretaria' && auth()->user()->rol != 'Doctor'){
            return redirect('Inicio');  
        }
        $pacientes=DB::select('select * from users where rol = "Paciente" ');
        
        return view('modulos.Pacientes')->with('pacientes',$pacientes);
    }
}
