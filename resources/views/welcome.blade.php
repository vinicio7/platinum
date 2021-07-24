<?php 
use App\Models\User;
use App\Models\Property;
use App\Models\Region;
use App\Models\Images;


use App\Models\Configuraciones;
$config = Configuraciones::first();
if($config){
    $propiedad_principal  =  $config->propiedad_principal;
    if($propiedad_principal == 0){
      $test = 1;
    }else{
      $test = 2;
      $datos_propiedad = Property::where('propiertiy_id',$propiedad_principal)->first();
    }
    $capsula = $config->capsula;
   $a = '/'.$capsula;
    $url =  asset($a);
    $texto = $config->texto;
    $titulo = $config->titulo;
}else{
    $test  = 0;
    $propiedad_principal = '';
    $capsula = '';
    $texto = '';
    $titulo = '';
}

//$asociats    = User::where('rol_id',2)->with('rol')->get();
$asociats    = User::where('status',1)->get();
$regions     = Region::all();
$propiedades = Property::orderBy('propiertiy_id','ASC')->get()->take(4);
$todas       = Property::orderBy('propiertiy_id','DESC')->get()->take(6);
$i1 = asset('pslider1.jpg');
$i2 = asset('pslider2.jpg');;
$i3 = asset('pslider3.jpg');
$i4 = asset('pslider4.jpg');;
$i5 = asset('pslider5.jpg');
$titulo_1 = $propiedades[0]->title;
$id_1     = $propiedades[0]->propiertiy_id;
if($propiedades[0]->sale_usd > 0){
   $tipo_1   = 'En venta';
   $precio_1 = number_format($propiedades[0]->sale_usd,2);
}else{
   $tipo_1   = 'En renta';
   $precio_1 = number_format($propiedades[0]->rent_usd,2);
}
$direccion_1 = $propiedades[0]->adress;
$buscar_imagen    = Images::where('propierty_id',$propiedades[0]->propiertiy_id)->first();
if($buscar_imagen){
   $imagen_1 = $buscar_imagen->path;
}

$titulo_2 = $propiedades[1]->title;
$id_2     = $propiedades[1]->propiertiy_id;
if($propiedades[1]->sale_usd > 0){
   $tipo_2   = 'En venta';
   $precio_2 = number_format($propiedades[1]->sale_usd,2);
}else{
   $tipo_2   = 'En renta';
   $precio_2 = number_format($propiedades[1]->rent_usd,2);
}
$direccion_2 = $propiedades[1]->adress;
$buscar_imagen_2    = Images::where('propierty_id',$propiedades[1]->propiertiy_id)->first();
if($buscar_imagen_2){
   $imagen_2 = $buscar_imagen_2->path;
}

$titulo_3 = $propiedades[2]->title;
$id_3     = $propiedades[2]->propiertiy_id;
if($propiedades[2]->sale_usd > 0){
   $tipo_3   = 'En venta';
   $precio_3 = number_format($propiedades[2]->sale_usd,2);
}else{
   $tipo_3   = 'En renta';
   $precio_3 = number_format($propiedades[2]->rent_usd,2);
}
$direccion_3 = $propiedades[2]->adress;
$buscar_imagen_3    = Images::where('propierty_id',$propiedades[2]->propiertiy_id)->first();
if($buscar_imagen_3){
   $imagen_3 = $buscar_imagen_3->path;
}

$titulo_4 = $propiedades[3]->title;
$id_4     = $propiedades[3]->propiertiy_id;
if($propiedades[3]->sale_usd > 0){
   $tipo_4   = 'En venta';
   $precio_4 = number_format($propiedades[3]->sale_usd,2);
}else{
   $tipo_4   = 'En renta';
   $precio_4 = number_format($propiedades[3]->rent_usd,2);
}
$direccion_4   = $propiedades[3]->adress;
$descripcion_4 = $propiedades[3]->description;
$metros_4      = $propiedades[3]->build_mts;
$dormitorios_4 = $propiedades[3]->rooms;
$parqueos_4    = $propiedades[3]->parking;
$banos_4       = $propiedades[3]->bathrooms;
$buscar_imagen_4    = Images::where('propierty_id',$propiedades[3]->propiertiy_id)->first();
if($buscar_imagen_4){
   $imagen_4 = $buscar_imagen_4->path;
}
?>
<!DOCTYPE html>
<html lang="en-US" class="scheme_original">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1">
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
      <link rel="stylesheet" href="css/social_bar.css" type="text/css" media="all">
      <style type="text/css">
         @media screen 
              and (min-device-width: 1200px) 
              and (max-device-width: 1600px) 
              and (-webkit-min-device-pixel-ratio: 1) { 
            }

            /* ----------- Retina Screens ----------- */
            @media screen 
              and (min-device-width: 1200px) 
              and (max-device-width: 1600px) 
              and (-webkit-min-device-pixel-ratio: 2)
              and (min-resolution: 192dpi) { 
            }

            @font-face {
              font-family: 'Gotham';
              src: url('fonts/Gotham-Medium.eot'); /* IE9 Compat Modes */
              src: url('fonts/Gotham-Medium.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
                 url('fonts/Gotham-Medium.woff') format('woff'), /* Modern Browsers */
                 url('fonts/Gotham-Medium.ttf')  format('truetype'), /* Safari, Android, iOS */
                 url('fonts/Gotham-Medium.svg#svgFontName') format('svg'); /* Legacy iOS */
               font-weight: 400;
               font-style: normal;
            }

      </style>
   </head>
   <body class="body_style_wide responsive_menu scheme_original top_panel_show top_panel_over sidebar_hide">
      <div class="body_wrap">
         <div class="page_wrap">
            <header class="top_panel_wrap top_panel_style_1 scheme_original" style="position: fixed;">
               <div class="header-bg">
                  <div class="top_panel_wrap_inner top_panel_inner_style_1 top_panel_position_over">
                     <div class="content_wrap clearfix container_header">
                        <div class="top_panel_logo" style="margin-right: 0px">
                           <div class="logo">
                              <a href="./"><img src="image/logo_lg_blanco.svg" class="logo_main"></a>
                           </div>
                        </div>
                        <div class="top_panel_menu container_logo_right">
                          <a href="/"><img src="/images/plecka.png" ></a>
                        </div>
                        <div class="top_panel_menu container_menu">
                           <a href="#" class="menu_main_responsive_button icon-down">MENU</a>
                           <nav class="menu_main_nav_area">
                              <ul id="menu_main" class="menu_main_nav">
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
            <section class="slider_wrap slider_fullwide slider_engine_revo slider_alias_revsliderHome1">
               <!-- REVOLUTION SLIDER -->
               <div id="rev_slider_4_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container">
                  <div id="rev_slider_4_1" class="rev_slider fullwidthabanner" data-version="5.1">
                     <ul>
                        <li data-index="rs-8" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="1000" data-thumb="images/slider1h1-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-description="">
                           <img src="{{$i1}}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                           <div class="tp-caption Estate tp-resizeme" id="slide-8-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:2000;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" data-start="1500" data-splitin="none" data-splitout="none" data-responsive_offset="on">
                              <div class="sc_property_wrap">
                                 <div class="sc_property sc_property_style_property-6" data-interval="7176" data-slides-min-width="250">
                                     
                                 </div>
                              </div>
                           </div>
                        </li>
                        <li data-index="rs-12" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="images/slider1h2-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-description="">
                           <img src="{{$i2}}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                           <div class="tp-caption Estate tp-resizeme" id="slide-12-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:2000;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" data-start="1500" data-splitin="none" data-splitout="none" data-responsive_offset="on">
                              <div class="sc_property_wrap">
                                 <div class="sc_property sc_property_style_property-6 " data-interval="7743" data-slides-min-width="250">
                                    
                                 </div>
                              </div>
                           </div>
                        </li>
                        <li data-index="rs-13" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="images/slider1h3-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-description="">
                           <img src="{{$i3}}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                           <div class="tp-caption Estate tp-resizeme" id="slide-13-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:2000;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" data-start="1500" data-splitin="none" data-splitout="none" data-responsive_offset="on">
                              <div class="sc_property_wrap">
                                 <div class="sc_property sc_property_style_property-6 " data-interval="5718" data-slides-min-width="250">
                                    
                                 </div>
                              </div>
                           </div>
                        </li>
                        <li data-index="rs-14" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="images/slider1h2-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-description="">
                           <img src="{{$i4}}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                           <div class="tp-caption Estate tp-resizeme" id="slide-12-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:2000;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" data-start="1500" data-splitin="none" data-splitout="none" data-responsive_offset="on">
                              <div class="sc_property_wrap">
                                 <div class="sc_property sc_property_style_property-6 " data-interval="7743" data-slides-min-width="250">
                                    
                                 </div>
                              </div>
                           </div>
                        </li>
                        <li data-index="rs-15" data-transition="fade" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="1500" data-thumb="images/slider1h3-100x50.jpg" data-rotate="0" data-saveperformance="off" data-title="Slide" data-description="">
                           <img src="{{$i5}}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                           <div class="tp-caption Estate tp-resizeme" id="slide-13-layer-1" data-x="center" data-hoffset="" data-y="center" data-voffset="" data-width="['auto']" data-height="['auto']" data-transform_idle="o:1;" data-transform_in="opacity:0;s:2000;e:Power2.easeInOut;" data-transform_out="opacity:0;s:300;s:300;" data-start="1500" data-splitin="none" data-splitout="none" data-responsive_offset="on">
                              <div class="sc_property_wrap">
                                 <div class="sc_property sc_property_style_property-6 " data-interval="5718" data-slides-min-width="250">
                                    
                                 </div>
                              </div>
                           </div>
                        </li>
                     </ul>
                     <div class="tp-bannertimer tp-bottom"></div>
                  </div>
               </div>
               <!-- END REVOLUTION SLIDER -->
            </section>
            <div class="ps_header" style="background-color: white ">
               <div class="content_wrap">
                  <div class="sc_section scheme_dark">
                     <div class="sc_section_inner">
                        <div class="sc_property_search">
                           <form method="get" action="propiedades_post">
                              <div class="sc_ps_type">
                                 <select name="tipo_venta">
                                    <option value="venta">En Venta</option>
                                    <option value="renta">En Renta</option>
                                    <option value="cualquiera">Cualquiera</option>
                                 </select>
                              </div>
                              <div class="sc_ps_type">
                                 <select name="tipo_inmueble">
                                    <option value="apartamento">Apartamentos</option>
                                    <option value="casa">Casa</option>
                                    <option value="condominio">Condominio</option>
                                    <option value="loft">Loft</option>
                                    <option value="cualquiera">Cualquiera</option>
                                 </select>
                              </div><br> 
                              <div class="sc_ps_type">
                                  <input type="text" name="precio_minimo" placeholder="US$ Precio minimo" value="" style="border-color: white">
                              </div>
                              <div class="sc_ps_type">
                                  <input type="text" name="precio_maximo" placeholder="US$ Precio maximo" value="" style="border-color: white">
                              </div>
                              <div class="sc_ps_submit" style="text-align: left;">
                                    <input type="submit" class="sc_button sc_button_box sc_button_style_style2 aligncenter ps" value="Buscar" style="background: #11264e;color:WHITE;margin-top:0px">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="page_content_wrap page_paddings_no">
               @if($test > 0)
                  @if($test == 1)
                  <div class="sc_section overflow_hidden bg_color_2" style="background-color: #11264e!important">
                      <center>
                        <div style="width:100%;height: auto;margin-top: 10px">
                          <h3 style="color:white;font-family: 'Gotham';font-size: 4vw; ">{{$titulo}}</h3>
                        </div>
                      </center>
                      <center>
                        <div style="width:100%">
                        <h3 style="color:white;font-family: 'Gotham';font-weight: lighter;font-size: 3vw">
                           {{$texto}}
                         </h3>
                       </div>
                      </center>
                      <center>
                        <video style="width: 80%;height: 600px"  muted controls autoplay="true" id="vid">
                            <source src="{{$url}}" type="video/mp4">
                              Su navegador no soporta la etiqueta de vídeo.  
                        </video>
                      </center>
                  </div>
                  @else
                     <div class="sc_section overflow_hidden bg_color_2" style="background-color: #11264e!important">
                        <h1 style="color:white;margin-left: 40px">{{$titulo}}</h1>
                        <center>
                           <h3 style="color:white;width: 900px">
                              {!!$texto!!}
                           </h3>
                      
                        <div class="sc_columns columns_wrap" style="color:white">
                           <div class="column-1_3 column_padding_bottom" style="color:white">
                                 <div class="sc_property_item" style="color:white">
                                    <div class="sc_property_image" style="color:white">
                                       <a href="/propierty/view/{{$datos_propiedad->propiertiy_id}}">
                                          <div class="property_price_box"><span class="property_price_box_price">${{$datos_propiedad->sale_usd}}</span></div>
                                          <?php
                                          $busqueda    = Images::where('propierty_id',$datos_propiedad->propiertiy_id)->first();
                                          if($busqueda){
                                             $imagen =  $busqueda->path;
                                          }else{
                                             $imagen = ''; 
                                          }
                                          ?>
                                          <img alt="" style="width: 400px;height: 300px;object-fit:cover; " src="{{$imagen}}">
                                          
                                       </a>
                                    </div>
                                    <div class="sc_property_info" style="color:white">
                                       @if($datos_propiedad->sale_usd > 0)
                                          <div class="sc_property_description">En Venta</div>
                                       @else
                                          <div class="sc_property_description">En Renta</div>
                                       @endif
                                       <div>
                                          <div class="sc_property_icon" style="color:white">
                                             <span class="icon-location"></span>
                                          </div>
                                          <div class="sc_property_title" style="color:white">
                                             <div class="sc_property_title_address_1" >
                                                <a href="/propierty/view/{{$datos_propiedad->propiertiy_id}}" style="text-transform: uppercase;color: white">{!!$datos_propiedad->title!!}</a>
                                             </div>
                                             @if(strlen($datos_propiedad->adress) > 0)
                                                <div class="sc_property_title_address_2" style="color:white"> {{$datos_propiedad->adress}}</div>
                                             @else
                                                <div class="sc_property_title_address_2" style="color:white">Sin direccion</div>
                                             @endif
                                          </div>
                                          <div class="cL"></div>
                                       </div>
                                    </div>
                                    <div class="sc_property_info_list" style="color:white">
                                       <span style="display:inline-block" class="icon-building113">{{$datos_propiedad->build_mts}} mts</span><span style="display:inline-block" class="icon-bed">{{$datos_propiedad->rooms}}</span><span style="display:inline-block" class="icon-bath">{{$datos_propiedad->bathrooms}}</span><span style="display:inline-block" class="icon-warehouse">{{$datos_propiedad->parking}}</span>
                                    </div>
                                 </div>
                              </div>
                        </div>
                           </center>
                     </div>
                  @endif
               @endif
               <div class="sc_section overflow_hidden bg_color_1">
                  <div class="content_wrap margin_top_large margin_bottom_medium">
                     <h4 class="sc_title margin_top_null margin_bottom_medium"><b>Propiedades</b></h4>
                     <div class="sc_property_wrap">
                        <div class="sc_property sc_property_style_property-1">
                           <div class="sc_columns columns_wrap">

                              @foreach($todas as $item)
                              <div class="column-1_3 column_padding_bottom">
                                 <div class="sc_property_item">
                                    <div class="sc_property_image">
                                       <a href="/propierty/view/{{$item->propiertiy_id}}">
                                          <div class="property_price_box"><span class="property_price_box_price">${{$item->sale_usd}}</span></div>
                                          <?php
                                          $busqueda    = Images::where('propierty_id',$item->propiertiy_id)->first();
                                          if($busqueda){
                                             $imagen =  $busqueda->path;
                                          }else{
                                             $imagen = ''; 
                                          }
                                          ?>
                                          <img alt="" style="width: 400px;height: 300px;object-fit:cover;" src="{{$imagen}}">
                                          
                                       </a>
                                    </div>
                                    <div class="sc_property_info">
                                       @if($item->sale_usd > 0)
                                          <div class="sc_property_description">En Venta</div>
                                       @else
                                          <div class="sc_property_description">En Renta</div>
                                       @endif
                                       <div>
                                          <div class="sc_property_icon">
                                             <span class="icon-location"></span>
                                          </div>
                                          <div class="sc_property_title">
                                             <div class="sc_property_title_address_1" style="height:84px">
                                              @php
                                              $texto =  strip_tags($item->title)  
                                              @endphp
                                                <a href="/propierty/view/{{$item->propiertiy_id}}" style="text-transform: uppercase;">{!!$texto!!}</a>
                                             </div>
                                             @if(strlen($item->adress) > 0)
                                                <div class="sc_property_title_address_2" style="height:40px">{{$item->adress}}</div>
                                             @else
                                                <div class="sc_property_title_address_2" style="height:40px">Sin direccion</div>
                                             @endif
                                          </div>
                                          <div class="cL"></div>
                                       </div>
                                    </div>
                                    <div class="sc_property_info_list">
                                       <span style="display:inline-block" class="icon-building113">{{$item->build_mts}} mts</span><span style="display:inline-block" class="icon-bed">{{$item->rooms}}</span><span style="display:inline-block" class="icon-bath">{{$item->bathrooms}}</span><span style="display:inline-block" class="icon-warehouse">{{$item->parking}}</span>
                                    </div>
                                 </div>
                              </div>
                              @endforeach

                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sc_section overflow_hidden bg_color_1">
                  <div class="content_wrap margin_top_large margin_bottom_medium">
                     <h4 class="sc_title margin_top_null margin_bottom_medium"><b>Agentes Inmobiliarios</b></h4>
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
                                       <img alt="" src="{{asset($item->picture)}}" style="width:280px!important;height: 405px!important;object-fit:cover;">
                                    </div>
                                    <div class="sc_team_item_info">
                                       <center>
                                          <div class="sc_team_item_position" style="text-transform: uppercase;">{{$item->rol->name}}</div>
                                          <div class="sc_socials sc_socials_type_icons sc_socials_size_small">
                                             <div class="sc_socials_item"><a href="tel:{{ $item->phone }}" class="social_icons"><span class="icon-phone"></span></a></div>
                                             <div class="sc_socials_item"><a href="https://www.facebook.com/propiedadesplatinumguatemala" target="_blank" class="social_icons"><span class="icon-facebook"></span></a></div>
                                             <div class="sc_socials_item"><a href="https://wa.me/502{{ $item->whatsapp }}" target="_blank" class=""><span class="fa fa-whatsapp" style="font-size: 1.65em;padding-top:3px;width: auto"></span></a></div>
                                             <form action="/propiedades">
                                                <button style="background-color: #11264e" hre>Propiedades</button>  
                                             </form>
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
            <footer class="contacts_wrap" style="color: white!important">
               <div class="contacts_wrap_inner" style="background-color:#11264e!important;color: white!important">
                  <div class="content_wrap">
                     <div class="columns_wrap">
                        <div class="column-1_4 show_logo_footer">
                           <div class="logo">
                              <img src="\images\cbrlogo.png">
                           </div>
                        </div>
                        <div class="column-2_4">
                           <h5>Acerca de</h5>
                           Somos una empresa de Bienes Raíces, integrada con Agentes muy profesionales, debidamente entrenados para dar asesoramiento en todo lo relacionado a la compra/venta, arrendamiento y permutas de propiedades, Contamos con bastantes opciones de propiedades en toda Guatemala, y nos especializamos en Propiedades de Alto Nivel.
                        </div>
                        <div class="column-1_4" style="color: white!important">
                           <h5 style="color: white">Siguenos</h5>
                           <div class="sc_socials sc_socials_type_icons sc_socials_size_small" style="color: white!important">
                              <div class="sc_socials_item"><a href="https://www.facebook.com/propiedadesplatinumguatemala" target="_blank" class="social_icons"><span class="icon-facebook" style="color:white!important"></span></a></div>
                              <div class="sc_socials_item"><a href="https://www.instagram.com/propiedadesplatinum/" target="_blank" class="social_icons"><span class="icon-instagramm" style="color:white!important"></span></a></div>
                              <div class="sc_socials_item"><a href="https://www.linkedin.com/in/sarah-alzugaray-1315b81a6/" target="_blank" class="social_icons"><span class="icon-linkedin" style="color:white!important"></span></a></div>
                              <div class="sc_socials_item"><a href="https://www.youtube.com/channel/UCK7CdSf2FUQKGcEJ7L9yDcA/featured" target="_blank" class="social_icons"><span class="icon-youtube-play" style="color:white!important"></span></a></div>
                           </div>
                        </div>
                        <div class="cL"></div>
                     </div>
                  </div>
               </div>
            </footer>
            
            <div class="copyright_wrap copyright_style_menu scheme_original">
               <div class="copyright_wrap_inner">
                  <div class="content_wrap">

                          <div class="copyright_text"><center>Platinum © 2021 All Rights Reserved</center></div>

                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Floating Social Media bar Starts -->
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
      <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v10.0" nonce="0ss8Crp2"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
      <script>
        // A $( document ).ready() block.
        $( document ).ready(function() {
             document.getElementById('vid').play();
        });
         
      </script>
   </body>
</html>
