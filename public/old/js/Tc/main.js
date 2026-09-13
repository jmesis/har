$(document).ready(function(){

    //Borra registro de la tabla de port
    $("#tableTcPort tbody").on("click",".btnDPort",function(e){
        e.preventDefault();
        var row = $(this).parents('tr');
        row.remove();
    })

    $("#btnCancelCont").on("click",function(){
        $("#formtccontenedor").trigger("reset");
        $("#txttipocont").focus();
    })

    $("#btnAddPort").on("click",function(){

        var pais = $("#txtpais").val().toUpperCase();
        var puerto = $("#txtpuerto").val().toUpperCase();
        var codigo = $("#txtcodigo").val().toUpperCase();

        var idpais = "pais";
        var idpuerto = "puerto";
        var idcodigo = "codigo";

        if(pais != '' && puerto !='' && codigo !=''){
            agregarFila(pais, puerto, codigo,idpais,idpuerto,idcodigo);
            $(".msgsession").attr("hidden",true);
            $("#formtcpuerto").trigger("reset");
            $("#txtpais").focus();
            $("#btnSavePort").removeAttr("hidden");
        }
        else{
            var sms = "No pueden haber campos en blanco";
            $(".msgsession").removeAttr("hidden");
            $(".msg").html(sms);
            $("#txtpais").focus();
        }
    })

    //Carga combo Municipio
    $("#txtprov").on("change", function(){
        var provincia = $(this).val();

        if($.trim(provincia) !=''){
            $.get("mcipio",{param: provincia}, function(response){
                $("#txtmcpio").empty();
                $("#txtmcpio").append("<option value=''></option>")

                $.each(response, function(index,value){
                    $("#txtmcpio").append("<option value="+value+">"+value+"</option>");
                })
            })
        }
    })

    //carga combo articulos desde el combo capitulo
    $("#txtmcapitulo").on("change", function(){
        var idcapitulo = $(this).val();

        if($.trim(idcapitulo) !=''){
            $.get("articulos",{param: idcapitulo}, function(response){
                $("#txtmarticulo").empty();
                $("#txtmarticulo").append("<option value=''></option>");

                $.each(response, function(index,value){
                    $("#txtmarticulo").append("<option value="+index+">"+value+"</option>");
                })
            })
        }
    })

    //abre modal para buque
    $(".btnAddBuque").on("click",function(e){
        $(".formAV").trigger("reset");
        $("#mBuque").modal({backdrop: 'static'});
        $(".txttcbuque").trigger("focus");
    })

    //cierra el modal para buque
    $(".btnCloseBuque").on("click",function(){
        $("#mBuque").modal('hide');
        $(".formAV").trigger("reset");
        $("#lbl-titlebuque").html("Agregar Buque");
        $("#btnUpdateBuque").attr("hidden",true);
        $("#btnSaveBuque").attr("hidden",false);
    })

    //abre modal para contenedor
    $(".btnAddCont").on("click",function(e){
        $(".formTipoCont").trigger("reset");
        $("#mTipoCont").modal({backdrop: 'static'});
        $(".txttipcont").focus();
    })

    //cierra el modal para contenedor
    $(".btnCloseCont").on("click",function(){
        $("#mTipoCont").modal('hide');
        $(".formTipoCont").trigger("reset");
    })

    //abre modal para cliente
    $(".btnAddCliente").on("click",function(e){
        $(".formCliente").trigger("reset");
        $("#mCliente").modal({backdrop: 'static'});
        $(".clientename").focus();
    })

    //cierra el modal para cliente
    $(".btnCloseCliente").on("click",function(){
        $("#mCliente").modal('hide');
        $(".formCliente").trigger("reset");
    })

    //abre modal para viaje
    $(".btnAddViaje").on("click",function(e){
        $(".formViaje").trigger("reset");
        $("#mViaje").modal({backdrop: 'static'});
        $(".viajebuque").focus();
    })

    //cierra el modal para viaje
    $(".btnCloseViaje").on("click",function(){
        $("#mViaje").modal('hide');
        $(".formViaje").trigger("reset");
        $(".buque").show();
        $(".buquetxt").attr("hidden",true);
    })

    //abre modal para Remitentes y Destinatarios
    $(".btnAddRemDest").on("click",function(e){
        $(".formRemDest").trigger("reset");
        $("#mRemDest").modal({backdrop: 'static'});
    })

    //cierra el modal para viaje
    $(".btnCloseRemDest").on("click",function(){
        $("#mRemDest").modal('hide');
        $(".formRemDest").trigger("reset");
    })

    //Abre modal Productos
    $('.btnAddItemProd').on('click', function(){
        $("#mItemProd").modal({backdrop: 'static'});
    })

    //Cierra Modal Productos
    $('.btnCloseItemProd').on('click', function(){
        $("#mItemProd").modal("hide");
        $("#formmItemProd").trigger("reset");

        $("#title-mitemprod").html("Nuevo Producto");
        $("#btnUpdateItemProd").attr("hidden",true);
        $("#btn-guardaItemProd").removeAttr("hidden");
    })

    $(".btncerrar-producto").on("click", function(){
        $(".tablacontrol-producto").attr("hidden", true);
    })
})
