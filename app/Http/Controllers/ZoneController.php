<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class ZoneController extends Controller
{
    public $message        = "";
    public $result         = false;
    public $records        = array();
    public $statusCode     = 200;
    
    public function index()
    {
        $titulo     = 'zones';
        $dt_route   = route('zones.show');
        $dt_order   = [[0, 'desc']];
        $dt_columns = [
            ['data' => 'zone_id','title'=>'ID'],
            ['data' => 'municipio', 'title'=>'MUNICIPIO'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'estado', 'title'=>'ESTADO'],
            ['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false]
        ]; 
        return view('zones', compact('dt_route', 'dt_columns','dt_order' ));
    }

    public function capsulas()
    {
        return view('capsulas');
    }
    
    public function get(Request $request)
    {
        try {
            $rol = Zone::get();
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

    public function show(Zone $data)
    {
        return datatables()->of( Zone::get())
            ->addColumn('acciones', function ($record) {
                return
                    "<a class='btn btn-info btn-rounded m-1 text-white btn-edit' id='".$record->zone_id."'>Editar</a>".
                    "<a class='btn btn-danger btn-danger rounded m-1 text-white btn-delete' id='".$record->zone_id."'>Eliminar</a>";  
            })->addColumn('municipio', function ($record){
                 $class       = 'badge-info';
                $departament = Municipality::find($record->municipality_id);
                return "<span class='badge text-white {$class}'>{$departament->name}</span>";
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
            })->rawColumns(['estado','acciones','municipio'])
            ->toJson();
    }

    public function create(Request $request)
    {
        $random = Str::random(60);
        $data   = Zone::create([
            'municipality_id'        => $request->municipality_id,
            'name'                  => $request->name,
            'status'                => $request->status
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
        $data = Zone::find($request->zone_id);
        if ($data) {
            $data->zone_id      = $request->zone_id ?$request->zone_id:$data->zone_id;
            $data->municipality_id            = $request->municipality_id?$request->municipality_id:$data->municipality_id;
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
            $data = Zone::find($request->zone_id);
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
        $id         = $request->zone_id;
        $zones      = Zone::destroy($id);
        $titulo     = 'zones';
        $dt_route   = route('zones.show');
        $dt_order   = [[0, 'desc']];
        $dt_columns = [
            ['data' => 'zone_id','title'=>'ID'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'estado', 'title'=>'ESTADO'],
            ['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false]
        ]; 
        return redirect('zones')->with('dt_route', 'dt_columns','dt_order');
    }
}
