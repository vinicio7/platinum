 <script type='text/javascript' src='js/vendor/jquery.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="css/social_bar.css" type="text/css" media="all">
<header style="position: absolute;height: 60px;z-index: 99999;width: 100%">
              <table style="width: 100%;background-color: #15254b;border-color:#15254b;height: 60px ">
                <tbody>
                  <tr>
                    <td style="border-color: #15254b"><img src="image/logo_lg_blanco.svg"  style="height: 40px"></td>
                    <td style="border-color: #15254b"> 
                      
                         <a href="#" class="menu_main_responsive_button icon-down" style="color: white">MENU</a>
                         <nav class="menu_main_nav_area" style="vertical-align: bottom;">
                            <ul id="menu_main" class="menu_main_nav" style="color: white">
                              <li class="menu-item"><a href="/" style="color: white">INICIO</a></li>
                              <li class="menu-item"><a href="/quienes" style="color: white">QUIENES SOMOS</a></li>
                              <li class="menu-item"><a href="/propiedades" style="color: white">PROPIEDADES</a></li>
                              <li class="menu-item"><a href="/contacto" style="color: white">CONTACTENOS</a></li>
                              <li class="menu-item"><a href="/login" style="color: white">INGRESAR</a></li>
                            </ul>
                         </nav>
                    </td>
                    <td style="border-color: #15254b"><a href="/"><img src="/images/plecka.png" style="width: 60px" ></a></td>
                  </tr>
                </tbody>
              </table>
<style type="text/css">
  form {
}

/* Full-width inputs */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Extra style for the cancel button (red) */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the avatar image inside this container */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

/* Avatar image */
img.avatar {
  width: 40%;
  border-radius: 50%;
}

/* Add padding to containers */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
}

</style>
<center>
  <section class="slider_wrap" style="margin-top:60px">
    <div class="page_wrap">
        <div class="container">
                <div class="rev_slider_wrapper" style="margin-top:80px;margin-bottom: 180px">
                  <b><h2 style="color:#11264e !important;font-size: 1.2rem; text-transform: uppercase;letter-spacing: 0.15rem;">SITIO ADMINISTRATIVO</h2>
                    </b>       
                     <a href="{{ route('home') }}" class="sign__logo">
                                <img src="image/simple.png" alt="" style="width: 10em">
                            </a> 
                    <div class="" style=";border-color: white">
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
                        <form method="POST" action="{{ route('login') }}" class="left" autocomplete="new-password">
                            {{ csrf_field() }}

                            <span> {{ Session::get('error') }}</span>
                            <div class="" style="width: 20em">
                                <input type="text" class="sign__input" placeholder="Usuario" id="user" name="user" autocomplete="new-password" >
                            </div>

                            <div class="">
                                <input type="password" class="sign__input" placeholder="Contraseña" id="password" name="password" autocomplete="new-password" style="width: 20em">
                            </div>

                            
                            <button class="sign__btn" type="submit" style="background-color: #11264e;width: 20em">Iniciar sesión</button>
                            <span class="sign__text"><a href="forgot.html" style="width: 20em">Olvido su contraseña?</a></span>
                        </form>
                    </div>
                </div>
        </div>
    </div>
  </section>
</center>
@endsection
<div class="float-sm">
        <div class="fl-fl float-fb">          
          <a href="https://www.facebook.com/propiedadesplatinumguatemala" target="_blank" style="color:white!important">Búscanos en Facebook</a>
          <i class="fa fa-facebook" style="text-align: right!important;"></i>
        </div>
        <div class="fl-fl float-gp">
          <a href="https://www.instagram.com/propiedades_platinum/" target="_blank" style="color:white!important">Síguenos en Instagram</a>
          <i class="fa fa-instagram" style="text-align: right!important;"></i>
        </div>
        <div class="fl-fl float-ig">
          <a href="https://www.linkedin.com/in/sarah-alzugaray-1315b81a6/" target="_blank" style="color:white!important">Conéctate en LinkedIn</a>
          <i class="fa fa-linkedin" style="text-align: right!important;"></i>
        </div>
        <div class="fl-fl float-pn">
          <a href="https://www.youtube.com/channel/UCK7CdSf2FUQKGcEJ7L9yDcA/featured" target="_blank" style="color:white!important">Suscríbete en Youtube</a>
          <i class="fa fa-youtube" style="text-align: right!important;"></i>
        </div>
      </div>