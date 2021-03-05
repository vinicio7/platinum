<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use DB;


class BankController extends Controller
{
    public $message     = "";
    public $result         = false;
    public $records     = array();
    public $statusCode     = 200;

    public function show(Bank $bank)
    {
        try {
            $banks = Bank::all();
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $banks;
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
            $banks = Bank::find($request->bank_id);
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $banks;
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
                'account'   => 'required',
                'status'   => 'required'

            ]);
            $id = $request->bank_id;
            $banks = Bank::find($id);
            $banks->name = $validate['name'];
            $banks->account = $validate['account'];
            $banks->status = $validate['status'];
            $banks->update();

            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $banks;
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
            $id = $request->bank_id;
            $banks = Bank::destroy($id);

            $this->message = "Registro eliminado correctamente";
            $this->result = true;
            $this->records = $banks;
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
