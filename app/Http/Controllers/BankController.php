<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use \Yajra\Datatables\Datatables;

class BankController extends Controller
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
                'account'   => 'required',
                'status'   => 'required'

            ]);
            $banks = Bank::create([
                'name'        => $validate['name'],
                'account'   => $validate['account'],
                'status'   => $validate['status'],
            ]);
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


    public function show(Request $request)
    {
           return datatables()->of( Bank::get())
            ->addColumn('estado', function ($record){
                if ($record->status == 0) {
                    $class = 'badge-warning';
                    $descripcion = 'Inactivo';
                } else {
                    $class = 'badge-success';
                    $descripcion = 'Activo';
                }
                return "<span class='badge text-white {$class}'>{$descripcion}</span>";
            })->rawColumns(['estado'])
            ->toJson();
    }

    public function index()
    {
        $titulo  = 'banks';
        $dt_route = route('banks.show');
        $dt_order= [[0, 'desc']];
        $dt_columns = [
            ['data' => 'bank_id','title'=>'ID'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'account','title'=>'CUENTA'],
            ['data' => 'estado', 'title'=>'ESTADO'],
        ]; 
        return view('banks', compact('dt_route', 'dt_columns','dt_order' ));
    }
    
    public function showId(Request $request)
    {
        try {
            //dd($request->all());
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
