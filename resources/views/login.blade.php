 <script type='text/javascript' src='js/vendor/jquery.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
@extends('layouts.app')

@section('content')
<header class="top_panel_wrap top_panel_style_1 scheme_original">
   <div class="header-bg">
      <div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_over">
         <div class="content_wrap clearfix">
            <div class="top_panel_logo" style="width: 400px">
               <div class="logo">
                  <a href="./"><img src="image/logo_lg_blanco.svg" class="logo_main" alt="" ></a>
               </div>
            </div>
            <div class="top_panel_contacts">
               <div class="top_panel_contacts_left">
                  <div class="contact_phone">Guatemala</div>
                  <div class="contact_email">info@propiedadesplatinum.com</div>
               </div>
               <div class="top_panel_contacts_right">Telefono: <strong><i>+(502)</i> 5368-9090</strong></div>
               <div class="cL"></div>
            </div>
            <div class="top_panel_menu">
               <a href="#" class="menu_main_responsive_button icon-down">Select menu item</a>
               <nav class="menu_main_nav_area">
                  <ul id="menu_main" class="menu_main_nav"> 
                    <li class="menu-item"><a href="contacts.html"></a></li>
                    <li class="menu-item"><a href="contacts.html"></a></li>
                    <li class="menu-item"><a href="contacts.html"></a></li>
                    <li class="menu-item"><a href="contacts.html"></a></li>
                    <li class="menu-item"><a href="contacts.html"></a></li>
                    <li class="menu-item"><a href="/login"></a></li>
                  </ul>
               </nav>
            </div>
            <div class="cL"></div>
         </div>
      </div>
   </div>
</header>
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
                <div class="rev_slider_wrapper" style="margin-top:60px;margin-bottom: 180px">
                  <b><h2 style="color:#11264e !important;font-size: 1.2rem; text-transform: uppercase;letter-spacing: 0.15rem;">INICIAR SESION</h2>
                    </b>       
                     <a href="{{ route('home') }}" class="sign__logo">
                                <img src="image/simple.png" alt="" style="width: 10%">
                            </a> 
                    <div class="" style="width: 400px;border-color: white">
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
                        <form method="POST" action="{{ route('login') }}" class="" autocomplete="new-password">
                            {{ csrf_field() }}

                            <span> test {{ Session::has('error') }}</span>
                            <div class="">
                                <input type="text" class="sign__input" placeholder="Usuario" id="user" name="user" autocomplete="new-password">
                            </div>

                            <div class="">
                                <input type="password" class="sign__input" placeholder="Contraseña" id="password" name="password" autocomplete="new-password">
                            </div>

                            
                            <button class="sign__btn" type="submit" style="background-color: #11264e">Iniciar sesión</button>
                            <span class="sign__text"><a href="forgot.html">Olvido su contraseña?</a></span>
                        </form>
                    </div>
                </div>
        </div>
    </div>
  </section>
</center>
@endsection