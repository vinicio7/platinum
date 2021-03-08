
@extends('layouts.admin')

@section('content_admin')

    <main class="main">
        <div class="container-fluid">
            <div class="row">
                <!-- main title -->
                <div class="col-12">
                    <div class="main__title">
                        <h2>Historial</h2>
                        <span class="main__title-stat">5 Total</span>
                    </div>
                </div>
                <div id="app">
                    <history-component></history-component> 
                       
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection