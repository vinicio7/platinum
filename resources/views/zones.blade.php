@section('page-css')
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/datatables.min.css')}}">
@endsection
@extends('layouts.admin')
<main class="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="main__title">
                    <h2 style="color: #12264d">Zonas</h2>
                </div>
            </div>
            
            <div id="app">
                <zones-component></zones-component>
                @section('content_admin')
                    {{--  <div class="separator-breadcrumb border-top"></div>
                    <div class="separator-breadcrumb border-top"></div>--}}
                    {{-- <div class="row mb-4">
                    <div class="col-md-12">
                    </div>
                    </div>--}}
                    <div class="row ">
                            <div class="col-md-12 mb-4">
                                <div class="card text-left">
                                    <div class="card-header bg-transparent">
                                        <!--<a href="{{route('banks.create')}}"  class="btn btn-success btn-icon m-1">
                                            <span class="ul-btn__icon text-white"><i class="i-Add"></i></span>
                                            <span class="ul-btn__text text-white">Crear Solicitud</span>
                                        </a>-->
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">Registros</h4>
                                        <p>Se muestran todos los registros almacenados en la base de datos</p>
                                        <div class="table-responsive">
                                            <table id="records-table" class="display table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                <tr>
                                                    @foreach($dt_columns as $col)
                                                        <th>{{strtoupper($col['data'])}}</th>
                                                    @endforeach
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('page-js')
    <script src="{{asset('assets/js/vendor/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatables.script.js')}}"></script>
    <script>
        $(function() {
            $('#records-table').DataTable({
                language: { url: "./lang/datatables-spanish.json" },
                processing: true,
                destroy: true,
                serverSide: true,
                ajax: '{!! $dt_route !!}',
                columns: {!! json_encode($dt_columns,true)!!},
                order: {!! json_encode($dt_order, true) !!}
            });
        });
    </script>
@endsection 