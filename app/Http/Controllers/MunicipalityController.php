<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use Illuminate\Http\Request;

class MunicipalityController extends Controller
{
    public $message     = "";
    public $result      = false;
    public $records     = array();
    public $statusCode  = 200;

    public function showAll()
    {
        try {
            $municipalities = Municipality::all();
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $municipalities;
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
                'departament_id'    => 'required',
                'name'              => 'required',
                'status'            => 'required'

            ]);
            $municipality = Municipality::create([
                'departament_id'    => $validate['departament_id'],
                'name'              => $validate['name'],
                'status'            => $validate['status']
            ]);
            $this->message  = "Municipio creado correctamente.";
            $this->result   = true;
            $this->records  = $municipality;
        } catch (\Exception $e) {
            $statusCode     = 200;
            $this->message  = env('APP_DEBUG') ? $e->getMessage() : 'Ocurrió un problema al crea el municipio.';
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
            $municipality   = Municipality::where('municipality_id',$request->municipality_id)->get();
            $this->message  = "Municipio consultado correctamente.";
            $this->result   = true;
            $this->records  = $municipality;
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
                'departament_id'    => 'required',
                'name'              => 'required',
                'status'            => 'required',
                'minicipality_id'   => 'required'
            ]);
            $municipality                   = Municipality::find($validate['minicipality_id']);
            $municipality->name             = $validate['name'];
            $municipality->status           = $validate['status'];
            $municipality->departament_id   = $validate['departament_id'];
            $municipality->update();
            $this->message  = "Registro actualizado correctamente.";
            $this->result   = true;
            $this->records  = $municipality;
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
            $municipality        = Municipality::destroy($request->municipality_id);
            $this->message      = "Registro eliminado correctamente";
            $this->result       = true;
            $this->records      = $municipality;
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
