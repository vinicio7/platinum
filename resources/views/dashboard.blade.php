<?php
use App\Models\Region;
use App\Models\Rol;
use App\Models\User;
use App\Models\Bank;
use App\Models\Property;
$regiones_total = Region::count();
$total_bancos = Bank::count();
$total_usuarios = User::count();
$total_asociados = User::where('rol_id',2)->count();
$total_roles = Rol::count();
$total_propiedades = Property::count();
$total_venta = Property::where('type',1)->count();
$total_renta = Property::where('type',2)->count();
$propiedades = Property::orderBy('propiertiy_id')->get()->take(3);
$usuarios = User::orderBy('user_id')->get()->take(3);
$bancos = Bank::orderBy('bank_id')->get()->take(3);
$regiones = Region::orderBy('regions_id')->get()->take(3);
?>
@extends('layouts.admin')

@section('content_admin')
 <main class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span >Total de propiedades</span>
                        <p>{{ $total_propiedades }}</p>
                        <i class="icon ion-ios-film"></i>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span>Propiedades renta</span>
                        <p>{{ $total_renta }}</p>
                        <i class="icon ion-ios-film"></i>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span>Propiedades venta</span>
                        <p>{{ $total_venta }}</p>
                        <i class="icon ion-ios-film"></i>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span>Total de regiones</span>
                        <p>{{ $regiones_total }}</p>
                        <i class="icon ion-ios-star-half"></i>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span>Total de bancos</span>
                        <p>{{ $total_bancos }}</p>
                        <i class="icon ion-ios-star-half"></i>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span>Total de usuarios</span>
                        <p>{{ $total_usuarios }}</p>
                        <i class="icon ion-ios-star-half"></i>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span>Total de asociados</span>
                        <p>{{ $total_asociados }}</p>
                        <i class="icon ion-ios-star-half"></i>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="stats">
                        <span>Total de roles</span>
                        <p>{{ $total_roles }}</p>
                        <i class="icon ion-ios-star-half"></i>
                    </div>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="dashbox" >
                        <div class="dashbox__title">
                            <h3 style="color:white!important"><i class="icon ion-ios-trophy"></i> Ultimos usuarios</h3>
                            <div class="dashbox__wrap">
                                <a class="dashbox__refresh" href="#"><i class="icon ion-ios-refresh"></i></a>
                                <a class="dashbox__more" href="catalog.html">Ver todos</a>
                            </div>
                        </div>
                        <div class="dashbox__table-wrap">
                            <table class="main__table main__table--dash">
                                <thead>
                                    <tr style="color:#13274c!important;">
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>TELEFONO</th>
                                        <th>EMAIL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usuarios as $item)
                                        <tr>
                                        <td>
                                            <div class="main__table-text">{{$item->user_id}}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{$item->name}}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{$item->phone}}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{$item->email}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end dashbox -->

                <!-- dashbox -->
                <div class="col-12 col-xl-6">
                    <div class="dashbox">
                        <div class="dashbox__title">
                            <h3 style="color:white!important"><i class="icon ion-ios-film"></i> Ultimas Propiedades</h3>

                            <div class="dashbox__wrap">
                                <a class="dashbox__refresh" href="#"><i class="icon ion-ios-refresh"></i></a>
                                <a class="dashbox__more" href="catalog.html">Ver todos</a>
                            </div>
                        </div>

                        <div class="dashbox__table-wrap">
                            <table class="main__table main__table--dash">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TITULO</th>
                                        <th>TIPO</th>
                                        <th>DIRECCION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($propiedades as $item)
                                        <tr>
                                        <td>
                                            <div class="main__table-text">{{$item->propiertiy_id }}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{$item->title}}</div>
                                        </td>
                                        <td>
                                            @if($item->type == 1)
                                            <div class="main__table-text">Venta</div></td>
                                            @else
                                            <div class="main__table-text">Renta</div></td>
                                            @endif
                                        <td>
                                            <div class="main__table-text">{{$item->adress}}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end dashbox -->

                <!-- dashbox -->
                <div class="col-12 col-xl-6">
                    <div class="dashbox">
                        <div class="dashbox__title">
                            <h3 style="color:white!important"><i class="icon ion-ios-contacts"></i> Ultimos Bancos</h3>

                            <div class="dashbox__wrap">
                                <a class="dashbox__refresh" href="#"><i class="icon ion-ios-refresh"></i></a>
                                <a class="dashbox__more" href="users.html">Ver todos</a>
                            </div>
                        </div>

                        <div class="dashbox__table-wrap">
                            <table class="main__table main__table--dash">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>CUENTA</th>
                                        <th>ESTADO</th>
                                    </tr>
                                </thead>
                                 <tbody>
                                    @foreach($bancos as $item)
                                        <tr>
                                            <td>
                                                <div class="main__table-text">{{$item->bank_id}}</div>
                                            </td>
                                            <td>
                                                <div class="main__table-text">{{$item->name}}</div>
                                            </td>
                                            <td>
                                                <div class="main__table-text">{{$item->account}}</div>
                                            </td>
                                            <td>
                                                @if($item->status == 1)
                                                    <div class="main__table-text">Activo</div>
                                                @else
                                                    <div class="main__table-text">Inactivo</div>
                                                @endif
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end dashbox -->

                <!-- dashbox -->
                <div class="col-12 col-xl-6">
                    <div class="dashbox">
                        <div class="dashbox__title">
                            <h3 style="color:white!important"><i class="icon ion-ios-star-half"></i> Ultimas regiones</h3>
                            <div class="dashbox__wrap">
                                <a class="dashbox__refresh" href="#"><i class="icon ion-ios-refresh"></i></a>
                                <a class="dashbox__more" href="reviews.html">Ver todos</a>
                            </div>
                        </div>
                        <div class="dashbox__table-wrap">
                            <table class="main__table main__table--dash">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>ESTADO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($regiones as $item)
                                        <tr>
                                        <td>
                                            <div class="main__table-text">{{$item->regions_id}}</div>
                                        </td>
                                        <td>
                                            <div class="main__table-text">{{$item->name}}</div>
                                        </td>
                                        <td>
                                              @if($item->status == 1)
                                                    <div class="main__table-text">Activo</div>
                                                @else
                                                    <div class="main__table-text">Inactivo</div>
                                                @endif
                                                
                                        </td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- end dashbox -->
            </div>
        </div>
    </main>
@endsection