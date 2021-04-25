<!DOCTYPE html>
<html lang="en-US" class="scheme_original">
<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico" />
    <title>Propiedades &#8211; Platinum</title>
    <link rel="stylesheet" href="../../css/fuente1.css" type="text/css" media="all">
    <link rel='stylesheet' href='../../js/vendor/booked/font-awesome.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../js/vendor/essgrid/tooltipster.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../js/vendor/essgrid/tooltipster-light.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../js/vendor/booked/styles.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../js/vendor/revslider/settings.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../css/fontello/css/fontello.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../css/custom/_animation.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../css/custom/shortcodes.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../css/custom/skin.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../css/custom/custom-style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../css/custom/colors.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../css/custom/responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../css/custom/skin.responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../js/vendor/swiper/swiper.css' type='text/css' media='all' />
    <link rel='stylesheet' href='../../css/custom/_messages.css' type='text/css' media='all' />
</head>
<body class="body_style_wide responsive_menu scheme_original top_panel_show top_panel_over sidebar_hide">
<div class="body_wrap">
    <div class="page_wrap">
        <header class="top_panel_wrap top_panel_style_1 scheme_original">
            <div class="header-bg">
                <div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_above">
                    <div class="content_wrap clearfix">
                        <div class="top_panel_logo" style="width: 300px">
                            <div class="logo">
                                <a href="./"><img src="../../image/logo_lg_blanco.svg" class="logo_main" alt="" ></a>
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
                                  <li class="menu-item"><a href="/">Inicio</a></li>
                                  <li class="menu-item"><a href="/quienes">Quienes somos</a></li>
                                  <li class="menu-item"><a href="/propiedades">Propiedades</a></li>
                                  <li class="menu-item"><a href="/contacto">Contactenos</a></li>
                                  <li class="menu-item"><a href="/login">Ingresar</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="cL"></div>
                    </div>
                </div>
            </div>
        </header>

        <div class="page_content_wrap page_paddings_no" style="margin-top:100px">
               <div class="sc_section linear_gradient">
                  <div class="content_wrap">
                     <div class="columns_wrap">
                        <div class="column-1_2">
                           <div class="sc_section margin_top_xlarge margin_bottom_xlarge">
                              <div class="sc_section_inner">
                                 <div class="bgtext1">
                                    <p>{{$data->rol->name}}</p>
                                 </div>
                                 <h3 class="sc_title ind1 margin_top_null margin_bottom_null">{{$data->name}}</h3>
                                 <p>{{$data->adress}}</p>
                                 <div class="margin_top_xmedium">
                                    <p>Lorem ipsum dolor sit amet, ne veniam alienum ius. Sit ea idque dolore similique, facete malorum corpora at vis. Ut cum omittam signiferumque, an usu delectus euripidis. Quem solum dicant vim an. Mel an vivendum imperdiet. Probo option pro, pri ne partem.</p>
                                 </div>
                                 <div class="columns_wrap sc_columns margin_top_xmedium margin_bottom_xmedium">
                                    <div class="column-1_2 sc_column_item">
                                       <ul class="sc_list sc_list_style_iconed">
                                          <li class="sc_list_item">
                                             <span class="sc_list_icon icon-message106 color_2"></span>
                                             <p>{{$data->email}}</p>
                                          </li>
                                       </ul>
                                    </div>
                                    <div class="column-1_2 sc_column_item">
                                       <ul class="sc_list sc_list_style_iconed">
                                          <li class="sc_list_item">
                                             <span class="sc_list_icon icon-mobile29 color_2"></span>
                                             <p>{{$data->phone}}</p>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="sc_team_wrap">
                                    <div class="sc_team sc_team_style_team-3">
                                       <div class="sc_team_item">
                                          <div class="sc_team_item_socials">
                                             <div class="sc_socials sc_socials_type_icons sc_socials_size_small">
                                              <div class="sc_socials_item"><a href="{{$data->whatsapp}}" target="_blank" class="social_icons"><span class="icon-phone"></span></a></div>
                                                <div class="sc_socials_item"><a href="{{$data->facebook}}" target="_blank" class="social_icons"><span class="icon-facebook"></span></a></div>
                                                <div class="sc_socials_item"><a href="{{$data->twitter}}" target="_blank" class="social_icons"><span class="icon-twitter"></span></a></div>
                                                <div class="sc_socials_item"><a href="{{$data->instagram}}" target="_blank" class="social_icons"><span class="icon-instagramm"></span></a></div>
                                                <div class="sc_socials_item"><a href="{{$data->linkedin}}" target="_blank" class="social_icons"><span class="icon-linkedin"></span></a></div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="column-1_2">
                           <div class="sc_section margin_top_xlarge margin_bottom_xlarge">
                              <div class="sc_section_inner">
                                 <figure class="sc_image"><img src="../../{{$data->picture}}" style="margin-left:120px" alt="" /></figure>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sc_section">
                  <div class="sc_content content_wrap margin_top_xlarge margin_bottom_xlarge">
                     <h4 class="sc_title margin_top_null margin_bottom_medium">Mis especialidades</h4>
                     <div class="sc_skills sc_skills_pie sc_skills_compact_off" data-type="pie" data-caption="Skills">
                        <div class="columns_wrap sc_skills_columns sc_skills_columns_4">
                           <div class="sc_skills_column column-1_4">
                              <div class="sc_skills_item sc_skills_style_1">
                                 <canvas></canvas>
                                 <div class="sc_skills_total" data-start="0" data-stop="80" data-step="1" data-steps="100" data-max="100" data-speed="17" data-duration="1360" data-color="#11264e" data-bg_color="#f0f1f5" data-border_color="#ffffff" data-cutout="88" data-easing="easeOutCirc" data-ed="%">0%</div>
                              </div>
                              <div class="sc_skills_info">
                                 <div class="sc_skills_label">Residenciales familiares</div>
                              </div>
                           </div>
                           <div class="sc_skills_column column-1_4">
                              <div class="sc_skills_item sc_skills_style_1">
                                 <canvas></canvas>
                                 <div class="sc_skills_total" data-start="0" data-stop="75" data-step="1" data-steps="100" data-max="100" data-speed="40" data-duration="3000" data-color="#11264e" data-bg_color="#f0f1f5" data-border_color="#ffffff" data-cutout="88" data-easing="easeOutCirc" data-ed="%">0%</div>
                              </div>
                              <div class="sc_skills_info">
                                 <div class="sc_skills_label">Alquileres vacacionales</div>
                              </div>
                           </div>
                           <div class="sc_skills_column column-1_4">
                              <div class="sc_skills_item sc_skills_style_1">
                                 <canvas></canvas>
                                 <div class="sc_skills_total" data-start="0" data-stop="95" data-step="1" data-steps="100" data-max="100" data-speed="20" data-duration="1900" data-color="#11264e" data-bg_color="#f0f1f5" data-border_color="#ffffff" data-cutout="88" data-easing="easeOutCirc" data-ed="%">0%</div>
                              </div>
                              <div class="sc_skills_info">
                                 <div class="sc_skills_label">Arrendamientos residencial</div>
                              </div>
                           </div>
                           <div class="sc_skills_column column-1_4">
                              <div class="sc_skills_item sc_skills_style_1">
                                 <canvas></canvas>
                                 <div class="sc_skills_total" data-start="0" data-stop="95" data-step="1" data-steps="100" data-max="100" data-speed="13" data-duration="1235" data-color="#11264e" data-bg_color="#f0f1f5" data-border_color="#ffffff" data-cutout="88" data-easing="easeOutCirc" data-ed="%">0%</div>
                              </div>
                              <div class="sc_skills_info">
                                 <div class="sc_skills_label">Nuevos departamentos</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sc_section bg_color_3">
                  <div class="sc_section scheme_dark">
                     <div class="sc_section_inner">
                        <div  class="sc_testimonials sc_testimonials_style_testimonials-1  sc_slider_swiper sc_slider_nopagination sc_slider_controls sc_slider_controls_side" data-interval="8587" data-slides-min-width="250">
                           <div class="slides swiper-wrapper">
                              <div class="swiper-slide">
                                 <div  class="sc_testimonial_item">
                                    <div class="sc_testimonial_content">
                                       <p>Gracias a su equipo por su arduo trabajo, consejo, honestidad y compromiso para permitirnos vender la casa de mi madre.</p>
                                    </div>
                                    <div class="sc_testimonial_three_dots">. . . .</div>
                                    <div class="sc_testimonial_avatar"><img alt="" src="../../images/mujer22.webp"></div>
                                    <div class="sc_testimonial_author">
                                       <a href="#" class="sc_testimonial_author_name">Irene Garcia</a>
                                       <span class="sc_testimonial_author_position">, 22 años</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="swiper-slide">
                                 <div class="sc_testimonial_item">
                                    <div class="sc_testimonial_content">
                                       <p>Muchas gracias por sus buenos deseos y por su gran acompañamiento en nuestro cambio de residencia. ¡5 estrellas!</p>
                                    </div>
                                    <div class="sc_testimonial_three_dots">. . . .</div>
                                    <div class="sc_testimonial_avatar"><img alt="" src="../../images/mujer.jpg"></div>
                                    <div class="sc_testimonial_author">
                                       <span class="sc_testimonial_author_name">Enma de Leon</span>
                                       <span class="sc_testimonial_author_position">, 40 años</span>
                                    </div>
                                 </div>
                              </div>
                              <div class="swiper-slide">
                                 <div class="sc_testimonial_item">
                                    <div class="sc_testimonial_content">
                                       <p>La variedad de casas nos dificulto elegir, sin embargo el asesor nos ayudo a tomar la mejor decision.</p>
                                    </div>
                                    <div class="sc_testimonial_three_dots">. . . .</div>
                                    <div class="sc_testimonial_avatar"><img src="../../images/steven.jpg"></div>
                                    <div class="sc_testimonial_author">
                                       <a href="#" class="sc_testimonial_author_name">Steve Garcia</a>
                                       <span class="sc_testimonial_author_position">, 31 años</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="sc_slider_controls_wrap">
                              <a class="sc_slider_prev" href="#"></a>
                              <a class="sc_slider_next" href="#"></a>
                           </div>
                           <div class="sc_slider_pagination_wrap"></div>
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
<a href="#" class="scroll_to_top icon-up"></a>
<script type='text/javascript' src='../../js/vendor/jquery.js'></script>
<script type='text/javascript' src='../../js/custom/plugins.js'></script>
<script type='text/javascript' src='../../js/custom/messages.js'></script>
<script type='text/javascript' src='../../js/vendor/jquery-migrate.min.js'></script>
<script type='text/javascript' src='../../js/vendor/essgrid/lightbox.js'></script>
<script type='text/javascript' src='../../js/vendor/essgrid/jquery.themepunch.tools.min.js'></script>
<script type='text/javascript' src='../../js/vendor/revslider/jquery.themepunch.revolution.min.js'></script>
<script type='text/javascript' src='../../js/vendor/modernizr.min.js'></script>
<script type='text/javascript' src='../../js/vendor/ui/jquery-ui.min.js'></script>
<script type="text/javascript" src="../../js/vendor/revslider/revolution.extension.slideanims.min.js"></script>
<script type="text/javascript" src="../../js/vendor/revslider/revolution.extension.layeranimation.min.js"></script>
<script type="text/javascript" src="../../js/vendor/revslider/revolution.extension.navigation.min.js"></script>
<script type='text/javascript' src='../../js/vendor/superfish.js'></script>
<script type='text/javascript' src='../../js/custom/_utils.js'></script>
<script type='text/javascript' src='../../js/custom/_init.js'></script>
<script type='text/javascript' src='../../js/custom/_shortcodes.js'></script>
<script type='text/javascript' src='../../js/vendor/parallax.js'></script>
<script type='text/javascript' src='../../js/vendor/skrollr.min.js'></script>
<script type='text/javascript' src='../../js/vendor/swiper/swiper.min.js'></script>
<script type='text/javascript' src='../../js/vendor/chart/chart.min.js'></script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v10.0" nonce="0ss8Crp2"></script>
</body>
</html>
