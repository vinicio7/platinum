<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public $message     = "";
    public $result         = false;
    public $records     = array();
    public $statusCode     = 200;

    public function create(Request $request)
    {
        try {
            $validate = $request->validate([
                'name'        => 'required',
                'status'   => 'required'

            ]);
            $regions = Region::create([
                'name'        => $validate['name'],
                'status'   => $validate['status'],
            ]);
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $regions;
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

    public function index()
    {
        $titulo     = 'regions';
        $dt_route   = route('regions.show');
        $dt_order   = [[0, 'desc']];
        $dt_columns = [
            ['data' => 'regions_id','title'=>'ID'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'estado', 'title'=>'ESTADO'],
            ['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false]
        ]; 
        return view('regions', compact('dt_route', 'dt_columns','dt_order' ));
    }


    public function show(Region $region)
    {
        return datatables()->of( Region::get())
            ->addColumn('acciones', function ($record) {
                return
                    "<a href='".route('regions.edit',['bank'=>$record->regions_id])."' class='btn btn-info btn-rounded m-1 text-white'>Editar</a>".
                    "<a href='".route('regions.destroy',['bank'=>$record->regions_id])."' class='btn btn-danger btn-rounded m-1 text-white'>Eliminar</a>";    
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

    public function showId(Request $request)
    {
        try {
            $regions = Region::find($request->regions_id);
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $regions;
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
                'name'        => 'required',
                'status'   => 'required'

            ]);

            $regions = Region::find($request->regions_id);
            $regions->name = $validate['name'];
            $regions->status = $validate['status'];
            $regions->update();

            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $regions;
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

    public function destroy(Request $request)
    {
        try {
            $regions = Region::destroy($request->bank_id);

            $this->message = "Registro eliminado correctamente";
            $this->result = true;
            $this->records = $regions;
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
}
