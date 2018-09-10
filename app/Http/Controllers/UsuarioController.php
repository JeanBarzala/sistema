<?php

namespace App\Http\Controllers;
use App\Persona;
use App\Usuario;
use App\User;
use App\EstadoCivil;
use App\Ciudad;
use App\Barrio;
use App\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Http\Response;


class UsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $request;
    private $usuario;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //return view('clientes.index', compact('clientes'));
        $users = User::with('roles_user')->where('estado_usuario', 'ACTIVO')->paginate(15);
        
        //dd($users);
        return view('user.index', compact('users'));

    }
    public function all()
    {

        //return view('clientes.index', compact('clientes'));
        $users = User::with('roles_user')->where('estado_usuario', 'ACTIVO')->paginate(15);
        
        //dd($users);
        return view('user.all', compact('users'));

    }

    public function create()
    {
        $estado_civil = EstadoCivil::all();
        $ciudades = Ciudad::limit(5)->get();
        $barrios = Barrio::limit(5)->get();
        $roles = Role::all()->pluck('name', 'id');

        return view('user.create', compact('estado_civil', 'roles'));

        //return view('auth.login');
    }

    public function store(Request $request)
    {
        //return bcrypt($request->password);
        try
        {
            $fecha_registro = date("Y-m-d H:i:s");
            $password = bcrypt($request->password);

            $persona = new Persona();
            $persona->id_estado_civil               =$request->estado_civil;
            $persona->nombre_persona                =$request->nombre;
            $persona->apellido_persona              =$request->apellido;
            $persona->num_doc_persona               =$request->ci;
            $persona->email_persona                 =$request->email;         
            $persona->id_tipo_persona               =0;
            $persona->fecha_registro_persona        =$fecha_registro;
            $persona->estado_persona                =1;
            $persona->save();

            $usuario = new User();
            $usuario->id_persona                    = $persona->id_persona;
            $usuario->name                          =$request->nombre;
            $usuario->email                         =$request->email;
            $usuario->vehiculo_usuario              =$request->vehiculo;
            $usuario->matricula_vehiculo_usuario    =$request->matricula;
            $usuario->fecha_registro_usuario        =$fecha_registro;
            $usuario->password                      =$password;
            $usuario->estado_usuario                ='ACTIVO';
                
            $usuario->save();


            if ($request->role) {
                DB::table('role_user')->where('user_id', $usuario->id)->delete();
                foreach ($request->role as $role_request) {
                    DB::table('role_user')->insert(['user_id' => $usuario->id, 'role_id' => $role_request]);
                }
            }

            return redirect('/account/editar/'.$usuario->id);
        }
        catch(Exception $e)
        {
            return "Fatal error - "-$e->getMessage();
        }
    }

    public function edit($id)
    {

        $usuarios = Usuario::find($id);
        $roles = Role::all()->pluck('name', 'id');
        $roles_selected = DB::table('role_user')->where('user_id', $usuarios->id)->pluck('role_id');


        return view('user.edit', compact('usuarios', 'roles', 'roles_selected'));
    }


    public function update($id, $id_persona, Request $request)
    {
        $file = $request->file('profile');

        $password = bcrypt($request->password);

        $persona = Persona::find($id_persona);
        $persona->nombre_persona             =$request->nombre;
        $persona->apellido_persona           =$request->apellido;
        $persona->num_doc_persona            =$request->ci;
        $persona->email_persona              =$request->email;
        $persona->save();

        $usuario = Usuario::where('id_persona', $id_persona)->first();
        $usuario->name = $request->name;

        if ($file)
        {
            if ($usuario->image) {
                Storage::delete($usuario->image);
            }
            $usuario->image       = $request->file('profile')->store('profile');

        }else {
            $usuario->image       = $usuario->image;
        }
        if (!empty($request->password)) {
            $usuario->password = $password;
        }

        $usuario->save();

        if ($request->role) {
            DB::table('role_user')->where('user_id', $id)->delete();
            foreach ($request->role as $role_request) {
                DB::table('role_user')->insert(['user_id' => $id, 'role_id' => $role_request]);
            }
        }

        Session::flash('message', 'El usuario ha sido actualizado correctamente.');

        return redirect()->back();

    }

    public function destroy($id)
    {
        $persona = Persona::find($id);
        $persona->estado_persona = 'ELIMINADO';
        $persona->save();

        $usuario = Usuario::where('id_persona' ,$id)->first();
        $usuario->estado_usuario = 'INACTIVO';
        $usuario->save();

        Session::flash('message', 'El usuario ha sido eliminado.');

        return redirect()->back();

    }
}
