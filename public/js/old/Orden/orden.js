$(document).ready(function(){

    //Abre modal para nueva orden
    $('.btn-nuevaorden').on('click', function(){
        $("#m-orden").modal({backdrop: 'static'});
        $("#txtembarque_ordenmodal").val($("#txtnoembarque_orden").val());
    })

    //Valida remitente y destinatario
    $("#txtremitente").on("change", function(){
        var remitente = $("#txtremitente option:selected").text();
        var idremitente = $("#txtremitente option:selected").val();
        $("#txtdestinatario_input").val(remitente);
        $("#txtiddestinatario_input").val(idremitente)
    })

    $("#txtdestinatario").on("change", function(){
        var iddestinatario = $("#txtdestinatario option:selected").val();
        $("#txtiddestinatario_input").val(iddestinatario)
    })


    //Cierra listado de ordenes
    $(".btncerrar-embarquedetalle").on("click", function(){
        // $(".embarque_principal").attr("hidden",false);
        $(".embarque-datalle").attr("hidden", true);
        $(".orden-datalle").attr("hidden",true);
        $(".orden-nuevoproducto").attr("hidden",true);
    })

    //Cierra panel ordenes a confirmar
    $(".btncerrar-listadoOrdenConfirmada").on("click", function(){
        $(".listadoOrdenConfirmada").attr("hidden",true);
        $("#btnTransferOrden").attr("disabled",true);
    });

    //Cierra modal ordenes
    $('.btn-closeorden').on('click', function(){
        $("#m-orden").modal('hide');
        $(".formOrden").trigger("reset");
        $("#div_remselect").attr("hidden",true);
        $("#div_destinput").attr("hidden",true);
        $("#div_reminput").attr("hidden",true);
        $("#div_destselect").attr("hidden",true);
    })

   //Muestra las ordenes asociadas a cada embarque
   $("#txtnoembarque_orden").on("change",function(){

        if($.trim($("#txtnoembarque_orden option:selected").text()) != ''){

            $("#creaNorden").removeAttr("disabled");
            $("#leyendafooterlistadoordenes").html("");

            var noembarque = $.trim($("#txtnoembarque_orden option:selected").text());
            var action = $("#urlgetordenes").attr("href");
            var method = 'GET';
            var url = action+"/"+noembarque;

            $.ajax({
                type:method,
                url:url,
                success:function(obj, status, error){
                    if(status=="success"){

                        var jsonResults = JSON.parse(obj);

                        $("#tableordenesBody tr").remove();

                        if(jsonResults.data == ''){
                            $("#leyendaOrdenes").removeAttr("hidden");
                        }
                        else{
                            $("#leyendaOrdenes").attr("hidden", true);
                            $.each(jsonResults.data , function( index, obj ) {
                                agregarFilaOrdenes(obj.no_orden,obj.fecha,obj.remitente,obj.nombre,obj.apellidop,obj.apellidom,obj.estado);

                            });
                        }
                    }
                },
                error:function(obj){
                    var sms = obj.message;
                    $(".msgsession").removeAttr("hidden");
                    $(".msg").html(sms).fadeOut( 1000 );
                }
            });
        }
    });



    //Muestra los productos asociados a cada orden
    $(".tablelistadoordenes tbody").on("dblclick",".rowtdorden",function(){

        $("#tableordenesBody tr").css("background","white");

        var row = $(this).parents('tr');

        row.css("background","#f2f2f1");

        var noorden = (row.data("noorden"));
        var estado = (row.data("estado"));
        var fecha = (row.data("fecha"));
        var nombre = (row.data("nombre"));
        var apellidop = (row.data("apellidop"));
        var apellidom = (row.data("apellidom"));
        var noembarque = $(".txtnoembarque_orden").val();
        var destinatario = nombre+" "+apellidop+" "+apellidom;

        if(noembarque !="" && estado =='PENDIENTE'){
            //$(".embarque-datalle").attr("hidden", true);
            $(".orden-datalle").attr("hidden",false);
            $(".orden-nuevoproducto").attr("hidden",true);
            $(".txtnoorden_prod").val(noorden);
            $(".txtnoembarque_prod").val(noembarque);
            $(".txtdest_prod").val(destinatario);
            $(".btn-nuevoproducto").removeAttr("disabled");
            $(".btn-cargos").removeAttr("disabled");

            if($.trim(noorden) !=''){
                $.ajax({
                    type: "POST",
                    url: "listaproductoorden",
                    data:{
                        noorden:noorden
                    },
                    success:function(response){
                        $(".table-listadoProductosBody tr").remove();
                        var jsonResults = JSON.parse(response);
                        $.each(jsonResults.data, function( index, response ){
                            agregarFilaProdOrden(response.noproducto,response.cantidad,response.mcubico,response.vaduana,response.pesokg);
                        });
                    }
                });
            }
        }
        else{
            var message="Esta orden ya esta confirmada o no se ha seleccionado el embarque";
            var title="Atencion !!!";
            var error ='';
            var reload = false
            var win="error"
            showMessage(message,error,title,reload,win);
        }

    });

    //Mueve las ordenes pendientes de un embarque a otro
    $("#txtembarquenuevo").on("change", function(){
        var valor = $("#txtembarquenuevo option:selected").text();

        if(valor.length != 1){
            $("#btnTransferOrden").removeAttr("disabled");
        }
        else{
            $("#btnTransferOrden").attr("disabled",true);
        }
    });

    //Valida nueva orden
    $("#txttipoenvio").on("change", function(){

        var tipoenvio = $("#txttipoenvio option:selected").text();

        if( tipoenvio.substr(1,3) == "ENA" || tipoenvio.substr(1,3) == "MNJ"){
            $("#div_remselect").removeAttr("hidden");
            $("#div_destinput").removeAttr("hidden");
            $("#txtdestinatario_input").attr("disabled",true);

            $("#div_reminput").attr("hidden",true);
            $("#div_destselect").attr("hidden",true);

            $("#txtremitente").removeClass("valid");
            //$("#txtremitente").addClass("error");

            $("#txtdestinatario").prop('selectedIndex',0);
            $("#txtrem_nomb").val('');
            $("#txtrem_apellp").val('');
            $("#txtrem_apellm").val('');
            $("#txtrem_nomb").addClass("valid");
            $("#txtrem_nomb").attr("aria-invalid", false);
            $("#txtrem_apellp").addClass("valid");
            $("#txtrem_apellp").attr("aria-invalid", false);
            $("#txtrem_apellm").addClass("valid");
            $("#txtrem_apellm").attr("aria-invalid", false);
            $("#txtdestinatario_input").addClass("valid");
            $("#txtdestinatario_input").attr("aria-invalid", false);

            $("#txtiddestinatario_input").addClass("valid");
            $("#txtiddestinatario_input").attr("aria-invalid", false);


        }
        else{
            $("#div_reminput").removeAttr("hidden");
            $("#div_destselect").removeAttr("hidden");

            $("#div_remselect").attr("hidden", true);
            $("#div_destinput").attr("hidden", true);

            $("#txtremitente").prop('selectedIndex',0);
            $("#txtdestinatario-input").val('');

            $("#txtiddestinatario_input").addClass("valid");
            $("#txtiddestinatario_input").attr("aria-invalid", false);
        }
    });

    //Carga el modulo ordenes a embarcar
    $("#txtembarqueconf").on("change", function(){

        var embarque=$.trim($("#txtembarqueconf option:selected").text());
        getOrdenes(embarque);
    });
})

//Funciones
function getOrdenes(embarque){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "post",
        url: "listaordenestoembarque",
        data: {
            embarque: embarque
        },
        success: function (response) {
            var jsonResults = JSON.parse(response);

            if(jsonResults.success == true){

                var count_register=0;
                var count_pdte=0;
                var count_ready=0;
                $(".TablaListaOrdenConfirmadaBody tr").remove();
                $('.TablaListaOrdenPdteBody tr').remove();
                $.each(jsonResults.data, function( index, response ){

                    if(response.ci != null ){
                        if(response.estado == "EN ALMACEN"){
                            var tabla_en_almacen = $('.tablaListadoOrdenes tbody');
                            agregarFilaListadoOrdenes(response.no_orden,response.no_embarque,response.remitente,response.destinatario,response.codigobarra,response.estado,tabla_en_almacen);
                            count_register++;
                        }
                        if(response.estado == "CONFIRMADO"){
                            var tabla_en_camion = $(".tablaListadoOrdenConfirmada tbody");
                            agregarFilaListadoOrdenes(response.no_orden,response.no_embarque,response.remitente,response.destinatario,response.codigobarra,response.estado,tabla_en_camion);
                            count_ready++;
                        }
                    }
                    else{
                        if(response.ci == null || response.estado =='ALMACEN')
                            var tabla_en_almacen = $('.TablaListaOrdenPdte tbody');
                            agregarFilaListadoOrdenes(response.no_orden,response.no_embarque,response.remitente,response.destinatario,response.codigobarra,response.estado,tabla_en_almacen);
                            count_pdte++;
                    }
                });

                if(count_register){
                    $(".countordenes").html(count_register);
                }
                else{
                    $(".countordenes").html("0");
                }
                if(count_ready){
                    $("#countordenesready").html(count_ready);
                }
                else{
                    $("#countordenesready").html("0");
                }
                if(count_pdte){
                    $(".countordenesPdte").html(count_pdte);
                }
                else{
                    $(".countordenesPdte").html("0");
                }

            }
            else{
                var message="Error, contactar a su administrador";
                var title="Atencion";
                var error ='';
                var win = 'error';
                var reload=false;
                showMessage(message,error,title,reload,win);
            }
        }
    });
}

//Recargar listado de ordenes despues de crear nuevas
function showOrdenes(noembarque){

    $("#txtembarque_ordenmodal").text(noembarque);
    $("#txtembarque_ordenmodal").val(noembarque);

    var action = $("#urlgetordenes").attr("href");
    var method = 'GET';
    var url = action+"/"+noembarque;

    $.ajax({
        type:method,
        url:url,
        data:{
            valor:noembarque
        },
        success:function(obj, status, error){
            if(status=="success"){
                //getPortBooking(data.id,data.country,data.port,data.code)

                    // Parse Data
                var jsonResults = JSON.parse(obj);

                $("#tableordenesBody tr").remove();

                if(jsonResults.data == ''){
                    $("#leyendaOrdenes").removeAttr("hidden");
                }
                else{
                    $("#leyendaOrdenes").attr("hidden", true);
                    $.each(jsonResults.data , function( index, obj ) {
                        /*console.log (obj.idport);
                        console.log (obj.country);*/
                        //,index[0],index[1],index.port,index.code
                        agregarFilaOrdenes(obj.no_orden,obj.fecha,obj.remitente,obj.nombre,obj.apellidop,obj.apellidom,obj.estado);
                        // noorden, fecha, remitente, nombre, apellidop, apellidom, noblhouse, estado

                    });
                }
            }
        },
        error:function(obj){
            var sms = obj.message;
            $(".msgsession").removeAttr("hidden");
            $(".msg").html(sms).fadeOut( 1000 );
        }
    })
}

function agregarFilaOrdenes(noorden,fecha,remitente,nombre,apellidop,apellidom,estado) {

    var htmlTags = '<tr data-noorden="'+noorden+'"data-fecha="'+fecha+'" data-remitente="'+remitente+'" data-nombre="'+nombre+'" data-apellidop="'+apellidop+'" data-apellidom="'+apellidom+'" data-estado="'+estado+'">'+
           '<td class="rowtdorden">'+noorden+'</td>'+
           '<td class="rowtdorden">'+fecha.substr(0,10)+'</td>'+
           '<td class="rowtdorden">'+remitente+'</td>'+
           '<td class="rowtdorden">'+nombre+" "+apellidop+" "+apellidom+'</td>'+
           '<td class="rowtdorden">'+estado+'</td>'+
           '<td class="rowtdorden" style="text-align:right"><button type="button" class="btn btn-sm mr-auto btn-outline-dark btn-facturaorden"><i class="fas fa-lg fa-file-invoice-dollar" data-toggle="tooltip" title="Facturar"></i></button><button class="btn btn-sm btn-outline-danger ml-1 mr-auto btn-cancelarorden"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Eliminar"></i></button><button type="button" class="btn-etiqueta btn btn-sm rounded ml-1 mr-auto btnEtiqueta btnEtiquetaResumen"><i class="fas fa-tags data-toggle="tooltip" title="Etiqueta General"></i></button></td>'+
           '</tr>';
    $('.tablelistadoordenes tbody').append(htmlTags);
}

function agregarFilaProdOrden(noproducto,cantidad,mcubico,vaduana,pesokg){

    var htmlTags = '<tr data-noproducto="'+noproducto+'"data-cantidad="'+cantidad+'" data-mcubico="'+mcubico+'" data-vaduana="'+vaduana+'" data-pesokg="'+pesokg+'">'+
           '<td class="rowtdproductoorden">'+noproducto+'</td>'+
           '<td class="rowtdproductoorden">'+cantidad+'</td>'+
           '<td class="rowtdproductoorden">'+mcubico.toFixed(5)+'</td>'+
           '<td class="rowtdproductoorden">'+vaduana.toFixed(2)+'</td>'+
           '<td class="rowtdproductoorden">'+pesokg.toFixed(3)+'</td>'+
           '<td class="rowtdproductoorden" style="text-align:center"><button type="button" class="btn-etiqueta btn btn-sm rounded m-auto btnEtiqueta"><i class="fas fa-tags mr-1"></i>Etiquetas</button></td>'+
           '</tr>';
    $('.table_listadoproducto tbody').append(htmlTags);
}

function agregarFilaListadoOrdenes(orden,embarque,remitente,destinatario,codigobarra,estado,tabla){

    var htmlTags = '<tr data-orden="'+orden+'" data-embarque="'+embarque+'" data-remitente="'+remitente+'" data-destinatario="'+destinatario+'" data-codigobarra="'+codigobarra+'" data-estado="'+estado+'">'+
           '<td class="rowtdordentoemb">'+orden+'</td>'+
           '<td class="rowtdordentoemb">'+embarque+'</td>'+
           '<td class="rowtdordentoemb">'+remitente+'</td>'+
           '<td class="rowtdordentoemb">'+destinatario+'</td>'+
           '<td class="rowtdordentoemb">'+codigobarra+'</td>'+
           '<td class="rowtdordentoemb">'+estado+'</td>'+
           '</tr>';
    tabla.append(htmlTags);
}



