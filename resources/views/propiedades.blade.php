<?php
use App\Models\Departament;
use App\Models\Municipality;
use App\Models\Zone;
use App\Models\Region;
use App\Models\Property;
use App\Models\Images;

$departamentos = Departament::all();  
$municipios    = Municipality::all();  
$zonas         = Zone::all();  
$regiones      = Departament::all();  
$propiedades   = Property::orderBy('propiertiy_id','ASC')->get()->take(16);

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
    <style type="text/css">
      .input-icono {
        background-image: url('/images/search.png');
        background-repeat: no-repeat;
        background-position: 4px center;
        background-size: 20px;
        display: flex;
        align-items: center;
        padding-left: 28px;
        border: 1px solid white;
        border-radius: 3px;
      }
      .input-icono input {
        width: 100%;
        font-size: 0.9em;
      }
      .input-icono input:focus {
        outline: none;
      }
    </style>
</head>
 <body class="page-template-blog-property body_filled body_style_wide responsive_menu scheme_original top_panel_show top_panel_above sidebar_show sidebar_right">
      <div class="body_wrap">
         <div class="page_wrap">
            <header class="top_panel_wrap top_panel_style_1 scheme_original" style="position: fixed;z-index: 100000">
               <div class="header-bg">
                  <div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_over">
                     <div class="content_wrap clearfix" style="margin-left:50px;width: auto">
                        <div class="top_panel_logo">
                           <div class="logo">
                              <a href="./"><img src="image/logo_lg_blanco.svg" class="logo_main"></a>
                           </div>
                        </div>
                        <div class="top_panel_menu">
                           <img src="/images/plecka.png" style="width:100px;margin-left: 40px;margin-right: 10px">
                        </div>
                        <div class="top_panel_menu" style="margin-top: 50px;">
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
                     </div>
                  </div>
               </div>
            </header>
            <div class="page_content_wrap">
               <div class="content_wrap" style="margin-top: 50px">
                  <div class="content">
                     <div class="sc_property sc_property_style_property-1">
                        <div class="columns_wrap ">
                          @foreach($propiedades as $item)   
                            <?php
                              $busqueda    = Images::where('propierty_id',$item->propiertiy_id)->first();
                              if($busqueda){
                                 $imagen =  $busqueda->path;
                              }else{
                                 $imagen = ''; 
                              }
                            ?>
                            <div class="column-1_2 column_padding_bottom">
                              <div class="sc_property_item">
                                 <div class="sc_property_image">
                                    <a href="/propierty/view/{{$item->propiertiy_id}}">
                                       <div class="property_price_box">
                                        @if($item->sale_usd > 0)
                                          <span class="property_price_box_price">$.{{number_format($item->sale_usd,2)}}</span>
                                        @else
                                          <span class="property_price_box_price">$.{{number_format($item->rent_usd,2)}}</span>
                                        @endif
                                       </div>
                                       <img alt="" style="width: 400px;height: 300px" src="{{$imagen}}">
                                    </a>
                                 </div>
                                 <div class="sc_property_info">
                                    @if($item->sale_usd > 0)
                                      <div class="sc_property_description">En venta</div>
                                    @else
                                      <div class="sc_property_description">En renta</div>
                                    @endif
                                    
                                    <div>
                                       <div class="sc_property_icon">
                                          <span class="icon-location"></span>
                                       </div>
                                       <div class="sc_property_title">
                                          <div class="sc_property_title_address_1">
                                             <a href="/propierty/view/{{$item->propiertiy_id}}">{{$item->title}}</a> 
                                          </div>
                                          <div class="sc_property_title_address_2">{{$item->adress}}</div>
                                       </div>
                                       <div class="cL"></div>
                                    </div>
                                 </div>
                                 <div class="sc_property_info_list">
                                    <span class="icon-building113" style="display: inline-block;">{{$item->build_mts}} mts</span>
                                    <span class="icon-bed" style="display: inline-block;">{{$item->rooms}}</span>
                                    <span class="icon-bath" style="display: inline-block;">{{$item->bathrooms}}</span>
                                    <span class="icon-warehouse" style="display: inline-block;">{{$item->parking}}</span>
                                 </div>
                              </div>
                            </div>
                           @endforeach
                        </div>
                     </div>
                     <nav id="pagination" class="pagination_wrap pagination_pages">
                        <span class="pager_current active">1</span>
                        <a href="#" class="">2</a>
                        <a href="#" class="pager_next"></a>
                        <a href="#" class="pager_last"></a>
                     </nav>
                  </div>
                  <div class="sidebar widget_area scheme_original">
                     <div class="sidebar_inner widget_area_inner">
                        <aside class="widget widget_property_search scheme_dark" style="color:white">
                           <form method="get" action="#">
                             <div class="input-icono">
                                <input type="text" name="input" value="" >
                              </div>
                              <select name="ps_status" style="border-color: white">
                                 <option value="sale">En venta</option>
                                 <option value="rent">En renta</option>
                              </select>
                              
                              <select name="ps_location" style="border-color: white">
                                <option value="0">Seleccione un departamento</option>
                                @foreach($departamentos as $item)
                                 <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                              </select>
                              <select name="ps_location"style="border-color: white">
                                <option value="0">Seleccione un municipio</option>
                                @foreach($municipios as $item)
                                 <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                              </select>
                              <select name="ps_location"style="border-color: white">
                                <option value="0">Seleccione una zona</option>
                                @foreach($zonas as $item)
                                 <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                              </select>
                              <select name="ps_location"style="border-color: white">
                                <option value="0">Seleccione una region</option>
                                @foreach($regiones as $item)
                                 <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                              </select>
                              <select name="ps_type" style="border-color: white">
                                    <option value="Cooperative">Apartamentos</option>
                                    <option value="Condominium">Casa</option>
                                    <option value="Cond-op">Condominio</option>
                                    <option value="House">Loft</option>
                                    <option value="House">Cualquiera</option>
                              </select>
                              <select name="ps_rooms" style="border-color: white">
                                 <option value="-1">Habitaciones</option>
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                 <option value="5">5 o mas</option>
                              </select>
                              <select name="ps_bathroom" style="border-color: white">
                                 <option value="-1">Baños</option>
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                 <option value="5">5 o mas</option>
                              </select>
                              <select name="ps_garages" style="border-color: white">
                                 <option value="-1">Parqueos</option>
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                 <option value="5">5 o mas</option>
                              </select>
                              <div class="ps_area ps_range_slider" style="color: white!important">
                                 Precio maximo:
                                  <input type="text" name="ps_keyword" placeholder="US$" value="" style="border-color: white">
                              </div>
                              <input type="submit" class="sc_button sc_button_box sc_button_style_style2 aligncenter ps" value="Buscar" style="background: white;color:#11264e">
                           </form>
                        </aside>
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
          <a href="" target="_blank" style="color:white!important">Búscanos en Facebook</a>
          <i class="fa fa-facebook" style="text-align: right!important;"></i>
        </div>
        <div class="fl-fl float-tw">
          <a href="" target="_blank" style="color:white!important;padding-left: 20px">Síguenos en Twitter</a>
          <i class="fa fa-twitter" style="text-align: right!important;"></i>
        </div>
        <div class="fl-fl float-gp">
          <a href="" target="_blank" style="color:white!important">Síguenos en Instagram</a>
          <i class="fa fa-instagram" style="text-align: right!important;"></i>
        </div>
        <div class="fl-fl float-ig">
          <a href="" target="_blank" style="color:white!important">Conéctate en LinkedIn</a>
          <i class="fa fa-linkedin" style="text-align: right!important;"></i>
        </div>
        <div class="fl-fl float-pn">
          <a href="" target="_blank" style="color:white!important">Suscríbete en Youtube</a>
          <i class="fa fa-youtube" style="text-align: right!important;"></i>
        </div>
      </div>

      <a href="#" class="scroll_to_top icon-up"></a>
      <script type='text/javascript' src='js/vendor/jquery.js'></script>
      <script type='text/javascript' src='js/custom/plugins.js'></script>
      <script type='text/javascript' src='js/custom/messages.js'></script>
      <script type='text/javascript' src='js/vendor/jquery-migrate.min.js'></script>
      <script type='text/javascript' src='js/vendor/modernizr.min.js'></script>
      <script type='text/javascript' src='js/vendor/ui/jquery-ui.min.js'></script>
      <script type='text/javascript' src='js/vendor/superfish.js'></script>
      <script type='text/javascript' src='js/custom/_utils.js'></script>
      <script type='text/javascript' src='js/custom/_init.js'></script>
      <script type='text/javascript' src='js/custom/_shortcodes.js'></script>
      <script type='text/javascript' src='js/vendor/magnific-popup/jquery.magnific-popup.min.js'></script>
   </body>
</html>
