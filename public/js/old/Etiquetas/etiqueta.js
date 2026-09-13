$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".table_listadoproducto tbody").on("click",".btn-etiqueta",function(){

        var row = $(this).parents('tr');
        var producto = (row.data("noproducto"));
        $("#modalLoading").modal({backdrop: 'static'});

        $.get("generatepdf",{param: producto}, function(response,param,status){

            if(response){
                $("#modalLoading").modal("hide");
                $("#modalLoading").removeClass("fade");
                $("#modalLoading").removeClass("show");
                var url="pdf/"+response.data+".pdf";
                window.open(url, '_blank');
            }
        });
    });

    $(".tablelistadoordenes tbody").on("click",".btnEtiquetaResumen",function(){

        var row = $(this).parents('tr');
        var noorden = (row.data("noorden"));
        $("#modalLoading").modal({backdrop: 'static'});

        $.get("etiquetaResumen",{param: noorden}, function(response,param,status){

            if(response){
                $("#modalLoading").modal("hide");
                $("#modalLoading").removeClass("fade");
                $("#modalLoading").removeClass("show");
                var url="pdf/"+response.data+".pdf";
                window.open(url, '_blank');
            }
        });
    });
    
    //cierra panel busqueda etiqueta
    $(".btncerrar-listadoE").on("click", function(){
        $(".listadoEtiquetas").attr("hidden", true);
    });

    //Lista etiquetas segun formulario de busqueda
    $("#btn-ebuscar").on("click",function(e){
        e.preventDefault();
        var desde = $('#txtedesde').val();
        var hasta = $('#txtehasta').val();
        var bl= $("#txtenobl").val();
        var noembarque = $("#txtenoEmbarque option:selected").text();
        var tipoenvio= $("#txttenvio option:selected").val();
        var estado = $("#txteestado option:selected").text();

        $(".tablaListadoEtiquetaBody tr").remove();
        $.ajax({
            type: "post",
            url: "listaEtiquetas",
            data: {
                desde: desde,
                hasta: hasta,
                bl:bl,
                noembarque:noembarque,
                codigoenvio:tipoenvio,
                estado:estado

            }, success: function (response) {
                var jsonResults = JSON.parse(response);

                if(jsonResults.success == true){

                    $.each(jsonResults.data, function( index, response ){
                        cargaListaEtiquetas(response.no_embarque,response.noblhouse,response.remitente,response.destinatario,response.ci,response.codigobarra,response.estado,response.fecha,response.idetiqueta,response.idorden);
                    })
                }
                else{
                    var message="No existen etiquetas asociadas a los filtros de busqueda";
                    var title="Atencion";
                    var error ='';
                    var win = 'informacion';
                    var reload=false;
                    showMessage(message,error,title,reload,win);
                }
            }
        });
    });
});

function cargaListaEtiquetas(no_embarque,noblhouse,remitente,destinatario,ci,codigobarra,estado,fecha,idetiqueta,idorden){

    var htmlTags = '<tr data-no_embarque="'+no_embarque+'" data-noblhouse="'+noblhouse+'" data-remitente="'+remitente+'" data-destinatario="'+destinatario+'" data-ci="'+ci+'" data-codigobarra="'+codigobarra+'" data-estado="'+estado+'" data-fecha="'+fecha+'" data-idetiqueta="'+idetiqueta+'" data-idorden="'+idorden+'">' +
        '<td class="rowtdetiqueta">' + no_embarque + '</td>' +
        '<td class="rowtdetiqueta">' + noblhouse + '</td>' +
        '<td class="rowtdetiqueta">' + remitente + '</td>' +
        '<td class="rowtdetiqueta">' + destinatario +'</td>' +
        '<td class="rowtdetiqueta">' + ci + '</td>' +
        '<td class="rowtdetiqueta">' + codigobarra + '</td>' +
        '<td class="rowtdetiqueta">' + estado + '</td>' +
        '<td class="rowtdetiqueta">' + moment(fecha).format('DD/MM/YYYY') + '</td>'+
        '<td class="rowtdetiqueta" hidden>' + idetiqueta + '</td>' +
        '<td class="rowtdetiqueta" hidden>' + idorden + '</td>' +
        '<td class="rowtdetiqueta" style="text-align: center"><button class="btn btn-sm btn-secondary mr-auto btn-verfact" disabled><i class="far fa-eye" data-toggle="tooltip" title="Ver Factura"></i></button><button class="btn btn-sm btn-danger mr-auto btn-cancelarfact ml-1" disabled><i class="fas fa-ban" data-toggle="tooltip" title="Cancelar Facturar"></i></button><button class="btn btn-sm btn-success mr-auto btn-pdfFact ml-1" disabled><i class="fas fa-tags" data-toggle="tooltip" title="PDF"></i></button></td>'
        '</tr>';
    $('.tablaListadoEtiquetas tbody').append(htmlTags);
}



