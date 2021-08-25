<?php
use App\Models\User;
?>
<!DOCTYPE html>
<html>
<head>
    <title> PDF Tour Platinum</title>
    <style>
        *{
            font-family: "Helvetica Neue Light", "HelveticaNeue-Light", "Helvetica Neue", Calibri, Helvetica, Arial, sans-serif;
        }
        .sheet{

        }
        .sheet-one{
            page-break-after: always;
            page-break-after:  always;
        }
        .sheet-last{
            page-break-after: always;
            page-break-before:  always;
        }
        .celda1{
            font-weight: normal;font-size: 14px;text-align: left;background-color:#11264e;color:white;vertical-align: top;padding: 5px;border-color: white
        }
        .celda12{
            font-weight: normal;font-size: 14px;text-align: left;background-color:#11264e;color:white;vertical-align: top;padding: 5px;border-color: white;
        }
        .celda13{
            padding-left: 10px;
            padding-right: 10px;
        }
        .celda-person{
            font-weight: normal;font-size: 14px;text-align: left;background-color:#11264e;color:white;vertical-align: center;padding: 5px;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height:2cm ;
            padding:20;
            background-color:  #11264e;

        }
        .image-header {
            margin-left:1cm;
            margin-top:-0.4cm;
        }
        footer {
            position: fixed;
            bottom: -1cm;
            left: 0cm;
            right: 0cm;
            height: 2.8cm;
        }
        @page {
            background-color:white;
        }

        #watermark {
            bottom:   0px;
            /*left:     -20px;*/
            /** El ancho y la altura pueden cambiar
                según las dimensiones de su membrete
            **/
            /* width:    28.8cm;
            height:   21cm; */

            /** Tu marca de agua debe estar detrás de cada contenido **/
            /* z-index:  99999; */
        }
        .sheet {
            background-color:transparent;
        }
        table {
            margin:2px;
            border-collapse: collapse;
            width:100%;
            background-color: #f9f9f9;
            border: 0px solid #11264e;
        }
        thead > tr {
            border:0;
            background-color: #11264e;
            color:#FFFFFF;
            font-size: 11px;
        }
        .celdatop{
            font-weight: bold;font-size: 22px;text-align: center;background-color:#11264e;color:white;
        }
        .celda {
            font-weight: light;font-size: 14px;text-align: left;background-color:white;color:black;
            vertical-align: top;
            padding:5px;
            border-color: #11264e;
        }
        .celdafin {
            font-weight: light;font-size: 14px;text-align: left;background-color:white;color:black;
            vertical-align: top;
            padding:0px;
            border-color: #11264e;
        }
        td {
            border: 1px solid #11264e;
            font-size: 11px;
        }
        body{
            background-color: white;
        }
        @page {
            margin: 0cm 0cm;
        }
        body {
            margin-top: 2cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 3cm;
        }
        .ex{
            width:auto;height:auto;display:inline-block;margin: 0;padding: 0;
        }
        .page_break { page-break-before: avoid;}
        .line { padding:0; margin:0}
        h1,h2,h3,h4,h5 {
            padding:0;
            margin:0;
        }
        h1 {
            font-size: 15px;
        }
        h2 {
            font-size: 15px;
        }
        h5 {
            font-size: 12px;
        }
        .pharagrap {
            text-align: justify;
            font-size: 14px;
            margin-bottom: 20px;
            background-color: rgba(0,0,0,0.02);
            padding:5px;
            border-radius:1px;
        }
        .imglogo{
            margin-top: 20px;
        }
        .img-principal{
            height: 220px;
            width: 260px;
        }
        .texto-pie {
            text-align: center;
            font-size: 9px;
            padding-left:1cm;
            padding-right:1cm;
        }
        .ex2{
            width:auto;height:auto;display:inline-block;margin-top: 5px;margin-right: 5px;padding: 0;float: right;color: white;font-size: 10px;
        }
        .tbl1{
            margin-left: auto;margin-right: auto;border-color: #11264e;margin-top: 20px; width: 50%
        }
        .tbl-final{
            margin-left: auto;margin-right: auto;border-color: #11264e;margin-top: 20px; width: 50%
        }
        .tbl2{
            margin-left: auto;margin-right: auto;border-color: #11264e;margin-top: 5px; width: 100%
        }
        .tbl3{
            border-color: #11264e;margin-top: 20px; width: 50%
        }
        .tblfin{
            margin-top:20px;
        }
        .secfin{
            margin-top: 20px;page-break-after: always;margin-left: 10px
        }
        .titulob{
            font-size: 20px;
        }
        .imggaleria{
            width: 300px;height:200px;margin-left: 50px;margin-bottom: 10px;margin-top: 10px
        }
        .block{
            display: block;
        }
        .section2{
            page-break-inside: always;
            page-break-after: avoid;
            page-break-before: avoid;
            margin-top: 0px;
            align-content: left;
        }
        .section-galeria{
            page-break-inside: always;
            page-break-after: avoid;
            page-break-before: always;
            margin-top: 0px;
            align-content: left;
        }
        .tbllast{
            margin-top:20px;
        }
        .td1{
            font-weight: bold;font-size: 14px;text-align: left;background-color:#11264e;color:white;border-color: white
        }
        .td2{
            font-weight: light;font-size: 14px;text-align: left;background-color:white;color:black;
        }

        .galeria-predeterminada-body {
            margin-top: 20px !important;
            display: block;
            border: 1px solid white;
        }
    </style>
</head>
<body>
    <header style="margin-bottom:0px">
        <center><img src="https://platinum.mavis.com.gt//image/logo_lg_blanco.svg" style="width: 400px;padding: 0px" /></center>
    </header>
    <br>
    <br>
    <br>
    <center><h1 style="font-size: 20px;color:#11264e">Reporte de Propiedades - Información para Tours</h1></center>
    <table>
        <thead>
            <tr>
                <td>Cod</td>
                <td>Fecha ingreso</td>
                <td>Captado por</td>
                <td>Estado</td>
                <td>Dirección</td>
                <td>Contacto</td>
                <td>Descripción</td>
                <td>Precio</td>
            </tr>
        </thead>
        <tbody>
            @php
                $user = User::where('user_id',$data->user_id)->first();    
            @endphp
            <tr>
                <td>{{$data->propiertiy_id}}</td>
                <td>{{$data->created_at}}</td>
                <td>{{$user->name}}</td>
                @if($data->sale_usd > 0)
                    <td>Venta</td>
                @else
                    <td>Alquiler</td>
                @endif
                
                <td>{{$data->adress}}</td>
                @if($data->name_contact <> 0 )
                    <td>{{$data->name_contact}} / {{$data->phone_contact}}</td>
                @else
                    <td></td>
                @endif
                <td>{!!$data->description!!}</td>
                 @if($data->sale_usd > 0)
                    <td>$.{{number_format($data->sale_usd,2)}}</td>
                @else
                    <td>$.{{number_format($data->rent_usd,2)}}</td>
                @endif
            </tr>
        </tbody>
    </table>
    <br>
    <table style="width: 400px">
        <thead>
            <tr>
                <td>Descripcion</td>
                <td>Cantidad</td>
                <td>Descripcion</td>
                <td>Cantidad</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 100px;font-weight: bold">Frente:</td>
                @if( $data->front_mts > 0)
                    <td>{{$data->front_mts}} mts</td>
                @else
                    <td></td>
                @endif
                <td style="font-weight: bold">Niveles:</td>
                @if($data->levels > 0)
                    <td>{{$data->levels}}</td>
                @else
                    <td></td>
                @endif
                
            </tr>
            <tr>
                <td style="font-weight: bold">Fondo:</td>
                @if($data->bottom_mts > 0)
                    <td>{{$data->bottom_mts}} mts</td>
                @else
                    <td></td>
                @endif
                <td style="font-weight: bold">Dormitorios:</td>
                @if($data->rooms > 0)
                    <td>{{$data->rooms}}</td>
                @else
                    <td></td>
                @endif
            </tr>
            <tr>
                <td style="font-weight: bold">Area de terreno:</td>
                @if($data->land_vrs > 0)
                    <td>{{$data->land_vrs}} vrs</td>
                @else
                    <td></td>
                @endif
                <td style="font-weight: bold">Baños:</td>
                @if($data->bathrooms > 0)
                    <td>{{$data->bathrooms}}</td>
                @else
                    <td></td>
                @endif
            </tr>
             <tr>
                <td style="font-weight: bold">Area de construccion:</td>
                @if($data->build_mts > 0)
                    <td>{{$data->build_mts}} mts</td>
                @else
                    <td></td>
                @endif
                <td style="font-weight: bold">Parqueos:</td>
                <td>{{$data->parking + $data->parking_roof + $data->parking_visit}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
