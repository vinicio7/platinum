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

    public function show(Region $region)
    {
        try {

            $regions = Region::all();
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

    public function showId(Request $request)
    {
        try {
            $regions = Region::find($request->region_id);
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

            $regions = Region::find($request->region_id);
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
