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

    public function propierties(){
        session(['user' => 'Vinicio J. Lopez']);
        if(session()->get('user')){
            return view('/propierties');
        }else{
            return view('login');
        }
    }

    public function regions(){
        session(['user' => 'Vinicio J. Lopez']);
        if(session()->get('user')){
            return view('/regions');
        }else{
            return view('login');
        }
    }

    public function zones(){
        session(['user' => 'Vinicio J. Lopez']);
        if(session()->get('user')){
            return view('/zones');
        }else{
            return view('login');
        }
    }

    public function banks(){
        session(['user' => 'Vinicio J. Lopez']);
        if(session()->get('user')){
            return view('/banks');
        }else{
            return view('login');
        }
    }

    public function history(){
        session(['user' => 'Vinicio J. Lopez']);
        if(session()->get('user')){
            return view('/history');
        }else{
            return view('login');
        }
    }

    public function roles(){
        session(['user' => 'Vinicio J. Lopez']);
        if(session()->get('user')){
            return view('/roles');
        }else{
            return view('login');
        }
    }

    public function users(){
        session(['user' => 'Vinicio J. Lopez']);
        if(session()->get('user')){
            return view('/users');
        }else{
            return view('login');
        }
    }
    
}
