
$(".table_listaitemcargos tbody").on("click", ".btn-deletecargo", function(e){
    e.preventDefault();
    var row = $(this).parents('tr');

    var message="Se eliminara el cargo "+row.data('tipocargo')+".  Estas Seguro?";
    var title="Atencion";
    showMessageDelete(message,title);

    var noorden = row.data("noorden");
    var idcargo=row.data("idcargo");

    var action = $("#urlcargodelete").attr("href");
    var method = 'DELETE';
    var url = action+"/"+idcargo;

    $("#modalDeleteYes").on("click", function(){

        $.ajax({
            type:method,
            url:url,
            data:{
                idcargo:idcargo,
            },
            success:function(data){
                if(data.success=="true"){
                    // row.remove();
                    $("#txttipocargo").prop('selectedIndex',0);
                    $("#txttipopago").prop('selectedIndex',0);
                    $("#txtmoneda").prop('selectedIndex',0);
                    $("#txtimporte").val("");
                    $("#txtumcargos").prop('selectedIndex',0);
                    $("#txtctdad").val("");
                    $("#txttotal").val("");

                    $("#btn-updItemCargos").attr("hidden",true);
                    $("#btn-addItemCargos").removeAttr("hidden");

                    $.ajax({
                        type: "POST",
                        url: "listadoItemCargos",
                        data:{
                            noblhouse:noorden
                        },
                        success:function(response){
                            $(".table_listaitemcargosBody tr").remove();
                            var jsonResults = JSON.parse(response);
                            if(jsonResults.success == true){
                                $.each(jsonResults.data, function( index, response ){
                                    agregarFilaCargos(response.no_orden,response.tipo_cargo,response.tipo_pago,response.moneda,response.importe,response.um,response.ctdad,response.total,response.idtipocargo,response.idpago,response.idmoneda,response.idcargo);
                                });
                            }
                        }
                    });
                }
                else{
                    var sms = data.message;
                    $(".msgsession").attr("hidden",false);
                    $(".msg").html(sms)/*.fadeOut(1000)*/;
                }
            },
            error:function(){
                var sms = "Error, por favor contactar su Administrador de sistema";
                $(".msgsession").attr("hidden",false);
                $(".msg").html(sms).fadeOut(8000);
            }
        })
    });
});
