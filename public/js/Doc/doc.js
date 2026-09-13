$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Busca informacion en una tala html
    $("#findTablaDoc").on("keyup", function() {
        var tabla = $(".tablaDocBody tr");
        var query = $("#findTablaDoc").val();
        buscarEnTabla(query,tabla);
    });

    //Cierra panel de Documentacion
    $(".btnCerrarPanelDoc").on("click", function(){
        $(".panelDocumentacion").attr("hidden", true);
    });

    //se marcan y desmarcan todos los checkbox
    $(".chkboxFullDoc").on("change", function(){
        if($(this).is(':checked')){
            $(".chkboxDoc").attr('checked',true);
            $(".chkboxDoc").prop("checked", true);
            $('#btnPrintAwb').prop('disabled',$('.chkboxDoc:checked').length == 0);
            $('#btnPL').prop('disabled',$('.chkboxDoc:checked').length == 0);
        }
        else{
            $(".chkboxDoc").removeAttr('checked');
            $(".chkboxDoc").prop("checked", false);
            $('#btnPrintAwb').prop('disabled',$('.chkboxDoc:checked').length == 0);
            $('#btnPL').prop('disabled',$('.chkboxDoc:checked').length == 0);
        }
    });

    //marcar checkbox de cada fila clickeada
    $(".tablaDoc tbody").on("click",".chkboxDoc",function(){
        console.log($(this));
        if($(this).is(':checked')){
            $(this).attr('checked',true);
            $('#btnPrintAwb').prop('disabled',$('.chkboxDoc:checked').length == 0);
            // $('#btnPL').prop('disabled',$('.chkboxDoc:checked').length == 0);
        }
        else{
            $(this).attr('checked',false);
            $('#btnPrintAwb').prop('disabled',$('.chkboxDoc:checked').length == 0);
            // $('#btnPL').prop('disabled',$('.chkboxDoc:checked').length == 0);
        }
    });

    //Carga el grid documentacion para generar bl,awb y mfto
    $("#txtEmbarqueDoc").on("change",function(){
        var embarque = $.trim($('#txtEmbarqueDoc option:selected').text());

        $("#btnExportMftoExcel").attr("href","https://har.syscomt.com/excel/"+embarque+"");
        $("#btnExportMftoExcelA").attr("href","https://har.syscomt.com/excela/"+embarque+"");

        var tabla = $(".tablaDoc tbody");
        if($.trim($("#txtEmbarqueDoc option:selected").text()) != ''){

            var noembarque = $.trim($("#txtEmbarqueDoc option:selected").text());
            var tipo_emb=noembarque.substr(3,2);

            var method = 'POST';

            $.ajax({
                type:method,
                url:"urlgetSolicitudes",
                data:{
                    noembarque:noembarque,
                    tipo_emb:tipo_emb
                },
                success:function(response){

                    var jsonResults = JSON.parse(response);
                    $(".tablaDocBody tr").remove();
                    $("#LeyendaDocumentos").attr("hidden",true);

                   if(jsonResults.data != 0){
                        if(tipo_emb=="EA"){
                            $("#btnExportMftoExcelA").removeAttr("hidden");
                            $("#btnExportMftoExcel").attr("hidden",true);
                            $.each(jsonResults.data, function( index, response ){
                                getSolicitudes(response.hawb,response.mawb,response.aeronave,response.vuelo,response.shipper,response.consignee,response.descripcion,tabla);
                                validaLE(response.shipper, response.consignee);
                            });
                            $(".btnAwbPDF").removeAttr("hidden");
                            $(".btnBillPDF").attr("hidden",true);
                        }
                        else{
                            $("#btnExportMftoExcel").removeAttr("hidden");
                            $("#btnExportMftoExcelA").attr("hidden",true);
                            $.each(jsonResults.data, function( index, response ){
                                getSolicitudes(response.noblhouse,response.shipper,response.consignee,tabla);
                            });
                            $(".btnAwbPDF").attr("hidden",true);
                            $(".btnBillPDF").removeAttr("hidden");
                        }
                    }
                    else{
                        $("#LeyendaDocumentos").removeAttr("hidden");
                        $(".tablaDocBody tr").remove();
                        $("#btnExportMftoExcel").attr("hidden", true);
                        $("#btnExportMftoExcelA").attr("hidden", true);
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

    //Genera Lista de empaque
    $(".tablaDoc tbody").on("click",".btnLE",function(){

        var row = $(this).parents("tr");
        var nodoc = row.data("noblhouse")
        
        $.get("generalempaque",{param: nodoc}, function(response,param,status){
            if(response){
                console.log(response.data);
                $("#modalLoading").modal("hide");
                $("#modalLoading").removeClass("fade");
                $("#modalLoading").removeClass("show");
                console.log(response.data);
                // var url="le/Listaempaque.pdf";
                var url="le/Listaempaque.pdf";
                window.open(url, '_blank');
            }
            else{
                console.log(response.arreglo);
            }
        });
    });

    //Genera AWB otra version -- prueba
    $("#btnPrintAwb").on("click", function(){

        var datos=[];
        var objetos={};
        $(".tablaDocBody tr td input[type='checkbox']:checked").each(function(){

            var row = $(this).closest("tr")[0];
            var nodoc =  row.cells[1].innerHTML;
            datos.push({
                "nodoc"  : nodoc

            });
        });
        objetos.datos=datos;
        //console.log(datos);

        $.get("generaawb",{param: datos}, function(response,param,status){
            if(response){
                console.log(response.arreglo);
                // $("#modalLoading").modal("hide");
                // $("#modalLoading").removeClass("fade");
                // $("#modalLoading").removeClass("show");
                // console.log(response.data);
                var url="pdf/"+response.data+".pdf";
                // var url="../../pdf/awbtest.pdf";
                window.open(url, '_blank');
            }
            else{
                console.log(response.arreglo);
            }
        });
    });


    //Genera AWB
    // $(".tablaDoc tbody").on("click",".btnAwbPDF",function(){

    //     var row = $(this).parents('tr');
    //     var noblhouse = (row.data("noblhouse"));
    //     /*var noblhouse = "DOMEA2022-0001";*/
    //     /*var original = $("input:checkbox[name=original]:checked").val();*/

    //     $.get("generaawb",{param: noblhouse}, function(response,param,status){
        
    //         if(response){
    //             $("#modalLoading").modal("hide");
    //             $("#modalLoading").removeClass("fade");
    //             $("#modalLoading").removeClass("show");
    //             var url="pdf/"+response.data+".pdf";
    //             window.open(url, '_blank');
    //         }
    //         else{
    //             console.log(response.data);
    //             alert("holaaaa");
    //         }
    //     });
    // });
});

function getSolicitudes(noblhouse,bl_mawb,aeronave,vuelo,remitente,destinatario,descripcion,tabla){
    var htmlTags = '<tr data-noblhouse="'+noblhouse+'" data-tipodoc="'+bl_mawb+'", data-aeronave="'+aeronave+'" data-vuelo="'+vuelo+'" data-remitente="'+remitente+'" data-destinatario="'+destinatario+'" data-descripcion="'+descripcion+'">'+
        '<td class="rowtdSolicitudes" style="width: 40px; text-align: center"><input type="checkbox" class="chkboxDoc"></td>'+
        '<td class="rowtdSolicitudes">'+noblhouse+'</td>'+
        '<td class="rowtdSolicitudes">'+bl_mawb+'</td>'+
        '<td class="rowtdSolicitudes">'+aeronave+'</td>'+
        '<td class="rowtdSolicitudes">'+vuelo+'</td>'+
        '<td class="rowtdSolicitudes">'+remitente+'</td>'+
        '<td class="rowtdSolicitudes">'+destinatario+'</td>'+
        '<td class="rowtdSolicitudes">'+descripcion+'</td>'+
        '<td class="rowtdSolicitudes" style="text-align:right"><button type="button" class="btn btn-sm btn-outline-info ml-2 btnLE"><i class="fa-thin fa-boxes-packing mr-2"></i>Lista de Empaque</button></td>'+
        '</tr>';
    tabla.append(htmlTags);
}

function validaLE(remitente, destinatario){
    $(".tablaDoc td").each(function() {
        if (remitente != destinatario) {
            $('.btnLE').attr("disabled", true);
        }
    });
}
