<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public $message     = "";
    public $result      = false;
    public $records     = array();
    public $statusCode  = 200;

    public function index()
    {
        $titulo     = 'zones';
        $dt_route   = route('zones.show');
        $dt_order   = [[0, 'desc']];
        $dt_columns = [
            ['data' => 'zone_id','title'=>'ID'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'estado', 'title'=>'ESTADO'],
            ['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false]
        ]; 
        return view('zones', compact('dt_route', 'dt_columns','dt_order' ));
    }
    
    public function show(Zone $zone)
    {
        return datatables()->of( Zone::get())
            ->addColumn('acciones', function ($record) {
                return
                    "<a href='".route('regions.edit',['bank'=>$record->zone_id])."' class='btn btn-info btn-rounded m-1 text-white'>Editar</a>".
                    "<a href='".route('regions.destroy',['bank'=>$record->zone_id])."' class='btn btn-danger btn-rounded m-1 text-white'>Eliminar</a>";    
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
            })->rawColumns(['estado','acciones'])
            ->toJson();
    }


    public function showAll()
    {
        try {
            $zones = Zone::all();
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $zones;
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
    
    public function create(Request $request)
    {
        try {
            $validate = $request->validate([
                'municipality_id'   => 'required',
                'name'              => 'required',
                'status'            => 'required'

            ]);
            $zone = Zone::create([
                'municipality_id'   => $validate['municipality_id'],
                'name'              => $validate['name'],
                'status'            => $validate['status']
            ]);
            $this->message  = "Zona creada correctamente.";
            $this->result   = true;
            $this->records  = $zone;
        } catch (\Exception $e) {
            $statusCode     = 200;
            $this->message  = env('APP_DEBUG') ? $e->getMessage() : 'Ocurrió un problema al crea la zona.';
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

   
    public function showId(Request $request)
    {
        try {
            $zone   = Zone::where('zone_id',$request->zone_id)->get();
            $this->message  = "Zona consultada correctamente.";
            $this->result   = true;
            $this->records  = $zone;
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

    

    
    public function edit(Request $request)
    {
        try {
            $validate = $request->validate([
                'municipality_id'   => 'required',
                'name'              => 'required',
                'status'            => 'required',
                'zone_id'           => 'required'
            ]);
            $zone                   = Zone::find($validate['zone_id']);
            $zone->name             = $validate['name'];
            $zone->status           = $validate['status'];
            $zone->municipality_id  = $validate['municipality_id'];
            $zone->update();
            $this->message  = "Registro actualizado correctamente.";
            $this->result   = true;
            $this->records  = $zone;
        } catch (\Exception $e) {
            $statusCode     = 400;
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

    
    public function destroy(Zone $zone)
    {
        try {
            $zone           = Zone::destroy($request->zone_id);
            $this->message  = "Registro eliminado correctamente";
            $this->result   = true;
            $this->records  = $zone;
        } catch (\Exception $e) {
            $statusCode     = 400;
            $this->message  = env('APP_DEBUG') ? $e->getMessage() : 'Ocurrió un problema al eliminar el registro';
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
}
