$(document).ready(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Abre modal para nueva orden
    $('.btn-nuevaorden').on('click', function(){
        $("#m-orden").modal({backdrop: 'static'});
        $("#txtembarque_ordenmodal").val($("#txtnoembarque_orden").val());
    });

    //Abre modal para nuevo remitente
    $('.btnAddRemitter').on('click', function(){
        $("#mTcremitter").modal({backdrop: 'static'});
    });

    //Valida remitente y destinatario
    // $("#txtremitente").on("change", function(){
    //     var remitente = $("#txtremitente option:selected").text();
    //     var idremitente = $("#txtremitente option:selected").val();
    //     $("#txtdestinatario_input").val(remitente);
    //     $("#txtiddestinatario_input").val(idremitente)
    // })

    // $("#txtdestinatario").on("change", function(){
    //     var iddestinatario = $("#txtdestinatario option:selected").val();
    //     $("#txtiddestinatario_input").val(iddestinatario)
    // })


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
        $("#tableRemittersBody tr").remove();
    });

    //cierra modal mover ordenes
    $('.btnCerrarMoveOrdenes').on('click', function(){
        $("#m-moverorden").modal('hide');
    });

    //se marcan y desmarcan todos los checkbox
    $(".chkboxFullOrdenes").on("change", function(){

        if($(this).is(':checked')){
            $(".chkboxOrden").attr('checked',true);
            $(".chkboxOrden").prop("checked", true);
            // $('.btnEtiquetaResumen').prop('disabled',$('.chkboxOrden:checked').length == 0);
            $('.btnMoveOrden').prop('disabled',$('.chkboxOrden:checked').length == 0);
        }
        else{
            $(".chkboxOrden").removeAttr('checked');
            $(".chkboxOrden").prop("checked", false);
            // $('.btnEtiquetaResumen').prop('disabled',$('.chkboxOrden:checked').length == 0);
            $('.btnMoveOrden').prop('disabled',$('.chkboxOrden:checked').length == 0);
        }
    });

    //marcar checkbox de cada fila clickeada
    $(".tablelistadoordenes tbody").on("click",".chkboxOrden",function(){
        var row = $(this).parents('tr');

        if($(this).is(':checked')){
            $(this).attr('checked',true);
            $('.btnMoveOrden').prop('disabled',$('.chkboxOrden:checked').length == 0);
        }
        else{
            $(this).attr('checked',false);
            $('.btnMoveOrden').prop('disabled',$('.chkboxOrden:checked').length == 0);
        }
    });

     //CARGA EL COMBO EMBARQUE DEL MODULO ORDENES SEGUN EL AÑO SELECCIONADO
     $("#txtanno_embarque").on("change", function(){
        var anno = $("#txtanno_embarque option:selected").text();
        var embarque = $("#txtnoembarque_orden");
        embarque.empty();
        $("#tableordenesBody tr").remove();
        $.ajax({
            url: "getEmbarquesCombo",
            type: 'POST',
            data:{
                anno:anno
            },
            success: function (response) {
                $.each(response.data, function (key, value) {
                    embarque.append("<option value='" + value + "'>" + value + "</option>");
                });
            },
            error: function () {
                alert('Hubo un error obteniendo los embarques!');
            }
        });
    });

   //Muestra las ordenes asociadas a cada embarque
   $("#txtnoembarque_orden").on("change",function(){

        if($.trim($("#txtnoembarque_orden option:selected").text()) != ''){

            $("#creaNorden").removeAttr("disabled");
            $("#leyendafooterlistadoordenes").html("");

            $(".table-listadoProductosBody tr").remove();
            $(".tablanewprodBody tr").remove();
            $(".orden-nuevoproducto").attr("hidden",true);

            $("#txtproducto").prop('selectedIndex',0);
            $("#txtproducto option:selected").text('');
            $("#txtproducto option:selected").val('');
            $("#txtarticulo").val('');
            $("#txtcategoria").val('');
            $("#txtumedida").val('');
            $("#txtcantidad").val('');
            $("#txtmcubico").val('');
            $("#txtmcubicokg").val('');
            $("#txtlargom3").val('');
            $("#txtaltom3").val('');
            $("#txtanchom3").val('');
            $("#txtvaduana").val('');
            $("#txtpesokg").val('');
            $("#ow").prop("checked", false);
            $("#btnCalculaM3").removeAttr("disabled");

            var noembarque = $.trim($("#txtnoembarque_orden option:selected").text());
            showOrdenes(noembarque);
        }
    });

    //Abre modal para editar ordenes
    $(".tablelistadoordenes tbody").on("click",".btn-editorden",function(){
        var row = $(this).parents('tr');

        $("#m-orden").modal({backdrop: 'static'});
        $("#txtembarque_ordenmodal").val($("#txtnoembarque_orden").val());
    });

    //carga remitente desde id
    $("#txtRemitterId").on("focusout", function(){
        var id = $(this).val();
        $.get("getId",{param: id}, function(response){
            if(response.idremitter != undefined){

                $(".inputremdest").prop("disabled",true);
                var message="El remitente "+response.name+" "+response.lastnamep+" "+response.lastnamem+" ya existe";
                var title="Informacion!!!";
                var window="informacion"
                var error ='';
                var reload = false
                showMessage(message,error,title,reload,window);
            }
            else{
                $(".inputremdest").removeAttr("disabled");
                $("#txtRemitterName").trigger("focus");
            }
        })
    })

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

        // if(noembarque !="" && estado =='PENDIENTE'){
            //$(".embarque-datalle").attr("hidden", true);
            $(".orden-datalle").attr("hidden",false);
            $(".orden-nuevoproducto").attr("hidden",true);
            $(".txtnoorden_prod").val(noorden);
            $(".txtnoembarque_prod").val(noembarque);
            $(".txtdest_prod").val(destinatario);
            $(".btn-nuevoproducto").removeAttr("disabled");
            $(".btn-cargos").removeAttr("disabled");

            $("#txtproducto").prop('selectedIndex',0);
            $("#txtproducto option:selected").text('');
            $("#txtproducto option:selected").val('');
            $("#txtarticulo").val('');
            $("#txtcategoria").val('');
            $("#txtumedida").val('');
            $("#txtcantidad").val('');
            $("#txtmcubico").val('');
            $("#txtmcubicokg").val('');
            $("#txtlargom3").val('');
            $("#txtaltom3").val('');
            $("#txtanchom3").val('');
            $("#txtvaduana").val('');
            $("#txtpesokg").val('');
            $("#ow").prop("checked", false);
            $("#btnCalculaM3").removeAttr("disabled");

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
                            agregarFilaProdOrden(response.noproducto,response.cantidad,response.mcubico,response.vaduana,response.pesokg,response.mguia_bl);
                        });
                    }
                });
            }
        // }
        // else{
        //     var message="Esta orden ya esta confirmada o no se ha seleccionado el embarque";
        //     var title="Atencion !!!";
        //     var error ='';
        //     var reload = false
        //     var win="error"
        //     showMessage(message,error,title,reload,win);
        // }

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

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var tipoenvio = $("#txttipoenvio option:selected").text();

        $("#txtrem_nomb").val('');
        $("#txtdestinatario_input").val('');

        $.ajax({
            type: "POST",
            url: "listaremitentes_remitters",
            data:{
                tipoenvio:tipoenvio.substr(1,3)
            },
            success:function(response){
                $("#tableRemittersBody tr").remove();
                var jsonResults = JSON.parse(response);
                $.each(jsonResults.data, function( index, response ){
                    agregarFilaRemitters(response.id,response.number,response.name,response.lastnamep,response.lastnamem,response.identify);
                });
            }
        });

        if( tipoenvio.substr(1,3) == "ENA" || tipoenvio.substr(1,3) == "MNJ"){
            $(".btnAddRemitter").attr("disabled", true);
            $(".btnAddReceiver").removeAttr("disabled");
            $("#btn_DesRem").removeAttr('hidden');
            $("#btn_dest").attr('hidden', true);
        }
        else{
            $(".btnAddRemitter").removeAttr("disabled");
            $(".btnAddReceiver").removeAttr("disabled");
            $("#btn_DesRem").attr('hidden',true);
            $("#btn_dest").removeAttr('hidden');
        }
    });

    //abre modal de remitentes y destinatario desde el modal de nueva orden
    $(".btnAddReceiver").on("click", function(){
        $(".formRemDest").trigger("reset");
        $("#mRemDest").modal({backdrop: 'static'});
    });

    //Busca las ordenes emitidas, facturadas y pendientes por facturar
    $("#btn-fbuscarO").on("click",function(e){
        e.preventDefault();
        var nodoc= $("#txtnodocOrden").val();
        var estadof = $("#txtfestado option:selected").text();
        var estado_orden = $("#txtfestadoO option:selected").text();
        var embarque = $.trim($("#txtnoembarquelo option:selected").text());
        var doc;

        if(nodoc == ''){
            doc="SN";
        }
        else{
            doc=nodoc
        }

        $("#btnFacturaOrdenExcel").attr("href","http://gloshima.localhost/excelof/"+embarque+"/"+doc+"/"+estadof+"/"+estado_orden+"");

        $(".tablaListadoFacturaOrdenBody tr").remove();
        $.ajax({
            type: "post",
            url: "listaordenes",
            data: {
                nodoc: doc,
                estadof:estadof,
                estadoo:estado_orden,
                embarque:embarque
            },
            success: function (response) {
                var jsonResults = JSON.parse(response);

                if(jsonResults.success == true){

                    $.each(jsonResults.data, function( index, response ){
                        cargaListaOrdenFactura(response.embarque,response.nomfto,response.master,response.noorden,response.fechaorden,response.remitente,response.consignatario,response.nofactura,response.totalfacturado,response.estadofactura,response.estadoorden);
                    });
                    $(".ctdadOrden").html(jsonResults.cantidad);
                    $(".ordenFact").html(jsonResults.ctdfacturada);
                    $(".ordenPdtFact").html(jsonResults.ctdPdtefactura);
                }
                else{
                    var message="No existen ordenes asociadas a los filtros de busqueda";
                    var title="Atencion";
                    var error ='';
                    var win = 'informacion';
                    var reload=false;
                    showMessage(message,error,title,reload,win);

                    $(".ctdadFact").html(jsonResults.cantidad);
                    $(".factEmit").html(jsonResults.ctEmitida);
                    $(".factCancel").html(jsonResults.ctCancelada);
                    $(".importe").html(jsonResults.totalfact);
                }
            }
        });
    });

    //Carga remitente de la tabla a los campos
    $(".tableRemitters tbody").on("dblclick",".rowtdremitters",function(){

        $("#tableRemittersBody tr").css("background","white");

        var tipoenvio = $("#txttipoenvio option:selected").text();
        var row = $(this).parents('tr');

        row.css("background","#f2f2f1");

        if(tipoenvio.substr(1,3) == "ENA" || tipoenvio.substr(1,3) == "MNJ"){
            $("#txtrem_nomb").val(row.data("name").concat(" ",row.data("lastnamep")," ",row.data("lastnamem")));
            $("#txtremittersid").val(row.data("id"));
            $("#txtdestinatario_input").val(row.data("name").concat(" ",row.data("lastnamep")," ",row.data("lastnamem")));
            $("#txtiddestinatario_input").val(row.data("id"));
        }
        else{
            if(row.data("tabla") == "REMITENTE"){
                $("#txtrem_nomb").val(row.data("name").concat(" ",row.data("lastnamep")," ",row.data("lastnamem")));
                $("#txtremittersid").val(row.data("id"));
            }
            else{
                $("#div_destinput").removeAttr("hidden");
                $("#txtdestinatario_input").val(row.data("name").concat(" ",row.data("lastnamep")," ",row.data("lastnamem")));
                $("#txtiddestinatario_input").val(row.data("id"));
            }
        }
    });

    //Carga el modulo ordenes a embarcar
    $("#txtembarqueconf").on("change", function(){
        var opcion="2";
        var embarque=$.trim($("#txtembarqueconf option:selected").text());
        getOrdenes(embarque,opcion);
    });

    //busca registros en la tabla ordenes_factura
    $("#findTablaFactOrden").on("keyup", function() {
        var tabla = $(".tablaListadoFacturaOrdenBody tr");
        var query = $("#findTablaFactOrden").val();
        buscarEnTabla(query,tabla);
    });

    //busca registros en la tabla remitentes
    $("#findTablaRemitter").on("keyup", function() {
        var tabla = $("#tableRemittersBody tr");
        var query = $("#findTablaRemitter").val();
        buscarEnTabla(query,tabla);
    });
});

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

    var action = $(".urlgetordenes").attr("href");
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

                    // Parse Data
                var jsonResults = JSON.parse(obj);

                $("#tableordenesBody tr").remove();

                if(jsonResults.data == ''){
                    $("#leyendaOrdenes").removeAttr("hidden");
                }
                else{
                    $("#leyendaOrdenes").attr("hidden", true);
                    $.each(jsonResults.data , function( index, obj ) {
                        // agregarFilaOrdenes(obj.no_orden,obj.fecha,obj.remitente,obj.nombre,obj.apellidop,obj.apellidom,obj.estado);
                        agregarFilaOrdenes(obj.no_orden,obj.fecha,obj.remitente,obj.nombre,obj.apellidop,obj.apellidom,obj.estado,obj.mguia_bl);
                        validaDeleteOrden(obj.estado);
                        validaEROrdenes(obj.no_orden);
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

function agregarFilaOrdenes(noorden,fecha,remitente,nombre,apellidop,apellidom,estado,mguiabl) {

    var htmlTags = '<tr data-noorden="'+noorden+'"data-fecha="'+fecha+'" data-remitente="'+remitente+'" data-nombre="'+nombre+'" data-apellidop="'+apellidop+'" data-apellidom="'+apellidom+'" data-estado="'+estado+'" data-mguiabl="'+mguiabl+'">'+
        '<td class="rowtdorden" style="width: 40px; text-align: center"><input type="checkbox" class="chkboxOrden"></td>'+
        '<td class="rowtdorden">'+noorden+'</td>'+
        '<td class="rowtdorden">'+fecha.substr(0,10)+'</td>'+
        '<td class="rowtdorden">'+remitente+'</td>'+
        '<td class="rowtdorden">'+nombre+" "+apellidop+" "+apellidom+'</td>'+
        '<td class="rowtdorden">'+estado+'</td>'+
        '<td class="rowtdorden" hidden>'+mguiabl+'</td>'+
        '<td class="rowtdorden" style="text-align:right"><button type="button" class="btn-etiqueta btn btn-sm rounded ml-1 mr-auto btnEtiqueta btnEtiquetaResumen"><i class="fas fa-file-pdf mr-1" data-toggle="tooltip" title="Etiqueta General"></i></button><button type="button" class="btn btn-sm mr-auto btn-secondary btn-editorden disabled"><i class="fas fa-edit"></i><button class="btn btn-sm btn-outline-danger ml-1 mr-auto btn-cancelarorden"><i class="fas fa-trash-alt mr-1" data-toggle="tooltip" title="Eliminar"></i></button></td>'+
        '</tr>';
    $('.tablelistadoordenes tbody').append(htmlTags);
}

function agregarFilaProdOrden(noproducto,cantidad,mcubico,vaduana,pesokg,mguiabl){

    var htmlTags = '<tr data-noproducto="'+noproducto+'"data-cantidad="'+cantidad+'" data-mcubico="'+mcubico+'" data-vaduana="'+vaduana+'" data-pesokg="'+pesokg+'" data-mguiabl="'+mguiabl+'">'+
           '<td class="rowtdproductoorden">'+noproducto+'</td>'+
           '<td class="rowtdproductoorden">'+cantidad+'</td>'+
           '<td class="rowtdproductoorden">'+mcubico.toFixed(5)+'</td>'+
           '<td class="rowtdproductoorden">'+vaduana.toFixed(2)+'</td>'+
           '<td class="rowtdproductoorden">'+pesokg.toFixed(3)+'</td>'+
           '<td class="rowtdproductoorden" hidden>'+mguiabl+'</td>'+
           '<td class="rowtdproductoorden" style="text-align:center"><button type="button" class="btn-etiqueta btn btn-sm rounded m-auto btnEtiqueta"><i class="fas fa-file-pdf mr-1"></i>Etiquetas</button></td>'+
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

function cargaListaOrdenFactura(noemb,nomfto,nodoc,noorden,fechaorden,remitente,consignatario,nofactura,totalfacturado,estado_factura,estado_orden){
    var htmlTags = '<tr data-noemb="'+noemb+'" data-nomfto="'+nomfto+'" data-nodoc="'+nodoc+'" data-noorden="'+noorden+'" data-fechaorden="'+fechaorden+'" data-remitente="'+remitente+'" data-consignatario="'+consignatario+'" data-nofactura="'+nofactura+'" data-totalfacturado="'+totalfacturado+'" data-estado_factura="'+estado_factura+'" data-estado_orden="'+estado_orden+'">'+
        '<td class="celdachkbox"><input type="checkbox" class="chkboxItemF" disabled></td>'+
        '<td class="tdnoemb">'+noemb+'</td>'+
            '<td class="nomfto">'+nomfto+'</td>'+
            '<td class="nodoc">'+nodoc+'</td>'+
            '<td class="noorden">'+noorden+'</td>'+
            '<td class="fechaorden">'+moment(fechaorden).format('DD/MM/YYYY')+'</td>'+
            '<td class="remitente">'+remitente+'</td>'+
            '<td class="consignatario">'+consignatario+'</td>'+
            '<td class="nofactura">'+nofactura+'</td>'+
            '<td class="totalfacturado">'+totalfacturado+'</td>'+
            '<td class="estado_factura">'+estado_factura+'</td>'+
            '<td class="estado_orden">'+estado_orden+'</td>'+
            '</tr>';
    $('.tablaListadoFacturaOrden tbody').append(htmlTags);
}

function agregarFilaRemitters(id,number,name,lastnamep,lastnamem,tabla){
    var htmlTags = '<tr data-id="'+id+'"data-number="'+number+'" data-name="'+name+'" data-lastnamep="'+lastnamep+'" data-lastnamem="'+lastnamem+'" data-tabla="'+tabla+'">'+
           '<td class="rowtdremitters" hidden>'+id+'</td>'+
           '<td class="rowtdremitters">'+number+'</td>'+
           '<td class="rowtdremitters">'+name+'</td>'+
           '<td class="rowtdremitters">'+lastnamep+'</td>'+
           '<td class="rowtdremitters">'+lastnamem+'</td>'+
           '<td class="rowtdremitters">'+tabla+'</td>'+
           '</tr>';
    $('#tableRemitters tbody').append(htmlTags);
}

function validaDeleteOrden(estado){
    $(".tablelistadoordenes td").each(function() {
        if (estado=='CONFIRMADO') {
            $('.btn-cancelarorden').attr("disabled", true);
        }
    });
}

function validaEROrdenes(noorden){
    $(".tablelistadoordenes td").each(function() {
        if(noorden.substr(0,3) == 'ENA'){
            $('.btnEtiquetaResumen').attr("enabled", true);
        }
        else{
            $('.btnEtiquetaResumen').removeAttr("disabled");
            $('.btnEtiquetaResumen').attr("enabled",true);
        }
    });
}



