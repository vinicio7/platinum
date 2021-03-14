<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use Illuminate\Http\Request;

class DepartamentController extends Controller
{
    public $message     = "";
    public $result      = false;
    public $records     = array();
    public $statusCode  = 200;

    
    public function create(Request $request)
    {
        try {
            $validate = $request->validate([
                'country_id'    => 'required',
                'name'          => 'required',
                'status'        => 'required'

            ]);
            $departament = Departament::create([
                'country_id'    => $validate['country_id'],
                'name'          => $validate['name'],
                'status'        => $validate['status']
            ]);
            $this->message  = "Departamento creado correctamente.";
            $this->result   = true;
            $this->records  = $departament;
        } catch (\Exception $e) {
            $statusCode     = 200;
            $this->message  = env('APP_DEBUG') ? $e->getMessage() : 'Ocurrió un problema al crea el departamento.';
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

    
    public function showAll()
    {
        try {

            $departaments = Departament::all();
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $departaments;
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

    public function showId(Request $request)
    {
        try {
            $departament = Departament::where('departament_id',$request->departament_id)->get();
            $this->message  = "Departamento consultado correctamente.";
            $this->result   = true;
            $this->records  = $departament;
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
                'country_id'        => 'required',
                'name'              => 'required',
                'status'            => 'required',
                'departament_id'    => 'required'
            ]);
            $departament                = Departament::find($validate['departament_id']);
            $departament->name          = $validate['name'];
            $departament->status        = $validate['status'];
            $departament->country_id    = $validate['country_id'];
            $departament->update();
            $this->message = "Registro actualizado correctamente.";
            $this->result = true;
            $this->records = $departament;
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
            $departament        = Departament::destroy($request->departament_id);
            $this->message      = "Registro eliminado correctamente";
            $this->result       = true;
            $this->records      = $departament;
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
