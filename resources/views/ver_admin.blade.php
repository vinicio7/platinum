<?php
use App\Models\Departament;
use App\Models\Municipality;
use App\Models\Zone;
use App\Models\Region;
use App\Models\Property;
use App\Models\Images;
use App\Models\User;
use App\Models\Rol;
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
    <link type="text/css" rel="stylesheet" href="/css/lightslider.css" />
    <link type="text/css" rel="stylesheet" href="/css/lightgallery.css" />
  
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

.container {
    width: 100%;
    height: 20vh;
    padding-bottom: 56.25%;
}
.video {
    top: 0;
    left: 0;
    width: 80vh;
    height: 32vh;
}
    </style>
</head>
 <body class="page-template-blog-property body_filled body_style_wide responsive_menu scheme_original top_panel_show top_panel_above sidebar_show sidebar_right">
      <div class="body_wrap">
         <div class="page_wrap">
            <header style="position: absolute;height: 60px;z-index: 99999;width: 100%">
              <table style="width: 100%;background-color: #15254b;border-color:#15254b;height: 60px ">
                <tbody>
                  <tr>
                    <td style="border-color: #15254b"><img src="../../../image/logo_lg_blanco.svg"  style="height: 40px"></td>
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
              <div class="page_content_wrap">
               <div class="content_wrap">
                  <div class="content" >
                      @php
                        $texto =  strip_tags($test->title)  
                      @endphp
                    <h3 class="post_title">{!!nl2br($test->title)!!}</h3>
                     <section class="post_featured">
                        <div class="post_thumb">
                          <b>Codigo: {{$test->propiertiy_id}}</b>
                           <a class="" title="{{$test->title}}">
                            @if($test->sale_usd > 0)
                              <span class="ps_single_status" style="z-index: 999999">Venta</span>
                            @else
                              <span class="ps_single_status" style="z-index: 999999">Renta</span>
                            @endif
                           </a>
                           <div class="row">
                            <div class="col">
                              <ul class="images-properties">
                                @if(count($imagenes) > 0)
                                  @foreach($imagenes as $item)
                                  <li data-thumb="{{$item->path}}"  data-src="{{$item->path}}">
                                    <img   src="{{$item->path}}" class="w-100"/>
                                  </li>
                                  @endforeach
                                @else
                                  <li data-thumb="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/1.jpg"  data-src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/1.jpg">
                                    <img   src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/1.jpg" class="w-100"/>
                                  </li>
                                  <li data-thumb="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/2.jpg"  data-src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/2.jpg">
                                    <img   src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/2.jpg" class="w-100"/>
                                  </li>
                                  <li data-thumb="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/3.jpg"  data-src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/3.jpg">
                                    <img   src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/3.jpg" class="w-100"/>
                                  </li>
                                  <li data-thumb="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/4.jpg"  data-src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/4.jpg">
                                    <img   src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/4.jpg" class="w-100"/>
                                  </li>
                                  <li data-thumb="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/5.jpg"  data-src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/5.jpg">
                                    <img   src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/5.jpg" class="w-100"/>
                                  </li>
                                  <li data-thumb="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/6.jpg"  data-src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/6.jpg">
                                    <img   src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/6.jpg" class="w-100"/>
                                  </li>
                                  <li data-thumb="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/7.jpg"  data-src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/7.jpg">
                                    <img   src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/7.jpg" class="w-100"/>
                                  </li>
                                  <li data-thumb="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/8.jpg"  data-src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/8.jpg">
                                    <img   src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/8.jpg" class="w-100"/>
                                  </li>
                                  <li data-thumb="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/9.jpg"  data-src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/9.jpg">
                                    <img   src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/9.jpg" class="w-100"/>
                                  </li>
                                  <li data-thumb="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/10.jpg"  data-src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/10.jpg">
                                    <img   src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/10.jpg" class="w-100"/>
                                  </li>
                                  <li data-thumb="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/11.jpg"  data-src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/11.jpg">
                                    <img   src="https://pruebaplatinum.mavis.com.gt/includes/propiedades/{{$test->propiertiy_id}}/11.jpg" class="w-100"/>
                                  </li>
                                @endif
                              </ul>
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
                                          <span class="icon-warehouse" style="display: inline-block;font-size: 20px">{{$test->parking + $test->parking_roof + $test->pargkin_visit}}</span>
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
                                @if($test->land_vrs > 0)
                                  <td style="font-weight: bold;text-transform: uppercase;border: none">Terreno</td>
                                  <td style="border: none">{{$test->land_vrs}} vrs2</td>
                                @endif
                                 @if($test->build_mts > 0)
                                  <td style="font-weight: bold;text-transform: uppercase;border: none">Construccion</td>
                                  <td style="border: none">{{$test->build_mts}} mts2</td>
                                @endif
                              </tr>
                              <tr style="border:none">
                                @if($test->front_mts)
                                  <td style="font-weight: bold;text-transform: uppercase;border: none">Frente</td>
                                  <td style="border: none">{{$test->front_mts}} mts2</td>
                                @endif
                                @if($test->bottom_mts > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Fondo</td>
                                <td style="border: none">{{$test->bottom_mts}} mts2</td>
                                @endif
                              </tr>
                              <tr>
                                @if($test->build_year > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Año de construccion</td>
                                <td style="border: none">{{$test->build_year}}</td>
                                @endif
                                 @if($test->levels > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Niveles</td>
                                <td style="border: none">{{$test->levels}} </td>
                                @endif
                              </tr>
                              <tr>
                                @if($test->rooms > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Dormitorios</td>
                                <td style="border: none">{{$test->rooms}}</td>
                                @endif
                                  @if($test->rooms_service > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Dormitorios de servicio</td>
                                <td style="border: none">{{$test->service_rooms}}</td>
                                @endif
                              </tr>
                              <tr>
                                @if($test->bathrooms > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Baños</td>
                                <td style="border: none">{{$test->bathrooms}} </td>
                                @endif
                              @if($test->bathrooms_service > 0)
                                <td style="font-weight: bold;text-transform: uppercase;border: none">Baños de servicio</td>
                                <td style="border: none">{{$test->bathrooms_service}}</td>
                                @endif
                              </tr>
                            </tbody>
                          </table>
                         <div class="sc_section">
                            @if($test->walkin_closet == 1 ||  $test->closet == 1 || $test->gardeen_front == 1 || $test->gardeen_bottom == 1 || $test->dining_room == 1 ||
                              $test->chimeny == 1   ||  $test->kitchen_room == 1 || $test->laundry == 1 || $test->balcony == 1 || $test->roof_room == 1 ||
                              $test->pantry == 1   ||  $test->cupboard == 1 || $test->bathroom_visit)
                             <h4 class="sc_title" style="font-weight: bold">Detalles</h4>
                            @endif
                            <div class="columns_wrap ">
                              <ul class="sc_list sc_list_style_iconed color_1" style="display: inline-block;">
                                @if($test->walkin_closet == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Walkin Closet</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->closet == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Closet</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->gardeen_front == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Jardin Frontal</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->jardin_trasero == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Jardin Trasero</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->dining_room == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Sala/Comedor</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->chimeny == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Chimenea</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->kitchen_room == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Cocina con gabinetes</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->laundry == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Lavanderia</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->balcony == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Balcon</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->roof_room == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Terraza</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->pantry == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Despensa</p>
                                    </li>
                                  </div>
                                @endif
                                 @if($test->desayunador == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Desayunador</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->cupboard == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Alacena</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->bathroom_visit == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Baño de visita</p>
                                    </li>
                                  </div>
                                @endif
                              </ul>
                            </div>
                          </div>
                          <div class="sc_section">
                            @if($test->fridge == 1 || $test->kitchen == 1 || $test->dishwater == 1 || $test->bell == 1 || $test->water_heater == 1 || $test->cistern == 1 ||
                              $test->bathroom_mirros == 1)
                             <h4 class="sc_title" style="font-weight: bold">Incluye</h4>
                            @endif
                            <div class="columns_wrap ">
                              <ul class="sc_list sc_list_style_iconed color_1" style="display: inline-block;">
                                @if($test->fridge == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Refrigeradora</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->kitchen == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Estufa</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->dishwater == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Lavavajillas</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->bell == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Campana</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->water_heater == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Calentador de agua</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->cistern == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Cisterna</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->bathroom_mirros == 1)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p>Espejos de baño</p>
                                    </li>
                                  </div>
                                @endif
                                @if($test->another_include != '' && $test->another_include != null && $test->another_include != 0)
                                  <div>
                                    <li class="sc_list_item" style="display: inline-block;text-transform: uppercase;">
                                       <span class="sc_list_icon icon-check color_2"></span>
                                       <p><b>Otros: </b> {{$test->another_include}}</p>
                                    </li>
                                  </div>
                                @endif
                              </ul>
                            </div>
                          </div>
                           @if(strlen( $test->another_details) > 1)
                              <h4 class="sc_title" style="font-weight: bold">OTROS DETALLES:</h4>
                              @php
                                $nuevo_texto =  str_replace('<p>&nbsp;</p>', '', $test->another_details)
                              @endphp
                              <p>{!!$nuevo_texto!!}</p>
                            @endif
                        <div class="sc_section">
                          @if($test->cabin == 1 || $test->gym == 1 || $test->kids_area == 1 || $test->daycare == 1 || $test->sauna_shared == 1 || $test->floor_shared == 1 || $test->social_area == 1 
                          || $test->spa == 1 || $test->floor_shared == 1 || $test->pet_area == 1 || $test->beauty_salon == 1 || $test->plant_phone == 1 || $test->plant_phone == 1 
                          || $test->parking_visit == 1 || $test->court == 1 || $test->ribbon == 1 )
                           <h4 class="sc_title" style="font-weight: bold">Amenidades</h4>
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
                          </div>

                         

                          
                          <div class="sc_section"> 
                           
                             @if($test->internal_note)
                              <h4 class="sc_title" style="font-weight: bold">NOTAS INTERNAS:</h4>
                              @php
                                $nuevo_texto =  str_replace('<p>&nbsp;</p>', '', $test->internal_note)
                              @endphp
                              <p>{!!$nuevo_texto!!}</p>
                            @endif
                             @if( strlen($test->adress) > 1)
                              <h4 class="sc_title" style="font-weight: bold">DIRECCION:</h4>
                              @php
                                $nuevo_texto =  str_replace('<p>&nbsp;</p>', '', $test->adress)
                              @endphp
                              <p>{!!$nuevo_texto!!}</p>
                            @endif
                            @php
                            $propietario = User::where('user_id',$test->owner_id)->first();
                            if($propietario){
                              $propietario_nombre    = $propietario->name;
                              $telefono_propietario  = $propietario->phone;
                              $whatsap_propietario   = $propietario->whatsapp;
                              $correo_propietario    = $propietario->email;
                              $direccion_propietario = $propietario->adress;
                            }else{
                              $propietario_nombre = 'No asignado';
                              $telefono_propietario  = '-';
                              $whatsap_propietario   = '-';
                              $correo_propietario    = '-';
                              $direccion_propietario = '-';
                            }  
                            $name = Session::get('user');
                            $user = User::where('name',$name)->first();
                            @endphp
                            @if($user->rol_id == 10)
                            @else
                              <h4 class="sc_title" style="font-weight: bold">PROPIETARIO:</h4>
                               <b>Nombre:</b> {{$propietario_nombre}}<br>
                               <b>Telefono:</b> {{$telefono_propietario}}<br>
                               <b>Whatsapp:</b> {{$whatsap_propietario}}<br>
                               <b>Correo:</b> {{$correo_propietario}}<br>
                               <b>Direccion:</b> {{$direccion_propietario}}<br>
                            @endif
                          </div>
                          <div class="columns_wrap">
                             @if($test->youtube)
                            <h4 class="sc_title" style="font-weight: bold">TOUR VIRTUAL:</h4>
                            @php
                            //test
                            $link_youtube = substr($test->youtube, 17, 20);  
                            $nuevo_link = "https://www.youtube.com/embed/".$link_youtube."?controls=0";
                            @endphp
                              <div class="container">
                                  <iframe src="{{$nuevo_link}}" 
                                  frameborder="0" allowfullscreen class="video"></iframe>
                              </div>
                            @endif
                            <br>
                            <button class="btn btn-danger" onclick="location.href='/pdf/{{$test->propiertiy_id}}'" type="submit" style="background-color: #e40a0a">Generar PDF</button>
                            <button class="btn btn-primary" onclick="location.href='/editar_propiedad/{{$test->propiertiy_id}}'" style="float: right;background-color: #11264e">Editar Propiedad</button>
                          </div>




                     </section>
                  </div>
                  <div class="sidebar widget_area scheme_original" style="margin-top: 10em">
                     <div class="sidebar_inner widget_area_inner">
                      @php
                        $agente = User::where('user_id',$test->user_id)->first();  
                        if(!$agente){
                          $agente = User::where('user_id',2)->first();  
                        }
                        $rol    = Rol::where('rol_id',$agente->rol_id)->first();  

                      @endphp

                             <div class="column_padding_bottom" style="text-align: center;height:600px;margin-top: -35px">
                                 <center><h6 class="agent d-block text-center m-0 p-2 py-3;" style="padding:12px;margin:0px;font-size: 1rem;color: #11264e;font-weight: 600;display: block;background-color: white;-webkit-box-shadow: none;box-shadow: none;text-transform: uppercase;letter-spacing: 0.15rem;pb-3, .py-3 {
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
                              </h6></center>
                                 <div class="sc_team_item" style="background-color: white;height: 625px">
                                    <div class="sc_team_item_avatar">
                                       <img alt="" src="{{asset($agente->picture)}}" style="width:280px!important;height: 405px!important;object-fit:cover;">
                                    </div>
                                    <div class="sc_team_item_info">
                                       <center>
                                          <div class="sc_socials sc_socials_type_icons sc_socials_size_small">
                                          <form action="/propiedades" style="text-align: left;margin-left: 50px;color: #11264e">
                                            <br>
                                             <center> <b style="font-size: 24px;margin-left: -50px">{{strtoupper($agente->name)}}</b></center>
                                             <center> <b style="font-size: 24px;margin-left: -50px">{{$rol->name}}</b></center>
                                          </form>
                                            <div class="sc_socials_item" style="width: auto;height: auto;width: auto"><a href="tel:{{ $agente->phone }}" class="social_icons" style="width: 50px;height: 120px"><span class="icon-phone" style="font-size: 3em;margin-top: 10px"></span></a></div>
                                            <div class="sc_socials_item"><a href="https://www.facebook.com/propiedadesplatinumguatemala" target="_blank" class="social_icons" style="width: 50px;height: 120px"><span class="icon-facebook" style="font-size: 3em;margin-top: 10px"></span></a></div>
                                            <div class="sc_socials_item"><a href="mailto:{{ $agente->email }}?subject=Informacion de propiedad Cod.{{$test->propiertiy_id}}&body=Hola quisiera tener mas información%0DSobre la propiedad con codigo {{$test->propiertiy_id}}%0D" class="social_icons" style="width: 50px;height: 120px"><span class="icon-mail" style="font-size: 3em;margin-top: 10px"></span></a></div>
                                            <div class="sc_socials_item"><a href="https://wa.me/{{ $agente->phone }}?text=Hola%20quisiera%20obtener%20mas%20información%20de%20la%20propiedad%20con%20código%20{{$test->propiertiy_id}}" target="_blank" class="social_icons" style="width: 50px;height: 120px"><span class="fa fa-whatsapp" style="padding-top:3px;width: auto;font-size: 3em;margin-top: 10px"></span></a></div> 
                                          </div>
                                       </center>
                                    </div>
                                 </div>
                              </div>

                     
                              <br><br>
                        <aside class="widget widget_property_search scheme_dark" style="color:white;margin-top: 40px">
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
      <script src="/js/lightslider.js"></script>
      <script src="/js/lightgallery.js"></script>
      <script>

    $(document).ready(function() {

      // MAP 

      (function(exports) {

        "use strict";



        function initMap() {

          exports.map = new google.maps.Map(document.getElementById("map"), {

            center: {

              lat: -34.397,

              lng: 150.644

            },

            zoom: 8

          });

        }

        exports.initMap = initMap;

      })((this.window = this.window || {}));



      // $('#imageGallery').magnificPopup({

      //  type: 'image',

      //  delegate: 'a',

      //  gallery: {

      //    enabled: true

      //  }

      // });



      // SLIDER

      $('.images-properties').lightSlider({

        adaptiveHeight: true,

        gallery: true,

        item: 1,

        loop: true,

        thumbItem: 8,

        slideMargin: 0,

        enableDrag: false,

        currentPagerPosition: 'left',

        verticalHeight: 300,

        onSliderLoad: function(el) {

          el.lightGallery({

            selector: '.images-properties .lslide'

          });

        }

      });



    });

  </script>
   </body>
</html>
