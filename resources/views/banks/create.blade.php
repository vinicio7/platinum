@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/toastr.css')}}">
@endsection
@extends('layouts.admin')
<main class="main">
    <div class="container-fluid">
        <div class="breadcrumb">
             <div id="app">
                @section('content_admin')
                <h1>Crear un banco</h1>
                <ul>
                    <li>
                        <a href="">Detalle de banco</a>
                    </li>
                </ul>
            </div>
        </div>
        <banks-component></banks-component>
    </div>
</main>
@endsection
@section('page-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables.script.js')}}"></script>
    <script src="{{asset('assets/js/vendor/toastr.min.js')}}"></script>
@endsection 
