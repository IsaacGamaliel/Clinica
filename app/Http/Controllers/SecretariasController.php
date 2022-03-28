<?php

namespace App\Http\Controllers;

use App\Models\Secretarias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SecretariasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (auth()->user()->rol !="Administrador") {
            return redirect('Inicio');
        }
        $secretarias = Secretarias::all()->where('rol','Secretaria');

        return view('modulos.Secretarias')->with('secretarias',$secretarias);
    }

    
    public function store(Request $request)
    {
        $datos = request()->validate([
            'name'=>['required','string', 'max:255'],
            'password'=>['required', 'string','min:3'],
            'email'=> ['required', 'string','max:255','email','unique:users']
        ]);
        $secretarias= Secretarias::create([
            'name'=>$datos['name'],
            'id_consultorio'=>0,
            'email'=>$datos['email'],
            'sexo'=>'',
            'documento'=>'',
            'telefono'=>'',
            'rol'=>'Secretaria',
            'password'=>Hash::make($datos['password'])
        ]);
        return redirect('Secretarias')->with('SecretariaCreada','Si');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Secretarias  $secretarias
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->rol !="Administrador") {
            return redirect('Inicio');
        }
        $secretarias = Secretarias::all()->where('rol','Secretaria');
        $secretaria= Secretarias::find($id);

        return view('modulos.Secretarias', compact('secretarias', 'secretaria'));
    }

    /*    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Secretarias  $secretarias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Secretarias $id)
    {
        if ($id['email'] != request('email') && request('passwordN') != "") {
            $datos = request()->validate([
                'name'=>['required','string', 'max:255'],
                'passwordN'=>['required', 'string','min:3'],
                'email'=> ['required', 'string','max:255','email','unique:users']
            ]);

            DB::table('users')->where('id', $id["id"])->update(['name'=>$datos["name"], 'email'=>$datos["email"], 'password'=>Hash::make($datos["passwordN"])]);
        
        }else if($id['email'] != request('email') && request('passwordN') == ""){
            $datos = request()->validate([
                'name'=>['required','string', 'max:255'],
                'password'=>['required', 'string','min:3'],
                'email'=> ['required', 'string','max:255','email','unique:users']
            ]);

            DB::table('users')->where('id', $id["id"])->update(['name'=>$datos["name"], 'email'=>$datos["email"], 'password'=>Hash::make($datos["password"])]);

        }else if($id['email'] == request('email') && request('passwordN') != ""){

            $datos = request()->validate([
                'name'=>['required','string', 'max:255'],
                'passwordN'=>['required', 'string','min:3'],
                'email'=> ['required', 'string','max:255']
            ]);

            DB::table('users')->where('id', $id["id"])->update(['name'=>$datos["name"], 'email'=>$datos["email"], 'password'=>Hash::make($datos["passwordN"])]);
        }else{
            $datos = request()->validate([
                'name'=>['required','string', 'max:255'],
                'passwordN'=>['required', 'string','min:3'],
                'email'=> ['required', 'string','max:255','email','unique:users']
            ]);

            DB::table('users')->where('id', $id["id"])->update(['name'=>$datos["name"], 'email'=>$datos["email"], 'password'=>Hash::make($datos["password"])]);
        }
    
       
        return redirect('Secretarias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secretarias  $secretarias
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Secretarias::destroy($id);
        return redirect('Secretarias');
    }
}
