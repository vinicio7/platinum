<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class RoleController extends Controller
{
    public $message        = "";
    public $result         = false;
    public $records        = array();
    public $statusCode     = 200;
    
    public function index()
    {
        $titulo     = 'rols';
        $dt_route   = route('rols.show');
        $dt_order   = [[0, 'desc']];
        $dt_columns = [
            ['data' => 'rol_id','title'=>'ID'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'dashboard_label', 'title'=>'DASHBOARD'],
            ['data' => 'propiedades_label', 'title'=>'PROPIEDADES'],
            ['data' => 'departamentos_label', 'title'=>'DEPARTAMENTOS'],
            ['data' => 'municipios_label', 'title'=>'MUNICIPIOS'],
            ['data' => 'regiones_label', 'title'=>'REGIONES'],
            ['data' => 'usuarios_label', 'title'=>'USUARIOS'],
            ['data' => 'zonas_label', 'title'=>'ZONAS'],
            ['data' => 'bancos_label', 'title'=>'BANCOS'],
            ['data' => 'historial_label', 'title'=>'HISTORIAL'],
            ['data' => 'roles_label', 'title'=>'ROLES'],
            ['data' => 'estado', 'title'=>'ESTADO'],
            ['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false]
        ]; 
        return view('rols', compact('dt_route', 'dt_columns','dt_order' ));
    }
    
    public function get(Request $request)
    {
        try {
            $rol = Rol::get();
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

    public function show(Rol $data)
    {
        return datatables()->of( Rol::get())
            ->addColumn('acciones', function ($record) {
                return
                    "<a class='btn btn-info btn-rounded m-1 text-white btn-edit' id='".$record->rol_id."'>Editar</a>".
                    "<a class='btn btn-danger btn-danger rounded m-1 text-white btn-delete' id='".$record->rol_id."'>Eliminar</a>";  
            })
            ->addColumn('dashboard_label', function ($record){
                if($record->dashboard == 1){
                    $class       = 'badge-success';
                    return "<span class='badge text-white {$class}'>Si</span>"; 
                }else{
                    $class       = 'badge-danger';
                    return "<span class='badge text-white {$class}'>No</span>";
                }
                
            })
            ->addColumn('propiedades_label', function ($record){
                if($record->propierties == 1){
                    $class       = 'badge-success';
                    return "<span class='badge text-white {$class}'>Si</span>"; 
                }else{
                    $class       = 'badge-danger';
                    return "<span class='badge text-white {$class}'>No</span>";
                }
                
            })
             ->addColumn('departamentos_label', function ($record){
                if($record->departaments == 1){
                    $class       = 'badge-success';
                    return "<span class='badge text-white {$class}'>Si</span>"; 
                }else{
                    $class       = 'badge-danger';
                    return "<span class='badge text-white {$class}'>No</span>";
                }
                
            })
              ->addColumn('municipios_label', function ($record){
                if($record->municipality == 1){
                    $class       = 'badge-success';
                    return "<span class='badge text-white {$class}'>Si</span>"; 
                }else{
                    $class       = 'badge-danger';
                    return "<span class='badge text-white {$class}'>No</span>";
                }  
            })
              ->addColumn('regiones_label', function ($record){
                if($record->regions == 1){
                    $class       = 'badge-success';
                    return "<span class='badge text-white {$class}'>Si</span>"; 
                }else{
                    $class       = 'badge-danger';
                    return "<span class='badge text-white {$class}'>No</span>";
                }
                
            })
            ->addColumn('usuarios_label', function ($record){
                if($record->user == 1){
                    $class       = 'badge-success';
                    return "<span class='badge text-white {$class}'>Si</span>"; 
                }else{
                    $class       = 'badge-danger';
                    return "<span class='badge text-white {$class}'>No</span>";
                }
                
            })
             ->addColumn('zonas_label', function ($record){
                if($record->zones == 1){
                    $class       = 'badge-success';
                    return "<span class='badge text-white {$class}'>Si</span>"; 
                }else{
                    $class       = 'badge-danger';
                    return "<span class='badge text-white {$class}'>No</span>";
                }
                
            })
              ->addColumn('bancos_label', function ($record){
                if($record->banks == 1){
                    $class       = 'badge-success';
                    return "<span class='badge text-white {$class}'>Si</span>"; 
                }else{
                    $class       = 'badge-danger';
                    return "<span class='badge text-white {$class}'>No</span>";
                }
                
            })->addColumn('roles_label', function ($record){
                if($record->rols == 1){
                    $class       = 'badge-success';
                    return "<span class='badge text-white {$class}'>Si</span>"; 
                }else{
                    $class       = 'badge-danger';
                    return "<span class='badge text-white {$class}'>No</span>";
                }
                
            })->addColumn('historial_label', function ($record){
                if($record->history == 1){
                    $class       = 'badge-success';
                    return "<span class='badge text-white {$class}'>Si</span>"; 
                }else{
                    $class       = 'badge-danger';
                    return "<span class='badge text-white {$class}'>No</span>";
                }
                
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
            })->rawColumns(['estado','acciones','dashboard_label','propiedades_label','departamentos_label','municipios_label','regiones_label','usuarios_label','zonas_label','bancos_label','roles_label','historial_label'])
            ->toJson();
    }

    public function create(Request $request)
    {
        $random = Str::random(60);
        $data   = Rol::create([
            'name'       => $request->name,
            'dashboard'       => $request->dashboard,
            'propierties'                  => $request->propierties,
            'departaments'                => $request->departaments,
            'municipality'                  => $request->municipality,
            'regions'                => $request->regions,
            'user'                  => $request->user,
            'status'                => $request->status,
            'zones'                  => $request->zones,
            'banks'                => $request->banks,
            'rols'                  => $request->rols,
            'history'                => $request->history
        ]);
        if ($data) {
            $this->message = "Regisstro creado correctamente";
            $this->result  = true;
            $this->records = $data;
        } else {
            $this->message = "Uno o mas campos requeridos";
            $this->result  = false;
        }
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
        $data = Rol::find($request->rol_id);
        if ($data) {
            $data->dashboard            = $request->dashboard;
            $data->propierties            = $request->propierties;
            $data->departaments            = $request->departaments;
            $data->municipality            = $request->municipality;
            $data->regions            = $request->regions;
            $data->user            = $request->user;
            $data->zones            = $request->zones;
            $data->banks            = $request->banks;
            $data->history            = $request->history;
            $data->rols            = $request->rols;
            $data->name            = $request->name?$request->name:$data->name;
            $data->status          = $request->status;
            $data->update();
        } else {
            $this->message = "Registro no encontrado";
            $this->result  = false;
        }
        $this->message = "Registro editado correctamente";
        $this->result  = true;
        $this->records = $data;
        $response =
            [
                'message'   => $this->message,
                'result'    => $this->result,
                'records'   => $this->records,
            ];
        return response()->json($response, $this->statusCode);
        
    }

    public function showid(Request $request)
    {
        try {
            $data = Rol::find($request->rol_id);
            $this->message = "Consulta correcta";
            $this->result  = true;
            $this->records = $data;
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
        $id         = $request->rol_id;
        $rols      = Rol::destroy($id);
        $titulo     = 'rols';
        $dt_route   = route('rols.show');
        $dt_order   = [[0, 'desc']];
        $dt_columns = [
            ['data' => 'rol_id','title'=>'ID'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'estado', 'title'=>'ESTADO'],
            ['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false]
        ]; 
        return redirect('rols')->with('dt_route', 'dt_columns','dt_order');
    }
}
