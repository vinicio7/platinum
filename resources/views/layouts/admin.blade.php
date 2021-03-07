<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="../css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../css/magnific-popup.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../css/select2.min.css">
    <link rel="stylesheet" href="../css/ionicons.min.css">
    <link rel="stylesheet" href="../css/admin.css">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Favicons -->
    <link rel="shortcut icon" href="image/favicon.ico" type="image/x-icon">
    
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Vinicio Lopez">
    <title>Propiedades Platinum</title>
    <style type="text/css">
        .main{
             background-color: #2b2c30;
        }
        .btn-success{
             background-color: #77a62e;
             border-color: #77a62e;
        }
        td{
            color:white;
        }
        th{
            color:white;
        }
        
    </style>
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
                @if(Request::route()->getName() == 'home')
                    <a href="{{ route('home') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-keypad"></i> Dashboard</a>
                @else
                    <a href="{{ route('home') }}" class="sidebar__nav-link "><i class="icon ion-ios-keypad"></i> Dashboard</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'home')
                    <a href="{{ route('home') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-star-half"></i> Cines</a>
                @else
                    <a href="{{ route('home') }}" class="sidebar__nav-link"><i class="icon ion-ios-star-half"></i> Cines</a>
                @endif
            </li>
            
            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'home')
                    <a href="{{ route('home') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-copy"></i> Salas</a>
                @else()
                    <a href="{{ route('home') }}" class="sidebar__nav-link"><i class="icon ion-ios-copy"></i> Salas</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'home')
                    <a href="{{ route('home') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-star-half"></i> Asientos</a>
                @else
                    <a href="{{ route('home') }}" class="sidebar__nav-link"><i class="icon ion-ios-star-half"></i> Asientos</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'home')
                    <a href="{{ route('logout') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-film"></i> Peliculas</a>
                @else
                    <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-film"></i> Peliculas</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                 @if(Request::route()->getName() == 'bilboard')
                    <a href="{{ route('logout') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-star-half"></i> Cartelera</a>
                 @else
                    <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-star-half"></i> Cartelera</a>
                 @endif
            </li>

            <li class="sidebar__nav-item">
                 @if(Request::route()->getName() == 'home')
                    <a href="{{ route('home') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-star-half"></i> Usuarios</a>
                 @else
                    <a href="{{ route('home') }}" class="sidebar__nav-link"><i class="icon ion-ios-star-half"></i> Usuarios</a>
                 @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'home')
                    <a href="{{ route('logout') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-star-half"></i> Departamentos</a>
                @else
                    <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-star-half"></i> Departamentos</a>
                @endif
            </li>

            <li class="sidebar__nav-item">
                @if(Request::route()->getName() == 'home')
                    <a href="{{ route('logout') }}" class="sidebar__nav-link sidebar__nav-link--active"><i class="icon ion-ios-star-half"></i> Municipios</a>
                @else
                    <a href="{{ route('logout') }}" class="sidebar__nav-link"><i class="icon ion-ios-star-half"></i> Municipios</a>
                @endif
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
</body>
</html>