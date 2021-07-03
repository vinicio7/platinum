<?php
use App\Models\Images;
?>
<!DOCTYPE html>
<html>
<head>
    <title> PDF Propiedades Platinum</title>
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
@php    
    $imagenes   = Images::where('propierty_id',$data->propiertiy_id)->get();
@endphp
    <center>
        <section class="sheet-one" style="display: inline-block;">
            <br><br><br><br>
            <table style="margin: 0!important;border-style: none!important;border:0!important;background-color: white">
                <tr style="border-style: none!important;border:0!important;">
                    <td width="10%" style="border-style: none!important;border:0!important;"><h2 style="color: #11264e;">COD. {{$data->propiertiy_id}}</h2></td>
                    <td width="80%" style="border-style: none!important;border:0!important;"><center><h1 style="color: #11264e;font-size: 30px;">{{strtoupper($data->title)}}</h1></center></td>
                    <td width="10%" style="border-style: none!important;border:0!important;"><img style="width: 100px;margin-top: 10px" src="https://platinum.mavis.com.gt//assets/simple.png"></td>
                </tr>
            </table>
            
            <table style="margin-top: 20px">
                <tr>
                    <td width="320" rowspan="2" style="border-style: none!important;border:0!important;"><img style="width: 100%;height: 380px" src="{{$imagenes[0]->path}}"></td>
                    <td width="235" style="border-style: none!important;border:0!important;"><img style="width: 100%;height: 188px" src="{{$imagenes[0]->path}}"></td>
                </tr>
                <tr>
                    <td width="235" style="border-style: none!important;border:0!important;"><img style="width: 100%;height: 188px" src="{{$imagenes[0]->path}}"></td>
                </tr>
            </table>
            <table style="margin:0px;height: 250px">
                <tr>
                    <td rowspan="3"colspan="1" style="border-style: none;border:0;color:#11264e;background-color: white;width: 500px;vertical-align: top">
                        <p>DESCRIPCION<br>
                            {!!$data->description!!}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="border-style: none;border:0;color:#11264e;background-color: white;width: 300px">
                        <p>CUOTA DE MANTENIMIENTO<br><br>
                        $99.61/mex</br>
                        Q.767.99 aprox</br>
                        Incluye(Agua,Extraccion,Seguridad,Mantenimiento de areas comunes)
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="border-style: none;border:0;color:#11264e;background-color: white">
                        <p>INCLUYE<br><br>
                        Refrigueradora, Lampara, Estufa</br>
                        Calentador de agua, Lavadora Espejos</br>
                        Deposito de basura
                        </p>
                    </td>
                </tr>
            </table>
        </section>
        <footer style="background-color: #11264e;width:900px;padding: 20px;height: 100px">
                <h1 style="color: white;font-size: 40px;font-style: bold;display: inline-block;margin-left: 120px">${{$data->sale_usd}}</h1>
                <h1 style="color: white;font-size: 20px;font-style: bold;display: inline-block;margin-left: 100px">Info/Cel 502 3276-9893</h1>
                <h1 style="color: white;font-size: 20px;font-style: bold;margin-left: 80px">Email: vjlopezdeleon@gmail.com</h1>
        </footer>
    </center>
    <center>
        <section class="sheet-last" style="display: inline-block;">
            <br><br><br><br>
            <table style="margin: 0!important;border-style: none!important;border:0!important;background-color: white;margin-bottom: 40px">
                <tr style="border-style: none!important;border:0!important;">
                    <td width="10%" style="border-style: none!important;border:0!important;"><h2 style="color: #11264e;">COD. {{$data->propiertiy_id}}</h2></td>
                    <td width="80%" style="border-style: none!important;border:0!important;"><center><h1 style="color: #11264e;font-size: 30px;">{{strtoupper($data->title)}}</h1></center></td>
                    <td width="10%" style="border-style: none!important;border:0!important;"><img style="width: 100px;margin-top: 10px" src="https://platinum.mavis.com.gt//assets/simple.png"></td>
                </tr>
            </table>
            @php
                $contador = 0;
            @endphp
            @foreach($imagenes as $imagen)
            @if($contador < 6)
                <img src="{{$imagen->path}}" style="width: 350px;height: 180px;margin: 5px">
                @if($contador == 1 || $contador == 3 || $contador == 5)
                <br>
                @endif
                @php
                    $contador = $contador+1;
                @endphp
            @endif
            @endforeach
        </section>
        <footer style="background-color: #11264e;width:900px;padding: 20px;height: 100px">
                <h1 style="color: white;font-size: 40px;font-style: bold;display: inline-block;margin-left: 120px">${{$data->sale_usd}}</h1>
                <h1 style="color: white;font-size: 20px;font-style: bold;display: inline-block;margin-left: 100px">Info/Cel 502 3276-9893</h1>
                <h1 style="color: white;font-size: 20px;font-style: bold;margin-left: 80px">Email: vjlopezdeleon@gmail.com</h1>
        </footer>
    </center>

</body>
</html>