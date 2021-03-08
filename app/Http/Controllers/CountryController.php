<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public $message     = "";
    public $result      = false;
    public $records     = array();
    public $statusCode  = 200;
    
    public function create(Request $request)
    {
        try {
            $validate = $request->validate([
                'name'        => 'required',
                'status'   => 'required'

            ]);
            $country = Country::create([
                'name'      => $validate['name'],
                'status'    => $validate['status']
            ]);
            $this->message  = "Pais creado correctamente.";
            $this->result   = true;
            $this->records  = $country;
        } catch (\Exception $e) {
            $statusCode     = 200;
            $this->message  = env('APP_DEBUG') ? $e->getMessage() : 'Ocurrió un problema al crea el pais.';
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

            $countries = Country::all();
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $countries;
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
            $country = Country::find($request->country_id);
            $this->message  = "Pais consultado correctamente.";
            $this->result   = true;
            $this->records  = $country;
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
                'name'      => 'required',
                'status'    => 'required'

            ]);
            $country          = Country::find($request->country_id);
            $country->name    = $validate['name'];
            $country->status  = $validate['status'];
            $country->update();

            $this->message = "Registro actualizado correctamente.";
            $this->result = true;
            $this->records = $country;
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
            $country        = Country::destroy($request->country_id);
            $this->message  = "Registro eliminado correctamente";
            $this->result   = true;
            $this->records  = $country;
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
