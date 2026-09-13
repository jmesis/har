<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <meta charset="UTF-8"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            @foreach($data as $mfto)
                <tr>
                    <th style="width: 100px; height: 60px; font-size: 9px; font-weight: bold; word-wrap: break-word; text-align: center; vertical-align: center;">Nombre del Agente Transitario</th>
                    <th style="width: 100px; height: 60px; font-size: 9px; text-align: center; word-wrap: break-word;">{{ $mfto->embarcador }}</th>
                    <th style="height: 60px"></th>
                    <th style="width: 100px; text-align: right; vertical-align: middle; height: 60px;">{{ __("Fecha") }}</th>
                    <th style="text-align: center; vertical-align: middle;">{{ Carbon\Carbon::parse($mfto->fets)->format('Y-m-d') }}</th>
                    <th style="height: 60px"></th>
                    <th style="height: 60px"></th>
                    <th style="height: 60px"></th>
                </tr>
                <tr>
                    <th style="width: 100px; height: 40px; font-size: 9px; font-weight: bold; text-align: center">Pais</th>
                    <th style="width: 100px; height: 40px; font-size: 9px; text-align: center">{{ $mfto->pais }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th style="width: 100px; height: 40px; font-size: 9px; font-weight: bold; text-align: center">Consignatario</th>
                    <th style="width: 100px; height: 40px; font-size: 9px; text-align: center">{{ $mfto->consignatario }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th style="width: 100px; height: 40px; font-weight: bold; font-size: 9px; word-wrap: break-word; vertical-align: center; text-align: center">Cantidad de House</th>
                    <th class="datosleft" style="width: 100px; height: 40px; font-size: 9px; text-align: center">{{$ctdh}}</th>
                    <th></th>
                    <th class="datosleft" style="width: 100px; text-align: right; vertical-align: middle; font-size: 9px; height: 40px;">Total de Sacas</th>
                    <th class="datosleft" style="width: 100px; text-align: center; vertical-align: middle; font-size: 9px; height: 40px;">#</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th style="text-align: center; font-weight: bold; font-size: 9px; word-wrap: break-word; vertical-align: center;">No. de Master AWB</th>
                    <th style="font-size: 9px; font-weight: bold; text-align: center">{{ $mfto->mawb }}</th>
                    <th></th>
                    <th style="font-size: 9px; text-align:right; word-wrap: break-word; vertical-align: middle;">Total de personas</th>
                    <th class="datosleft" style="width: 100px; height: 40px; font-size: 9px; text-align:center; vertical-align: middle">{{$totalpersonas}}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                @break
            @endforeach
            <tr>
                <th style="width: 90px; height: 45px; text-align:center; font-size: 8px; font-weight: bold; word-wrap: break-word; vertical-align: center; border: 1px solid black;">House</th>
                <th style="width: 125px; height: 45px; text-align:center; font-size: 8px; font-weight: bold; word-wrap: break-word; vertical-align: center; border: 1px solid black;">Naturaleza y Cantidad</th>
                <th style="width: 48px; height: 45px; text-align:center; font-size: 8px; font-weight: bold; word-wrap: break-word; vertical-align: center; border: 1px solid black;">Peso (Kg)</th>
                <th style="width: 115px; height: 45px; text-align:center; font-size: 8px; font-weight: bold; word-wrap: break-word; vertical-align: center; border: 1px solid black;">Bultos (Cant)</th>
                <th style="width: 100px; height: 45px; text-align:center; font-size: 8px; font-weight: bold; word-wrap: break-word; vertical-align: center; border: 1px solid black;">Nombre y Apellidos del REMITENTE</th>
                <th style="width: 44px; height: 45px; text-align:center; font-size: 8px; font-weight: bold; word-wrap: break-word; vertical-align: center; border: 1px solid black;">Passport</th>
                <th style="width: 98px; height: 45px; text-align:center; font-size: 8px; font-weight: bold; word-wrap: break-word; vertical-align: center; border: 1px solid black;">Nombre y Apellidos del DESTINATARIO</th>
                <th style="width: 83px; height: 45px; text-align:center; font-size: 8px; font-weight: bold; word-wrap: break-word; vertical-align: center; border: 1px solid black;">No. de Carnet de Identidad</th>
                <th style="width: 86px; height: 45px; text-align:center; font-size: 8px; font-weight: bold; word-wrap: break-word; vertical-align: center; border: 1px solid black;">Telefono del DESTINATARIO</th>
                <th style="width: 125px; height: 45px; text-align:center; font-size: 8px; font-weight: bold; word-wrap: break-word; vertical-align: center; border: 1px solid black;">Direcicon del DESTINATARIO</th>
                <th style="width: 94px; height: 45px; text-align:center; font-size: 8px; font-weight: bold; word-wrap: break-word; vertical-align: center; border: 1px solid black;">Identificacion de cobro de la transportacion del House</th>
                <th style="width: 59px; height: 45px; text-align:center; font-size: 8px; font-weight: bold; word-wrap: break-word; vertical-align: center; border: 1px solid black;">Unidad de destino</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $mfto)
            <tr>
                <td style="width: 90px; height: 70px; text-align:center; font-size: 7px; word-wrap: break-word; vertical-align: center; border: 1px solid black;">{{ $mfto->noblhouse }}</td>
                <td style="width: 125px; height: 70px; text-align:center; font-size: 7px; word-wrap: break-word; vertical-align: center; border: 1px solid black;">{{ $mfto->producto }}</td>
                <td style="width: 48px; height: 70px; text-align:center; font-size: 7px; word-wrap: break-word; vertical-align: center; border: 1px solid black;">{{ $mfto->pesokg }}</td>
                <td style="width: 115px; height: 70px; text-align:center; font-size: 7px; word-wrap: break-word; vertical-align: center; border: 1px solid black;">{{ $mfto->bultos }}</td>
                <td style="width: 100px; height: 70px; text-align:center; font-size: 7px; word-wrap: break-word; vertical-align: center; border: 1px solid black;">{{ $mfto->remitente }}</td>
                <td style="width: 44px; height: 70px; text-align:center; font-size: 7px; word-wrap: break-word; vertical-align: center; border: 1px solid black;">{{ $mfto->nopasaporte }}</td>
                <td style="width: 98px; height: 70px; text-align:center; font-size: 7px; word-wrap: break-word; vertical-align: center; border: 1px solid black;">{{ $mfto->destinatario }}</td>
                <td style="width: 83px; height: 70px; text-align:center; font-size: 7px; word-wrap: break-word; vertical-align: center; border: 1px solid black;">{{ $mfto->ci }}</td>
                <td style="width: 86px; height: 70px; text-align:center; font-size: 7px; word-wrap: break-word; vertical-align: center; border: 1px solid black;">{{ $mfto->telefono }}</td>
                <td style="width: 125px; height: 70px; text-align:center; font-size: 7px; word-wrap: break-word; vertical-align: center; border: 1px solid black;">{{ $mfto->dir }}</td>
                <td style="width: 94px; height: 70px; text-align:center; font-size: 7px; word-wrap: break-word; vertical-align: center; border: 1px solid black;">{{ $mfto->entrega }}</td>
                <td style="width: 59px; height: 70px; text-align:center; font-size: 7px; word-wrap: break-word; vertical-align: center; border: 1px solid black;">{{ $mfto->unidaddestino }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
