<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;



class UserController extends Controller
{
    public $message     = "";
    public $result         = false;
    public $records     = array();
    public $statusCode     = 200;
   
    public function create(Request $request)
    {
        $random = Str::random(60);
        $validate = $request->validate([
            'rol_id'            => 'required',
            'name'              => 'required',
            'username'          => 'required',
            'password'          => 'required',
            'email'             => 'required',
            'phone'             => 'required',
            'adress'            => 'required',
            'gender'            => 'required',
            'document_id'       => 'required',
            'birthdate'         => 'required',
            'marital_status'    => 'required',
            'title'             => 'required',
            'picture'           => 'required',
        ]);
        $users = User::create([
            'rol_id'            => $validate['rol_id'],
            'name'              => $validate['name'],
            'username'          => $validate['username'],
            'password'          => bcrypt($validate['password']),
            'email'             => $validate['email'],
            'phone'             => $validate['phone'],
            'adress'            => $validate['adress'],
            'gender'            => $validate['gender'],
            'document_id'       => $validate['document_id'],
            'birthdate'         => $validate['birthdate'],
            'marital_status'    => $validate['marital_status'],
            'title'             => $validate['title'],
            'facebook'          => $request->facebook,
            'twitter'           => $request->twitter,
            'whatsapp'          => $request->whatsapp,
            'instagram'         => $request->instagram,
            'pinterest'         => $request->pinterest,
            'youtube'           => $request->youtube,
            'linkedin'          => $request->linkedin,
            'picture'           => $validate['picture'],
            'api_token'         => ""
        ]);


        $this->message = "Consulta correcta";
        $this->result = true;
        $this->records = $users;

        $response =
            [
                'message'   => $this->message,
                'result'    => $this->result,
                'records'   => $this->records,
            ];
        return response()->json($response, $this->statusCode);

    }

    public function show(Request $request)
    {
        try {
            $users = User::all();
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $users;
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
            $users = User::find($request->user_id);
            $this->message = "Consulta correcta";
            $this->result = true;
            $this->records = $users;
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
        $random = Str::random(60);
        $validate = $request->validate([
            'rol_id'            => 'required',
            'name'              => 'required',
            'username'          => 'required',
            'password'          => 'required',
            'email'             => 'required',
            'phone'             => 'required',
            'adress'            => 'required',
            'gender'            => 'required',
            'document_id'       => 'required',
            'birthdate'         => 'required',
            'marital_status'    => 'required',
            'title'             => 'required',
            'picture'           => 'required',
        ]);
        $users = User::find($request->user_id);
        $users->rol_id          = $validate['rol_id'];
        $users->name            = $validate['name'];
        $users->username        = $validate['username'];
        $users->password        = bcrypt($validate['password']);
        $users->email           = $validate['email'];
        $users->phone           = $validate['phone'];
        $users->adress          = $validate['adress'];
        $users->gender          = $validate['gender'];
        $users->document_id     = $validate['document_id'];
        $users->birthdate       = $validate['birthdate'];
        $users->marital_status  = $validate['marital_status'];
        $users->title           = $validate['title'];
        $users->facebook        = $request->facebook;
        $users->twitter         = $request->twitter;
        $users->whatsapp        = $request->whatsapp;
        $users->instagram       = $request->instagram;
        $users->pinterest       = $request->pinterest;
        $users->youtube         = $request->youtube;
        $users->linkedin        = $request->linkedin;
        $users->picture         = $validate['picture'];
        $users->update();
    }

    public function destroy(Request $request)
    {
        try {
            $id = $request->bank_id;
            $users = User::destroy($id);

            $this->message = "Registro eliminado correctamente";
            $this->result = true;
            $this->records = $users;
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
