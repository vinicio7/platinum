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
   <script type='text/javascript' src='js/vendor/jquery.js'></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body class="body_style_wide responsive_menu scheme_original top_panel_show top_panel_over sidebar_hide">
<div class="body_wrap">
    <div class="page_wrap">
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
        <div class="page_content_wrap page_paddings_no contacto" style="position: relative; ">
          <div class="sc_section">
            <div class="content_wrap" >
              <div class="columns_wrap">
              <div class="column-1_2">
                <div class="sc_section custom_box_form">
                  <div class="sc_section_inner">
                    <h4 class="sc_title margin_top_null margin_bottom_xmedium" style="font-size: 38px;font-weight: bold">Envianos tu mensaje</h4>
                    <div class="sc_form_wrap" style="margin-top: 100px">
                      <div class="sc_form" >
                         <script>
                           toastr.success("test");
                        </script>
                        <form method="POST" action="{{ route('send_message') }}" class="">
                            {{ csrf_field() }}
                          <div class="sc_form_info">
                            <div class="sc_form_item sc_form_field"><input id="sc_form_username" type="text" name="username" placeholder="Nombre"></div>
                            <div class="sc_form_item sc_form_field"><input id="sc_form_email" type="text" name="email" placeholder="Correo*"></div>
                            <div class="sc_form_item sc_form_field"><input id="sc_form_subj" type="text" name="subject" placeholder="Asunto"></div>
                          </div>
                          <div class="sc_form_item sc_form_message">
                            <textarea id="sc_form_message" name="message" placeholder="Mensaje"></textarea>
                          </div>
                          <div class="sc_form_item sc_form_button">
                            <button class="sc_button sc_button_box sc_button_style_style3">Enviar</button></div>
                          <div class="result sc_infobox"></div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="column-1_2">
                <div class="sc_section margin_top_xlarge margin_bottom_xlarge">
                  <div class="sc_section_inner">
                    <figure class="sc_image"><a href="/"><img src="image/simple.png" alt="" /></a></figure>
                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="sc_section bg_color_1">
            <div class="columns_wrap sc_columns" style="background-color: white"> <br><br><br><br>
              <div class="column-1_2 sc_column_item">
               
              </div>
              
            </div>
          </div>
        </div>
        <div class="contacts_emailer_wrap">
          <div class="content_wrap">
            <div class="sc_emailer">
              <div class="sc_emailer_content">
                <form class="sc_emailer_form">
                </form>
              </div>
              <div class="cL"></div>
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
          <a href="https://www.instagram.com/propiedadesplatinum/" target="_blank" style="color:white!important">Síguenos en Instagram</a>
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
 
<script type='text/javascript' src='js/custom/plugins.js'></script>
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
<script type='text/javascript' src='http://maps.google.com/maps/api/js?&key=AIzaSyCk4V6YC1Lj_wl6DA7UqlAYU99VU5j2Gmo'></script>
<script type='text/javascript' src='js/custom/_googlemap.js'></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v10.0" nonce="0ss8Crp2"></script>

</body>
</html>
