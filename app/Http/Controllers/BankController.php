<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;


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
        $order = 'bank_id';
        if( $request->input('order')){
            $order =  $request->input('bank_id');
        }
        $length      = $request->input('length');
        $orderBy     = $order; //Index
        $orderByDir  = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        $query       = Bank::eloquentQuery($orderBy, $orderByDir, $searchValue);
        //->with('departament','municipality');
        $data        = $query->paginate($length);
        return new DataTableCollectionResource($data);
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
