<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link id="gull-theme" rel="stylesheet" href="{{  asset('assets/styles/css/themes/lite-roble.min.css')}}">
    <link rel="stylesheet" href="../css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../css/select2.min.css">
    <link rel="stylesheet" href="../css/ionicons.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('page-css')
    <!-- Favicons -->
    <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/toastr.css')}}">
    <title>Propiedades Platinum</title>
     
</head>
<body>

    <!-- header -->
    <header class="header">
        <div class="header__content">
            <!-- header logo -->
            <a href="{{ route('home') }}" class="header__logo">
                <img src="image/logo_lg_blanco.svg" alt="">
            </a>
            <!-- end header logo -->

            <!-- header menu btn -->
            <button class="header__btn" type="button">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <!-- end header menu btn -->
        </div>
    </header>
    <!-- end header -->

    <!-- sidebar -->
    <div class="sidebar">
        <!-- sidebar logo -->
        <a href="{{ route('home') }}" class="">
            <br>
            <img src="image/logo_lg_blanco.svg" style="width: 100%">
        </a>
        <!-- end sidebar logo -->
        
        <!-- sidebar user -->
        <div class="sidebar__user">
            <div class="sidebar__user-img">
                <img src="image/users/1.png" alt="">
            </div>

            <div class="sidebar__user-title">
                <span>User</span>
                <p>{{ Session::get('user') }}</p>
            </div>

        </div>
        <!-- end sidebar user -->

        <!-- sidebar nav -->
        <ul class="sidebar__nav">
            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'dashboard')
                    <a href="{{ route('dashboard') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-monitor"></i> Dashboard</a>
                @else
                    <a href="{{ route('dashboard') }}" class="sidebar__nav-link "><i class="icon ion-ios-monitor"></i> Dashboard</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'propierties')
                    <a href="{{ route('propierties') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-book"></i> Propiedades</a>
                @else
                    <a href="{{ route('propierties') }}" class="sidebar__nav-link"><i class="icon ion-ios-book"></i> Propiedades</a>
                @endif
            </li>
            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'pdf_list')
                    <a href="{{ route('pdf_list') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-book"></i> Lista PDF</a>
                @else
                    <a href="{{ route('pdf_list') }}" class="sidebar__nav-link"><i class="icon ion-ios-book"></i> Lista PDF</a>
                @endif
            </li>
            
            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'departaments')
                    <a href="{{ route('departaments') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-world"></i> Departamentos</a>
                @else()
                    <a href="{{ route('departaments') }}" class="sidebar__nav-link"><i class="icon ion-ios-world"></i> Departamentos</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'municipalities')
                    <a href="{{ route('municipalities') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-location"></i> Municipios</a>
                @else()
                    <a href="{{ route('municipalities') }}" class="sidebar__nav-link"><i class="icon ion-ios-location"></i> Municipios</a>
                @endif
            </li>


            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'regions')
                    <a href="{{ route('regions') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-information"></i> Regiones</a>
                @else()
                    <a href="{{ route('regions') }}" class="sidebar__nav-link"><i class="icon ion-ios-information"></i> Regiones</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'zones')
                    <a href="{{ route('zones') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-list"></i> Zonas</a>
                @else
                    <a href="{{ route('zones') }}" class="sidebar__nav-link"><i class="icon ion-ios-list"></i> Zonas</a>
                @endif
            </li>

           <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'banks')
                    <a href="{{ route('banks') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-home"></i> Bancos</a>
                @else
                    <a href="{{ route('banks') }}" class="sidebar__nav-link"><i class="icon ion-home"></i> Bancos</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'history')
                    <a href="{{ route('dashboard') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-search"></i> Historial</a>
                @else
                    <a href="{{ route('dashboard') }}" class="sidebar__nav-link"><i class="icon ion-search"></i> Historial</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                 @if(Request::route()->getName() == 'roles')
                    <a href="{{ route('rols') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-eye"></i> Roles</a>
                 @else
                    <a href="{{ route('rols') }}" class="sidebar__nav-link"><i class="icon ion-eye"></i> Roles</a>
                 @endif
            </li>

            <li class="sidebar__nav-item">
                 @if(Request::route()->getName() == 'users')
                    <a href="{{ route('users') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-person"></i> Usuarios</a>
                 @else
                    <a href="{{ route('users') }}" class="sidebar__nav-link"><i class="icon ion-person"></i> Usuarios</a>
                 @endif
            </li>
            <li class="sidebar__nav-item">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <a href="{{ route('logout') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-log-out"></i> Cerrar sesion</a>
            </li>

           
        </ul>
        <!-- end sidebar nav -->
        
        <!-- sidebar copyright -->
        <div class="sidebar__copyright">© 2021 Propiedades Platinum <br>Create by <a href="" target="_blank">MAVIS</a></div>
        <!-- end sidebar copyright -->
    </div>
    <!-- end sidebar -->

    <!-- main content -->
   
    @yield('content_admin')

   
    <!-- end main content -->

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js?vr900') }}" defer></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/vendor/jquery.smartWizard.min.js')}}"></script>
    <script src="{{asset('assets/js/vendor/toastr.min.js')}}"></script>
    <script src="{{ asset('assets/js/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="https://unpkg.com/vue-form-wizard/dist/vue-form-wizard.js"></script>
    <script>
        @if (session('success'))
            toastr.success("{{session('success')}}", "Listo", {timeOut: "1500"})
        @endif
        @if (session('error'))
            toastr.error("{{session('error')}}", "Listo", {timeOut: "1500"})
        @endif
    </script>
    @yield('page-js')
    
</body>
</html>
