<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(){
        if(session()->get('user')){
            return redirect('/dashboard');
        }else{
            return view('login');
        }
    }

    public function login_post(Request $request){
        $user = User::where('username',$request->input('user'))->first();
        if(isset($user)){
            if (\Hash::check($request->input('password'), $user->password)) {
                session()->flush();
                session(['success' => 'Sesion iniciada exitosamente']);
                session(['user' => $user->name]);
                return redirect('/propierties');
            } else {
                session(['error' => 'Password no coincide']);
                return view('login')->with('error','Password no coincide');
            }
        }else{
            session(['error' => 'Usuario no existe']);
            return view('login')->with('error','Usuario no existe');
        }
    }

    public function home(){
        session()->flush();
        return view('welcome');
    }

    public function logout(){
            session()->flush();
            return redirect('login');
    }

    public function dashboard(){
    	//las primeras 2 lineas las debe de tener el autenticar
    	//session(['success' => 'Sesion iniciada correctamente']);
        if(session()->get('user')){
            return view('/dashboard');
        }else{
            return view('login');
        }
    }

    public function propierties(){
        if(session()->get('user')){
            return view('/propierties');
        }else{
            return view('login');
        }
    }

    public function regions(){
        if(session()->get('user')){
            return view('/regions');
        }else{
            return view('login');
        }
    }

    public function zones(){
        if(session()->get('user')){
            return view('/zones');
        }else{
            return view('login');
        }
    }

    public function banks(){
        if(session()->get('user')){
            return view('/banks');
        }else{
            return view('login');
        }
    }

    public function history(){
        if(session()->get('user')){
            return view('/history');
        }else{
            return view('login');
        }
    }

    public function roles(){
        if(session()->get('user')){
            return view('/roles');
        }else{
            return view('login');
        }
    }

    public function users(){
        if(session()->get('user')){
            return view('/users');
        }else{
            return view('login');
        }
    }
    
}
