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

        if($("#txtnoembarque_orden option:selected").text() != ''){

            $("#creaNorden").removeAttr("disabled");
            $("#leyendafooterlistadoordenes").html("");
            $(".orden-datalle").attr("hidden",true);
            $(".orden-nuevoproducto").attr("hidden",true);

            var noembarque = $("#txtnoembarque_orden option:selected").text();
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
                                agregarFilaOrdenes(obj.no_emarque,obj.no_orden,obj.fecha,obj.remitente,obj.nombre,obj.apellidop,obj.apellidom,obj.noblhouse);

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
    })

    //Muestra los productos asociados a cada orden
    $(".tablelistadoordenes tbody").on("dblclick",".rowtdorden",function(){

        $("#tableordenesBody tr").css("background","white");

        var row = $(this).parents('tr');
        row.css("background","mediumturquoise");
        var noorden = (row.data("noorden"));
        var remitente = (row.data("remitente"));
        var fecha = (row.data("fecha"));
        var nombre = (row.data("nombre"));
        var apellidop = (row.data("apellidop"));
        var apellidom = (row.data("apellidom"));
        var noembarque = $(".txtnoembarque_orden").val();
        var destinatario = nombre+" "+apellidop+" "+apellidom;

        if(noembarque !=""){
            // $(".embarque-datalle").attr("hidden", true);
            $(".orden-datalle").attr("hidden",false);
            $(".orden-nuevoproducto").attr("hidden",true);
            $(".txtnoorden_prod").val(noorden);
            $(".txtnoembarque_prod").val(noembarque);
            $(".txtdest_prod").val(destinatario);

            $("#leyendafooterlistadoordenes").html("<strong>ORDEN:</strong> "+noorden+" / <strong>FECHA:</strong> "+fecha.substr(0,10)+" / <strong>REMITENTE:</strong> "+remitente+" / <strong>DESTINATARIO:</strong> "+destinatario);

            if($.trim(noorden) !=''){

                $.get("listaproductoorden",{param: noorden}, function(response){

                    $(".table-listadoProductosBody tr").remove();
                    var jsonResults = JSON.parse(response);
                    $.each(jsonResults.data, function( index, response ){
                        agregarFilaProdOrden(response.noproducto,response.cantidad,response.mcubico,response.vaduana,response.pesokg);
                    })
                })
            }

        }
        else{
            showMessage("No hay un embarque seleccionado","","Error",false);
        }

    })


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
    })
})

//Funciones
function agregarFilaOrdenes(noembarque, noorden, fecha, remitente, nombre, apellidop, apellidom, blhouse) {

    var htmlTags = '<tr data-noorden="'+noorden+'"data-fecha="'+fecha+'" data-remitente="'+remitente+'" data-nombre="'+nombre+'" data-apellidop="'+apellidop+'" data-apellidom="'+apellidom+'" data-blhouse="'+blhouse+'">' +
           '<td class="rowtdorden">' + noorden + '</td>' +
           '<td class="rowtdorden">' + fecha.substr(0,10) + '</td>' +
           '<td class="rowtdorden">' + remitente + '</td>' +
           '<td class="rowtdorden">' + nombre+" "+apellidop+" "+apellidom + '</td>' +
           '<td class="rowtdorden">' + blhouse + '</td>' +
           '</tr>';
    $('.tablelistadoordenes tbody').append(htmlTags);
}

function agregarFilaProdOrden(noproducto,cantidad,mcubico,vaduana,pesokg){

    var htmlTags = '<tr data-noproducto="'+noproducto+'"data-cantidad="'+cantidad+'" data-mcubico="'+mcubico+'" data-vaduana="'+vaduana+'" data-pesokg="'+pesokg+'">' +
           '<td class="rowtdproductoorden">' + noproducto + '</td>' +
           '<td class="rowtdproductoorden">' + cantidad + '</td>' +
           '<td class="rowtdproductoorden">' + mcubico + '</td>' +
           '<td class="rowtdproductoorden">' + vaduana +'</td>' +
           '<td class="rowtdproductoorden">' + pesokg + '</td>' +
           '</tr>';
    $('.table_listadoproducto tbody').append(htmlTags);
}
