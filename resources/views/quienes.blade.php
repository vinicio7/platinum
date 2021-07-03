<?php 
use App\Models\User;
use App\Models\Property;
//$asociats    = User::where('rol_id',2)->with('rol')->get();
$asociats    = User::all();
$nombre      = 'todos';
$numero      = rand(1,2);
if ($numero == 2){
$nombre = $nombre."2";
}
$imagen_random      = 'images/'.$nombre.'.jpg';
?>
<!DOCTYPE html>
<html lang="en-US" class="scheme_original">
<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
    <title>Propiedades &#8211; Platinum</title>
    <link rel="stylesheet" href="css/fuente1.css" type="text/css" media="all">
    <link rel='stylesheet' href='js/vendor/booked/font-awesome.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/essgrid/tooltipster.css' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/essgrid/tooltipster-light.css' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/booked/styles.css' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/revslider/settings.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/fontello/css/fontello.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/custom/_animation.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/custom/shortcodes.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/custom/skin.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/custom/custom-style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/custom/colors.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/custom/responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/custom/skin.responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='js/vendor/swiper/swiper.css' type='text/css' media='all' />
    <link rel='stylesheet' href='css/custom/_messages.css' type='text/css' media='all' />
    <link rel="stylesheet" href="css/social_bar.css" type="text/css" media="all">
</head>
<body class="body_style_wide responsive_menu scheme_original top_panel_show top_panel_over sidebar_hide">
<div class="body_wrap">
    <div class="page_wrap">
        <header class="top_panel_wrap top_panel_style_1 scheme_original" style="position: fixed;">
               <div class="header-bg">
                  <div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_over">
                     <div class="content_wrap clearfix" style="margin-left:50px;width: auto">
                        <div class="top_panel_logo">
                           <div class="logo">
                              <a href="./"><img src="image/logo_lg_blanco.svg" class="logo_main"></a>
                           </div>
                        </div>
                        <div class="top_panel_menu">
                           <a href="/"><img src="/images/plecka.png"  style="width:100px;margin-left: 0px;margin-right: 20px;margin-top: 15px"></a>
                        </div>
                        <div class="top_panel_menu" style="margin-top: 50px;">
                           <a href="#" class="menu_main_responsive_button icon-down">Menu</a>
                           <nav class="menu_main_nav_area">
                              <ul id="menu_main" class="menu_main_nav">
                                <li class="menu-item"><a href="/">Inicio</a></li>
                                <li class="menu-item"><a href="/quienes">Quienes somos</a></li>
                                <li class="menu-item"><a href="/propiedades">Propiedades</a></li>
                                <li class="menu-item"><a href="/contacto">Contactenos</a></li>
                                <li class="menu-item"><a href="/login">Ingresar</a></li>
                              </ul>
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
            </header>

        <div class="page_content_wrap page_paddings_top">
               <div class="sc_section">
                  <div class="content_wrap" style="margin-top: 60px">
                     <div class="columns_wrap margin_bottom_xmedium">
                        <div class="column-1_2">
                           <div class="bgtext1">
                           </div>
                           <h2 class="sc_title sc_title_iconed ind2 margin_top_null margin_bottom_xmedium margin_left_null">
                              <span class="sc_title_icon sc_title_icon_left  sc_title_icon_small icon-worker12 sc_left"></span>
                              <span class="sc_title_box">NUESTRO EQUIPO:
                           </h2>
                           <div class="sc_section margin_bottom_xmedium section_style_1">
                              <div class="sc_section_inner">
                                 <p>
Trabajamos con devoción a nuestros clientes, honramos la historia de cada propiedad, cuidamos los detalles, y nos capacitamos constantemente en todos los aspectos que se involucran en nuestra profesión, para dar acompañamiento y una asesoría profesional con responsabilidad y honestidad! <p> Somos un equipo de Asesores jóvenes con un respaldo solido de una Líder en este mercado  con experiencia de mas de 28 años en la compra/venta, arrendamiento y permutas de propiedades en Guatemala.</p>
                              </div>
                           </div>
                         
                        </div>
                        <div class="column-1_2">
                           <figure class="sc_image"><img src="{{$imagen_random}}" style="border-radius: 20px" /></figure>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sc_section overflow_hidden bg_color_1">
                  <div class="content_wrap margin_top_large margin_bottom_medium">
                     <h4 class="sc_title margin_top_null margin_bottom_medium"><b>Nuestros agentes:</b></h4>
                     <div class="sc_property_wrap">
                        <div class="sc_property sc_property_style_property-1">
                           <div class="sc_columns columns_wrap">
                              @foreach($asociats as $item)
                              
                              <div class="column-1_4 column_padding_bottom" style="">
                                 <center><h6 class="agent d-block text-center m-0 p-2 py-3" style="padding:12px;margin:0px;font-size: 1rem;color: white;font-weight: 600;display: block;background-color: #11264e;-webkit-box-shadow: none;box-shadow: none;text-transform: uppercase;letter-spacing: 0.15rem;pb-3, .py-3 {
    padding-bottom: 2rem !important;
}

.pt-3, .py-3 {
    padding-top: 2rem !important;
}.p-2 {
    padding: 2.5rem !important;
}

.m-0 {
    margin: 0 !important;
}">
                                 {{$item->name}}
                              </h6></center>
                                 <div class="sc_team_item" style="background-color: white">
                                    <div class="sc_team_item_avatar">
                                       <img alt="" src="{{asset($item->picture)}}" style="width: auto;height: auto!important">
                                    </div>
                                    <div class="sc_team_item_info">
                                       <center>
                                          <div class="sc_team_item_position" style="text-transform: uppercase;">{{$item->rol->name}}</div>
                                          <div class="sc_socials sc_socials_type_icons sc_socials_size_small">
                                             <div class="sc_socials_item"><a href="tel:{{ $item->phone }}" class="social_icons"><span class="icon-phone"></span></a></div>
                                             <div class="sc_socials_item"><a href="mailto:{{ $item->email }}" target="_blank" class="social_icons"><span class="icon-mail"></span></a></div>
                                             <div class="sc_socials_item"><a href="{{ $item->facebook }}" target="_blank" class="social_icons"><span class="icon-facebook"></span></a></div>
                                             <div class="sc_socials_item"><a href="https://wa.me/502{{ $item->whatsapp }}" target="_blank" class=""><span class="fa fa-whatsapp" style="font-size: 1.65em;padding-top:3px;width: auto"></span></a></div>
                                             <button style="background-color: #11264e">Propiedades</button>
                                          </div>
                                       </center>
                                    </div>
                                 </div>
                              </div>
                              @endforeach
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

        <div class="copyright_wrap copyright_style_menu scheme_original">
            <div class="copyright_wrap_inner">
                <div class="content_wrap">

                    <div class="copyright_text"><center>Platinum © 2021 All Rights Reserved</center></div>

                </div>
            </div>
        </div>
    </div>
</div>

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
<a href="#" class="scroll_to_top icon-up"></a>
<script type='text/javascript' src='js/vendor/jquery.js'></script>
<script type='text/javascript' src='js/custom/plugins.js'></script>
<script type='text/javascript' src='js/custom/messages.js'></script>
<script type='text/javascript' src='js/vendor/jquery-migrate.min.js'></script>
<script type='text/javascript' src='js/vendor/essgrid/lightbox.js'></script>
<script type='text/javascript' src='js/vendor/essgrid/jquery.themepunch.tools.min.js'></script>
<script type='text/javascript' src='js/vendor/revslider/jquery.themepunch.revolution.min.js'></script>
<script type='text/javascript' src='js/vendor/modernizr.min.js'></script>
<script type='text/javascript' src='js/vendor/ui/jquery-ui.min.js'></script>
<script type="text/javascript" src="js/vendor/revslider/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="js/vendor/revslider/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="js/vendor/revslider/revolution.extension.navigation.min.js"></script>
<script type='text/javascript' src='js/vendor/superfish.js'></script>
<script type='text/javascript' src='js/custom/_utils.js'></script>
<script type='text/javascript' src='js/custom/_init.js'></script>
<script type='text/javascript' src='js/custom/_shortcodes.js'></script>
<script type='text/javascript' src='js/vendor/parallax.js'></script>
<script type='text/javascript' src='js/vendor/skrollr.min.js'></script>
<script type='text/javascript' src='js/vendor/swiper/swiper.min.js'></script>
<script type='text/javascript' src='js/vendor/chart/chart.min.js'></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v10.0" nonce="0ss8Crp2"></script>
</body>
</html>
