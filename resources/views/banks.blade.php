
@extends('layouts.admin')

@section('content_admin')

    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Bancos</h2>
                        <span class="main__title-stat">5 Total</span>
                    </div>
                </div>
                <div id="app">
                    <banks-component></banks-component> 
                       
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection