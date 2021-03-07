<?php

namespace App\Http\Controllers;

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
        session(['user' => 'Vinicio J. Lopez']);
        if(session()->get('user')){
            return view('/dashboard');
        }else{
            return view('login');
        }
    }
    
}
