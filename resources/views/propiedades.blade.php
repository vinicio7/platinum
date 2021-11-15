<?php
use App\Models\Departament;
use App\Models\Municipality;
use App\Models\Zone;
use App\Models\Region;
use App\Models\Property;
use App\Models\Images;
use App\Models\User;
use App\Models\Rol;
$agente        = Session::get('agente');
$departamentos = Departament::all();
$municipios    = Municipality::all();
$zonas         = Zone::all();
$regiones      = Departament::all();

if(isset($precio_minimo)){
  $precio_minimo = $precio_minimo;
}else{
  $precio_minimo = '';
}

if(isset($agente_nuevo)){
  $agente_nuevo = $agente_nuevo;
}else{
  $agente_nuevo = 0;
}

if(isset($precio_maximo)){
  $precio_maximo = $precio_maximo;
}else{
  $precio_maximo = '';
}

if(isset($tipo_inmueble)){
  $tipo_inmueble = $tipo_inmueble;
}else{
  $tipo_inmueble = '';
}

if(isset($zona)){
  $zona = $zona;
}else{
  $zona = '';
}

if(isset($zona2)){
  $zona2 = $zona2;
}else{
  $zona2 = '';
}

if(isset($zona3)){
  $zona3 = $zona3;
}else{
  $zona3 = '';
}

if(isset($departamento)){
  $departamento = $departamento;
}else{
  $departamento = '';
}

if(isset($municipio)){
  $municipio = $municipio;
}else{
  $municipio = '';
}

if(isset($input)){
  $input = $input;
}else{
  $input = '';
}

if(isset($tipo_venta)){
  $tipo_venta = $tipo_venta;
}else{
  $tipo_venta = '';
}


if($tipo_inmueble == 'apartamento'){
  $inmueble = 2;
}else if($tipo_inmueble == 'casa'){
  $inmueble = 1;
}
else if($tipo_inmueble == 'oficina'){
  $inmueble = 3;
}
else if($tipo_inmueble == 'bodega'){
  $inmueble = 4;
}
else if($tipo_inmueble == 'terreno'){
  $inmueble = 5;
}else if($tipo_inmueble == 'finca'){
  $inmueble = 6;
}else if($tipo_inmueble == 'clinica'){
  $inmueble = 7;
}else if($tipo_inmueble == 'playa'){
  $inmueble = 8;
}else if($tipo_inmueble == 'granja'){
  $inmueble = 9;
}else if($tipo_inmueble == 'edificio'){
  $inmueble = 10;
}else if($tipo_inmueble == 'local'){
  $inmueble = 11;
}

$propiedades   = Property::where('status',1);
$propiedades->where('zone_id',[$zona,$zona2,$zona3]);


if($agente_nuevo > 0){
  $propiedades->where('user_id',$agente_nuevo);
}

if ($departamento > 0){
  $propiedades->where('departament_id',$departamento);
}
if ($municipio > 0){
  $propiedades->where('municipality_id',$municipio);
}

if (isset($inmueble)){
  $propiedades->where('type',$inmueble);
}
$propiedades = $propiedades->where('status',1);
if (isset($tipo_venta)){

  if($tipo_venta == 'venta'){
    
    if($precio_minimo > 1){
      $precio_minimo = $precio_minimo;
    }else{
      $precio_minimo = 1;
    }
    
    if($precio_maximo > 1){
      $precio_maximo = $precio_maximo;
    }else{
      $precio_maximo = 999999999999;
    }
    
    $propiedades->whereBetween('sale_usd',[$precio_minimo,$precio_maximo]);
  }else{
    
    if($precio_minimo > 1){
      $precio_minimo = $precio_minimo;
    }else{
      $precio_minimo = 1;
    }
    if($precio_maximo > 1){
      $precio_maximo = $precio_maximo;
    }else{
      $precio_maximo = 999999999999;
    }
    $propiedades->whereBetween('rent_usd',[$precio_minimo,$precio_maximo]);
  }

}
if (strlen($input) > 0){
  $propiedades->orWhere(function($query)use($input) {
                $query->where('title', 'like', '%' .$input. '%')
                      ->where('status', 1);
            });
  $propiedades->orWhere(function($query)use($input) {
                $query->where('propiertiy_id', 'like', '%' .$input. '%')
                      ->where('status', 1);
            });
}
$propiedades   = $propiedades->orderBy('propiertiy_id','DESC')->paginate(10);
$ruta_completa = Request::fullUrl();
$parametro     = env("RAIZ","http://127.0.0.1:8000/");
$cortar        = explode($parametro, $ruta_completa);
$propiedades->withPath($cortar[1]);


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
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> --}}

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
      p{
        margin-bottom: 0px!important
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
            <div class="page_content_wrap page_paddings_top" style="position: relative; ">
               <div class="content_wrap" >
                  <div class="content">
                     <div class="sc_property sc_property_style_property-1">
                        <div class="columns_wrap ">
                          @foreach($propiedades as $item)
                            <?php
                              $busqueda    = Images::where('propierty_id',$item->propiertiy_id)->first();
                              if($busqueda){
                                 $imagen =  $busqueda->path;
                              }else{
                                 $imagen = 'https://pruebaplatinum.mavis.com.gt/includes/propiedades/'.$item->propiertiy_id.'/1.jpg';
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
                                       <img alt="" style="width: 30em;height: 20em;object-fit: cover;" src="{{$imagen}}">
                                    </a>
                                 </div>
                                 <div class="sc_property_info">
                                    @if($item->sale_usd > 0)
                                      <div class="sc_property_description">En venta - Cod. {{$item->propiertiy_id}}</div>
                                    @else
                                      <div class="sc_property_description">En renta - Cod. {{$item->propiertiy_id}}</div>
                                    @endif

                                    <div>
                                       <div class="sc_property_icon">
                                          <span class="icon-location"></span>
                                       </div>
                                       <div class="sc_property_title">
                                          @php
                                              $texto  =  nl2br($item->title);
                                              $limpio = str_replace('</p><br />', '', $texto);
                                              $limpio2 = str_replace('<p>', '', $limpio);
                                          @endphp
                                          <div class="sc_property_title_address_1">
                                            <a href="/propierty/view/{{$item->propiertiy_id}}">
                                             <span style="font-size: 13px;">{!!$limpio!!}</span>
                                            </a>
                                          </div>

                                       </div>
                                       <div class="cL"></div>
                                    </div>
                                 </div>
                                 <div class="sc_property_info_list">
                                    <span class="icon-building113" style="display: inline-block;">{{$item->land_vrs}} mts</span>
                                    <span class="icon-bed" style="display: inline-block;">{{$item->rooms}}</span>
                                    <span class="icon-bath" style="display: inline-block;">{{$item->bathrooms}}</span>
                                    <span class="icon-warehouse" style="display: inline-block;">{{$item->parking}}</span>
                                 </div>
                              </div>
                            </div>
                           @endforeach
                        </div>
                     </div>
                     {{-- {{ $propiedades->links("vendor.pagination.default") }} --}}
                     {!! $propiedades->links("vendor.pagination.bootstrap-4") !!}
                  </div>
                  <div class="sidebar widget_area scheme_original">
                     <div class="sidebar_inner widget_area_inner">

                      @if($agente_nuevo > 0)

                      
                      @php
                        $agente = User::where('user_id',$agente_nuevo)->first(); 
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
                                            <div class="sc_socials_item" style="width: auto;height: auto;width: auto"><a href="tel:{{ $agente->phone }}" class="social_icons" style="width: 50px;height: 120px"><span class="icon-phone zoom-in-zoom-out" style="font-size: 2em;margin-top: 10px;margin-left: 2px"></span></a></div>
                                            <div class="sc_socials_item"><a href="https://www.facebook.com/propiedadesplatinumguatemala" target="_blank" class="social_icons" style="width: 50px;height: 120px"><span class="icon-facebook zoom-in-zoom-out" style="font-size: 2em;margin-top: 10px;margin-left: 2px"></span></a></div>
                                            <div class="sc_socials_item"><a href="mailto:{{ $agente->email }}?subject=Informacion de propiedad&body=Hola quisiera tener mas información%0DSobre la propiedad con codigo%0D" class="social_icons" style="width: 50px;height: 120px"><span class="icon-mail zoom-in-zoom-out" style="font-size: 2em;margin-top: 10px;margin-left: 2px"></span></a></div>
                                            <div class="sc_socials_item"><a href="https://wa.me/{{ $agente->phone }}?text=Hola%20quisiera%20obtener%20mas%20información%20de%20la%20propiedad%20con%20código%20" target="_blank" class="social_icons" style="width: 50px;height: 120px"><span class="fa fa-whatsapp zoom-in-zoom-out" style="padding-top:3px;width: auto;font-size: 2em;margin-top: 10px;margin-left: 2px"></span></a></div> 
                                            @php
                                              $phone = substr($agente->phone,0,4);
                                              $phone2 = substr($agente->phone,4,7);  
                                            @endphp
                                            <span style="margin-top: -4em;color:#11264e;font-weight: bold;font-size: 18px">Cel: {{$phone}} - {{$phone2}}</span><br><br><br>
                                            <span style="margin-top: -4em;color:#11264e;font-weight: bold;font-size: 16px">Email: {{$agente->email}}</span>
                                          </div>
                                       </center>
                                    </div>
                                 </div>
                              </div>
                              <br><br><br>
                        @endif
                        <aside class="widget widget_property_search scheme_dark" style="color:white">
                           <form method="get" action="propiedades_post">
                             <div class="input-icono">
                                <input type="text" name="input" value="{{$input}}" >
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
                                <option value="0">Seleccione una ubicacion</option>
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
                              <select name="zona2" value="{{$zona2}}" style="border-color: white">
                                <option value="0">Seleccione una zona</option>
                                @foreach($zonas as $item)
                                  @if($zona2 == $item->zone_id)
                                    <option value="{{$item->zone_id}}" selected>{{$item->name}}</option>
                                  @else
                                    <option value="{{$item->zone_id}}">{{$item->name}}</option>
                                  @endif
                                @endforeach
                              </select>
                              <select name="zona3" value="{{$zona3}}" style="border-color: white">
                                <option value="0">Seleccione una zona</option>
                                @foreach($zonas as $item)
                                  @if($zona3 == $item->zone_id)
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
                                @if($tipo_inmueble == 'oficina')
                                  <option value="oficina" selected>Oficinas</option>
                                @else
                                  <option value="oficina">Oficinas</option>
                                @endif
                                @if($tipo_inmueble == 'bodega')
                                  <option value="bodega" selected>Bodegas</option>
                                @else
                                  <option value="bodega">Bodegas</option>
                                @endif
                                @if($tipo_inmueble == 'terreno')
                                  <option value="terreno" selected>Terrenos</option>
                                @else
                                  <option value="terreno">Terrenos</option>
                                @endif

                                @if($tipo_inmueble == 'fincas')
                                  <option value="fincas" selected>Fincass</option>
                                @else
                                  <option value="fincas">Fincass</option>
                                @endif

                                @if($tipo_inmueble == 'clinica')
                                  <option value="clinica" selected>Clinicas</option>
                                @else
                                  <option value="clinica">Clinicas</option>
                                @endif

                                @if($tipo_inmueble == 'playa')
                                  <option value="playa" selected>Casa de playa</option>
                                @else
                                  <option value="playa">Casa de playa</option>
                                @endif

                                @if($tipo_inmueble == 'granja')
                                  <option value="granja" selected>Granja</option>
                                @else
                                  <option value="granja">Granjas</option>
                                @endif

                                @if($tipo_inmueble == 'edificio')
                                  <option value="edificio" selected>Edificos</option>
                                @else
                                  <option value="edificio">Eficios</option>
                                @endif

                                @if($tipo_inmueble == 'local')
                                  <option value="local" selected>Locales</option>
                                @else
                                  <option value="local">Locales</option>
                                @endif
                              </select>


                              <div class="ps_area ps_range_slider" style="color: white!important">
                                 Precio minimo:
                                 @if($precio_minimo == 1)
                                  <input type="text"id="precio_minimo" name="precio_minimo" placeholder="US$" style="border-color: white">
                                 @else
                                  <input type="text"id="precio_minimo" name="precio_minimo" placeholder="US$" value="{{$precio_minimo}}" style="border-color: white">
                                 @endif
                              </div>
                              <div class="ps_area ps_range_slider" style="color: white!important">
                                 Precio maximo:
                                 @if($precio_maximo == 999999999999 )
                                  <input type="text"id="precio_maximo" name="precio_maximo" placeholder="US$" value="" style="border-color: white">
                                 @else
                                  <input type="text"id="precio_maximo" name="precio_maximo" placeholder="US$" value="{{$precio_maximo}}" style="border-color: white">
                                 @endif
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
<div class="float-sm" style="z-index: 99999999">
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
      <script type='text/javascript' src='js/vendor/modernizr.min.js'></script>
      <script type='text/javascript' src='js/vendor/ui/jquery-ui.min.js'></script>
      <script type='text/javascript' src='js/vendor/superfish.js'></script>
      <script type='text/javascript' src='js/custom/_utils.js'></script>
      <script type='text/javascript' src='js/custom/_init.js'></script>
      <script type='text/javascript' src='js/custom/_shortcodes.js'></script>
      <script type='text/javascript' src='js/vendor/magnific-popup/jquery.magnific-popup.min.js'></script>
      {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> --}}
   </body>
</html>
