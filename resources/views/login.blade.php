
@extends('layouts.app')

@section('content')

<div class="sign section--bg" data-bg="img/section/section.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="sign__content">
                        <script>
                          @if(Session::has('success'))
                                toastr.success("{{ Session::get('success') }}");
                          @endif


                          @if(Session::has('info'))
                                toastr.info("{{ Session::get('info') }}");
                          @endif


                          @if(Session::has('warning'))
                                toastr.warning("{{ Session::get('warning') }}");
                          @endif


                          @if(Session::has('error'))
                                toastr.error("{{ Session::get('error') }}");
                          @endif
                        </script>
                        <form method="POST" action="{{ route('dashboard') }}" class="sign__form" autocomplete="new-password">
                            <h2 style="color:#11264e !important;font-size: 1.2rem; text-transform: uppercase; font-weight: 500;letter-spacing: 0.15rem;">Propiedades Platinum</h2>
                            {{ csrf_field() }}
                            <a href="{{ route('home') }}" class="sign__logo">
                                <img src="image/simple.png" alt="">
                            </a>

                            <div class="sign__group">
                                <input type="text" class="sign__input" placeholder="Usuario" id="user" name="user" autocomplete="new-password">
                            </div>

                            <div class="sign__group">
                                <input type="password" class="sign__input" placeholder="Contraseña" id="password" name="password" autocomplete="new-password">
                            </div>

                            
                            <button class="sign__btn" type="submit">Iniciar sesión</button>
                            <span class="sign__text"><a href="forgot.html">Olvido su contraseña?</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection