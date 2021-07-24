<?php
use App\Models\Configuraciones;
use App\Models\Property;

$propiedades = Property::all();
$config = Configuraciones::first();
if($config){
    $propiedad_principal  =  $config->propiedad_principal;
    $capsula = $config->capsula;
    $texto = $config->texto;
    $titulo = $config->titulo;
}else{
    $propiedad_principal  = 0;
    $capsula = 0;
    $texto = '';
    $titulo = '';
}

?>
@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection
@extends('layouts.admin')
<main class="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="main__title">
                    <h2 style="color: #12264d">Capsulas</h2>
                </div>
            </div>
            <form method="post" action="capsulas" enctype="multipart/form-data">
                @csrf
                <div class="row ">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-header bg-transparent">
                                <h1>Cambiar configuracion</h1>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3" style="margin-top: 5px;display: inline-block;">
                                        <b>Capsula:</b> <input name="capsula" type="file" value="{{$capsula}}" />
                                    </div>                              
                                </div>
                            </div>
                                <div class="row" style="margin-left: 8px;margin-bottom: 20px">
                                    <div class="col-md-10" style="margin-top: 5px;display: inline-block;">
                                       <b> Propiedad:</b> 
                                       <select class="form-control"  name="propiedad_principal">
                                        <option value="-1">Seleccione una opcion</option>
                                        @foreach($propiedades as $item)
                                           <option value="{{$item->propiertiy_id}}">{{$item->title}}</option>
                                        @endforeach
                                       </select>
                                    </div> 
                                </div>
                                
                                 <div class="row">
                                    <div class="col-md-10" style="margin-top: 20px;display: inline-block;margin-left: 20px">
                                        <b>Titulo:</b> <input name="titulo" type="text" value="{{$titulo}}" class="form-control" />
                                    </div>                              
                                </div>
                                 <div class="row">
                                    <div class="col-md-10" style="margin-top: 0px;display: inline-block;margin-left: 20px">
                                        <b>Texto:</b> <textarea name="texto" type="text" class="form-control" />{{$texto}}</textarea> 
                                    </div>                              
                                </div>
                            <div class="row" style="margin-top: 30px">
                                <div class="col-md-2" style="display: inline-block;margin-left: 20px">
                                       <input class="btn btn-success" type="submit" name="" value="Cambiar">
                                </div>
                            </div>
                            <div class="row">
                                <br>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</main>