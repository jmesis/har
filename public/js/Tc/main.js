$(document).ready(function(){
    $(".inputremdest").prop("disabled",true);

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
        var provincia = $("#txtprov option:selected").text();

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

    $("#txtmcpio").on("change", function(){
        var mcpio = $("#txtmcpio option:selected").text();

        if($.trim(mcpio) !=''){
            $.get("cp",{param: mcpio}, function(response){
                $("#txtcp").empty();
                $("#txtcp").append("<option value=''></option>")

                $.each(response, function(index,value){
                    $("#txtcp").append("<option value="+value+">"+value+"</option>");
                })
            })
        }
    })

    //carga combo articulos desde el combo capitulo
    $("#txtmcapitulo").on("change", function(){
        var nocapitulo = $(this).val();

        if($.trim(nocapitulo) !=''){
            $.get("articulos",{param: nocapitulo}, function(response){
                $("#txtmarticulo").empty();
                $("#txtmarticulo").append("<option value=''></option>");

                $.each(response, function(index,value){
                    $("#txtmarticulo").append("<option value="+index+">"+value+"</option>");
                })
            })
        }
    })

    //carga cliente desde ci
    $("#txtci").on("focusout", function(){
        var ci = $(this).val();
        $.get("getCi",{param: ci}, function(response){
            console.log(response.municipio);
            if(response.ci != undefined){
                $(".inputremdest").prop("disabled",true);
                var message="El cliente "+response.nombre+" ya existe";
                var title="Informacion!!!";
                var window="informacion"
                var error ='';
                var reload = false
                showMessage(message,error,title,reload,window);
            }
            else{
                $(".inputremdest").removeAttr("disabled");
                $("#txtpassport").trigger("focus");
            }
        });
    });

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
        $("#btnUpdateCont").attr("hidden", true);
        $("#btnSaveCont").removeAttr("hidden");
        $("#titletipocont").html("Nuevo Tipo de Contenedor");
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
        $("#clientename").val("");
        $("#clientedir").html("");
        $("#btnUpdateCliente").attr("hidden", true);
        $("#btnSaveCliente").removeAttr("hidden");
        $("#titulocliente").html("Nuevo Cliente");
    });

    //cierra modal de remitter
    $("#btnCloseRemitter").on("click", function(){
        $("#mTcremitter").modal('hide');
        $(".formTcremitter").trigger("reset");
        $(".inputremitter").removeClass("error");
        $(".inputremitter").prop("disabled",true);
        $(".error").removeClass("error");
        $("#btnUpdateRemitter").attr("hidden", true);
        $("#btnSaveRemitter").removeAttr("hidden");
        $("#title-mremitter").html("Nuevo Cliente");
        $("#txtRemitterId").removeAttr("disabled");
    });

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
        $("#buque").show();
        $("#buquetxt").attr("hidden",true);
        $("#titleviaje").html("Nuevo Viaje");
        $("#btnUpdateViaje").attr("hidden", true);
        $("#btnSaveViaje").removeAttr("hidden");
    })

    //abre modal para Remitentes y Destinatarios
    $(".btnAddRemDest").on("click",function(e){
        $(".formRemDest").trigger("reset");
        $("#mRemDest").modal({backdrop: 'static'});
    })

    //cierra el modal para Remitentes y Destinatarios
    $("#btnCloseRemDest").on("click",function(){
        $("#mRemDest").modal('hide');

        // $(".formRemDest").trigger("reset");
        $(".inputremdest").removeClass("error");
        $(".error").removeClass("error");
        $("#btnUpdateRemDest").attr("hidden",true);
        $("#btnSaveRemDest").removeAttr("hidden");
        $("#title-mremdest").html("Nuevo Cliente");
        $(".inputremdest").prop("disabled",true);
        $("#txtci").removeAttr("disabled");
        // $("#txtprov").empty();
        $("#txtmcpio").empty();
        $("#txtcp").empty();
    });

    //Abre modal Productos
    $('.btnAddItemProd').on('click', function(){
        $("#mItemProd").modal({backdrop: 'static'});
    });

    //Cierra Modal Productos
    $('.btnCloseItemProd').on('click', function(){
        $("#mItemProd").modal("hide");
        $("#formmItemProd").trigger("reset");

        $("#title-mitemprod").html("Nuevo Producto");
        $("#btnUpdateItemProd").attr("hidden",true);
        $("#btn-guardaItemProd").removeAttr("hidden");
    });

    //Abre modal Cargos
    $('.btnAddItemCargo').on('click', function(){
        $("#mItemCargo").modal({backdrop: 'static'});
    });

    //Cierra Modal Cargos
    $('#btnCloseItemCargo').on('click', function(){
        $("#mItemCargo").modal("hide");
        $("#formmItemCargo").trigger("reset");

        $("#title-mitemcargo").html("Nuevo Cargo");
        $("#btnUpdateItemCargo").attr("hidden",true);
        $("#btn-guardaItemCargo").removeAttr("hidden");
    });

    //Cierra modal tipo cobro
    $("#btnCloseTipocobro").on("click", function(){
        $("#mTipocobro").modal("hide");
        $("#formTipocobro").trigger("reset");

        $("#title-mTipocbro").html("Actualizar registro");
        $("#btnUpdateTipocobro").attr("hidden",false);
        $("#btnCreaTipocobro").attr("hidden",true);
    });

    //Abre modal para tipos de cambio y moneda
    $("#btnAddMoneda").on("click", function(){
        $("#mMoneda").modal({backdrop: 'static'});

        $("#txtmoneda").removeAttr("disabled");
        $("#txtipocambio").removeAttr("disabled");
        $("#txtfinicioMoneda").removeAttr("disabled");
        $("#txtffinMoneda").removeAttr("disabled");
        $("#btnUpdateMoneda").attr("hidden",true);
        $("#btnSaveMoneda").removeAttr("hidden");
    })

    //Cierra modal para tipos de cambio y moneda
    $("#btnCloseMoneda").on("click", function(){
        $("#mMoneda").modal("hide");
        $("#formMoneda").trigger("reset");
        $("#txtmoneda").attr("disabled", true);
        $("#txtipocambio").attr("disabled", true);
        $("#txtfinicioMoneda").attr("disabled", true);
        $("#txtffinMoneda").attr("disabled", true);
        $("#btnUpdateMoneda").attr("hidden",true);
        $("#btnSaveMoneda").removeAttr("hidden");
    })

    //Cierra paneles tablas de control
    $(".btncerrar-producto").on("click", function(){
        $(".tablacontrol-producto").attr("hidden", true);
    });

    $("#btn-closeRemdest").on("click", function(){
        $(".tablacontrol-cliente").attr("hidden", true);
    });

    $("#btn-closeCliente").on("click", function(){
        $(".tablacontrol-cliente").attr("hidden", true);
        $("#")
    });

    $("#btn-closeCont").on("click", function(){
        $(".tablacontrol-tipocontenedor").attr("hidden", true);
    });

    $("#btn-closeBuque").on("click", function(){
        $(".tablacontrol-buque").attr("hidden", true);
    });

    $(".btncerrar-viaje").on("click", function(){
        $(".tablacontrol-viaje").attr("hidden", true);
    });
})
