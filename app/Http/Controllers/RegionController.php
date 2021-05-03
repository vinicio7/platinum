<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class RegionController extends Controller
{
    public $message        = "";
    public $result         = false;
    public $records        = array();
    public $statusCode     = 200;
    
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

    public function get(Request $request)
    {
        try {
            $rol = Region::get();
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $rol;
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
    
    public function show(Region $data)
    {
        return datatables()->of( Region::get())
            ->addColumn('acciones', function ($record) {
                return
                    "<a class='btn btn-info btn-rounded m-1 text-white btn-edit' id='".$record->regions_id."'>Editar</a>".
                    "<a class='btn btn-danger btn-danger rounded m-1 text-white btn-delete' id='".$record->regions_id."'>Eliminar</a>";  
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
        $data   = Region::create([
            'regions_id'            => $request->rol,
            'name'                  => $request->name,
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
        $this->message = "Region creado correctamente";
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
        $data = Region::find($request->regions_id);
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
            $data->regions_id      = $request->regions_id ?$request->regions_id:$data->regions_id;
            $data->name            = $request->name?$request->name:$data->name;
            $data->status          = $request->status;
            $data->update();
        } else {
            $this->message = "Region no encontrado";
            $this->result  = false;
        }
        $this->message = "Region editado correctamente";
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
            $data = Region::find($request->regions_id);
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
        $id         = $request->regions_id;
        $regions      = Region::destroy($id);
        $titulo     = 'regions';
        $dt_route   = route('regions.show');
        $dt_order   = [[0, 'desc']];
        $dt_columns = [
            ['data' => 'regions_id','title'=>'ID'],
            ['data' => 'name', 'title'=>'NOMBRE'],
            ['data' => 'estado', 'title'=>'ESTADO'],
            ['data' => 'acciones',"title"=>"ACCIONES", 'orderable'=> false, 'searchable' => false]
        ]; 
        return redirect('regions')->with('dt_route', 'dt_columns','dt_order');
    }
}
