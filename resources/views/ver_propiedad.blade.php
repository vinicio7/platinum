<?php
use App\Models\Departament;
use App\Models\Municipality;
use App\Models\Zone;
use App\Models\Region;
use App\Models\Property;
use App\Models\Images;

$tipo_venta   = 1;
$departamento = 1;
$municipio    = 1;
$zona         = 1;
$tipo_inmueble = 1;
$precio_maximo = 0;
$precio_minimo = 0;
$busqueda    = Images::where('propierty_id',$data->propiertiy_id)->first();
$imagenes    = Images::where('propierty_id',$data->propiertiy_id)->get();
$contador1    = 1;
$contador2    = 1;
$contador3    = 1;
$total_imagenes = count($imagenes);
if($busqueda){
   $imagen =  $busqueda->path;
}else{
   $imagen = ''; 
}
$departamentos = Departament::all();  
$municipios    = Municipality::all();  
$zonas         = Zone::all();  
$regiones      = Departament::all();  
$propiedades   = Property::orderBy('propiertiy_id','ASC')->get()->take(16);
$test          = Property::where('propiertiy_id',$data->propiertiy_id)->first();
$amenidades    = Property::where('propiertiy_id',$data->propiertiy_id)->first()->toArray();

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
    <link rel="stylesheet" href="/css/fuente1.css" type="text/css" media="all">
    <link rel='stylesheet' href='/js/vendor/booked/font-awesome.min.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/js/vendor/essgrid/tooltipster.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/js/vendor/essgrid/tooltipster-light.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/js/vendor/booked/styles.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/js/vendor/revslider/settings.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/fontello/css/fontello.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/_animation.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/shortcodes.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/skin.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/custom-style.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/colors.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/skin.responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/js/vendor/swiper/swiper.css' type='text/css' media='all' />
    <link rel='stylesheet' href='/css/custom/_messages.css' type='text/css' media='all' />
    <link rel="stylesheet" href="/css/social_bar.css" type="text/css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css"/>
  
    <style type="text/css">
      owl-carousel .item {
    height: 10rem;
    background: #4DC7A0;
    padding: 1rem;
  }
  .owl-carousel .item h4 {
    color: #FFF;
    font-weight: 400;
    margin-top: 0rem;
   }
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
      table {border: none;}
      .row > .column {
  padding: 0 0px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Create four equal columns that floats next to eachother */
.column {
  float: left;
  width: 25%;
}

/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

/* Hide the slides by default */
.mySlides {
  display: none;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Caption text */
.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

img.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
    </style>
</head>
 <body class="page-template-blog-property body_filled body_style_wide responsive_menu scheme_original top_panel_show top_panel_above sidebar_show sidebar_right">
      <div class="body_wrap">
         <div class="page_wrap">
            <header class="top_panel_wrap top_panel_style_1 scheme_original" style="position: fixed;z-index: 100000;width: 100%;">
               <div class="header-bg">
                  <div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_over">
                     <div class="content_wrap clearfix" style="margin-left:50px;width: auto">
                        <div class="top_panel_logo">
                           <div class="logo">
                              <a href="./"><img src="/image/logo_lg_blanco.svg" class="logo_main"></a>
                           </div>
                        </div>
                         <div class="top_panel_menu container_logo_right">
                            <a href="/"><img src="/images/plecka.png" ></a>
                        </div>
                        <div class="top_panel_menu container_menu">
                           <a href="#" class="menu_main_responsive_button icon-down">MENU</a>
                           <nav class="menu_main_nav_area" >
                              <ul id="menu_main" class="menu_main_nav"style="margin-top: 50px">
                                <li class="menu-item"><a href="/">INICIO</a></li>
                                <li class="menu-item"><a href="/quienes">QUIENES SOMOS</a></li>
                                <li class="menu-item"><a href="/propiedades">PROPIEDADES</a></li>
                                <li class="menu-item"><a href="/contacto">CONTACTENOS</a></li>
                                <li class="menu-item"><a href="/login">INGRESAR</a></li>
                              </ul>
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
            </header>
              <div id="myModal" class="modal" style="z-index: 9999999">
                <span class="close cursor" onclick="closeModal()">&times;</span>
                <div class="modal-content">

                  <div class="owl-carousel owl-theme mt-5">
                  @foreach($imagenes as $item)

                    <div class="item">  <img src="{{$item->path}}" style="width:100%"></div>
                    @php
                    $contador1 = $contador1 + 1;  
                    @endphp
                  @endforeach
                  </div>

                  <div class="owl-carousel owl-theme mt-5">
        <div class="item"><h4>1</h4></div>
        <div class="item"><h4>2</h4></div>
        <div class="item"><h4>3</h4></div>
        <div class="item"><h4>4</h4></div>
        <div class="item"><h4>5</h4></div>
        <div class="item"><h4>6</h4></div>
        <div class="item"><h4>7</h4></div>
        <div class="item"><h4>8</h4></div>
        <div class="item"><h4>9</h4></div>
        <div class="item"><h4>10</h4></div>
        <div class="item"><h4>11</h4></div>
    </div>  

                  <!-- Next/previous controls -->
                  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                  <a class="next" onclick="plusSlides(1)">&#10095;</a>

                  <!-- Caption text -->
                  <div class="caption-container">
                    <p id="caption"></p>
                  </div>
                  <div class="owl-carousel owl-theme mt-5">
                  @foreach($imagenes as $item)

                    <div class="item">  <img src="{{$item->path}}" style="width:100%"></div>
                    @php
                    $contador1 = $contador1 + 1;  
                    @endphp
                  @endforeach
                  </div>
                </div>
              </div>
              <div class="page_content_wrap">
               <div class="content_wrap">
                  <div class="content" style="margin-top: 20px">
                      @php
                        $texto =  strip_tags($test->title)  
                      @endphp
                    <h3 class="post_title" style="text-transform: uppercase;height: 2em">{!!$texto!!}</h3>
                     <section class="post_featured">
                        <div class="post_thumb">
                           <a class="" title="{{$test->title}}">
                            @if($test->sale_usd > 0)
                              <span class="ps_single_status">Venta</span>
                            @else
                              <span class="ps_single_status">Renta</span>
                            @endif
                           
                           <img alt="" src="{{$imagen}}" style="margin-bottom: 20px"></a>
                           <div class="row">
                            <div class="owl-carousel owl-theme mt-5">
                  @foreach($imagenes as $item)

                    <div class="item">  <img src="{{$item->path}}" style="width:100%"></div>
                    @php
                    $contador1 = $contador1 + 1;  
                    @endphp
                  @endforeach
                  </div>
                          </div>

                        </div>
                     </section>
                     <section class="post_content">
                        <div class="sc_section">
                          <div class="sc_property_item">
                                    <div class="ps_single_info">
                                       <div class="property_price_box">
                                         @if($test->sale_usd > 0)
                                          <span class="property_price_box_price" style="font-size: 40px;height: 30px;padding-top: 5px">$.{{number_format($test->sale_usd,2)}}</span>
                                        @else
                                          <span class="property_price_box_price" style="font-size: 40px;height: 30px;padding-top: 5px">$.{{number_format($test->rent_usd,2)}}</span>
                                        @endif
                                          
                                       </div>
                                      <div class="sc_property_info_list" style="align-content: rigth">
                                          <span class="icon-area_2" style="display: inline-block;font-size: 20px">{{$test->land_vrs}} mts</span>
                                          <span class="icon-bed" style="display: inline-block;font-size: 20px">{{$test->rooms}}</span>
                                          <span class="icon-bath" style="display: inline-block;font-size: 20px">{{$test->bathrooms}}</span>
                                          <span class="icon-warehouse" style="display: inline-block;font-size: 20px">{{$test->parking}}</span>
                                       </div>
                                     </div></div>
                          <h4 class="sc_title" style="font-weight: bold">DESCRIPCION:</h4>
                          @php
                            $nuevo_texto =  str_replace('<p>&nbsp;</p>', '', $test->description)
                          @endphp
                          <p>{!!$nuevo_texto!!}</p>
                          <table style="border:none" border="0">
                            <tbody>
                              <tr style="border:none">
                                @if($test->build_mts > 0)
                                  <td style="font-weight: bold;text-transform: uppercase;border: none">Construccion</td>
                                  <td style="border: none">{{$test->build_mts}} mts2</td>
                                @endif
                                @if($test->front_mts)
                                  <td style="font-weight: bold;text-transform: uppercase;border: none">Frente</td>
                                  <td style="border: none">{{$test->front_mts}} mts2</td>
                                @endif
                              </tr>
                              <tr>
                                @if($test->bottom_mts > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Fondo</td>
                                <td style="border: none">{{$test->bottom_mts}} mts2</td>
                                @endif
                                @if($test->build_year > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Año de construccion</td>
                                <td style="border: none">{{$test->build_year}}</td>
                                @endif
                              </tr>
                              <tr>
                                @if($test->levels > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Niveles</td>
                                <td style="border: none">{{$test->levels}} </td>
                                @endif
                                @if($test->rooms > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Dormitorios</td>
                                <td style="border: none">{{$test->rooms}}</td>
                                @endif
                              </tr>
                              <tr>
                                @if($test->bathrooms > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Baños</td>
                                <td style="border: none">{{$test->bathrooms}} </td>
                                @endif
                                @if($test->rooms_service > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Dormitorios de servicio</td>
                                <td style="border: none">{{$test->rooms_service}}</td>
                                @endif
                              </tr>
                              <tr>
                                @if($test->bathrooms_service > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Baños de servicio</td>
                                <td style="border: none">{{$test->bathrooms_service}}</td>
                                @endif
                              </tr>
                            </tbody>
                          </table>
                        <div class="sc_section">
                          @if($test->cabin == 1 || $test->gym == 1 || $test->kids_area == 1 || $test->daycare == 1 || $test->sauna_shared == 1 || $test->floor_shared == 1 || $test->social_area == 1 
                          || $test->spa == 1 || $test->floor_shared == 1 || $test->pet_area == 1 || $test->beauty_salon == 1 || $test->plant_phone == 1 || $test->plant_phone == 1 
                          || $test->parking_visit == 1 || $test->court == 1 || $test->ribbon == 1 )
                           <h4 class="sc_title" style="font-weight: bold">Caracteristicas &amp; Amenidades</h4>
                          @endif
                           <div class="columns_wrap ">
                             <ul class="sc_list sc_list_style_iconed color_1" style="display: inline-block;">
                              @if($test->cabin == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Garita</p>
                              </li>
                              </div>
                              @endif
                              @if($test->gym == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Gimnasio</p>
                              </li>
                              </div>
                              @endif
                              @if($test->kids_area == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Area de niños</p>
                              </li>
                              </div>
                              @endif
                              @if($test->daycare == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Guadriania</p>
                              </li>
                              </div>
                              @endif
                              @if($test->sauna_shared == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Sauna</p>
                              </li>
                              </div>
                              @endif
                              @if($test->floor_shared == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Piscina</p>
                              </li>
                              </div>
                              @endif
                              @if($test->social_area == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Area social</p>
                              </li>
                              </div>
                              @endif

                              @if($test->spa == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>SPA</p>
                              </li>
                              </div>
                              @endif

                              @if($test->floor_shared == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Acceso para silla de ruedas</p>
                              </li>
                              </div>
                              @endif
                              @if($test->pet_area == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Area de mascotas</p>
                              </li>
                              </div>
                              @endif
                              @if($test->beauty_salon == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Salon de belleza</p>
                              </li>
                              </div>
                              @endif
                              @if($test->plant_phone == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Planta telefonica</p>
                              </li>
                              </div>
                              @endif

                              @if($test->parking_visit == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Parqueo de visitas</p>
                              </li>
                              </div>
                              @endif
                              @if($test->court == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Canchas deportivas</p>
                              </li>
                              </div>
                              @endif
                              @if($test->ribbon == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Razor Ribbon</p>
                              </li>
                              </div>
                              @endif
                              @if($test->bussines_center == 1)
                              <div>
                              <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                 <span class="sc_list_icon icon-check color_2"></span>
                                 <p>Bussines Center</p>
                              </li>
                              </div>
                              @endif
                             </ul>
                             @if($test->youtube)
                             <h4 class="sc_title" style="font-weight: bold">TOUR VIRTUAL:</h4>
                               @php
                               //test
                                $link_youtube = substr($test->youtube, 17, 20);  
                                $nuevo_link = "https://www.youtube.com/embed/".$link_youtube."?controls=0";
                               @endphp
                               <iframe style="width: 120vh!important;height: 50vh!important;" src="{{$nuevo_link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                             @endif
                           </div>
                     </section>
                  </div>
                  <div class="sidebar widget_area scheme_original" style="margin-top: 8.3em">
                     <div class="sidebar_inner widget_area_inner">
                        <aside class="widget widget_property_search scheme_dark" style="color:white;">
                           <form method="get" action="propiedades_post">
                             <div class="input-icono">
                                <input type="text" name="input" value="" >
                              </div>
                              <select name="tipo_venta" value="{{$tipo_venta}}" style="border-color: white">
                                 @if($tipo_venta == 'venta')
                                 <option value="venta" selected>En venta</option>
                                 @else
                                  <option value="venta">En venta</option>
                                 @endif
                                 @if($tipo_venta == 'renta')
                                 <option value="renta" selected>En renta</option>
                                 @else
                                  <option value="renta">En renta</option>
                                 @endif
                              </select>
                              
                              <select name="departamento" value="{{$departamento}}" style="border-color: white">
                                <option value="0">Seleccione un departamento</option>
                                @foreach($departamentos as $item)
                                  @if($departamento == $item->departament_id)
                                    <option value="{{$item->departament_id}}" selected>{{$item->name}}</option>
                                  @else
                                    <option value="{{$item->departament_id}}">{{$item->name}}</option>
                                  @endif
                                @endforeach
                              </select>
                             
                              <select name="zona" value="{{$zona}}" style="border-color: white">
                                <option value="0">Seleccione una zona</option>
                                @foreach($zonas as $item)
                                  @if($zona == $item->zone_id)
                                    <option value="{{$item->zone_id}}" selected>{{$item->name}}</option>
                                  @else
                                    <option value="{{$item->zone_id}}">{{$item->name}}</option>
                                  @endif
                                @endforeach
                              </select>
                               <select name="zona" value="{{$zona}}" style="border-color: white">
                                <option value="0">Seleccione una zona</option>
                                @foreach($zonas as $item)
                                  @if($zona == $item->zone_id)
                                    <option value="{{$item->zone_id}}" selected>{{$item->name}}</option>
                                  @else
                                    <option value="{{$item->zone_id}}">{{$item->name}}</option>
                                  @endif
                                @endforeach
                              </select>
                               <select name="zona" value="{{$zona}}" style="border-color: white">
                                <option value="0">Seleccione una zona</option>
                                @foreach($zonas as $item)
                                  @if($zona == $item->zone_id)
                                    <option value="{{$item->zone_id}}" selected>{{$item->name}}</option>
                                  @else
                                    <option value="{{$item->zone_id}}">{{$item->name}}</option>
                                  @endif
                                @endforeach
                              </select>
                              
                              <select name="tipo_inmueble" value="{{$tipo_inmueble}}" style="border-color: white">
                                @if($tipo_inmueble == 'apartamento')
                                  <option value="apartamento" selected>Apartamentos</option>
                                @else
                                  <option value="apartamento">Apartamentos</option>
                                @endif
                                @if($tipo_inmueble == 'casa')
                                  <option value="casa" selected>Casa</option>
                                @else
                                  <option value="casa">Casa</option>
                                @endif
                                @if($tipo_inmueble == 'condominio')
                                  <option value="condominio" selected>Condominio</option>
                                @else
                                  <option value="condominio">Condominio</option>
                                @endif
                                @if($tipo_inmueble == 'loft')
                                  <option value="loft" selected>Loft</option>
                                @else
                                  <option value="loft">Loft</option>
                                @endif
                                @if($tipo_inmueble == 'cualquiera')
                                  <option value="cualquiera" selected>Cualquiera</option>
                                @else
                                  <option value="cualquiera">Cualquiera</option>
                                @endif
                              </select>
                              
                              <div class="ps_area ps_range_slider" style="color: white!important">
                                 Precio minimo:
                                  <input type="text"id="precio_minimo" name="precio_minimo" placeholder="US$" value="{{$precio_minimo}}" style="border-color: white">
                              </div>
                              <div class="ps_area ps_range_slider" style="color: white!important">
                                 Precio maximo:
                                  <input type="text"id="precio_maximo" name="precio_maximo" placeholder="US$" value="{{$precio_maximo}}" style="border-color: white">
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
      <script type='text/javascript' src='/js/vendor/jquery.js'></script>
      <script type='text/javascript' src='/js/custom/plugins.js'></script>
      <script type='text/javascript' src='/js/custom/messages.js'></script>
      <script type='text/javascript' src='/js/vendor/jquery-migrate.min.js'></script>
      <script type='text/javascript' src='/js/vendor/modernizr.min.js'></script>
      <script type='text/javascript' src='/js/vendor/ui/jquery-ui.min.js'></script>
      <script type='text/javascript' src='/js/vendor/superfish.js'></script>
      <script type='text/javascript' src='/js/custom/_utils.js'></script>
      <script type='text/javascript' src='/js/custom/_init.js'></script>
      <script type='text/javascript' src='/js/custom/_shortcodes.js'></script>
      <script type='text/javascript' src='/js/vendor/magnific-popup/jquery.magnific-popup.min.js'></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  
      <script type="text/javascript">
         jQuery(document).ready(function($){
          $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
              0:{
                items:1
              },
              600:{
                items:3
              },
              1000:{
                items:5
              }
            }
          })
        })
      </script>
   </body>
</html>
