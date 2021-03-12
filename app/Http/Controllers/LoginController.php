<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    public $message     = "";
    public $result         = false;
    public $records     = array();
    public $statusCode     = 200;

    public function login(Request $request){
        try {
            $random = Str::random(60);
            $auth = User::where('email', $request->email)->first();
           if ($auth) {
                $check = Hash::check($request->password, $auth->password);
                if($check){
                    $auth->api_token = $random;
                    $auth->update();

                    $response =[
                        'user_id' => $auth->user_id,
                        'name' => $auth->name,
                        'email' => $auth->email,
                        'api_token'=> $auth->api_token,
                    ];

                    $this->message = "Bienvenido"." ". $auth->name;
                    $this->result = true;
                    $this->records = $response;

                }else{
                $this->message = "Credenciales incorrectas";
                $this->result = false;
                $this->records = [];
                }
           }
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
    public function logout(Request $request){
        try {
                $users = User::find($request->user_id);
                $users->api_token = "";
                $users->update();

                $this->message = "Logout Correcto";
                $this->result = true;
                $this->records = [];
           }
         catch (\Exception $e) {
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
