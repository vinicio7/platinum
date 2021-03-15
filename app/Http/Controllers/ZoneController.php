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
