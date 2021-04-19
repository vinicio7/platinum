<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class BankController extends Controller
{
    public $message        = "";
    public $result         = false;
    public $records        = array();
    public $statusCode     = 200;
    
    public function index()
    {
        $titulo     = 'banks';
        $dt_route   = route('banks.show');
        $dt_order   = [[0, 'desc']];
        $dt_columns = [
            ['data' => 'bank_id','title'=>'ID'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'account', 'title'=>'CUENTA'],
            ['data' => 'estado', 'title'=>'ESTADO'],
            ['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false]
        ]; 
        return view('banks', compact('dt_route', 'dt_columns','dt_order' ));
    }
    
    public function show(Bank $data)
    {
        return datatables()->of( Bank::get())
            ->addColumn('acciones', function ($record) {
                return
                    "<a class='btn btn-info btn-rounded m-1 text-white btn-edit' id='".$record->bank_id."'>Editar</a>".
                    "<a class='btn btn-danger btn-danger rounded m-1 text-white btn-delete' id='".$record->bank_id."'>Eliminar</a>";  
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

    public function create(Request $request)
    {
        $random = Str::random(60);
        $data   = Bank::create([
            'bank_id'            => $request->rol,
            'name'                  => $request->name,
            'account'                  => $request->account,
            'status'                => $request->status
        ]);
        if ($data) {
            $path= '';
            $archivo = $request->file;
            if ($archivo) {
                $path = $archivo->store('assets/images');
                $fileName = collect(explode('/', $path))->last();
                $image = Image::make(Storage::get($path));
                $image->resize(1280, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                Storage::disk('local')->put($path, (string) $image->encode($archivo->extension(), 30));
                $data->picture = $path;
                $data->save();
            }
        } else {
            $this->message = "Uno o mas campos requeridos";
            $this->result  = false;
        }
        $this->message = "Banco creado correctamente";
        $this->result  = true;
        $this->records = $data;
        $response =
            [
                'message'   => $this->message,
                'result'    => $this->result,
                'records'   => $this->records,
            ];
        return response()->json($response, $this->statusCode);
    }

    public function edit(Request $request)
    {
        $data = Bank::find($request->bank_id);
        if ($data) {
            $random = Str::random(60);
            $archivo = $request->file;
            if ($archivo) {
                $path = $archivo->store('assets/images');
                $fileName = collect(explode('/', $path))->last();
                $image = Image::make(Storage::get($path));
                $image->resize(1280, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                Storage::disk('local')->put($path, (string) $image->encode($archivo->extension(), 30));
                $data->picture = $path;
                $data->save();
            }
            $data->bank_id      = $request->bank_id ?$request->bank_id:$data->bank_id;
            $data->name            = $request->name?$request->name:$data->name;
            $data->account            = $request->account?$request->account:$data->account;
            $data->status          = $request->status;
            $data->update();
        } else {
            $this->message = "Banco no encontrado";
            $this->result  = false;
        }
        $this->message = "Banco editado correctamente";
        $this->result  = true;
        $this->records = $data;
        $response =
            [
                'message'   => $this->message,
                'result'    => $this->result,
                'records'   => $this->records,
            ];
        return response()->json($response, $this->statusCode);
        
    }

    public function showid(Request $request)
    {
        try {
            $data = Bank::find($request->bank_id);
            $this->message = "Consulta correcta";
            $this->result  = true;
            $this->records = $data;
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

    public function delete(Request $request)
    {
        $id         = $request->bank_id;
        $banks      = Bank::destroy($id);
        $titulo     = 'banks';
        $dt_route   = route('banks.show');
        $dt_order   = [[0, 'desc']];
        $dt_columns = [
            ['data' => 'bank_id','title'=>'ID'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'account', 'title'=>'CUENTA'],
            ['data' => 'estado', 'title'=>'ESTADO'],
            ['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false]
        ]; 
        return redirect('banks')->with('dt_route', 'dt_columns','dt_order');
    }
}
