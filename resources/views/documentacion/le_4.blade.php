<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    {{-- <link rel="stylesheet" href="tables-le2.css"> --}}
    <title>Listas de Empaque</title>
    <style type="text/css">

 * {
    margin: 0;
    padding: 0;
    text-indent: 0;
}

h2 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: bold;
    text-decoration: none;
    font-size: 16pt;
}

h1 {
    color: #000080;
    font-family: Arial, sans-serif;
    font-style: normal;
    font-weight: bold;
    text-decoration: none;
    font-size: 18pt;
}

.s1 {
    color: #000080;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 18pt;
}

.s2 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: bold;
    text-decoration: none;
    font-size: 11.5pt;
    vertical-align: 1pt;
}

h3 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: bold;
    text-decoration: none;
    font-size: 10.5pt;
}

.p,
p {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 10.5pt;
    margin: 0pt;
}

.s3 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: underline;
    font-size: 10.5pt;
}

.s4 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 10.5pt;
}

.s5 {
    color: black;
    font-family: Arial, sans-serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 9pt;
}

.s6 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 9pt;
}

.s7 {
    color: black;
    font-family: Arial, sans-serif;
    font-style: normal;
    font-weight: bold;
    text-decoration: none;
    font-size: 8.5pt;
}

.s8 {
    color: black;
    font-family: "Times New Roman", serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 8.5pt;
}

.s9 {
    color: black;
    font-family: Arial, sans-serif;
    font-style: normal;
    font-weight: normal;
    text-decoration: none;
    font-size: 9pt;
}

table,
tbody {
    vertical-align: top;
    overflow: visible;

}
/*
.table{
    width: 1000px;
    border: #000080 1px;
}

*/

.pageprint{
    width: 800px;
    padding-left: 20px;
    padding-top: 40px;
}

.td1{
    width: 190px;
}

.td2{
    width: 180px;
}

.td3{
    width: 180px;
}

.td4{
    width: 100px;
}

.td5{
    width: 100px;
}


.td4puda{
    float: right;
}
    </style>
</head>

<body>
   
    <div class="pageprint">
       
        <table>
            <tr>
                 <td class="td3" colspan="3">
                    <h1 style="text-indent: 0pt;text-align: right;">LISTA<span class="s1">
                        </span>DE<span class="s1"> </span>EMPAQUE<span class="s1"> </span></h1>
                </td>
                <td class="td4">
                        <p class="s2" style="text-indent: 0pt;text-align: right;">C/B</p>
                    </td>
                <td class="td5">
                    <p class="s3" style="text-indent: 0pt;text-align: center;">30</p>
                </td>
            </tr>
            <tr>
                <td class="td1">
                    <p style="text-indent: 0pt;text-align: left;"><h4>{!! DNS1D::getBarcodeHTML($house, 'C128', 2,60, 'black','567') !!}</h4>
                    </p>
                </td>
                <td class="td2"></td>
                <td class="td3"></td>
                <td class="td4"></td>
                <td class="td5"></td>
            </tr>
            <tr>
                <td class="td1">
                    <h2 style="text-indent: 0pt;text-align: left;">{{ $house}}</h2>
                </td>
                <td class="td2"></td>
                <td class="td3"></td>
                <td class="td4"></td>
                <td class="td5"></td>
            </tr>
            <tr>
                <td class="td1"></td>
                <td class="td2"></td>
                <td class="td3"></td>
                <td class="td5" colspan="2">
                    <h3 style="text-indent: 0pt;text-align: left;">Para<span class="p"> </span>uso<span class="p">
                        </span>de<span class="p"> </span>la<span class="p"> </span>aduana</h3>
                </td>
            </tr>
            <tr>
                        <td class="td3" colspan="3">
                            <!-- tabla de  datos personales y de contacto -->
                            <table>
                                <tr>
                                    <td>
                                        <p style="padding-top: 4pt;text-indent: 0pt;text-align: left;">Nombre y Apellidos:</p>
                                    </td>
                                    <td>
                                        <p style="padding-top: 4pt;padding-left: 16pt;text-indent: 0pt;text-align: left;">
                                            {{ $nombre}}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="padding-top: 9pt; text-indent: 0pt;text-align: left;">CI:</p>
                                    </td>
                                    <td>
                                        <p style="padding-top: 9pt;padding-left: 16pt;text-indent: 0pt;text-align: left;">
                                            {{ $ci}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="padding-top: 5pt; text-indent: 0pt;line-height: 157%;text-align: left;">
                                            Teléfono:</p>
                                    </td>
                                    <td>
                                        <p style="padding-top: 5pt;padding-left: 16pt;text-indent: 0pt;text-align: left;">{{ $telefono}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="padding-top: 5pt; text-indent: 0pt;line-height: 157%;text-align: left;">
                                            Dirección:</p>
                                    </td>
                                    <td>
                                        <p
                                            style="padding-top: 6pt;padding-left: 16pt;text-indent: 0pt;line-height: 118%;text-align: left;">
                                            {{ $direccion}}</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <p class="s5" style="padding-top: 15pt;text-indent: 0pt;text-align: left;">Contenedor:
                                    </td>
                                    <td>
                                        <p
                                            style="padding-top: 15pt;padding-left: 16pt;text-indent: 0pt;line-height: 118%;text-align: left;">
                                            {{ $contenedor}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="s5" style="padding-top: 5pt;text-indent: 0pt;text-align: left;">#Telefono:
                                    </td>
                                    <td>
                                        <p style="padding-top: 5pt;padding-left: 16pt;text-indent: 0pt;text-align: left;">{{ $telefono}}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </td>
                <td class="td5" colspan="2">
                    <table style="border-collapse:collapse; width: 80%;" cellspacing="0">
                        <tr style="height:17pt">
                            <td
                                style="width:62pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p class="s4"
                                    style="padding-top: 4pt;padding-right: 9pt;text-indent: 0pt;line-height: 12pt;text-align: center;">
                                    Norma</p>
                            </td>
                            <td
                                style="width:87pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                            </td>
                        </tr>
                        <tr style="height:17pt">
                            <td
                                style="width:62pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p class="s4"
                                    style="padding-top: 4pt;padding-left: 7pt;padding-right: 9pt;text-indent: 0pt;line-height: 12pt;text-align: center;">
                                    Juridica</p>
                            </td>
                            <td
                                style="width:87pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                            </td>
                        </tr>
                        <tr style="height:17pt">
                            <td
                                style="width:62pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                            </td>
                            <td
                                style="width:87pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                            </td>
                        </tr>
                        <tr style="height:18pt">
                            <td
                                style="width:62pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p class="s4"
                                    style="padding-top: 4pt;padding-left: 8pt;padding-right: 9pt;text-indent: 0pt;line-height: 12pt;text-align: center;">
                                    V.A.</p>
                            </td>
                            <td
                                style="width:87pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                            </td>
                        </tr>
                        <tr style="height:18pt">
                            <td
                                style="width:62pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p class="s4"
                                    style="padding-top: 4pt;padding-left: 8pt;padding-right: 9pt;text-indent: 0pt;line-height: 12pt;text-align: center;">
                                    Libre</p>
                            </td>
                            <td
                                style="width:87pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                            </td>
                        </tr>
                        <tr style="height:17pt">
                            <td
                                style="width:62pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p class="s4"
                                    style="padding-top: 4pt;padding-right: 1pt;text-indent: 0pt;line-height: 12pt;text-align: center;">
                                    %
                                </p>
                            </td>
                            <td
                                style="width:87pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                            </td>
                        </tr>
                        <tr style="height:17pt">
                            <td
                                style="width:62pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p class="s4"
                                    style="padding-top: 4pt;padding-left: 8pt;padding-right: 9pt;text-indent: 0pt;line-height: 12pt;text-align: center;">
                                    D.A.</p>
                            </td>
                            <td
                                style="width:87pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                            </td>
                        </tr>
                        <tr style="height:21pt">
                            <td
                                style="width:62pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p class="s4"
                                    style="padding-top: 5pt;padding-left: 11pt;padding-right: 9pt;text-indent: 0pt;text-align: center;">
                                    Servicios</p>
                            </td>
                            <td
                                style="width:87pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                            </td>
                        </tr>
                        <tr style="height:21pt">
                            <td
                                style="width:62pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p class="s4"
                                    style="padding-top: 6pt;padding-left: 11pt;padding-right: 9pt;text-indent: 0pt;text-align: center;">
                                    Total</p>
                            </td>
                            <td
                                style="width:87pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                                <p style="text-indent: 0pt;text-align: left;"><br /></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="td1"></td>
                <td class="td2"></td>
                <td class="td3"></td>
                <td class="td4"></td>
                <td class="td5"></td>
            </tr>
            <tr>
                <td class="td1" colspan="5">
                    <!-- tabla de la parte de descripcion de articulos  -->
                     
                      <table style="border-collapse:collapse;margin-left:5.75pt; width: 100%;" cellspacing="0">
                        <tr style="height:30pt">
                            <td
                                style="width:378pt;border-top-style:solid;border-top-width:1px;border-left-style:solid;border-left-width:1px;border-bottom-style:solid;border-bottom-width:1px;border-right-style:solid;border-right-width:1px">
                                <p class="s4"
                                    style="padding-top: 4pt;padding-left: 163pt;padding-right: 161pt;text-indent: 0pt;text-align: center;">
                                    <strong> Descripción</strong></p>
                            </td>
                            <td
                                style="width:51pt;border-top-style:solid;border-top-width:1px;border-left-style:solid;border-left-width:1px;border-bottom-style:solid;border-bottom-width:1px;border-right-style:solid;border-right-width:1px">
                                <p class="s4"
                                    style="padding-top: 4pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">
                                    <strong> Cantidad</strong>
                                </p>
                            </td>
                            <td
                                style="width:59pt;border-top-style:solid;border-top-width:1px; border-left-style:solid;border-left-width:1px;border-bottom-style:solid;border-bottom-width:1px;border-right-style:solid;border-right-width:1px">
                                <p class="s4"
                                    style="padding-top: 1pt;padding-left: 14pt;text-indent: 0pt;line-height: 14pt;text-align: left;">
                                <strong>Valor Aduana</strong></p>
                            </td>
                            <td
                                style="width:50pt;border-top-style:solid;border-top-width:1px;border-left-style:solid;border-left-width:1px;border-bottom-style:solid;border-bottom-width:1px;border-right-style:solid;border-right-width:1px">
                                <p class="s7"
                                    style="padding-top: 4pt;padding-left: 17pt;padding-right: 6pt;text-indent: -4pt;line-height: 122%;text-align: left;">
                                <strong>Peso<span class="s8"> </span>Kg</strong></p>
                            </td>
                        </tr>
                        @foreach ($les as $data )
                        @foreach ($data as $le )
                        <tr style="height:23pt">
                            <td
                                style="width:378pt;border-top-style:solid;border-top-width:1px;border-left-style:solid;border-left-width:1px;border-right-style:solid;border-right-width:1px">
                                <p class="s4"
                                    style="padding-top: 7pt;padding-left: 4pt;text-indent: 0pt;text-align: left;">
                                    {{ $le->descripcion}}</p>
                            </td>
                            <td
                                style="width:51pt;border-top-style:solid;border-top-width:1px;border-left-style:solid;border-left-width:1px;border-right-style:solid;border-right-width:1px">
                                <p class="s4"
                                    style="padding-top: 7pt;padding-left: 19pt;text-indent: 0pt;text-align: left;">{{ $le->cantidadpiezas}}
                                </p>
                            </td>
                            <td
                                style="width:59pt;border-top-style:solid;border-top-width:1px;border-left-style:solid;border-left-width:1px;border-right-style:solid;border-right-width:1px">
                                <p class="s4"
                                    style="padding-top: 7pt;padding-left: 21pt;text-indent: 0pt;text-align: left;">
                                    {{ $le->valor}}
                                </p>
                            </td>
                            <td
                                style="width:50pt;border-top-style:solid;border-top-width:1px;border-left-style:solid;border-left-width:1px;border-right-style:solid;border-right-width:1px">
                                <p class="s9"
                                    style="padding-top: 6pt;padding-left: 17pt;text-indent: 0pt;text-align: left;">
                                    {{ $le->gross}}
                                </p>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach  
                    </table>  
                    
                </td>
            </tr>
            <tr>
                <td class="td1"></td>
                <td class="td2"></td>
                <td class="td3"></td>
                <td class="td4"></td>
                <td class="td5"></td>
            </tr>
        </table>
        
    </div>
    
</body>

</html>
