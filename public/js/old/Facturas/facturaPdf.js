$(document).ready(function(){

    $(".tablaListadoFactura tbody").on("click",".btn-pdfFact",function(){

        var row = $(this).parents('tr');
        var factura = (row.data("nofactura"));

        $(".tbodydatosconceptos tr").remove();
        $.ajax({
            type: "post",
            url: "cargadatopreviewfactura",
            data: {
                factura:factura
            },
            success:function(response){
                var jsonResults = JSON.parse(response);
                if(jsonResults.success == true){
                    $.each(jsonResults.data, function( index, response ){
                        $("#cliente").html(response.cliente);
                        $("#datoscliente").html(response.datoscliente);
                        $("#nofactura").html(response.nofactura);
                        $("#fecha_factura").html((response.fecha).substr(0,10));
                        $(".moneda").html("("+response.moneda+")");
                        $("#subtotalfp").html(response.subtotal.toFixed(2));
                        $(".iva_percent").html(" "+response.iva+"%");
                        $("#ivafp").html(response.valoriva.toFixed(2));
                        $("#descuentofp").html("0.00");
                        $("#totalfp").html(response.totalacobrar.toFixed(2));
                        if(response.estado == 'EMITIDA'){
                            $("#obsfp").html("FACTURA "+response.estado);
                        }
                        else{
                            $("#obsfp").html("FACTURA "+response.estado+"<br /> FECHA CANCELADA: "+(response.fcancelado).substr(0,10));
                            $("#motivo").html("MOTIVO CANCELACION: "+response.motivocancelado);
                        }

                        cargatablafacturapreview(response.concepto,response.importe,response.ctdad,response.um,response.totalporconcepto);
                    })
                }
            }
        })
        $("#facturaPDFView").modal({backdrop: 'static'});

        // $.get("generatepdfFactura",{param: id}, function(response,param,status){

        //     if(response){
        //         $("#modalLoading").modal("hide");
        //         $("#modalLoading").removeClass("fade");
        //         $("#modalLoading").removeClass("show");
        //         var url="../../pdf/factura.pdf";
        //         window.open(url, '_blank');
        //     }
        // });
        // pruebaDivAPdf();

    });

    $("#btn-facturaPDF").on("click",function(){
        pruebaDivAPdf();
    });

    $(".btn-facturaPDF").on("click", function(){
        var factura=$("#nofactura").html();
        $.get("generatepdfFactura",{param: factura}, function(response,param,status){

            if(response){
                var url="factura/"+factura+".pdf";
                window.open(url, '_blank');
            }
        });
    });

});

function cargatablafacturapreview(concepto,importe,ctdad,um,totalporconcepto){

    var htmlTags = '<tr data-no="" data-concepto="'+concepto+'" data-importe="'+importe+'" data-ctdad="'+ctdad+'" data-um="'+um+'" data-totalporconcepto="'+totalporconcepto+'">'+
            '<td class="tdnofp"></td>'+
            '<td class="tdconceptofp" colspan="2">'+concepto+'</td>'+
            '<td class="tdimportefp">'+importe.toFixed(2)+'</td>'+
            '<td class="tdctdadfp">'+ctdad.toFixed(2)+'</td>'+
            '<td class="tdumfp">'+um+'</td>'+
            '<td class="tdtotalconcefp tdrigth">'+totalporconcepto.toFixed(2)+'</td>'+
        '</tr>';
    $('.tablefactpdf .tbodydatosconceptos').append(htmlTags);
}

