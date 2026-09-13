<html lang="en" id="global">
    {{-- @include('modals.modalSuccess') --}}
	<head>
		<meta charset="UTF-8">
		{{-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        {{-- <link rel="stylesheet" href="../../css/app.css"> --}}
        {{-- <title>Etiquetas</title> --}}

        <style>
            .etiqueta{
                width: 375px;
                height: 558px;
                margin-left: -40px;
                margin-top: -30px;
                padding-top: 5px;
                padding-left: 10px;
                padding-right: 5px;
                background: white;
                border: 2px solid black;
                border-radius: 5px;
                box-shadow: opx opx 2px gray;
                break-after: always;
                /* display: block; */
            }

            .etiqueta div{
                width: 100%;
            }

            .titulo-cabecera{
                width: 100%;
                height: 100px;
                font-size: 20px;
                background-size: 400px;
            }

            img{
                display: flex;
                justify-content: center;
                height: 100px;
                width: 60%;
            }

            .detalles-header{
                width: 90%;
                margin-bottom: 0px;
            }

            .etiquetaBody{
                padding-left: 25;
            }
            .etiqueta-bl, .bulto{
                font-family: Arial, Helvetica, sans-serif;
                font-size: 14px;
                margin-bottom: 10px;
            }

            .tagReceived, .tagSend, .tagDir, .tagArticulos{
                padding: 0;
                margin-top: 10px;
                margin-bottom: 5px;
                text-align: left;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
            }

            .etiqueta-dir{
                text-align: justify;
                text-size-adjust: unset;
                font: 13px;
            }

            .etiqueta-footer{
                width: 90%;
                display: flex;
                justify-content: center;
                margin-bottom: -15px;
                margin-left: 130px;
                padding: 0px;
                /* background: red; */
            }

            .etiqueta-subfooter{
                width: 90%;
                text-align: center;
                margin-top: -5px;
                display: flex
            }

            .cbtext{
                font-family: Arial, Helvetica, sans-serif;
                font-size: 14px;
            }
        </style>
    </head>

    @foreach ($etiquetas as $etiqueta )
	<body style="background: white">
            <div class="etiqueta">
                {{-- <div>
                    
                </div> --}}
                <table width="100%">
                    <tr>
                        <td style="width: 70%;"><div class="titulo-cabecera" style="width: 100%"><img src="images/kharlogo.png"></div></td>
                        <td style="width: 50%; text-align: right"><span class="etiqueta-bl">MAWB: </span><span class="etiqueta-bl">{{$etiqueta->mawb}}</span> <br> AWB: </span><span class="etiqueta-bl">{{$etiqueta->noblhouse}}</span></td>
                    </tr>
                </table>
                <table width="100%">
                    <tbody>
                        <tr class="detalles-header">
                            <td style="width: 50%; text-align: left"><span class="etiqueta-bl">Ruta: </span><span class="etiqueta-bl">{{$etiqueta->rutas}}</span></td>
                            <td style="width: 25%"><span>BULTO: {{$etiqueta->bulto}} / {{$etiqueta->cantidad}}</span></td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <table class="etiqueta-body mb-1" width="100%">
                    <tbody>
                        <tr class="tagSend">
                            <td width="25%" style="text-align: left"><span>Remitente:</span></td>
                            <td width="70%" style="text-align: left">{{$etiqueta->remitente}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="etiqueta-body" width="100%">
                    <tbody>
                        <tr class="tagReceived mb-2">
                            <td width="25%" style="text-align: left"><span>Destinatario:</span></td>
                            <td width="70%" style="text-align: left">{{$etiqueta->destinatario}}</td>
                        </tr>
                    </tbody>
                </table>
                <table style="height: 10px">

                </table>
                <table class="etiqueta-body" width="100%">
                    <tbody>
                        <tr class="tagReceived">
                            <td width="50%" style="text-align: left"><span>CI: </span>{{$etiqueta->ci}}</td>
                            <td width="50%" style="text-align: left" colspan="2"><span>Telef: </span><span>{{$etiqueta->telefono}}</span></td>
                        </tr>
                    </tbody>
                </table>
                <table style="height: 10px">

                </table>
                <table class="etiqueta-body" width="96%">
                    <tbody>
                        <tr class="tagReceived">
                            <td width="25%" style="vertical-align: top"><span>DIRECCION: </span></td>
                            <td width="70%" colspan="2" class="etiqueta-dir">{{$etiqueta->direccion}}</td>
                        </tr>
                    </tbody>
                </table>
                <table style="height: 5px">

                </table>
                <table class="etiqueta-body" width="100%">
                    <tbody>
                        <tr class="tagReceived">
                            <td width="50%"><span>PROVINCIA</span></td>
                            <td width="50%" ><span>MUNICIPIO</span></td>
                        </tr>
                        <tr class="tagReceived">
                            <td width="50%"><strong>{{$etiqueta->provincia}}</strong></td>
                            <td width="50%" >{{$etiqueta->municipio}}</td>
                        </tr>
                    </tbody>
                </table>
                {{-- <br> --}}
                <table width="100%">
                    <tbody class="etiqueta-body">
                        <tr class="tagReceived">
                            <td width="20%"><span>ARTICULOS:</span></td>
                            <td width="60%"><span>{{$etiqueta->descripcion}}</span></td>
                            @if($etiqueta->codigoenvio == 'ENA')
                                <td width="20%"><span style="background-color: lightgray">Ctd: {{$etiqueta->cantidadpiezas}}</span></td>

                                @elseif ($etiqueta->codigoenvio == 'MNJ')
                                    <td width="20%"><span style="background-color: lightgray">Ctd: {{$etiqueta->cantidadpiezas}}</span></td>

                                    @else
                                    <td width="20%"><span style="background-color: lightgray">Ctd: {{$etiqueta->cantidadpiezas}}</span></td>
                            @endif
                        </tr>
                    </tbody>
                </table>
                <table width="100%">
                    <tbody class="etiqueta-body">
                    <tr class="tagReceived">
                        <td width="60%"><div style="margin-top: -5px">

                            @if($etiqueta->codigoenvio == 'ENA')
                                <h4>EQUIPAJE NO ACOMPANADO</h4>
                                @elseif ($etiqueta->codigoenvio == 'MNJ')
                                    <h4>MENAJE DE CASA</h4>
                                    @else
                                    <h4>ENVIO</h4>
                            @endif
                        </div>
                        </td>
                        <td width="30%"><div style="margin-top: -5px">
                            <span>PESO: {{$etiqueta->pesokg}} KG</span>
                            </div>
                        </td>
                    </tr>
                </table>
                {{-- <div style="margin-top: -5px">

                    @if($etiqueta->codigoenvio == 'ENA')
                        <h5>EQUIPJAE NO ACOMPANADO</h5>        <span> PESO: {{$etiqueta->pesokg}} kg </span>
                        @elseif ($etiqueta->codigoenvio == 'MNJ')
                            <h5>MENAJE DE CASA</h5>      <span> PESO: {{$etiqueta->pesokg}} kg </span>
                            @else
                            <h5>ENVIO</h5>      <span> PESO: {{$etiqueta->pesokg}} kg </span>
                    @endif
                </div> --}}
                <hr>
                <table style="height: auto">
                    <tbody>
                        <tr>
                            <td>
                                {{-- <div style="width: 230px;">
                                    <div style="margin-top: -15px; text-align: center"><h4>{!! DNS1D::getBarcodeHTML($etiqueta->codigobarra, 'C128', 1,60, 'black','567') !!}</h4></div>
                                </div>
                                <div style="padding: 0px; margin-top:0px">
                                    <h6 class="codigobarra cbtext" style="padding: 0px; margin-top:0px">{{$etiqueta->codigobarra}}</h6>
                                </div> --}}
                            </td>
                            <td>
                                <div style="width: 120px; padding: 0">
                                    <img style="width: 120px; margin-top:0" src="data:public/images/png;base64, {!! base64_encode(QrCode::format('png')->errorCorrection('H')->size(200)->generate($etiqueta->codigoqr))!!} ">
                                    <h6 class="codigobarra cbtext" style="padding: 0px; margin-top:0px">AEROVARADERO</h6>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>
  	</body>
      @endforeach
</html>


