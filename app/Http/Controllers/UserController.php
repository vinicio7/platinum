<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Configuraciones;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Rol;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;



class UserController extends Controller
{
    public $message        = "";
    public $result         = false;
    public $records        = array();
    public $statusCode     = 200;
    
    public function index()
    {
        $titulo     = 'users';
        $dt_route   = route('users.show');
        $dt_order   = [[0, 'desc']];
        $dt_columns = [
            ['data' => 'user_id','title'=>'ID'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'imagen', 'title'=>'IMAGEN'],
            ['data' => 'rol_label', 'title'=>'ROL'],
            ['data' => 'username', 'title'=>'USUARIO'],
            ['data' => 'email', 'title'=>'EMAIL'],
            ['data' => 'estado', 'title'=>'ESTADO'],
            ['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false]
        ]; 
        return view('users', compact('dt_route', 'dt_columns','dt_order' ));
    }

    public function clientes()
    {
        $titulo     = 'clientes';
        $dt_route   = route('clientes_show');
        $dt_order   = [[0, 'desc']];
        $dt_columns = [
            ['data' => 'user_id','title'=>'ID'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'email', 'title'=>'EMAIL'],
            ['data' => 'telefono', 'title'=>'TELEFONO'],
             ['data' => 'whatsapp', 'title'=>'TELEFONO 2'],
            ['data' => 'estado', 'title'=>'ESTADO'],
            ['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false]
        ]; 
        return view('clientes', compact('dt_route', 'dt_columns','dt_order' ));
    }
    
    public function capsulas(Request $request){
        $configuracion = Configuraciones::truncate();
        $archivo = $request->capsula;
        $respuesta = [];
        if ($archivo) {
            try {
                $urlVideo = '';
                   if ($request->hasFile('capsula')) {
                            $archivo = $request->file('capsula');
                            $nombre_archivo = 'capsula'. '.' .  $archivo->getClientOriginalExtension();
                            Storage::disk('local')->put($nombre_archivo, File::get($archivo));
                            $urlVideo = $nombre_archivo;
                        }

                         $configuracion = Configuraciones::create([
                            'propiedad_principal' => 0,
                            'capsula'             => $urlVideo,
                            'texto'               => $request->input('texto'),
                            'titulo'              => $request->input('titulo'),
                        ]);

                return view('capsulas');
            } catch(\Exception $e){
                return response()->json(['result' => false, 'message' => 'Error subiendo. '.$e->getMessage(), 'records' => []]);
            }
            return response()->json(['result' => true, 'message' => "Archivo subido completamente.", 'records' => $records]);
        } else {
             $configuracion = Configuraciones::create([
                    'propiedad_principal' => $request->input('propiedad_principal'),
                    'capsula'             => '',
                     'texto'              => $request->input('texto'),
                    'titulo'              => $request->input('titulo'),
                ]);
            return view('capsulas');
        }
    }

    public function get(Request $request)
    {
        try {
            $rol = User::select('user_id','name')->where('rol_id',8)->get();
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $rol;
        } catch (\Exception $e) {
            $statusCode     = 200;
            $this->message  = env('APP_DEBUG') ? $e->getMessage() : 'Ocurrió un problema al consultar los datos';
        } finally {
            $response =
                [
                    'message'   => $this->message,
                    'result'    => $this->result,
                    'records'   => $this->records,
                ];
            return response()->json($response, $this->statusCode);
        }
    }

    public function vendedores(Request $request)
    {
        try {
            $rol = User::select('user_id','name')->whereIn('rol_id',[10,5])->get();
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $rol;
        } catch (\Exception $e) {
            $statusCode     = 200;
            $this->message  = env('APP_DEBUG') ? $e->getMessage() : 'Ocurrió un problema al consultar los datos';
        } finally {
            $response =
                [
                    'message'   => $this->message,
                    'result'    => $this->result,
                    'records'   => $this->records,
                ];
            return response()->json($response, $this->statusCode);
        }
    }

    public function show(User $user)
    {
        return datatables()->of( User::where('rol_id',10)->get())
            ->addColumn('acciones', function ($record) {
                return
                    "<a class='btn btn-info btn-rounded m-1 text-white btn-edit' id='".$record->user_id."'>Editar</a>".
                    "<a class='btn btn-danger btn-danger rounded m-1 text-white btn-delete' id='".$record->user_id."'>Eliminar</a>";  
            })
             ->addColumn('rol_label', function ($record) {
                    $rol = Rol::find($record->rol_id);
                    if ($rol) {
                        $class       = 'badge-info';  
                        return "<span class='badge text-white {$class}'>{$rol->name}</span>";
                    } else {
                       $class       = 'badge-warning';  
                       $name        = 'Sin rol asignado';
                        return "<span class='badge text-white {$class}'>{$name}</span>";
                    }        
            })
            ->addColumn('imagen', function ($record) {
                    return "<img src='".$record->picture."' style='width:80px;height:100px;object-fit:cover'>";
            })
            ->addColumn('estado', function ($record){
                if ($record->status == 0) {
                    $class       = 'badge-secondary';
                    $descripcion = 'Inactivo';
                } else {
                    $class       = 'badge-success';
                    $descripcion = 'Activo';
                }
                return "<span class='badge text-white {$class}'>{$descripcion}</span>";
            })->rawColumns(['estado','acciones','rol_label','imagen'])
            ->toJson();
    }

    public function clientes_show(User $user)
    {
        return datatables()->of( User::where('rol_id',8)->get())
            ->addColumn('acciones', function ($record) {
                return
                    "<a class='btn btn-warning btn-rounded m-1 text-white btn-edit' id='".$record->user_id."'>Acciones</a>".
                    "<a class='btn btn-info btn-rounded m-1 text-white btn-edit' id='".$record->user_id."'>Editar</a>".
                    "<a class='btn btn-danger btn-danger rounded m-1 text-white btn-delete' id='".$record->user_id."'>Eliminar</a>";  
            })
            ->addColumn('rol_label', function ($record) {
                    $rol = Rol::find($record->rol_id);
                    if ($rol) {
                        $class       = 'badge-info';  
                        return "<span class='badge text-white {$class}'>{$rol->name}</span>";
                    } else {
                       $class       = 'badge-warning';  
                       $name        = 'Sin rol asignado';
                        return "<span class='badge text-white {$class}'>{$name}</span>";
                    }        
            })
             ->addColumn('telefono', function ($record) {
                    if($record->phone){
                        return $record->phone;
                    }
                    else{
                        return "Sin telefono";
                    }
                        
            })
            ->addColumn('estado', function ($record){
                $class       = 'badge-success';
                $descripcion = 'Activo';
                return "<span class='badge text-white {$class}'>{$descripcion}</span>";
            })->rawColumns(['estado','acciones','rol_label','imagen'])
            ->toJson();
    }

    public function create(Request $request)
    {
        $random = Str::random(60);
        $user   = User::create([
            'rol_id'            => $request->rol,
            'name'              => $request->name,
            'username'          => $request->user,
            'password'          => bcrypt($request->password),
            'email'             => $request->email,
            'phone'             => $request->phone,
            'adress'            => $request->adress,
            'gender'            => $request->gender,
            'document_id'       => $request->document_id,
            'birthdate'         => $request->birthdate,
            'marital_status'    => $request->marital_status,
            'title'             => $request->title,
            'facebook'          => $request->facebook,
            'twitter'           => $request->twitter,
            'whatsapp'          => $request->whatsapp,
            'instagram'         => $request->instagram,
            'pinterest'         => $request->pinterest,
            'youtube'           => $request->youtube,
            'linkedin'          => $request->linkedin,
            'picture'           => '',
            'api_token'         => ""
        ]);
        if ($user) {
            $path= '';
            $archivo = $request->file;
            if ($archivo) {
                $path = $archivo->store('assets/images');
                $fileName = collect(explode('/', $path))->last();
                $image = Image::make(Storage::get($path));
                Storage::disk('local')->put($path, (string) $image->encode($archivo->extension()));
                $user->picture = $path;
                $user->save();
            }
        } else {
            $this->message = "Uno o mas campos requeridos";
            $this->result  = false;
        }
        $this->message = "Usuario creado correctamente";
        $this->result  = true;
        $this->records = $user;
        $response =
            [
                'message'   => $this->message,
                'result'    => $this->result,
                'records'   => $this->records,
            ];
        return response()->json($response, $this->statusCode);
    }

    public function edit(Request $request)
    {
        $user = User::find($request->user_id);
        if ($user) {
            $random = Str::random(60);
            $archivo = $request->file;
            if ($archivo) {
                $path = $archivo->store('assets/images');
                $fileName = collect(explode('/', $path))->last();
                $image = Image::make(Storage::get($path));
                Storage::disk('local')->put($path, (string) $image->encode($archivo->extension()));
                $user->picture = $path;
                $user->save();
            }
            $user->rol_id          = $request->rol ?($request->rol):$user->rol_id;
            $user->status          = $request->status ?($request->status):$user->status;
            $user->name            = $request->name ?($request->name):$user->name;
            $user->username        = $request->user ?($request->user):$user->user;
            $user->password        = bcrypt($request->password) ?bcrypt($request->password):$user->password;
            $user->email           = $request->email ?($request->email):$user->email;
            $user->phone           = $request->phone ?($request->phone):$user->phone;
            $user->adress          = $request->adress ?($request->adress):$user->adress;
            $user->gender          = $request->gender ?($request->gender):$user->gender;
            $user->document_id     = $request->document_id ?($request->document_id):$user->document_id;
            $user->birthdate       = $request->birthdate ?($request->birthdate):$user->birthdate;
            $user->marital_status  = $request->marital_status ?($request->marital_status):$user->marital_status;
            $user->title           = $request->title ?($request->title):$user->title;
            $user->facebook        = $request->facebook ?($request->facebook):$user->facebook;
            $user->twitter         = $request->twitter ?($request->twitter):$user->twitter;
            $user->whatsapp        = $request->whatsapp ?($request->whatsapp):$user->whatsapp;
            $user->instagram       = $request->instagram?$request->instagram:$user->instagram;
            $user->pinterest       = $request->pinterest ?($request->pinterest):$user->pinterest;
            $user->youtube         = $request->youtube ?($request->youtube):$user->youtube;
            $user->linkedin        = $request->linkedin?$request->linkedin:$user->linkedin;
            $user->update();
        } else {
            $this->message = "Usuario no encontrado";
            $this->result  = false;
        }
        $this->message = "Usuario editado correctamente";
        $this->result  = true;
        $this->records = $user;
        $response =
            [
                'message'   => $this->message,
                'result'    => $this->result,
                'records'   => $this->records,
            ];
        return response()->json($response, $this->statusCode);
        
    }

    public function asociate($id){
        $data = User::find($id);
        return view('asociate', compact('data'));
    }

    public function send_message(Request $request){
        session()->flush();
        session(['success' => 'Mensaje Enviado exitosamente']);
        return redirect('/contacto');
    }

    public function showid(Request $request)
    {
        try {
            $user = User::find($request->user_id);
            $this->message = "Consulta correcta";
            $this->result  = true;
            $this->records = $user;
        } catch (\Exception $e) {
            $statusCode     = 200;
            $this->message  = env('APP_DEBUG') ? $e->getMessage() : 'Ocurrió un problema al consultar los datos';
        } finally {
            $response =
                [
                    'message'   => $this->message,
                    'result'    => $this->result,
                    'records'   => $this->records,
                ];
            return response()->json($response, $this->statusCode);
        }
    }

    public function delete(Request $request)
    {
        $id         = $request->user_id;
        $users      = User::destroy($id);
        $titulo     = 'users';
        $dt_route   = route('users.show');
        $dt_order   = [[0, 'desc']];
        $dt_columns = [
            ['data' => 'user_id','title'=>'ID'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'imagen', 'title'=>'IMAGEN'],
            ['data' => 'rol_label', 'title'=>'ROL'],
            ['data' => 'username', 'title'=>'USUARIO'],
            ['data' => 'email', 'title'=>'EMAIL'],
            ['data' => 'estado', 'title'=>'ESTADO'],
            ['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false]
        ]; 
        return redirect('users')->with('dt_route', 'dt_columns','dt_order');
    }
}
