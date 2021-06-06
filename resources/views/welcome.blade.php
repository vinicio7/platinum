<?php 
use App\Models\User;
use App\Models\Property;
use App\Models\Region;
use App\Models\Images;


//$asociats    = User::where('rol_id',2)->with('rol')->get();
$asociats    = User::all();
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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" />
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
                           <form method="get" action="#">
                              <div class="sc_ps_status">
                                 <select name="ps_status">
                                    <option value="sale">En Venta</option>
                                    <option value="rent">En Renta</option>
                                    <option value="5">Cualquiera</option>
                                 </select>
                              </div>
                              <div class="sc_ps_location">
                                 <select name="ps_location">
                                    @foreach($regions as $region)
                                    <option value="{{$region->regions_id}}">{{$region->name}}</option>
                                    @endforeach
                                    <option value="0">Cualquiera</option>
                                 </select>
                              </div>
                              <div class="sc_ps_type">
                                 <select name="ps_type">
                                    <option value="Cooperative">Apartamentos</option>
                                    <option value="Condominium">Casa</option>
                                    <option value="Cond-op">Condominio</option>
                                    <option value="House">Loft</option>
                                    <option value="House">Cualquiera</option>
                                 </select>
                              </div>
                              <div class="sc_ps_bedrooms">
                                 <select name="ps_bedrooms">
                                    <option value="-1">Parqueos</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">Cualquiera</option>
                                 </select>
                              </div>
                              <div class="sc_ps_bedrooms">
                                 <select name="ps_bedrooms">
                                    <option value="-1">Habitaciones</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">Cualquiera</option>
                                 </select>
                              </div>
                              <div class="sc_ps_bathrooms">
                                 <select name="ps_bathrooms">
                                    <option value="-1">Baños</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5 o mas</option>
                                 </select>
                              </div>
                              <div class="sc_ps_area">
                                 <div class="ps_area ps_range_slider">
                                    <div class="ps_area_info">
                                       <div class="ps_area_info_title">Precio $.</div>
                                       <div class="ps_area_info_value"></div>
                                       <div class="cL"></div>
                                    </div>
                                    <div id="slider-range-area"></div>
                                    <input type="hidden" class="ps_area_min" name="ps_area_min" value="0">
                                    <input type="hidden" class="ps_area_max" name="ps_area_max" value="10000">
                                    <input type="hidden" class="ps_area_big" name="ps_area_big" value="10000">
                                 </div>
                              </div>
                              <div class="sc_ps_price">
                                 <div class="ps_price ps_range_slider">
                                    <div class="ps_price_info">
                                       <div class="ps_price_info_title">Precio Q.</div>
                                       <div class="ps_price_info_value"></div>
                                       <div class="cL"></div>
                                    </div>
                                    <div id="slider-range-price"></div>
                                    <input type="hidden" class="ps_price_min" name="ps_price_min" value="0">
                                    <input type="hidden" class="ps_price_max" name="ps_price_max" value="10000000">
                                    <input type="hidden" class="ps_price_big" name="ps_price_big" value="10000000">
                                 </div>
                              </div>
                              <div class="sc_ps_submit">
                                    <a href="/propiedades" class="sc_button sc_button_box sc_button_style_style2" style="color:white">Buscar</a>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="page_content_wrap page_paddings_no">
               <div class="sc_section">
                  <div class="content_wrap">
                     <div class="columns_wrap margin_top_xlarge margin_bottom_xmedium">
                        <div class="column-1_2">
                           <div class="bgtext1">
                           </div>
                           <h2 class="sc_title sc_title_iconed ind2 margin_top_null margin_bottom_xmedium">
                              <span class="sc_title_icon sc_title_icon_left sc_title_icon_small icon-map-pointer18 sc_left"></span>
                              <span class="sc_title_box">
                              <a href="/propierty/view/{{$id_4}}">{{$titulo_4}}</a>
                              <span class="sc_title_subtitle">{{$direccion_4}}</span>
                              </span>
                           </h2>
                           <div class="sc_section margin_bottom_xmedium section_style_1">
                              <div class="sc_section_inner">
                                 <p>{!!$descripcion_4!!}</p>
                              </div>
                           </div>
                           <div class="columns_wrap sc_columns margin_bottom_medium">
                              <div class="column-1_2 sc_column_item">
                                 <ul class="sc_list sc_list_style_iconed color_1">
                                    <li class="sc_list_item">
                                       <span class="sc_list_icon icon-stop color_2"></span>
                                       <p>Zona tranquila</p>
                                    </li>
                                    <li class="sc_list_item">
                                       <span class="sc_list_icon icon-stop color_2"></span>
                                       <p>Excelente comunidad</p>
                                    </li>
                                 </ul>
                              </div>
                              <div class="column-1_2 sc_column_item">
                                 <ul class="sc_list sc_list_style_iconed color_1">
                                    <li class="sc_list_item">
                                       <span class="sc_list_icon icon-stop color_2"></span>
                                       <p>Vistas Fabulosas</p>
                                    </li>
                                    <li class="sc_list_item">
                                       <span class="sc_list_icon icon-stop color_2"></span>
                                       <p>Reciente construccion</p>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                           <div class="sc_property_wrap">
                              <div class="sc_property sc_property_style_property-2">
                                 <div class="sc_property_item">
                                    <div class="ps_single_info">
                                       <div class="property_price_box">
                                          <span class="property_price_box_sign">$</span><span class="property_price_box_price">{{$precio_4}}</span>
                                       </div>
                                       <div class="sc_property_info_list">
                                          <span class="icon-area_2">{{$metros_4}} mts</span>
                                          <span class="icon-bed">{{$dormitorios_4}}</span>
                                          <span class="icon-bath">{{$banos_4}}</span>
                                          <span class="icon-warehouse">{{$parqueos_4}}</span>
                                       </div>
                                       <div class="cL"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="column-1_2">
                           <figure class="sc_image ">
                              <a href="/propierty/view/{{$id_4}}"><img src="{{$imagen_4}}" alt="" /></a>
                           </figure>
                        </div>
                     </div>
                  </div>
               </div>
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
                                          <div class="property_price_box"><span class="property_price_box_sign">$</span><span class="property_price_box_price">1,249,000</span></div>
                                          <?php
                                          $busqueda    = Images::where('propierty_id',$item->propiertiy_id)->first();
                                          if($busqueda){
                                             $imagen =  $busqueda->path;
                                          }else{
                                             $imagen = ''; 
                                          }
                                          ?>
                                          <img alt="" src="{{$imagen}}">
                                          
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
                                             <div class="sc_property_title_address_1">
                                                <a href="/propierty/view/{{$item->propiertiy_id}}">{{$item->title}}</a>
                                             </div>
                                             <div class="sc_property_title_address_2">{{$item->adress}}</div>
                                          </div>
                                          <div class="cL"></div>
                                       </div>
                                    </div>
                                    <div class="sc_property_info_list">
                                       <span class="icon-building113">{{$item->build_mts}} mts</span><span class="icon-bed">{{$item->rooms}}</span><span class="icon-bath">{{$item->bathrooms}}</span><span class="icon-warehouse">{{$item->parking}}</span>
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
                              <div class="column-1_4 column_padding_bottom">
                                 <div class="sc_team_item" style="background-color: white">
                                    <div class="sc_team_item_avatar">
                                       <a href="/asociate/detail/{{$item->user_id}}" class="hover_icon hover_icon_view">
                                       <img alt="" src="{{asset($item->picture)}}" style="width: 90%;padding: 12px"></a>
                                    </div>
                                    <div class="sc_team_item_info">
                                       <center>
                                          <h3 class="sc_team_item_title"><a href="/asociate/detail/{{$item->user_id}}">{{$item->name}}</a></h3>
                                          <div class="sc_team_item_position">{{$item->rol->name}}</div>
                                          <div class="sc_socials sc_socials_type_icons sc_socials_size_small">
                                             <div class="sc_socials_item"><a href="{{ $item->facebook }}" target="_blank" class="social_icons"><span class="icon-facebook"></span></a></div>
                                             <div class="sc_socials_item"><a href="{{ $item->twitter }}" target="_blank" class="social_icons"><span class="icon-twitter"></span></a></div>
                                             <div class="sc_socials_item"><a href="{{ $item->instagram }}" target="_blank" class="social_icons"><span class="icon-instagramm"></span></a></div>
                                             <div class="sc_socials_item"><a href="{{ $item->linkedin }}" target="_blank" class="social_icons"><span class="icon-linkedin"></span></a></div>
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
            <footer class="footer_wrap widget_area scheme_original">
               <div class="footer_wrap_inner widget_area_inner">
                  <div class="content_wrap">
                     <div class="columns_wrap">
                        <aside class="column-1_3 widget widget_text">
                           <h5 class="widget_title">SARAH ALZUGARAY</h5>
                           <div class="textwidget" style="color:white">
                             Guatemalteca, Empresaria y Emprendedora, Licenciada en Administración de Empresas, Socia, Fundadora y Directora de empresas, Corredora de Bienes Raíces y Asesora de Inversiones por más de 25 años.
                              <br><br>
                              <br>
                               <img src="\images\cbrlogo.png">
                              <div class="footer-widget-contacts">
                                 <span class="accent1h margin_right_tiny icon-location"></span>
                                 <br>
                                 <span class="accent1h margin_right_tiny icon-tablet"></span>
                                 <br>
                                 <span class="accent1h margin_right_tiny icon-mail"></span>
                              </div>
                           </div>
                        </aside>
                        <aside class="column-1_3 widget widget_facebook">
                           <h5 class="widget_title">Ultimas publicaciones</h5>
                           <div id="fb-root"></div>
                           <div class="fb-page" data-href="https://www.facebook.com/PropiedadesPlatinum/" data-tabs="timeline" data-width="500" data-height="300" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/PropiedadesPlatinum/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/PropiedadesPlatinum/">Propiedades Platinum / Sarah Alzugaray</a></blockquote></div>
                        </aside>

                        <aside class="column-1_3 widget widget_tiktok">
                           <h5 class="widget_title">Ultimos videos</h5>
                           <blockquote class="tiktok-embed" cite="https://www.tiktok.com/@karlapropiedadesplatinum/video/6965920374139784454" data-video-id="6965920374139784454" style="max-width: 500px;min-width: 300px;" > <section> <a target="_blank" title="@karlapropiedadesplatinum" href="https://www.tiktok.com/@karlapropiedadesplatinum">@karlapropiedadesplatinum</a> <p><a title="apartamentosguatemala" target="_blank" href="https://www.tiktok.com/tag/apartamentosguatemala">##apartamentosguatemala</a> <a title="agenteinmobiliario" target="_blank" href="https://www.tiktok.com/tag/agenteinmobiliario">##agenteinmobiliario</a> <a title="propiedadesplatinum" target="_blank" href="https://www.tiktok.com/tag/propiedadesplatinum">##propiedadesplatinum</a> <a title="guatemala🇬🇹viral" target="_blank" href="https://www.tiktok.com/tag/guatemala%F0%9F%87%AC%F0%9F%87%B9viral">##guatemala🇬🇹viral</a> <a title="foryou" target="_blank" href="https://www.tiktok.com/tag/foryou">##foryou</a> <a title="agentekarlajuarez" target="_blank" href="https://www.tiktok.com/tag/agentekarlajuarez">##agentekarlajuarez</a></p> <a target="_blank" title="♬ Run Free (feat. IVIE) - Deep Chills" href="https://www.tiktok.com/music/Run-Free-feat-IVIE-6594233508997106433">♬ Run Free (feat. IVIE) - Deep Chills</a> </section> </blockquote> <script async src="https://www.tiktok.com/embed.js"></script>
                        </aside>
                     </div>
                  </div>
               </div>
            </footer>
            <footer class="contacts_wrap">
               <div class="contacts_wrap_inner">
                  <div class="content_wrap">
                     <div class="columns_wrap">
                        <div class="column-1_4 show_logo_footer">
                           <div class="logo">
                              <a href="index.html"><img src="image/simple.png" style="width: 50%"></a>
                           </div>
                        </div>
                        <div class="column-2_4">
                           <h5>Acerca de</h5>
                           Somos una empresa de Bienes Raíces, integrada con Agentes muy profesionales, debidamente entrenados para dar asesoramiento en todo lo relacionado a la compra/venta, arrendamiento y permutas de propiedades, Contamos con bastantes opciones de propiedades en toda Guatemala, y nos especializamos en Propiedades de Alto Nivel.
                        </div>
                        <div class="column-1_4">
                           <h5>Siguenos</h5>
                           <div class="sc_socials sc_socials_type_icons sc_socials_size_small">
                              <div class="sc_socials_item"><a href="https://www.facebook.com/PropiedadesPlatinum/" target="_blank" class="social_icons"><span class="icon-facebook"></span></a></div>
                              <div class="sc_socials_item"><a href="https://twitter.com/alzugaraysarah" target="_blank" class="social_icons"><span class="icon-twitter"></span></a></div>
                              <div class="sc_socials_item"><a href="https://www.instagram.com/propiedades_platinum/" target="_blank" class="social_icons"><span class="icon-instagramm"></span></a></div>
                              <div class="sc_socials_item"><a href="https://www.linkedin.com/in/sarah-alzugaray-1315b81a6/" target="_blank" class="social_icons"><span class="icon-linkedin"></span></a></div>
                              <div class="sc_socials_item"><a href="https://www.youtube.com/channel/UCK7CdSf2FUQKGcEJ7L9yDcA/featured" target="_blank" class="social_icons"><span class="icon-youtube-play"></span></a></div>
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
   </body>
</html>
