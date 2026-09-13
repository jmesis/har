$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Cierra panel de Documentacion
    $(".btnCerrarPanelDoc").on("click", function(){
        $(".panelDocumentacion").attr("hidden", true);
    });

    //Carga el grid
    $("#txtEmbarqueDoc").on("change",function(){
        var embarque = $.trim($('#txtEmbarqueDoc option:selected').text());

        $("#btnExportMftoExcel").attr("href","https://gloshima.casatitoymartha.com/public/excel/"+embarque+"");

        var tabla = $(".tablaDoc tbody");
        if($.trim($("#txtEmbarqueDoc option:selected").text()) != ''){

            var noembarque = $.trim($("#txtEmbarqueDoc option:selected").text());
            var method = 'POST';

            $.ajax({
                type:method,
                url:"urlgetSolicitudes",
                data:{
                    noembarque:noembarque
                },
                success:function(response){

                    var jsonResults = JSON.parse(response);
                    $(".tablaDocBody tr").remove();
                    $("#LeyendaDocumentos").attr("hidden",true);

                    if(jsonResults.data != 0){
                        $("#btnExportMftoExcel").removeAttr("hidden");
                        $.each(jsonResults.data, function( index, response ){
                            getSolicitudes(response.noblhouse,response.shipper,response.consignee,tabla);
                        });
                    }
                    else{
                        $("#LeyendaDocumentos").removeAttr("hidden");
                        $(".tablaDocBody tr").remove();
                        $("#btnExportMftoExcel").attr("hidden", true);
                    }

                },
                error:function(obj){
                    var sms = obj.message;
                    var message=sms;
                    var title="Atencion";
                    var error ='';
                    var win = 'error';
                    var reload=false;
                    showMessage(message,error,title,reload,win);
                }
            });
        }
    });

    //Genera BL
    $(".tablaDoc tbody").on("click",".btnBillPDF",function(){

        var row = $(this).parents('tr');
        var noblhouse = (row.data("noblhouse"));
        var original = $("input:checkbox[name=original]:checked").val();

        $.get("generatebl",{param: noblhouse+"+"+original}, function(response,param,status){

            if(response){
                $("#modalLoading").modal("hide");
                $("#modalLoading").removeClass("fade");
                $("#modalLoading").removeClass("show");
                var url="pdf/"+response.data+".pdf";
                window.open(url, '_blank');
            }
        });
    });
});

function getSolicitudes(noblhouse,remitente,destinatario,tabla){
    var htmlTags = '<tr data-noblhouse="'+noblhouse+'" data-remitente="'+remitente+'" data-destinatario="'+destinatario+'">'+
        '<td class="rowtdSolicitudes">'+noblhouse+'</td>'+
        '<td class="rowtdSolicitudes">'+remitente+'</td>'+
        '<td class="rowtdSolicitudes">'+destinatario+'</td>'+
        '<td class="rowtdopcion" style="text-align:right"><button type="button" class="btn btn-sm mr-auto btn-secondary btnBillPDF"><i class="fas fa-book"></i> Bill of Lading</button></td>'+
        '</tr>';
    tabla.append(htmlTags);
}
